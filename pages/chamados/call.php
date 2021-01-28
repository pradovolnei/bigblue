	
	<?php 
		if(isset($_POST["finish"])){
			$sql_send_message = "INSERT INTO chamados VALUES(NULL, $id_usuario, '".$_POST["obs"]."', NULL, NULL, NOW(), NULL, 'Aguardando Resposta') ";
			mysqli_query($con,$sql_send_message);
			
			echo "<script> alert('Mensagem enviada'); </script>";
		}
		
		if(isset($_POST["resposta"])){
			$sql = "UPDATE chamados SET status='Fechado',resposta='".$_POST["obs"]."',id_tratador=$id_usuario,data_resposta=NOW() WHERE id=".$_POST["id"];
			mysqli_query($con,$sql);
			
			echo "<script> alert('Mensagem respondida'); </script>";
		}
	?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-8">
            <ol class="breadcrumb float-sm-left">
			  <li class="breadcrumb-item"><a href="home.php" >Home</a></li>
              <li class="breadcrumb-item active">Mensagens</li>
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
		  
			<?php 
				$sql = "SELECT * FROM chamados ";
				if($perfil_usuario != 1)
					$sql .= " WHERE id_usuario=".$id_usuario;
				$sql .= " ORDER BY data_envio DESC";
				
				$exec = mysqli_query($con,$sql);
				while($col = mysqli_fetch_array($exec)){
					
				
			?>
		  
            <!-- general form elements -->
            <div class="card card-primary card-default collapsed-card">
			  <a href="#" data-widget="collapse" style="text-decoration:none;color:#000;">
              <div class="card-header">
                <h3 class="card-title">Mensagem <?php echo str_pad($col["id"] , 6 , '0' , STR_PAD_LEFT); ?></h3>
              </div>
			  </a>
              <!-- /.card-header -->
              <!-- form start -->
              
                <div class="card-body">
                 			 
				<div class="row">
					<div class="col-md-3">
						<!-- checkbox -->
						<div class="form-group">
						  <label>
							Data de envio:
						  </label> <?php echo dataBrasileira($col["data_envio"]); ?>
						</div>
					</div>
					<div class="col-md-6">
						<!-- checkbox -->
						<div class="form-group">
						  <label>
							Mensagem:
						  </label> <?php echo $col["mensagem"]; ?>
						</div>
					</div>
					
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<!-- checkbox -->
						<div class="form-group">
						  <label>
							Data de resposta:
						  </label> <?php echo dataBrasileira($col["data_resposta"]); ?>
						</div>
					</div>
					<div class="col-md-6">
						<!-- checkbox -->
						<div class="form-group">
						  <label>
							Resposta:
						  </label> <?php echo $col["resposta"]; ?>
						</div>
					</div>
					
				</div>
				  
                </div>
                <!-- /.card-body -->
				<?php 
					if($perfil_usuario == 1 && $col["status"] == "Aguardando Resposta"){
				?>
                <div class="card-footer">
                  <button  class="btn btn-primary" data-toggle="modal" data-target="#open<?php echo $col["id"]; ?>"> Responder </button>
                </div>
				<!-- Modal -->
				<form action="" method="post" >
				<div class="modal fade" id="open<?php echo $col["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Responder mensagem <?php echo str_pad($col["id"] , 6 , '0' , STR_PAD_LEFT); ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						<div class="form-group">
						  <label>Máximo 1000 caracteres</label>
						  <textarea name="obs" class="form-control" maxlength=1000 required ></textarea>
						  <input type="hidden" name="id" value="<?php echo $col["id"]; ?>" />
						 </div>
					  </div>
					  <div class="modal-footer">
						<a class="btn btn-danger" data-dismiss="modal">Cancelar</a>
						<input type="submit" class="btn btn-success" value='Enviar' name="resposta" />
					  </div>
					</div>
				  </div>
				</div>
				</form>
					<?php } ?>
            </div>
            <!-- /.card -->
			<?php } ?>
			
			<!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Envie sua dúvida ou opinião</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="">
                <div class="card-body">
                 			 
				 <div class="form-group">
                  <label>Máximo 500 caracteres</label>
                  <textarea name="obs" class="form-control" maxlength=500 required ></textarea>
				 </div>
				  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" name="finish" value="Enviar">
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