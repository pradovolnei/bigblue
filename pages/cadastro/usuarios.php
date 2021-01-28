	<?php 
		if(isset($_POST["cadastrat"])){
			
			$pass = rand(1000,9999).rand(1000,9999);
			$senha = encripta($pass);
			
			$sql = "INSERT INTO usuarios VALUES(NULL, '".$_POST["nome"]."', NULL, NULL, '".$_POST["cpf"]."', '".$_POST["email"]."', '".$senha."', 1, '".$_POST["perfil"]."', ".$_POST["unidade"].")";
			mysqli_query($con,$sql);
			
			
			ini_set('display_errors', 1);

			error_reporting(E_ALL);

			$from = "SGSC";

			$to = $_POST["email"];

			$subject = "Seu cadastro foi realizado";

			$message = "<html><body><label> E-mail: </label>$to <br> <label>Senha:</label>$pass <br>";
			$message .= "<a href='http://portalsgsc-com.umbler.net/index.php'> Clique aqui para acessar o sistema </a> </body></html>";
			
			//$headers = "From:". $from;
			
			$cabecalho = 'MIME-Version: 1.0' . "\r\n";
			$cabecalho .= 'Content-type: text/html; charset=iso-8859-1;' . "\r\n";
			$cabecalho .= "Return-Path: $from \r\n";
			$cabecalho .= "From: $from \r\n";

			mail($to, $subject, $message, $cabecalho);
			
			
			echo "<script> alert('Usuário Cadastrado!'); window.location='home.php?l=".base64_encode(1)."'; </script>";
		}
	?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-8">
            <ol class="breadcrumb float-sm-left">
			  <li class="breadcrumb-item"><a href="home.php" >Home</a></li>
              <li class="breadcrumb-item active">Novo Unuário</li>
            </ol>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

	
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
		
		<div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Dados do Unuário</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="">
                <div class="card-body">
                  <div class="form-group">
                    <label >Nome</label>
					<input type="text" name="nome" class="form-control" required />                    
                  </div>
				  
				 
				  
				  <div class="form-group">
                    <label >E-mail</label>
					<input type="email" name="email" class="form-control" required />                    
                  </div>				<div class="form-group">                    <label >CPF</label>					<input type="text" name="cpf" class="form-control" required />                                      </div>
				  
				  
				  <div class="form-group">
                    <label >Perfil</label>
                    <select name="perfil" class="form-control" required >
						<option value=""> Selecione o perfil </option>		
						<option value="3">Funcionário</option>						<option value="4">Médico</option>						<option value="5">Gestor</option>
					</select>
                  </div>
				  
                 <div class="form-group">
                    <label >Unidade</label>
                    <select name="unidade" class="form-control" required >
						
						<?php 
							$sql = "SELECT * FROM clinica ";	
							if($clinina_usuario){
								$sql .= " WHERE id=".$clinina_usuario;
							}
							$sql .= " ORDER BY nome";
							
							$exec = mysqli_query($con,$sql);
							if(mysqli_num_rows($exec) >1)
								echo '<option value=""> Selecione a unidade </option>';
							
							while($col = mysqli_fetch_array($exec)){
								echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
							}
						?>
					</select>
                  </div>
				
				  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" name="cadastrat" value="Cadastrar">
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->			
		
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
	
	<!-- bootstrap time picker-->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script> 