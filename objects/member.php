<?php
class Member{
	public $user_id;
	public $username;
	public $team;
	public $position;
	public $settings;
	private $pk_id;
	private $mem_pass;
	public $totalNumOfHrs;
	
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
	
	private function getmemberByUID($user_id){ // will be used later to check for duplicate usernames
		$query = "SELECT * FROM ".$this->table_members." WHERE user_id=?"; //LIMIT {$from_record_num},{$records_per_page}"
		$this->username = $user_id;
		$stmt->bindParam(1,$this->username);
		$stmt = $this->con->prepare($query);
		if($stmt->execute()){
			return $stmt;
		}else{
			echo '<script language="javascript">';
			echo 'alert("Failed")';
			echo '</script>';
		}
	}
	
	public function readAllMembers(){
		$query = "SELECT * FROM ".$this->table_members." ORDER BY team DESC"; //LIMIT {$from_record_num},{$records_per_page}"
		$stmt = $this->con->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	
	public function getMembersOfTeam($team_name){
		$query = "SELECT user_id, username FROM ".$this->table_members." WHERE team=?";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$team_name);
		if($stmt->execute()){
			return $stmt;
		}else{
			echo "somethings wrong";
		}
	}
	
	public function calculateTotalHours($user_id,$tasks_instance){

		$tasks_stmt = $tasks_instance->getTasksOfMember($user_id);
		$totalSeconds = 0;
		while($row = $tasks_stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$time = explode(":", $row['time_spent']);
			$totalSeconds += $time[0]*3600;
			$totalSeconds += $time[1]*60;
			$totalSeconds += $time[2];
		}
		$hours = number_format($totalSeconds/3600);
		$minutes = number_format(($totalSeconds%3600)/60);
		$seconds = ($totalSeconds%3600)%60;
		if($hours<10){
			$hours = "0".$hours;
		}
		if($minutes<10){
			$minutes = "0".$minutes;
		}
		if($seconds<10){
			$seconds = "0".$seconds;
		}
		
		$this->totalNumOfHrs = $hours.":".$minutes.":".$seconds;
		echo "<br><br>";
		echo $this->totalNumOfHrs;
		$query = "UPDATE ".$this->table_members." SET total_hoursOfWork=? WHERE user_id=?";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$this->totalNumOfHrs);
		$stmt->bindParam(2,$user_id);
		$stmt->execute();
	}
}
?>