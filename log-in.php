<?php

include_once 'header.php';
include_once '/db/db.php';


///session_start();

if(isset($_POST['submit'])){

if(isset($_POST['username'])&&isset($_POST['password'])){
	$database = new Database();
	$db = $database->getConnection();

	$username = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);
	
	$username = stripslashes($username);
	$password = stripslashes($password);
	$table_name = "users";
	$query = "SELECT * FROM ".$table_name." WHERE username=? AND password=?";
	
	$stmt = $db->prepare($query);
	$stmt->bindParam(1,$username);
	$stmt->bindParam(2,$password);

	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	echo $row;
	echo $row['username'];
	echo $row['password'];
	echo $row['privilege'];
	
	$admin_page = "admin-dashboard.php";
	$home_page = "index.php";
	$member_page = "member-dashboard.php";
	if($row!=null){
		if($row['privilege']==1){
			header('Location: '.$admin_page);			
		}else if($row['privilege']==2){
			header('Location: '.$member_page);	
		}

	}else{
		header("Location: ".$home_page);
	}
}else
	echo "no input";
}


?>