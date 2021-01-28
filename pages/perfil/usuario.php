	
	<?php 
		if(isset($_POST["alterar"])){
			$sql = "SELECT * FROM usuarios WHERE id=$id_usuario AND senha='".encripta($_POST["atual"])."'";
			$exec = mysqli_query($con,$sql);
			if(mysqli_num_rows($exec) ==1){
				if($_POST["s1"] == $_POST["s2"]){
					$update = "UPDATE usuarios SET senha='".encripta($_POST["s1"])."' WHERE id=$id_usuario";
					mysqli_query($con,$update);
					echo "<script> alert('Senha Alterada!');window.location='logout.php'; </script>";					
				}else{
					echo "<script> alert('Senhas diferentes!'); </script>";
				}
				
			}else{
				echo "<script> alert('Senha atual incorreta!'); </script>";
			}
				
		}
		
		if(isset($_POST["save"])){
			$sql = "UPDATE usuarios SET nome='".$_POST["nome"]."',genero='".$_POST["genero"]."',cpf='".$_POST["cpf"]."',data_nascimento='".$_POST["data"]."' WHERE id=$id_usuario";
			mysqli_query($con,$sql);
			
			echo "<script> alert('Alterações Salvas!');window.location='home.php'; </script>";
		}
	?>
	
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-8">
            <ol class="breadcrumb float-sm-left">
			  <li class="breadcrumb-item"><a href="home.php" >Home</a></li>
              <li class="breadcrumb-item active"> Usuario</li>
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
                <h3 class="card-title">Dados do Usuario</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="">
                <div class="card-body">
                  <div class="form-group">
                    <label >Nome</label>
					<input type="text" name="nome" class="form-control" value="<?php echo $nome_usuario;?>" required />                    
                  </div>
				  
				  <div class="form-group">
                    <label >Gênero</label>
					<select class="form-control" name='genero'> 
						<option value=""></option>
						<?php 
							$masculino = null;
							$feminino = null;
							if($genero_usuario ==1)
								$masculino = "selected";
							if($genero_usuario ==2)
								$feminino = "selected";
							
							echo "<option $masculino value='1'>Masculino</option>";
							echo "<option $feminino value='2'>Feminino</option>";
							
						?>
					</select>
                  </div>
				  
				  <div class="form-group">
                    <label >CPF</label>
					<input type="text" name="cpf" class="form-control" value="<?php echo $cpf_usuario;?>" required />                    
                  </div>

				  <div class="form-group">
                    <label >E-mail</label>
					<input type="email" class="form-control" value="<?php echo $email_usuario;?>" disabled />                    
                  </div>
				  
				  <div class="form-group">
                    <label >Data de Nascimento</label>
					<input type="date" name="data" class="form-control" value="<?php echo $data_usuario;?>" />                    
                  </div>
				  
				 <div class="form-group">
                    <label >Perfil</label>
					<input type="text" disabled class="form-control" value="<?php echo perfilUsuario($perfil_usuario);?>" />                    
                  </div>
				
				<div class="form-group">
                    <button class="btn btn-primary" data-toggle='modal' data-target='#alter'> Alterar Senha </button>                  
                  </div>
                </div>
                <!-- /.card-body -->
				
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" name="save" value="Salvar">
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
	
	<form action="" role="form" method="POST" >
	
	<div class="modal fade" id="alter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Alterar Senha</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="form-group">
			  <label>Senha Atual</label>
			  <input type="password" name="atual" class="form-control" required >
			  
			</div>
			<div class="form-group">
			  <label>Nova Senha</label>
			  <input type="password" name="s1" class="form-control" maxlength=10 minlength=8 required >
			  
			</div>
			<div class="form-group">
			  <label>Repita a Senha</label>
			  <input type="password" name="s2" class="form-control" maxlength=10 minlength=8 required >
			  
			</div>
		  </div>
		  <div class="modal-footer">
			<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
			<input type="submit" class="btn btn-success" value='Confirmar' name="alterar" />
		  </div>
		</div>
	  </div>
	</div>
	</form>
	
	<!-- bootstrap time picker-->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script> 