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

    public function addServers($me,$name,$adminDesc,$ip,$protos){
        foreach($protos as $key=>$val){
            $data = [
                "name" => $name,
                "adminDesc" => $adminDesc,
                "serverConfig" => $this->getServerConfig($name,$ip,$key),
                "serverIP" => $ip,
                "serverHash" => $val,
                "serverProto" => $key
            ];
            $this->db->insert("servers",$data);
            $insert_id = $this->db->insert_id();
            $data = [
                "resellerID" => $me->id,
                "serverID" => $insert_id
            ];
            $this->db->insert("resellerservers",$data);
        }
    }

    private function getServerConfig($serverName,$ip,$proto){
        switch($proto){
            case 'trojan_gRPC':
                return "trojan://{userRandomKey}@" . $ip . ":443?encryption=none&peer=" . $ip . "&security=tls&type=grpc&sni=" . $ip . "&alpn=h2&path=uodltrojangrpc&serviceName=uodltrojangrpc#{userFullName}";
                break;
            case 'VLESS_gRPC':
                return "vless://{userRandomKey}@" . $ip . ":443?encryption=none&security=tls&type=grpc&host=" . $ip . "&path=uodlgrpc&serviceName=uodlgrpc&alpn=h2&sni=" . $ip . "#{userFullName}";
                break;
            case 'VLESS_TCP':
                return "vless://{userRandomKey}@" . $ip . ":443?encryption=none&security=xtls&type=tcp&host=" . $ip . "&headerType=none&sni=" . $ip . "&flow=xtls-rprx-splice#{userFullName}";
                break;
            case 'trojan_TCP':
                return "trojan://{userRandomKey}@" . $ip . ":443?peer=" . $ip . "&sni=" . $ip . "&alpn=http/1.1#{userFullName}";
                break;
            case 'VLESS_WS':
                return "vless://{userRandomKey}@" . $ip . ":443?encryption=none&security=tls&type=ws&host=" . $ip . "&sni=" . $ip . "&path=/uodlws#{userFullName}";
                break;
            case 'VMess_WS':
                return false;
                break;
        }
    }

}