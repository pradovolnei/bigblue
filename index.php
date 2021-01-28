<!DOCTYPE html>
<html>
<head>
	
	<?php 
		include "conexao.php";
		include "funcao.php";
		
		session_start();
		if(isset($_SESSION["id"]))
			header("location: home.php");
		
		if(isset($_POST["resgatar"])){
			$sql = "SELECT * FROM usuarios WHERE email='".$_POST["email"]."'";
			$exec = mysqli_query($con,$sql);
			if(mysqli_num_rows($exec) == 0){
				echo "<script> window.location='index.php?msg=".base64_encode("Email não cadastrado")."'; </script>";
			}else{
				$senha = rand(1000,9999).rand(1000,9999);
				$up = "UPDATE usuarios SET senha='".encripta($senha)."' WHERE email='".$_POST["email"]."'";
				mysqli_query($con,$up);
				
				if($pode_enviar == 1){
					ini_set('display_errors', 1);

					error_reporting(E_ALL);

					$from = "SGSC";
														
					$to = $_POST["email"];

					$subject = "Sua nova senha";

					$message = "<html><body>";
					
					$message .= "Login: ".$to;
					$message .= "<br>Senha: $senha";
					
					$message .= "<br><br><a href='http://portalsgsc-com.umbler.net/index.php'> Clique aqui para acessar o sistema </a> </body></html>";
					
					//$headers = "From:". $from;
					
					$cabecalho = 'MIME-Version: 1.0' . "\r\n";
					$cabecalho .= 'Content-type: text/html; charset=iso-8859-1;' . "\r\n";
					$cabecalho .= "Return-Path: $from \r\n";
					$cabecalho .= "From: $from \r\n";
					if($to)
						mail($to, $subject, $message, $cabecalho);
				}
				
				echo "<script> window.location='index.php?msg=".base64_encode("Verifique seu e-mail")."'; </script>";
			}
		}
	?>
	
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BIG BLUE | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><b>BIG BLUE</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicie sua sessão</p>

      <form action="login.php" method="post">
        <div class="form-group has-feedback">
          <input type="text" name="email" class="form-control" placeholder="Email">
          <span class="fa fa-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Senha">
          <span class="fa fa-lock form-control-feedback"></span>
		  <?php 
			if(isset($_GET["msg"])) echo "<p><font color='red'> ".base64_decode($_GET["msg"])." </font></p>";
		  ?>
		  
        </div>
		
        <div class="social-auth-links text-center mb-3">
			<input type="submit" class="btn btn-block btn-primary" value="Login" />
		</div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- -</p>
        <a href="#" class="btn btn-block btn-secondary"  data-toggle="modal" data-target="#exampleModal">
          <i class="fi-question-mark mr-2"></i> Esqueci minha senha
        </a>
		<!--
        <a href="signup.php" class="btn btn-block btn-warning">
          <i class="icon ion-md-person"></i> Não tenho cadastro
        </a-->
      </div>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- Modal -->
<form action="" method="post" >
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Resgate de senha</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  <div class="form-group has-feedback">
			  <input type="email" required name="email" class="form-control" placeholder="Informe seu e-mail">
		  </div>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <input type="submit" class="btn btn-primary" value="Resgatar" name='resgatar' />
      </div>
    </div>
  </div>
</div>
</form>


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
