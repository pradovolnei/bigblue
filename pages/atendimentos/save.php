<?php 
	$id_user = 'null';
	if($_POST["email"]){
		$senha = rand(100,999).rand(100,999);
		$sql_user  = "INSERT INTO usuarios VALUES(NULL,'".$_POST["nome"]."',null,null,null,'".$_POST["email"]."', '".encripta($senha)."',1,2,null)";
		mysqli_query($con,$sql_user);
		
		$id_user = mysqli_insert_id($con);
	}
	$sql_pac = "INSERT INTO paciente VALUES($id_user,'".$_POST["referencia"]."','".$_POST["nome"]."','".$_POST["sexo"]."','".$_POST["data_nascimento"]."',".$_POST["peso"].",".$_POST["altura"].",'".$_POST["etnia"]."','".$_POST["rg"]."','".$_POST["cpf"]."','".$_POST["cns"]."','".$_POST["inscricao"]."','".$_POST["nome_mae"]."','".$_POST["obs"]."')";
	mysqli_query($con,$sql_pac);
	
	$sql_pedido = "INSERT INTO pedido VALUES(NULL,'".$_POST["referencia"]."','".$_POST["nome"]."','".$_POST["medico"]."',null,'".$_POST["obs_exame"]."','".$_POST["dum"]."','".$_POST["jejum"]."','".$_POST["medicamentos"]."','".$_POST["dt_marcado"]."',NOW())";
	mysqli_query($con,$sql_pedido);
	
	$id_pedido = mysqli_insert_id($con);
	
	$sql_orc = "SELECT * FROM orcamento WHERE id_usuario= $id_usuario";
	$exec=mysqli_query($con,$sql_orc);
	while($row = mysqli_fetch_array($exec)){
		$sql_exame = "INSERT INTO pedido_exame VALUES($id_pedido, ".$row["exame"].")";
		mysqli_query($con,$sql_exame);
	}
	$sql_pedido = "DELETE FROM orcamento WHERE id_usuario= $id_usuario";
	mysqli_query($con,$sql_pedido);
	
	
	echo "<script>alert('Exame Marcado!'); window.location='home.php?l=MQ==';</script>";
?>