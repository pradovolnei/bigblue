<?php 

	/*session_start();
	
	$_SESSION["id"] = 1;
    $_SESSION["nome"] = "Volnei";
	$_SESSION["data"] = "2019-05-13";
	$_SESSION["cpf"] = 111111;
	$_SESSION["email"] = "volneifjv@gmail.com";
    $_SESSION["perfil"] = 1;
	$_SESSION["id_clinina"] = null;
	
	$nome_usuario = $_SESSION["nome"];
	$id_usuario = $_SESSION["id"];
	$data_usuario = $_SESSION["data"];
	$cpf_usuario = $_SESSION["cpf"];
	$email_usuario = $_SESSION["email"];
	$perfil_usuario = $_SESSION["perfil"];
	$clinina_usuario = $_SESSION["id_clinina"];
	
	if(!isset($_SESSION["id"]))
		header("location: logout.php");
	*/
	
	/*$sessaoid = 1;
    $sessaonome = "Volnei";
	$sessaodata = "2019-05-13";
	$sessaocpf = 111111;
	$sessaoemail = "volneifjv@gmail.com";
    $sessaoperfil = 1;
	$sessaoid_clinina = null;*/

	session_start();
	if(!isset($_SESSION["id"]))
		header("location: index.php");

	$sql_sessoes = "SELECT * FROM usuarios WHERE id=".$_SESSION["id"];
	$exec_sql_sessoes = mysqli_query($con, $sql_sessoes);
	$col = mysqli_fetch_array($exec_sql_sessoes);
	
	$nome_usuario = $col["nome"];
	$id_usuario = $col["id"];
	$data_usuario = $col["data_nascimento"];
	$cpf_usuario = $col["cpf"];
	$email_usuario = $col["email"];
	$perfil_usuario = $col["perfil"];
	$genero_usuario = $col["genero"];
	$clinina_usuario = $col["id_clinica"];
?>