<?php 
	
		if(isset($_POST["avaliar"])){
			$sql = "UPDATE atendimentos SET nota=".$_POST["nota"]." WHERE id=".$_POST["id"];

			mysqli_query($con,$sql);
			echo "<script> alert('Atendimento avaliado!'); </script>";
		}
		
		if(isset($_POST["send_chat"])){
			$sql = "INSERT INTO chat VALUES($id_usuario, ".$_POST["receptor"].", '".$_POST["obs"]."', NOW(), NULL)";
			mysqli_query($con,$sql);
			echo "<script> alert('Mensagem Enviada!'); </script>";
		}
	
	
		if(isset($_POST["cancelar"])){
			
			if($clinina_usuario)
				$sql = "UPDATE atendimentos SET status='Cancelado',data_encerramento=NOW(),obs_clinica='".$_POST["obs"]."' WHERE id=".$_POST["id"];
			else
				$sql = "UPDATE atendimentos SET status='Cancelado',data_encerramento=NOW(),obs_paciente='".$_POST["obs"]."' WHERE id=".$_POST["id"];
			
			mysqli_query($con,$sql);

			
			if($clinina_usuario && $pode_enviar == 1){
				ini_set('display_errors', 1);

				error_reporting(E_ALL);

				$from = "SGSC";
				
				$sql_email = "SELECT b.email,b.id FROm atendimentos a 
								LEFT JOIN usuarios b ON b.id = a.id_paciente
								WHERE a.id =".$_POST["id"];
								
				$exec_email = mysqli_query($con,$sql_email);
				$row_email = mysqli_fetch_array($exec_email);
				
				$to = $row_email["email"];
				
				$sql_not = "INSERT INTO notificacao VALUES(NULL, 'Atendimento ".str_pad($_POST["id"] , 6 , '0' , STR_PAD_LEFT)." Cancelado!', ".$row_email["id"].", NOW(), NULL, 'home.php?l=".base64_encode(1)."&ntf=".$_POST["id"]."')";
				mysqli_query($con,$sql_not);
				
				$subject = "Sua solicitação foi cancelada";

				$message = "<html><body>";
				
				$message .= "Protocolo: ".str_pad($_POST["id"] , 6 , '0' , STR_PAD_LEFT);
				$message .= "<br>Status: Cancelado";
				$message .= "<br>Observação: ".$_POST["obs"];
				
				$message .= "<br><br><a href='http://portalsgsc-com.umbler.net/index.php'> Clique aqui para acessar o sistema </a> </body></html>";
				
				//$headers = "From:". $from;
				
				$cabecalho = 'MIME-Version: 1.0' . "\r\n";
				$cabecalho .= 'Content-type: text/html; charset=iso-8859-1;' . "\r\n";
				$cabecalho .= "Return-Path: $from \r\n";
				$cabecalho .= "From: $from \r\n";
				if($to)
					mail($to, $subject, $message, $cabecalho);
			}
			
			echo "<script> alert('Atendimento cancelado!'); </script>";
		}
		
		if(isset($_POST["confirm"])){

				$sql = "UPDATE atendimentos SET status='Atendimento Confirmado',obs_clinica='".$_POST["obs"]."' WHERE id=".$_POST["id"];
		
				mysqli_query($con,$sql);
				
				if($clinina_usuario && $pode_enviar == 1){
					ini_set('display_errors', 1);

					error_reporting(E_ALL);

					$from = "SGSC";

					$sql_email = "SELECT b.email,b.id FROm atendimentos a 
								LEFT JOIN usuarios b ON b.id = a.id_paciente
								WHERE a.id =".$_POST["id"];
								
					$exec_email = mysqli_query($con,$sql_email);
					$row_email = mysqli_fetch_array($exec_email);
					
					$to = $row_email["email"];
					$sql_not = "INSERT INTO notificacao VALUES(NULL, 'Atendimento ".str_pad($_POST["id"] , 6 , '0' , STR_PAD_LEFT)." Confirmado!', ".$row_email["id"].", NOW(), NULL, 'home.php?l=".base64_encode(1)."&ntf=".$_POST["id"]."')";
					mysqli_query($con,$sql_not);

					$subject = "Sua solicitação foi confirmado";

					$message = "<html><body>";
					
					$message .= "Protocolo: ".str_pad($_POST["id"] , 6 , '0' , STR_PAD_LEFT);
					$message .= "<br>Status: Confirmado";
					$message .= "<br>Observação: ".$_POST["obs"];
					
					$message .= "<br><br><a href='http://portalsgsc-com.umbler.net/index.php'> Clique aqui para acessar o sistema </a> </body></html>";
					
					//$headers = "From:". $from;
					
					$cabecalho = 'MIME-Version: 1.0' . "\r\n";
					$cabecalho .= 'Content-type: text/html; charset=iso-8859-1;' . "\r\n";
					$cabecalho .= "Return-Path: $from \r\n";
					$cabecalho .= "From: $from \r\n";
					
					if($to)
					mail($to, $subject, $message, $cabecalho);
				}
			
			echo "<script> alert('Atendimento confirmado!'); </script>";
		}
		
		if(isset($_POST["finalizar"])){
			//$sql = "UPDATE atendimentos SET status='Realizado',obs_clinica='".$_POST["obs"]."',resultado='".$_POST["resultado"]."' WHERE id=".$_POST["id"];			
			$sql = "UPDATE pedido_exame set resultado='".$_POST["resultado"]."' WHERE id_pedido=".$_POST["pedido"]." AND id_exame=".$_POST["exame"];
			mysqli_query($con,$sql);
			
			$sql = "UPDATE pedido set status='Finalizado' WHERE id=".$_POST["pedido"];
			mysqli_query($con,$sql);
			
			if($_FILES['laudo']['tmp_name']){
				$filename = "laudo_".$_POST["id"];
				$totalchar = strlen($_FILES['laudo']['name']);
				$extencaou = pathinfo($_FILES['laudo']['name']);
				$extencao = $extencaou["extension"];
				$arquivo = $filename.".".$extencao;
				
				move_uploaded_file($_FILES['laudo']['tmp_name'],"pages/laudos/anexos/".$arquivo);
				
				$sql = "UPDATE pedido_exame SET laudo='pages/laudos/anexos/".$arquivo."' WHERE id_pedido=".$_POST["pedido"]." AND id_exame=".$_POST["exame"];
				mysqli_query($con,$sql);
				
			}
			
			
			if($clinina_usuario && $pode_enviar == 9999999){
				ini_set('display_errors', 1);

				error_reporting(E_ALL);

				$from = "SGSC";

				$sql_email = "SELECT b.email,b.id FROm atendimentos a 
							LEFT JOIN usuarios b ON b.id = a.id_paciente
							WHERE a.id =".$_POST["id"];
							
				$exec_email = mysqli_query($con,$sql_email);
				$row_email = mysqli_fetch_array($exec_email);
				
				$to = $row_email["email"];
				$sql_not = "INSERT INTO notificacao VALUES(NULL, 'Atendimento ".str_pad($_POST["id"] , 6 , '0' , STR_PAD_LEFT)." Finalizado!', ".$row_email["id"].", NOW(), NULL, 'home.php?l=".base64_encode(1)."&ntf=".$_POST["id"]."')";
				mysqli_query($con,$sql_not);

				$subject = "Seu atendimento foi realizado";

				$message = "<html><body>";
				
				$message .= "Protocolo: ".str_pad($_POST["id"] , 6 , '0' , STR_PAD_LEFT);
				$message .= "<br>Status: Realizado";
				$message .= "<br>Resultado: ".$_POST["resultado"];
				$message .= "<br>Observação: ".$_POST["obs"];
				
				$message .= "<br><br><a href='http://portalsgsc-com.umbler.net/index.php'> Clique aqui para acessar o sistema </a> </body></html>";
				
				//$headers = "From:". $from;
				
				$cabecalho = 'MIME-Version: 1.0' . "\r\n";
				$cabecalho .= 'Content-type: text/html; charset=iso-8859-1;' . "\r\n";
				$cabecalho .= "Return-Path: $from \r\n";
				$cabecalho .= "From: $from \r\n";
				
				if($to)
				mail($to, $subject, $message, $cabecalho);
			}
			echo "<script> alert('Resultado fornecido!'); </script>";
		}
		
		if(isset($_POST["remarcar"])){
			$sql = "UPDATE atendimentos SET data_agendada='".$_POST["data"]." ".$_POST["hora"]."' WHERE id=".$_POST["id"];
			mysqli_query($con,$sql);
			
			if($clinina_usuario && $pode_enviar == 1){
				ini_set('display_errors', 1);

				error_reporting(E_ALL);

				$from = "SGSC";

				$sql_email = "SELECT b.email,b.nome,b.id FROm atendimentos a 
							LEFT JOIN usuarios b ON b.id = a.id_paciente
							WHERE a.id =".$_POST["id"];
							
				$exec_email = mysqli_query($con,$sql_email);
				$row_email = mysqli_fetch_array($exec_email);
				
				$to = $row_email["email"];
				
				if($row_email["id"]){
					$sql_not = "INSERT INTO notificacao VALUES(NULL, 'Atendimento ".str_pad($_POST["id"] , 6 , '0' , STR_PAD_LEFT)." Remarcado!', ".$row_email["id"].", NOW(), NULL, NULL)";
					mysqli_query($con,$sql_not) or die(mysqli_error($con));
					$idnot = mysqli_insert_id($con);
					$sql_up = "UPDATE notificacao SET link='home.php?l=".base64_encode(1)."&ntf=".$idnot."'";
					mysqli_query($con,$sql_up) or die(mysqli_error($con));
				}
				
				$subject = "Seu atendimento foi remarcado";

				$message = "<html><body>";
				
				$message .= "Olá, ".$row_email["nome"]."!<br>
							Seu atendimento <b>".str_pad($_POST["id"] , 6 , '0' , STR_PAD_LEFT)."</b> foi remarcado para <b>".dataBrasileira($_POST["data"])."</b> às <b>".$_POST["hora"]."</b>";
				
				$message .= "<br><br><a href='http://portalsgsc-com.umbler.net/index.php'> Clique aqui para acessar o sistema </a> </body></html>";
				
				$cabecalho = 'MIME-Version: 1.0' . "\r\n";
				$cabecalho .= 'Content-type: text/html; charset=iso-8859-1;' . "\r\n";
				$cabecalho .= "Return-Path: $from \r\n";
				$cabecalho .= "From: $from \r\n";
				
				if($to)
				mail($to, $subject, $message, $cabecalho);
			}
			echo "<script> alert('Atendimento Remarcado!'); </script>";
		}
		
		if(isset($_GET["ntf"])){
			$sql = "UPDATE notificacao SET status=1 WHERE id=".$_GET["ntf"];
			mysqli_query($con,$sql) or die(mysqli_error($con));
		}
		
	?>