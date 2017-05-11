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
		
	}
	
	public function addMember($userinput_username){
		
		
		$query = "INSERT INTO ".$this->table_users." SET username=?, password=?, privilege=2";
		
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$userinput_username);
		$stmt->bindParam(2,$this->random_password());
		
		if($stmt->execute()){
			echo "hooray";
		}else{
			echo "failed";
		}
		
	}
	
	
	
}
?>