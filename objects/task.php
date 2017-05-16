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
	public $start_date;
	public $end_date;
	public $time_spent;
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
	
	public function getTaskUnfinishedOfCategory($category_id){
		
		$query = "SELECT * FROM ".$this->table_task." WHERE category_id=? AND status<>2";
		
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
	
	public function getTaskUnfinished($member_id){
		$query = "SELECT * FROM ".$this->table_task." WHERE user_id=? AND status<>2";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$member_id);
		if($stmt->execute()){
			return $stmt;
		}else{
			echo "somethings wrong";
		}		
	}
	
	public function getTaskUnAssigned($category_id,$member_id){
		$query = "SELECT * FROM ".$this->table_task." WHERE category_id=? AND user_id=? AND status<>2";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$category_id);
		$stmt->bindParam(2,$member_id);
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
	
	public function saveTaskTime($task_id, $clock_in, $task_endTime, $cloud_file_url, $collab_with, $task_descrption){
		//$stmt = $task->saveTaskTime($_POST['task_id'],$_POST['mem-task-clockIn'],$_POST['time-ended'],$_POST['cloudFile-url'],$_POST['task-collab-wth'],$_POST['task-description']);
		$query = "UPDATE ".$this->table_task." SET Location=?, Collab=?, task_desc=?, start_date=?, end_date=?, time_spent=?, status=2, type='clock' WHERE task_id=?";
		
		$this->task_id = $task_id;
		$this->start_date = date("Y-m-d")." ".$clock_in;
		$this->end_date = date("Y-m-d")." ".$task_endTime;
		$this->calculateTimeSpentClock();
		
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$cloud_file_url);
		$stmt->bindParam(2,$collab_with);
		$stmt->bindParam(3,$task_descrption);
		$stmt->bindParam(4,$this->start_date);
		$stmt->bindParam(5,$this->end_date);
		$stmt->bindParam(6,$this->time_spent);	
		$stmt->bindParam(7,$this->task_id);	
		if($stmt->execute()){
			echo '<script language="javascript">';
			echo 'alert("Success")';
			echo '</script>';
		}else{
			echo "failed";
		}		
	}
	
	public function saveTaskTimer($task_id, $time_spent, $breaks, $time_ended){
		//set status to timer
		$query = "UPDATE ".$this->table_task." SET end_date=?, time_spent=?, breaks=?, status=2, type='timer' WHERE task_id=?";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$time_ended);
		$stmt->bindParam(2,$time_spent);
		$stmt->bindParam(3,$breaks);
		$stmt->bindParam(4,$task_id);

		if($stmt->execute()){
			echo '<script language="javascript">';
			echo 'alert("Success")';
			echo '</script>';
		}else{
			echo "failed";
		}	
	}
	
	public function startTimerTask($task_id, $StartTimeInput){
		$startDateAndTime = $StartTimeInput;
		$query = "UPDATE ".$this->table_task." SET start_date='".$StartTimeInput."' WHERE task_id=?";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$task_id);
		if($stmt->execute()){
			echo '<script language="javascript">';
			echo 'alert("Success")';
			echo '</script>';
		}else{
			echo "failed";
		}	
	}
	
	public function saveStartTime($task_id,$StartTimeInput){
		$startDateAndTime = $StartTimeInput;
		$query = "UPDATE ".$this->table_task." SET start_date='".$StartTimeInput."' WHERE task_id=?";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$task_id);
		if($stmt->execute()){

			echo '<script language="javascript">';
			echo 'alert("StartTime Logged")';
			echo '</script>';
		}else{
			echo "failed";
			echo '<script language="javascript">';
			echo 'alert("StartTime Failed")';
			echo '</script>';
		}
	}
	
	private function calculateTimeSpentClock(){
		
		$date1 = date_create($this->start_date);
		$date2 = date_create($this->end_date);
		$diff= date_diff($date1,$date2);
		$this->time_spent = $diff->format("%H:%I:%S");
	}
	
	
}

?>
