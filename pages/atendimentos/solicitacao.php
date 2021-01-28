
	<?php 
		
		$sql_preco = "SELECT b.id,a.preco 
						FROM proc_clinica a 
						LEFT JOIN procedimento b ON b.id = a.id_proc

						WHERE b.id_espec = ".base64_decode($_GET["sp"])." AND b.nome = 'Consulta'";
		
		$exec_sql_preco = mysqli_query($con, $sql_preco);
		$col = mysqli_fetch_array($exec_sql_preco);
		$preco = valorDecimal($col["preco"], "view");
		$id_proc = $col["id"];
	
		if(isset($_POST["finish"])){
		    if(isset($_POST["proc"]))
		        $id_proc = $_POST["proc"];
		        
		      if(isset($_POST["id_paciente"]) && $_POST["id_paciente"])
		        $id_pac = $_POST["id_paciente"];
		      else
		        $id_pac = "NULL";
		        
			if($clinina_usuario)
				$sql_att = "INSERT INTO atendimentos VALUES(NULL, $id_proc, ".$_POST["plano"].", $id_pac, '".$_POST["paciente"]."', $id_usuario, ".base64_decode($_GET["cl"]).", NOW(), '".$_POST["data"]." ".$_POST["hora"]."', NULL, '', '".$_POST["obs"]."', NULL, NULL, NULL, 'Atendimento Confirmado', NULL)";
			else
				$sql_att = "INSERT INTO atendimentos VALUES(NULL, $id_proc, ".$_POST["plano"].", ".$id_usuario.", '$nome_usuario', NULL, ".base64_decode($_GET["cl"]).", NOW(), '".$_POST["data"]." ".$_POST["hora"]."', NULL, '".$_POST["obs"]."', '', NULL, NULL, NULL, 'Aguardando Confirmação da Unidade', NULL)";			
			
			mysqli_query($con, $sql_att) or die(mysqli_error($con));
			
			echo "<script> alert('Atendimento Solicitado!'); window.location='home.php?l=".base64_encode(1)."'; </script>";
		}
	?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-8">
            <ol class="breadcrumb float-sm-left">
			  <li class="breadcrumb-item"><a href="?l=<?php echo base64_encode(5); ?>&cl=<?php echo $_GET["cl"]; ?>" >Especialidades</a></li>
              <li class="breadcrumb-item active">Solicitar Consulta</li>
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
                <h3 class="card-title"><?php if(isset($_GET["nm"])) echo base64_decode($_GET["nm"])." - "; ?> <?php echo base64_decode($_GET["sp2"]); ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="">
                <div class="card-body">
                  <div class="form-group">
                    <label >Paciente</label>
					<?php 
						if($clinina_usuario){
						    if(isset($_GET["ui"])){
						        echo "<input type='text' class='form-control' disabled value='".base64_decode($_GET["un"])."' />";
	                            echo "<input type='hidden' name='paciente' value='".base64_decode($_GET["un"])."'>";					    
    						    echo "<input type='hidden' name='id_paciente' value='".$_GET["ui"]."'>";    
						    }else{
						        echo "<input type='text' class='form-control' name='paciente' />";
						    }
						    
						}else{
						    echo "<input type='text' class='form-control' value='".$nome_usuario."' disabled />";
						}
							
					?>
                    
                  </div>
				  <?php
				    if($clinina_usuario){
				?>
				<div class="form-group">
                    <label >Procedimento</label>
                    <select class="form-control" name="proc" required onChange="listPlans(this.value,<?php echo $clinina_usuario; ?>)">
                        <option value=""> Selecione o Procedimento </option>
                        <?php 
                            $sql = "SELECT b.* FROM proc_clinica a
							LEFT JOIN procedimento b ON b.id = a.id_proc
							WHERE id_espec=".base64_decode($_GET["sp"])." AND a.id_clinica=".$clinina_usuario;
                            $exec = mysqli_query($con,$sql);
                            while($col = mysqli_fetch_array($exec)){
                                echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
                            }
                        ?>
                    </select>
                  </div>
				<?php     				
				    }else{
				  ?>
				  <div class="form-group">
                    <label >Procedimento</label>
                    <input type="text" class="form-control" value="Consulta" disabled />
                  </div>
				  <?php        
				    }
				  ?>
				  <div id="planos">
				  <div class="form-group">
                    <label >Plano</label>
                    <select name="plano" class="form-control" required >
						<option value=""> Selecione o plano </option>
						<option value="NULL"> Particular R$<?php echo $preco; ?> </option>
						
						<?php 
							$sql_planos = "SELECT b.id,b.nome, a.produto 
											FROM plano_clinica a
											LEFT JOIN plano b ON b.id = a.id_plano

											WHERE a.id_clinica =".base64_decode($_GET["cl"])." ORDER BY b.nome";
							$exec_sql_planos = mysqli_query($con, $sql_planos);
							
							while($col = mysqli_fetch_array($exec_sql_planos)){
								echo '<option value="'.$col["id"].'"> '.$col["nome"].' '.$col["produto"].' </option>';
							}
						?>
					</select>
                  </div>
				  </div>
                 
				 <div class="form-group">
                    <label >Data solicitada</label>
                    <input type="date" class="form-control" name="data" required min="<?php echo date("Y-m-d");?>" />
                 </div>
				  
				 <div class="form-group">
                  <label>Horário</label>
                  <input type="time" class="form-control my-colorpicker1" name="hora" required />
				 </div>
				 
				 <div class="form-group">
                  <label>Observação</label>
                  <textarea name="obs" class="form-control" ></textarea>
				 </div>
				  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" name="finish" value="Solicitar">
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