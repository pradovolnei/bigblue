<?php 
	include "conexao.php";
	include "funcao.php";
	
	$sql_user = "SELECT * FROM usuarios WHERE email='".$_POST["email"]."' AND senha='".encripta($_POST["password"])."'";
	$exec_sql_user = mysqli_query($con, $sql_user);
	
	if(mysqli_num_rows($exec_sql_user) == 1){
		$col = mysqli_fetch_array($exec_sql_user);

		session_start();
		$_SESSION["id"] = $col["id"];
		
		$sql_login = "INSERT INTO logins VALUES(".$col["id"].", NOW(), 'login', '".$_SERVER["REMOTE_ADDR"]."')";
		mysqli_query($con,$sql_login) or die(mysqli_error($con));
		
		header("location: home.php");
		
	}else{
		//echo $sql_user;
		header("location: index.php?msg=".base64_encode("*Email ou Senha inválidos!"));
	}
?>