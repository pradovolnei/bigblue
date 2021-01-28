	
	<?php 
		if(isset($_POST["cadastrat"])){
			$sql = "INSERT INTO clinica VALUES (NULL, '".$_POST["nome"]."', CURDATE(), '".$_POST["estado"]."', '".$_POST["cidade"]."', '".$_POST["bairro"]."', '".$_POST["rua"]." ".$_POST["numero"]."', '".$_POST["email"]."', '".$_POST["telefone"]."')";
			mysqli_query($con,$sql);
			
			$id_cl = mysqli_insert_id($con);
			
			if($_POST["especialidade"] == "outras"){
				$sql_cl = "INSERT INTO especialidades VALUES(NULL, '".$_POST["outras"]."')";
				mysqli_query($con,$sql_cl) or die(mysqli_error($con));
				
				$id_esp = mysqli_insert_id($con);
				
				$sql_cl = "INSERT INTO procedimento VALUES(NULL, 'Consulta', $id_esp)";
				mysqli_query($con,$sql_cl) or die(mysqli_error($con));
				
				$id_proc = mysqli_insert_id($con);
				
				if($_POST["preco"])
					$preco = $_POST["preco"];
				else
					$preco = "NULL";
				
				$sql_cl = "INSERT INTO proc_clinica VALUES($id_proc, $id_cl, $preco)";
				mysqli_query($con,$sql_cl) or die(mysqli_error($con));
				
			}else{
				$x=0;
				foreach($_POST["procedimento"] as $procs){
					if($_POST["preco"][$x])
						$preco = $_POST["preco"][$x];
					else
						$preco = "NULL";
					$sql_p = "INSERT INTO proc_clinica VALUES($procs, $id_cl, $preco)";
					mysqli_query($con,$sql_p) or die(mysqli_error($con));
					$x++;
				}				
			}
			
			$y=0;
			foreach($_POST["plano"] as $procs){
				if($_POST["produto"][$y])
					$produto = "'".$_POST["produto"][$y]."'";
				else
					$produto = "NULL";
				
				$sql_p = "INSERT INTO plano_clinica VALUES($procs, $id_cl, $produto)";
				mysqli_query($con,$sql_p) or die(mysqli_error($con));
				$y++;
			}
			
			echo "<script> alert('Clinica cadastrada!');window.location='?l=".base64_encode(5)."&cl=".base64_encode($id_cl)."&nm=".base64_encode($_POST["nome"])."'; </script>";
		}
	?>
	
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-8">
            <ol class="breadcrumb float-sm-left">
			  <li class="breadcrumb-item"><a href="home.php" >Home</a></li>
              <li class="breadcrumb-item active">Nova Unidade</li>
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
                <h3 class="card-title">Dados da Unidade</h3>
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
                  <label>Estado</label>
					  <select class="form-control" style="width: 100%;" onChange="listCity(this.value)" name="estado" required>
						<option value=''>Todos os estados</option>
						
						<?php 
								$sql_lab = "SELECT uf FROM cidades GROUP BY uf ORDER BY uf ";
								
								$exec_sql_lab = mysqli_query($con, $sql_lab);
								
								while($col = mysqli_fetch_array($exec_sql_lab)){
									if(isset($_POST["estado"]) && $_POST["estado"] == $col["uf"])
										echo "<option value='".$col["uf"]."' selected> ".$col["uf"]." </option>";
									else
										echo "<option value='".$col["uf"]."'> ".$col["uf"]." </option>";
								}
							?>
					  </select>
                  </div>
				  
				<div id="citys">
					<!-- /.form-group -->
					<div class="form-group">
					  <label>Cidade</label>
					  <select class="form-control" name="cidade" required >
						<?php 
							$sql_lab = "SELECT * FROM cidades ";
							if(isset($_POST["estado"]) && $_POST["estado"])
								$sql_lab .= " WHERE uf='".$_POST["estado"]."'";
							$exec_sql_lab = mysqli_query($con, $sql_lab);
							
							while($col = mysqli_fetch_array($exec_sql_lab)){
								
								if(isset($_POST["cidade"]) && $_POST["cidade"] == $col["id"])
									echo "<option value='".$col["id"]."' selected > ".$col["nome"]." </option>";
								else
									echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
							}
						?>
					  </select>
					</div>
					<!-- /.form-group -->
				</div>
				  
                 <div class="form-group">
                    <label >Bairro</label>
                    <input type="text" name="bairro" class="form-control" />
                 </div>
				 
				 <div class="form-group">
                    <label >Logadouro</label>
                    <input type="text" name="rua" class="form-control" />
                 </div>
				 
				 <div class="form-group">
                    <label >N°</label>
                    <input type="text" name="numero" class="form-control" />
                 </div>
				 
				  <div class="form-group">
                    <label >E-mail</label>
                    <input type="email" name="email" class="form-control" />
                 </div>
				 
				 <div class="form-group">
                    <label >Telefone</label>
                    <input type="email" name="telefone" class="form-control " data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask />
                 </div>
				
				
				<div class="form-group">
                  <label>Especialidade</label>
					  <select class="form-control" style="width: 100%;" onChange="listTespec(this.value);" onChange="listOutros(this.value);" name="especialidade" required>
						<option value=''></option>
						
						<?php 
								$sql_lab = "SELECT * FROM especialidades ORDER BY nome ";
								
								$exec_sql_lab = mysqli_query($con, $sql_lab);
								
								while($col = mysqli_fetch_array($exec_sql_lab)){
									echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
								}
								echo "<option value='outras'> Outras </option>";
							?>
					  </select>
					  <div id="outros"></div>
                </div>
				
				
				<div id="div_procs"></div>
				  
				<div class="form-group">
                  <label>Planos</label>
					  						
						<?php 
								$sql_lab = "SELECT * FROM plano WHERE id<999 ORDER BY nome ";
								
								$exec_sql_lab = mysqli_query($con, $sql_lab);
								echo "<table>";
								
								while($col = mysqli_fetch_array($exec_sql_lab)){
									echo "<tr>";
									echo '<td><input type="checkbox" class="flat-red" name="plano[]" value="'.$col["id"].'"> '.$col["nome"].'</td> <td> <input type="text" name="produto[]" placeholder="Cite o produto (Opcional)" /></td>';
									echo "</tr>";
								}
								
								echo "</table>";

							?>
							

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