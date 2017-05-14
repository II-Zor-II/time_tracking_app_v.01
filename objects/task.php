<?php 

class Task{
	
	public $category_id;
	public $task_name;
	private $task_id;
	private $user_id;
	public $task_descp;
	public $est_date;
	public $est_time;
	public $status;

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
	
	public function getTaskNamesforCtg($category_id){
		
		$query = "SELECT task_name FROM ".$this->table_task." WHERE category_id=?";
		
		$this->category_id = $category_id;
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$this->category_id);
		if($stmt->execute()){
			return $stmt;
		}else{
			echo "somethings wrong";
		}
		
	}
	
	public function getTasksOfMember($member_id){
		$query = "SELECT * FROM ".$this->table_task." WHERE user_id=?";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$member_id);
		if($stmt->execute()){
			return $stmt;
		}else{
			echo "somethings wrong";
		}
	}

	public function updateTask($task_id,$est_date,$est_time,$member_id){
		
		$query = "UPDATE ".$this->table_task." SET user_id=?, estimated_date=?, estimated_time=? WHERE task_id=?";
		
		$this->user_id = $member_id;
		$this->est_date = $est_date;
		$this->est_time = $est_time;
		$this->task_id = $task_id;
			
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$this->user_id);
		$stmt->bindParam(2,$this->est_date );
		$stmt->bindParam(3,$this->est_time);
		$stmt->bindParam(4,$this->task_id);
		if($stmt->execute()){
			echo "success";
			echo '<script language="javascript">';
			echo 'alert("Timeframe Created")';
			echo '</script>';
		}else{
			echo "failed";
			echo '<script language="javascript">';
			echo 'alert("Timeframe Failed")';
			echo '</script>';
		}
		
	}
	
	public function getTaskTimeFrame($task_id){
		$query = "SELECT estimated_date, estimated_time FROM ".$this->table_task." WHERE task_id=?";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$task_id);
		if($stmt->execute()){
			return $stmt;
		}else{
			echo "somethings wrong";
		}
	}
	
	public function saveTaskTimer($task_id){

	}
	
	public function saveTaskTime(){
		
	}
	
	public function saveStartTime($task_id,$StartTimeInput){
		$startDateAndTime = $StartTimeInput;
		$query = "UPDATE ".$this->table_task." SET start_date='".$StartTimeInput."' WHERE task_id=?";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$task_id);
		if($stmt->execute()){
			echo "success";
			echo '<script language="javascript">';
			echo 'alert("StartTime Logged")';
			echo '</script>';
			return $startDateAndTime;
		}else{
			echo "failed";
			echo '<script language="javascript">';
			echo 'alert("StartTime Failed")';
			echo '</script>';
		}
	}
	
	public function resetStartTime(){
		
	}
}

?>
