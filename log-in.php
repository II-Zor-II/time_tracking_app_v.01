<?php

include_once dirname(__FILE__).'/header.php';
include_once dirname(__FILE__).'/db/db.php';
//include_once 'objects/member.php';

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
	//--------------------------------------
//	$table_members = "member_details";
//	
//	$members = new Members($db);
//	
//	$memStmt = $members->getmemberByUID($row['id']);
//	$memData = $memStmt->fetch(PDO::FETCH_ASSOC);
//	$memData['username']	
	
	//--------------------------------------
	$admin_page = "admin-dashboard.php";
	$home_page = "index.php";
	$member_page = "member-dashboard.php?user_id=".$row['id']."&username=".$row['username'];
	if($row!=null){
		if($row['privilege']==1){
			header('Location: '.$admin_page);			
		}else if($row['privilege']==2){
			header('Location: '.$member_page);	
		}
	}else{
		echo '<script language="javascript">';
		echo 'alert("Incorrect Credentials");window.location.href="/tmq/index.php";; ';
		echo '</script>';
	}
}else
	echo "no input";
}


?>