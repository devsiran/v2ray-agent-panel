<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		require(APPPATH . "/config/dbinfo.php");
		$isOk = false;
		if(!isset($vpndb)){
			if(isset($_POST['dbhost'],$_POST['dbname'],$_POST['dbuser'],$_POST['dbpass'],$_POST['aduser'],$_POST['adpass'])){
				$servername = $_POST['dbhost'];
				$dbname = $_POST['dbname'];
				$username = $_POST['dbuser'];
				$password = $_POST['dbpass'];
				$adminUser = $_POST['aduser'];
				$adminPass = md5($_POST['adpass'] . "_DevsIran51684dw@@");
				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sq = file_get_contents(APPPATH . "/database.sql");
					$conn->exec($sq);
					$stmt = $conn->prepare("INSERT INTO resellers (username, password, charge,isAdmin) VALUES (:username, :password, 9999999, 1)");
					$stmt->bindParam(':username', $adminUser);
					$stmt->bindParam(':password', $adminPass);
					$stmt->execute();
					$res = '<?php

					$vpndb = [
						"username" => "' . $username . '",
						"password" => "' . $password . '",
						"hostname" => "' . $servername . '",
						"database" => "' . $dbname . '",
						"dbdriver"  => "mysqli"
					];';
					file_put_contents(APPPATH . "/config/dbinfo.php",$res);
					$isOk = true;
				} catch(PDOException $e) {
					
				}
			}
			if($isOk){
				exit("<script>window.location=window.location + '?setup=ok';</script>");
				return false;
			}
			else{
				$this->load->view("setup");
				return false;
			}
		}
		$me = $this->check_login();
		if($me == false){
			$this->load->view("login");
		}
		else{
			$canEdit = false;
			$messages = [];
			if(isset($_SESSION['token'],$_REQUEST['token']) && $_REQUEST['token']==$_SESSION['token']){
				$canEdit = true;
			}
			$token = intval(rand(100000,999999));
			$_SESSION['token'] = $token;
			$this->load->model("user");
			$this->load->model("server");
			if(isset($_POST['newUserName'],$_POST['newUserTime'])){
				if($canEdit){
					$newUserName = $_POST['newUserName'];
					$days = intval($_POST['newUserTime']);
					$newUserTime = date("Y-m-d H:i:s",strtotime("+" . $days . " days"));
					if(isset($_POST['servers'])){
						$servers = array_keys($_POST['servers']);
					}
					else{
						$servers = [];
					}
					if($this->user->newUser($newUserName,$newUserTime,$servers,$me,$days)==true){
						$me->charge -= $days;
						array_push($messages,["success","کاربر " . $newUserName . " با موفقیت ایجاد شد."]);
					}
					else{
						array_push($messages,["danger","کاربر ایجاد نشد."]);
					}
				}
				else{
					array_push($messages,["danger","ساخت کاربر به دلایل امنیتی انجام نشد. لطفا مجدد امتحان کنید."]);
				}
			}
			if(isset($_POST['editUserID'],$_POST['editUserName'])){
				if($canEdit){
					$editUserID = $_POST['editUserID'];
					$editUserName = $_POST['editUserName'];
					if(isset($_POST['edit_servers'])){
						$servers = array_keys($_POST['edit_servers']);
					}
					else{
						$servers = [];
					}
					$this->user->editUser($editUserID,$editUserName,$servers,$me);
					array_push($messages,["success","کاربر " . $editUserName . " با موفقیت ویرایش شد."]);
				}
				else{
					array_push($messages,["danger","ویرایش کاربر به دلایل امنیتی انجام نشد. لطفا مجدد امتحان کنید."]);
				}
			}
			if(isset($_POST['removeUser'])){
				if($canEdit){
					$removeUserID = $_POST['removeUser'];
					$res = $this->user->removeUser($removeUserID,$me);
					if($res==false){
						array_push($messages,["danger","کاربر حذف نشد."]);
					}
					else{
						array_push($messages,["success","کاربر " . $res[0]->fullName . " حذف شد و " . $res[1] . " روز به اعتبار شما اضافه شد."]);
						$me->charge += $res[1];
					}
				}
				else{
					array_push($messages,["danger","حذف کاربر به دلایل امنیتی انجام نشد. لطفا مجدد امتحان کنید."]);
				}
			}
			if(isset($_POST['chargeUserTime'],$_POST['chargeUserID'])){
				if($canEdit){
					$chargeUserID = $_POST['chargeUserID'];
					$days = intval($_POST['chargeUserTime']);
					$res = $this->user->chargeUser($chargeUserID,$days,$me);
					if($res==false){
						array_push($messages,["danger","شارژ انجام نشد."]);
					}
					else{
						array_push($messages,["success","حساب کاربری " . $res->fullName . " به مدت " . $days . " روز شارژ شد."]);
						$me->charge -= $days;
					}
				}
				else{
					array_push($messages,["danger","شارژ کاربر به دلایل امنیتی انجام نشد. لطفا مجدد امتحان کنید."]);
				}
			}
			$servers = $this->server->getResellerServers($me->id);
			$allServers = $this->server->getAllServers();
			$panelInfo = [
				"activeUser" => count($this->user->getActiveUsers($me->id)),
				"deactiveUser" => count($this->user->getDeActiveUsers($me->id)),
				"serverCount" => count($servers),
				"servers" => $servers,
				"users" => $this->user->getAllUsers($me->id),
				"allServers" => $allServers
			];
			$this->load->view("dashboard",["me"=>$me,"panelInfo"=>$panelInfo,"token" => $token,"messages"=>$messages]);
		}
	}

	public function admin($page){
		$me = $this->check_login();
		if($me == false){
			$this->load->view("login");
		}
		else if(!$me->isAdmin){
			header("HTTP/1.1 404 Not Found");
		}
		else{
			$canEdit = false;
			$messages = [];
			if(isset($_SESSION['token'],$_REQUEST['token']) && $_REQUEST['token']==$_SESSION['token']){
				$canEdit = true;
			}
			$token = intval(rand(100000,999999));
			$_SESSION['token'] = $token;
			$panelInfo = [];
			if($page=="resellers"){
				$this->load->model("reseller");
				if(isset($_POST['newResellerName'],$_POST['newResellerPass'],$_POST['newResellerCharge'])){
					if($canEdit){
						$newResellerName = $_POST['newResellerName'];
						$newResellerPass = $_POST['newResellerPass'];
						$newResellerCharge = $_POST['newResellerCharge'];
						$isAdmin = isset($_POST['newResellerIsAdmin'])?1:0;
						if($this->reseller->createNewResseler($newResellerName,$newResellerPass,$newResellerCharge,$isAdmin,$me)){
							array_push($messages,["success","فروشنده " . $newResellerName . " با موفقیت ایجاد شد."]);
						}
						else{
							array_push($messages,["danger","امکان ثبت فروشنده جدید وجود ندارد."]);
						}
					}
					else{
						array_push($messages,["danger","ثبت فروشنده به دلایل امنیتی انجام نشد. لطفا مجدد امتحان کنید."]);
					}
				}
				if(isset($_POST['deleteresseller'])){
					if($canEdit){
						$deleteId = intval($_POST['deleteresseller']);
						if($this->reseller->deleteReseller($me,$deleteId)){
							array_push($messages,["success","حذف با موفقیت انجام شد."]);
						}
						else{
							array_push($messages,["danger","حذف انجام نشد."]);
						}
					}
					else{
						array_push($messages,["danger","حذف فروشنده به دلایل امنیتی انجام نشد. لطفا مجدد امتحان کنید."]);
					}
				}
				if(isset($_POST['chargeresseller'],$_POST['chargeUserValue'])){
					if($canEdit){
						$chargeId = intval($_POST['chargeresseller']);
						$newValue = intval($_POST['chargeUserValue']);
						if($this->reseller->setResellerCharge($me,$chargeId,$newValue)){
							array_push($messages,["success","تغییر شارژ با موفقیت انجام شد."]);
						}
						else{
							array_push($messages,["danger","تغییر شارژ انجام نشد."]);
						}
					}
					else{
						array_push($messages,["danger","تغییر شارژ فروشنده به دلایل امنیتی انجام نشد. لطفا مجدد امتحان کنید."]);
					}
				}
				if(isset($_POST['passresseller'],$_POST['passUserValue'])){
					if($canEdit){
						$userID = intval($_POST['passresseller']);
						$newValue = md5($_POST['passUserValue'] . "_DevsIran51684dw@@");
						if($this->reseller->changeResellerPassword($me,$userID,$newValue)){
							array_push($messages,["success","تغییر پسورد با موفقیت انجام شد."]);
						}
						else{
							array_push($messages,["danger","تغییر پسورد انجام نشد."]);
						}
					}
					else{
						array_push($messages,["danger","تغییر پسورد فروشنده به دلایل امنیتی انجام نشد. لطفا مجدد امتحان کنید."]);
					}
				}
				$panelInfo['resellers'] = $this->reseller->getMyResellers($me);
			}
			else if($page=="servers"){
				$this->load->model("server");
				$panelInfo['servers'] = $this->server->getResellerServers($me->id);
				if(isset($_POST['newServerName'],$_POST['newServerDesc'],$_POST['newServerAddress'],$_POST['newServerUser'],$_POST['newServerPass'])){
					if($canEdit){
						$newServerName = $_POST['newServerName'];
						$newServerDesc = $_POST['newServerDesc'];
						$newServerAddress = $_POST['newServerAddress'];
						$newServerUser = $_POST['newServerUser'];
						$newServerPass = $_POST['newServerPass'];
						$res = $this->setupNewServer($me,$newServerName,$newServerDesc,$newServerAddress,$newServerUser,$newServerPass);
						if($res===true){
							array_push($messages,["success","سرور با موفقیت اضافه شد."]);
						}
						else{
							array_push($messages,["danger",$res]);
						}
					}
					else{
						array_push($messages,["danger","ساخت سرور به دلایل امنیتی انجام نشد. لطفا مجدد امتحان کنید."]);
					}
					
				}
			}
			$this->load->view("admin",["me"=>$me,"panelInfo" => $panelInfo,"page" => $page,"token" => $token,"messages"=>$messages]);
		}
	}

	private function getRandomKey($s){
		return(md5($s . "/" . time() . rand(10000,9999999) . "DevsIran"));
	}

	private function setupNewServer($me,$name,$adminDesc,$ip,$seruser,$serpass){
		$protos = [
			"trojan_gRPC" => $this->getRandomKey("trojan_gRPC"),
			"VLESS_gRPC" => $this->getRandomKey("VLESS_gRPC"),
			"VLESS_TCP" => $this->getRandomKey("VLESS_TCP"),
			"trojan_TCP" => $this->getRandomKey("trojan_TCP"),
			"VLESS_WS" => $this->getRandomKey("VLESS_WS"),
			// "VMess_WS" => $this->getRandomKey("VMess_WS")
		];
		try{
			set_time_limit(300);
			$admin_address = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . "/s/";
			include_once(APPPATH . "/ssh/Net/SSH2.php");
			$ssh = new Net_SSH2($ip);
			if (@$ssh->login($seruser, $serpass)) {
				$ssh->exec("curl -O https://raw.githubusercontent.com/devsiran/v2ray-agent-panel/main/ser.py");
				$ssh->exec("sed -i 's/{SERVER_HASH_HERE}/" . json_encode($protos) . "/' ser.py");
				$ssh->exec("sed -i 's/{ADMIN_ADDRESS_HERE}/" . $admin_address . "/' ser.py");
				$ssh->exec("bash <(curl -Ls https://raw.githubusercontent.com/devsiran/v2ray-agent-panel/main/ser.sh)");
				$ssh->exec("python3 ser.py &");
				$this->load->model("server");
				$this->server->addServers($me,$name,$adminDesc,$ip,$protos);
				return true;
			}
			else{
				return "امکان اتصال به سرور وجود ندارد.";
			}
		}
		catch(Exception $e) {
			return('Failed: ' .$e->getMessage());
		}
	}

	private function check_login(){
		@session_start();
		if(isset($_GET['logout'])){
			$_SESSION['user'] = "";
			$_SESSION['password'] = "";
			@session_destroy();
		}
		if(isset($_POST['user'],$_POST['pass'])){
			$_SESSION['user'] = $_POST['user'];
			$_SESSION['pass'] = md5($_POST['pass'] . "_DevsIran51684dw@@");
		}
		if(isset($_SESSION['user'],$_SESSION['pass'])){
			$user = $_SESSION['user'];
			$pass = $_SESSION['pass'];
			$this->load->model("reseller");
			return $this->reseller->getReseller($user,$pass);
		}
		return false;
	}

	public function getServerUsers($serverHash){
		$this->load->model("server");
		$res = $this->server->getServerInfoByHash($serverHash);
		echo json_encode($res);
	}
}
