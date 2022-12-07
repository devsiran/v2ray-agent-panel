<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reseller extends CI_Model{

    public function getReseller($user,$pass){
        $this->db->where("username",$user);
        $this->db->where("password",$pass);
        $res = $this->db->get("resellers");
        foreach($res->result() as $row){
            return $row;
        }
        return false;
    }

    public function getMyResellers($me){
        $this->db->where("adminid",$me->id);
        $q = $this->db->get("resellers")->result();
        return $q;
    }

    public function createNewResseler($newResellerName,$newResellerPass,$newResellerCharge,$isAdmin,$me){
        $this->db->where("username", $newResellerName);
        $res = $this->db->get("resellers")->result();
        foreach($res as $row){
            return false;
        }
        $data = [
            "username" => $newResellerName,
            "password" => md5($newResellerPass . "_DevsIran51684dw@@"),
            "charge" => intval($newResellerCharge),
            "telegram" => "",
            "adminid" => $me->id,
            "isAdmin" => $isAdmin
        ];
        $this->db->insert("resellers",$data);
        return true;
    }

    public function deleteReseller($me,$deleteId){
        if($me->id == $deleteId){
            return false;
        }
        $this->db->where("adminid",$me->id);
        $this->db->where("id",$deleteId);
        $this->db->delete("resellers");
        return true;
    }

    public function setResellerCharge($me,$chargeId,$newValue){
        $this->db->where("adminid",$me->id);
        $this->db->where("id",$chargeId);
        $data = [
            "charge" => $newValue
        ];
        $this->db->update("resellers",$data);
        return true;
    }

    public function changeResellerPassword($me,$userID,$newValue){
        $this->db->where("adminid",$me->id);
        $this->db->where("id",$userID);
        $data = [
            "password" => $newValue
        ];
        $this->db->update("resellers",$data);
        return true;
    }

}