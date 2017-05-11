<?php 

	include 'db/db.php';

    class Accounts{
		
		private $id;
		private $username;
		private $privilege;
		
		private $con;
		private $table_name = "users";
		
		public function __construct($db){
			$this->con = $db;
		}
		
		
		public function Login($user, $pass){
			if(!empty($user) && !empty($pass)){
				
				
//				$query = "SELECT * FROM ".$this->table_name." WHERE username=".$user." AND password=".$pass;
				$query = "SELECT * FROM ".$this->table_name." WHERE username=? AND password=?";
				$stmt->bindParam(1,$user);
				$stmt->bindParam(2,$pass);
				$stmt = $this->con->prepare($query);

				
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				
				echo $row;

			}else{
				echo "<h1>Please Enter username and password</h1>";
			}
		}
		
    }

?>
