<?php 

class Task{
	
	public $category_id;
	public $task_name;

	public $table_task = 'tasks';
	
		public function __construct($db){
			//instantiate variables on create here
			$this->con = $db;
		}
		
	public function add_task($inputCategory,$inputTaskName){

		$query = "INSERT INTO ".$this->table_task." SET category_id=?, task_name=?";
		$this->category_id = $inputCategory;
		$this->task_name = $inputTaskName;
			
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$this->category_id);
		$stmt->bindParam(2,$this->task_name);
		if($stmt->execute()){
			echo '<script language="javascript">';
			echo 'alert("Task Added")';
			echo '</script>';
		}else{
			echo '<script language="javascript">';
			echo 'alert("Adding Task Failed")';
			echo '</script>';
		}
	}
	
	
	public function getTaskOfCategory($category_id){
		
		$query = "SELECT * FROM ".$this->table_task." WHERE category_id=?";
		
		$this->category_id = $category_id;
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$this->category_id);
		if($stmt->execute()){
			return $stmt;
		}else{
			echo "somethings wrong";
		}
		
	}
	
	
	
/*	public function addMember($userinput_username, $userinput_team, $userinput_position, $userinput_settings,$mempass_input){
		
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
	
	public function readAllMembers(){
		
		$query = "SELECT * FROM ".$this->table_members." ORDER BY team DESC"; //LIMIT {$from_record_num},{$records_per_page}"
		$stmt = $this->con->prepare($query);
		$stmt->execute();
		return $stmt;
	}*/
	
}

?>
