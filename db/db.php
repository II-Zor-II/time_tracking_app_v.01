<?php 

class Database{
	protected $host="localhost";
	protected $db="tmq";
	protected $user="root";
	protected $pass="";
	public $con;


	function getConnection(){
		$this->con=null;

		try{
			$this->con = new PDO("mysql:host=".$this->host.";dbname=".$this->db, $this->user,$this->pass);
		}catch(PDOException $e){
			die("Error making connection".$e->getMessage());
		}
		return $this->con;    
	}

}

?>
