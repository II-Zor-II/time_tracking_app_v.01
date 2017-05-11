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
	
	public function testFunc(){
		echo "Test Class function";
	}
	
	private function random_password( $length = 6 ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}
	
	private function add_member_details(){
		echo "<br><br>".$this->user_id;
		$query = "INSERT INTO ".$this->table_members."SET user_id=".$this->user_id.", team=?, position=?, settings=?";
		
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$this->team);
		$stmt->bindParam(2,);
		$stmt->bindParam(3,);
	}
	
	public function addMember($userinput_username, $userinput_team, $userinput_position, $userinput_settings){
		
		$this->team= $userinput_team;
		$this->position= $userinput_position;
		$this->settings= $userinput_settings;
		
		$query = "INSERT INTO ".$this->table_users." SET username=?, password=?, privilege=2";
		
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$userinput_username);
		$stmt->bindParam(2,$this->random_password());
		
		if($stmt->execute()){
			$this->user_id=$this->con->lastInsertId("id");
			$this->add_member_details();
		}else{
			echo "failed";
		}
	}
	
	
	
}
?>