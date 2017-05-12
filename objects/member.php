<?php
class Member{
	public $user_id;
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
	
//	private function random_password( $length = 6 ) {
//		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
//		$password = substr( str_shuffle( $chars ), 0, $length );
//		$this->mem_pass = $password;
//		return $password;
//	}
	
	private function add_member_details(){

		$query = "INSERT INTO ".$this->table_members." SET user_id=".$this->user_id.", team=?, position=?, settings=?";
		
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$this->team);
		$stmt->bindParam(2,$this->position);
		$stmt->bindParam(3,$this->settings);
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
		
		$query = "INSERT INTO ".$this->table_users." SET username=?, password=?, privilege=2";
		
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$userinput_username);
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
	
	public function readAllMembes(){
		    $query = "SELECT id, title, description, date_released, img_src,vid_src FROM ".$this->table_name." ORDER BY team DESC 
            LIMIT {$from_record_num},{$records_per_page}"; //Sorted from newest to oldest
            
            $stmt = $this->con->prepare($query);
            $stmt->execute();
        
            return $stmt;
	}

}
?>