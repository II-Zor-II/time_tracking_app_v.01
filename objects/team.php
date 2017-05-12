<?php
class Team{
	
	
	public $team_id;
	public $teamName;
	public $teamDesc;

	private $con;
	private $table_teams = "teams";
	
	public function __construct($db){
		//instantiate variables on create here
		$this->con = $db;
	}

	
	public function readTeams(){
		$query = "SELECT * FROM ".$this->table_teams."";
		
		$stmt = $this->con->prepare($query);
		$stmt->execute();
		
		return $stmt;
	}
	public function countAll(){
	$query = "SELECT team_id FROM ".$this->table_teams."";

	$stmt = $this->con->prepare($query);
	$stmt->execute();

	$num = $stmt->rowCount();
	echo $num;
	return $num;
	}
     
	public function createTeam($teamNameInput, $teamDescInput){
		$query = "INSERT INTO ".$this->table_teams." SET team_name=?, team_description=?";
		
		$this->teamName = $teamNameInput;
		$this->teamDesc = $teamDescInput;
		
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,$this->teamName);
		$stmt->bindParam(2,$this->teamDesc);
		if($stmt->execute()){
			echo '<script language="javascript">';
			echo 'alert("Team Created")';
			echo '</script>';
		}else{
			echo '<script language="javascript">';
			echo 'alert("Team Creation Failed")';
			echo '</script>';
		}
	}
	
}

?>