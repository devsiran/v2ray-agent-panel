<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends CI_Model{

    public function getAllServers(){
        $q = $this->db->get("servers")->result();
        $res = [];
        foreach($q as $row){
            $res['server_' . $row->id] = $row;
        }
        return $res;
    }

    public function getResellerServers($resellerID){
        $this->db->where("resellerID",$resellerID);
        $res = $this->db->get("resellerservers");
        $s = [];
        foreach($res->result() as $row){
            $t = $this->getServerFromID($row->serverID);
            if($t!=false){
                array_push($s,$t);
            }
        }
        return $s;
    }

    public function getServerFromID($id){
        $this->db->where("id", $id);
        $res = $this->db->get("servers");
        foreach($res->result() as $row){
            return $row;
        }
        return false;
    }

    public function getServerInfoByHash($serverHash){
        $serverHash = urldecode($serverHash);
        $serverHash = json_decode($serverHash);
        $this->db->where_in("serverHash",$serverHash);
        $res = $this->db->get("servers")->result();
        $out = [];
        foreach($res as $s){
            $out[$s->serverProto] = $this->getServerUsers($s->id);
        }
        return $out;
    }

    private function getServerUsers($serverId){
        $res = [];
        $this->db->where("serverID",$serverId);
        $q = $this->db->get("userserver")->result();
        foreach($q as $i){
            $u = $this->getUserByID($i->userID);
            array_push($res,[
                "id" => $u->id,
                "randomKey" => $u->randomKey,
                "fullName" => $u->fullName
            ]);
        }
        return $res;
    }

    private function getUserByID($id){
        $this->db->where("id",$id);
        $q = $this->db->get("users")->result();
        foreach($q as $row){
            return $row;
        }
        return false;
    }

}