<?php 
	
	include "conexao.php";
	
	session_start();
	
	if(!isset($redir)){
		include "conexao.php";
		
		$sql_register_log = "INSERT INTO logins VALUES(".$_SESSION["id"].", NOW(), 'logout', '".$_SERVER["REMOTE_ADDR"]."')";
		mysqli_query($con, $sql_register_log) or die(mysqli_error($con));
	}
	
	session_destroy();
	
	
	header("location: index.php");
?>