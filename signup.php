<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SGC | Registro de usuário</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  	<?php 
		include "funcao.php";
		include "conexao.php";
	?>
</head>
<body class="hold-transition register-page">

<?php 
	$name = null;
	$email = null;
	$cpf = null;
	$data = null;
	$senha = null;
	$senha2 = null;
	$errorEmail = null;
	$errorCPF = null;
	$errorSenha = null;
	
	if(isset($_POST["register"])){
		$name = $_POST["name"];
		$email = $_POST["email"];
		$cpf = $_POST["cpf"];
		$genero = $_POST["genero"];
		$data = $_POST["data"];
		$senha = $_POST["senha"];
		$senha2 = $_POST["senha2"];
		
		$sql_verifica_email = "SELECT * FROM usuarios WHERE email='".$email."'";
		$exec_sql_verifica_email = mysqli_query($con, $sql_verifica_email);
		
		$sql_verifica_cpf = "SELECT * FROM usuarios WHERE cpf='".$cpf."'";
		$exec_sql_verifica_cpf = mysqli_query($con, $sql_verifica_cpf);
		
		if(mysqli_num_rows($exec_sql_verifica_email) >0){
			$errorEmail = "*Email já cadastrado!";
		}elseif(mysqli_num_rows($exec_sql_verifica_cpf) >0){
			$errorCPF = "*CPF já cadastrado!";
		}elseif($senha != $senha2){
			$errorSenha = "*Senhas diferentes!";
		}else{
			$sql_cadastrar = "INSERT INTO usuarios VALUES(NULL, '".$name."', '".$genero."', '".$data."', ".$cpf.", '".$email."', '".encripta($senha)."', 1, 3, NULL)";
			mysqli_query($con, $sql_cadastrar) or die(mysqli_error($con));
			
			$id = mysqli_insert_id($con);
			
			if($pode_enviar == 1){
				ini_set('display_errors', 1);

				error_reporting(E_ALL);

				$from = "SGSC";
				
				$to = $email;

				$subject = "Bem vindo ao SGCS!";

				$message = "<html><body>";
				
				$message .= "Olá, $name !<br>
								Seja bem vindo ao SGSC. Aqui você encontrará o serviço que deseja com os melhores atendimentos";
				
				$message .= "<br><br><a href='http://portalsgsc-com.umbler.net/index.php'> Clique aqui para acessar o sistema </a> </body></html>";
				
				//$headers = "From:". $from;
				
				$cabecalho = 'MIME-Version: 1.0' . "\r\n";
				$cabecalho .= 'Content-type: text/html; charset=iso-8859-1;' . "\r\n";
				$cabecalho .= "Return-Path: $from \r\n";
				$cabecalho .= "From: $from \r\n";
				if($to)
					mail($to, $subject, $message, $cabecalho);
			}
			
			session_start("sgc");
	
			$_SESSION["id"] = $id;
			
			header("location: home.php");
		}
		
		
	}
	
?>

<div class="register-box">
  <div class="register-logo">
    <a href="index2.html"><b>SGC</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Cadastrar um novo usuário</p>

      <form action="" method="post">
        <div class="form-group has-feedback">
			<span class="fa fa-user form-control-feedback"></span>
          <input type="text" class="form-control" placeholder="Nome completo" name="name" value="<?php echo $name; ?>" required>
		 
        </div>
		<div class="form-group has-feedback">
			<span class="fa fa-user form-control-feedback"></span>
          <select> 
			<option value="">Gênero</option>
			<?php 
				$masculino = null;
				$feminino = null;
				if($genero ==1)
					$masculino = "selected";
				if($genero ==2)
					$feminino = "selected";
				
				echo "<option $masculino value='1'>Masculino</option>";
				echo "<option $feminino value='2'>Feminino</option>";
				
			?>
		</select>
		 
        </div>

        <div class="form-group has-feedback">
			<span class="fa fa-envelope form-control-feedback"></span>
          <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
          <?php echo $errorEmail; ?>
        </div>
		<div class="form-group has-feedback">
			<span class="fa fa-envelope form-control-feedback"></span>
          <input type="number" class="form-control" placeholder="CPF" name="cpf" value="<?php echo $cpf; ?>" required>
          <?php echo $errorCPF; ?>
        </div>
		<div class="form-group has-feedback">
			<span class="fa fa-envelope form-control-feedback"></span>Data de nascimento
          <input type="date" class="form-control" name="data" value="<?php echo $data; ?>" >
          
        </div>
        <div class="form-group has-feedback">
			<span class="fa fa-lock form-control-feedback"></span>
          <input type="password" class="form-control" placeholder="Senha" required name="senha" value="<?php echo $senha; ?>">
          
        </div>
        <div class="form-group has-feedback">
			<span class="fa fa-lock form-control-feedback"></span>
          <input type="password" class="form-control" placeholder="Repita a senha" required name="senha2" value="<?php echo $senha2; ?>">
          <?php echo $errorSenha; ?>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <input type="submit" class="btn btn-block btn-primary" value="Registrar" name="register">
          </div>
          <!-- /.col -->
        </div>
		
      </form>

      <div class="social-auth-links text-center">
    
        <a href="index.php" class="btn btn-block btn-success">
          Já sou Usuário
        </a>
       
      </div>

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
</body>
</html>
