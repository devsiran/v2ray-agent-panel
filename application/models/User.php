<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model{

    public function getActiveUsers($resellerID){
        $this->db->where("resellerid",$resellerID);
        $this->db->where("expireDate>=",date("Y-m-d H:i:s"));
        $res = $this->db->get("users");
        return $res->result();
    }

    public function getDeActiveUsers($resellerID){
        $this->db->where("resellerid",$resellerID);
        $this->db->where("expireDate<",date("Y-m-d H:i:s"));
        $res = $this->db->get("users");
        return $res->result();
    }

    public function newUser($newUserName,$newUserTime,$servers,$reseller,$days){
        if($days<=0){
            return false;
        }
        if($reseller->charge<$days){
            return false;
        }
        $data = [
            "randomKey" => $this->generateRandomString(32),
            "fullName" => $newUserName,
            "resellerid" => $reseller->id,
            "expireDate" => $newUserTime,
            "allowServerList" => json_encode($servers)
        ];
        $this->db->insert("users",$data);
        $insert_id = $this->db->insert_id();
        $this->db->query("update resellers set charge = charge - " . $days . " where id=" . $reseller->id);
        $this->updateUserServers($insert_id,$servers);
        return true;
    }

    public function chargeUser($chargeUserID,$days,$me){
        if($days<=0){
            return false;
        }
        $this->db->where("id", $chargeUserID);
        $this->db->where("resellerid", $me->id);
        $res = $this->db->get("users")->result();
        foreach($res as $row){
            $newDays = date("Y-m-d h:i:s",strtotime($row->expireDate) + intval($days * 60 * 60 * 24));
            $this->db->query("update users set expireDate='" . $newDays . "' where id=" . $row->id);
            $this->db->query("update resellers set charge = charge - " . $days . " where id=" . $me->id);
            return $row;
        }
        return false;
    }

    public function editUser($editUserID,$editUserName,$servers,$me){
        $this->db->where("id", $editUserID);
        $this->db->where("resellerid", $me->id);
        $this->db->update("users",[
            "fullName" => $editUserName,
            "allowServerList" => json_encode($servers)
        ]);
        $this->updateUserServers($editUserID,$servers);
    }

    public function updateUserServers($userid,$serverList){
        $this->db->query("delete from userserver where userID=" . $userid);
        $ins = [];
        foreach($serverList as $s){
            array_push($ins,[
                "userID" => $userid,
                "serverID" => $s
            ]);
        }
        $this->db->insert_batch('userserver', $ins); 
    }

    public function removeUser($removeUserID,$me){
        $this->db->where("id", $removeUserID);
        $this->db->where("resellerid", $me->id);
        $res = $this->db->get("users")->result();
        foreach($res as $row){
            $this->db->query("delete from userserver where userID=" . $row->id);
            $this->db->query("delete from users where id=" . $row->id);
            $days = intval(((strtotime($row->expireDate) - time()) / (60*60*24))*0.7);
            if($days<0){
                $days = 0;
            }
            $this->db->query("update resellers set charge = charge + " . $days . " where id=" . $me->id);
            return [$row,$days];
        }
        return false;
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getAllUsers($rid){
        $this->db->where("resellerid",$rid);
        $this->db->order_by("id","DESC");
        $res = $this->db->get("users");
        return $res->result();
    }

}