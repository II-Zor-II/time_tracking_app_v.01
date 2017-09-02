<?php 

class Database{
	
	protected $host = "localhost";
	protected $db = "payroll_db";
	protected $user = "admin";
	protected $pw = "Fth12!jd#dW";
	public $con;
	
	public function getConnection(){
		
	$this->con = null;
		
		try{
			$this->con = new PDO("mysql:host=".$this->host.";dbname=".$this->db,$this->user,$this->pw);
		}catch(PDOException $e){
			die("Database connection failed. ".$e->getMessage());
		}
	return $this->con;	
	}
	
	
}

?>






<?php 

include_once (__FILE__)."\db\db.php";

$db = new Database();
$employees = new Employees($db);

$stmt = $employees->getName($_POST['employee_id']);
while($employee_name = $stmt->fetch(PDO::FETCH_ASSOC)){
	extract $empoloyee_name;
	$employee_name['first_name'];
	echo "<h1>first name: {$first_name}</h1>";
	$employee_name['last_name'];
	echo "<h1>last name: {$last_name}</h1>";
}


?>


<?php 

class Employees{
	protected $id;
	protected $fk;
	public $first_name;
	public $last_name;
	public $address;
	protected $con;
	
	protected $table = "employee_details";
	
	function __construct($db){
		$this->con = $db;
	}
	
	public function getName($emp_id){
		$query = "SELECT first_name,last_name, FROM ".$this->table." WHERE employee_id=?";
		
		$stmt = $this->con->prepare($query);
		$this->stmt = bindParam(1,$emp_id);
		if($stmt->execute()){
			return $stmt;
		}else{
			echo '<script language="javasscript">';
			 echo 'alert("DB failed")';
			echo '</script>';
		}
	}
}


?>

$.ajax({
	url: "../employee_api.php?uid="+$("#idofelementhere").val(),
	type: "POST",
	success:function(result){
		var x = JSON.parse(result);
	}
});

