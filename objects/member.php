<?php
class Member{
	public $user_id;
	public $username;
	public $team;
	public $position;
	public $settings;
	private $pk_id;
	private $mem_pass;
	
	private $con;
	private $table_users = "users";
	private $table_members = "member_details";
	
	public function __construct($db){
		//instantiate variables on create here
		$this->con = $db;
	}
	
	private function add_member_details(){

		$query = "INSERT INTO ".$this->table_members." SET user_id=".$this->user_id.", username=?, team=?, position=?, settings=?";
		
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$this->username);
		$stmt->bindParam(2,$this->team);
		$stmt->bindParam(3,$this->position);
		$stmt->bindParam(4,$this->settings);
		if($stmt->execute()){
			echo '<script language="javascript">';
			echo 'alert("Member Added")';
			echo '</script>';
		}else{
			echo '<script language="javascript">';
			echo 'alert("Adding Member Failed")';
			echo '</script>';
		}
	}
	
	public function addMember($userinput_username, $userinput_team, $userinput_position, $userinput_settings,$mempass_input){
		
		$this->team= $userinput_team;
		$this->position= $userinput_position;
		$this->settings= $userinput_settings;
		$this->mem_pass = $mempass_input;
		$this->username = $userinput_username;
		$query = "INSERT INTO ".$this->table_users." SET username=?, password=?, privilege=2";
		
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$this->username);
		$stmt->bindParam(2,$this->mem_pass);
		
		if($stmt->execute()){
			$this->user_id=$this->con->lastInsertId("id");
			$this->add_member_details();
		}else{
			echo '<script language="javascript">';
			echo 'alert("Adding Member Failed")';
			echo '</script>';
		}
	}
	
	private function getUsernames(){ // will be used later to check for duplicate usernames
		
	}
	
	public function readAllMembers(){
		$query = "SELECT * FROM ".$this->table_members." ORDER BY team DESC"; //LIMIT {$from_record_num},{$records_per_page}"
		$stmt = $this->con->prepare($query);
		$stmt->execute();
		return $stmt;
	}

}
?>