	
	<?php 
		$sql_dados = "SELECT a.*, b.nome as 'nome_cidade' 
						FROM clinica a
						LEFT JOIN cidades b ON b.id = a.cidade						
						WHERE a.id=".$clinina_usuario;
		$exec_dados = mysqli_query($con,$sql_dados);
		$row = mysqli_fetch_array($exec_dados);
		$nome = $row["nome"];
		$data = dataBrasileira($row["data_cadastro"]);
		$uf = $row["uf"];
		$cidade = $row["nome_cidade"];
		$bairro = $row["bairro"];
		$endereco = $row["endereco"];
		$email = $row["email"];
		$telefone = $row["telefone"];
		$id_cidade = $row["cidade"];
		
		if(isset($_POST["save"])){
			$sql_update = "UPDATE clinica 
							SET nome='".$_POST["nome"]."',uf='".$_POST["estado"]."',cidade='".$_POST["cidade"]."',bairro='".$_POST["bairro"]."',endereco='".$_POST["rua"]."',email='".$_POST["email"]."',telefone='".$_POST["telefone"]."'
							WHERE id=".$clinina_usuario;
			mysqli_query($con,$sql_update);
			
			$sql_limpa = "DELETE FROM proc_clinica WHERE id_clinica=".$clinina_usuario;
			mysqli_query($con,$sql_limpa);
			
			$y=0;
			foreach($_POST["id_espec"] as $especis){
				$x=0;
				foreach($_POST["proc_".$y] as $procs){
					if($_POST["preco_".$y][$x])
						$preco = $_POST["preco_".$y][$x];
					else
						$preco = "NULL";
					$sql_p = "INSERT INTO proc_clinica VALUES($procs, $clinina_usuario, $especis)";
					mysqli_query($con,$sql_p) or die(mysqli_error($con));
					$x++;
				}
				
				
				if($_POST["novo_proc"][$y]){
				
					$sql = "INSERT INTO procedimento VALUES(NULL,'Consulta', ".$especis.")";
					mysqli_query($con,$sql) or die(mysqli_error($con));
					
					$id_proc_n = mysqli_insert_id($con);
					
					if($_POST["novo_preco"][$y])
						$preco = $_POST["novo_preco"][$y];
					else
						$preco = "NULL";
					
					$sql_p = "INSERT INTO proc_clinica VALUES($id_proc_n, $clinina_usuario, $preco)";
					mysqli_query($con,$sql_p) or die(mysqli_error($con));
				}
				$y++;
			}
			
			$c=0;
			foreach($_POST["consulta"] as $consul){
				
				if($_POST["preco_consulta"][$c])
					$preco = $_POST["preco_consulta"][$c];
				else
					$preco = "NULL";
			
				$sql_p = "INSERT INTO proc_clinica VALUES($consul, $clinina_usuario, $preco)";
				mysqli_query($con,$sql_p) or die(mysqli_error($con));
				
				$c++;
			}
			
			if($_POST["especialidade"]){
				$sql = "INSERT INTO especialidades VALUES(NULL, '".$_POST["especialidade"]."')";
				mysqli_query($con,$sql) or die(mysqli_error($con));
				$id_sp = mysqli_insert_id($con);
				
				$sql = "INSERT INTO procedimento VALUES(NULL, 'Consulta', $id_sp)";
				mysqli_query($con,$sql) or die(mysqli_error($con));
				$id_pr = mysqli_insert_id($con);
				
				if($_POST["preco"])
					$preco = $_POST["preco"];
				else
					$preco = "NULL";
				
				$sql = "INSERT INTO proc_clinica VALUES($id_pr, '".$clinina_usuario."', $preco)";
				mysqli_query($con,$sql) or die(mysqli_error($con));
			}
			
			$sql_p = "DELETE FROM plano_clinica WHERE id_clinica=$clinina_usuario";
			mysqli_query($con,$sql_p) or die(mysqli_error($con));
			
			$y=0;
			foreach($_POST["plano"] as $procs){
				if($_POST["produto"][$y])
					$produto = "'".$_POST["produto"][$y]."'";
				else
					$produto = "NULL";
				
				$sql_p = "INSERT INTO plano_clinica VALUES($procs, $clinina_usuario, $produto)";
				mysqli_query($con,$sql_p) or die(mysqli_error($con));
				$y++;
			}
			
			echo "<script> alert('Dados Atualizados!');window.location='?l=".base64_encode(10)."'; </script>";
		}
		
	?>
	
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-8">
            <ol class="breadcrumb float-sm-left">
			  <li class="breadcrumb-item"><a href="home.php" >Home</a></li>
              <li class="breadcrumb-item active"> Unidade</li>
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
					<input type="text" name="nome" class="form-control" value="<?php echo $nome;?>" required />                    
                  </div>
				  
				  <div class="form-group">
                  <label>Estado</label>
					  <select class="form-control" style="width: 100%;" onChange="listCity(this.value)" name="estado" required>
						<option value=''>Todos os estados</option>
						
						<?php 
								$sql_lab = "SELECT uf FROM cidades GROUP BY uf ORDER BY uf ";
								
								$exec_sql_lab = mysqli_query($con, $sql_lab);
								
								while($col = mysqli_fetch_array($exec_sql_lab)){
									if($uf == $col["uf"])
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
							$sql_lab = "SELECT * FROM cidades WHERE uf='".$uf."' ORDER BY nome";
							
							$exec_sql_lab = mysqli_query($con, $sql_lab);
							
							while($col = mysqli_fetch_array($exec_sql_lab)){
								
								if($id_cidade == $col["id"])
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
                    <input type="text" name="bairro" value="<?php echo $bairro;?>" class="form-control" />
                 </div>
				 
				 <div class="form-group">
                    <label >Logadouro, N°</label>
                    <input type="text" name="rua" class="form-control" value="<?php echo $endereco;?>" />
                 </div>
				 
				  <div class="form-group">
                    <label >E-mail</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email;?>" />
                 </div>
				 
				 <div class="form-group">
                    <label >Telefone</label>
                    <input type="text" name="telefone" value="<?php echo $telefone;?>" class="form-control " data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask />
                 </div>
				 
				 <div class="form-group">
                  <label>Especialides</label>
					<!-- iCheck -->
					
						
							<?php 
									$sql_lab = "SELECT c.nome,c.id 
												FROM proc_clinica a 
												LEFT JOIN procedimento b ON b.id = a.id_proc
												LEFT JOIN especialidades c On c.id = b.id_espec
												
												WHERE a.id_clinica = $clinina_usuario
												GROUP BY c.id 
												ORDER BY c.nome ";
									$a=0;
									$exec_sql_lab = mysqli_query($con, $sql_lab);
									
									while($col = mysqli_fetch_array($exec_sql_lab)){
							?>
							
										<div class="card card-success card-default collapsed-card">
											<a href="#" data-widget="collapse" style="text-decoration:none;color:#000;">
											<div class="card-header" style="background-color:#48D1CC;">
												<h6 class="card-title"><?php echo $col["nome"];?></h6>
											</div>
											</a>
											<div class="card-body">
											<?php 
												$sql_p = "SELECT a.id,a.nome,b.preco, b.id_proc
													FROM procedimento a 
													LEFT JOIN (SELECT * FROM proc_clinica WHERE id_clinica=$clinina_usuario)as b ON b.id_proc = a.id
													
													WHERE a.id_espec = ".$col["id"]." 
													ORDER BY a.nome ";
												$exec_p = mysqli_query($con,$sql_p);
												echo "<table>";
												
												
												while($row = mysqli_fetch_array($exec_p)){
													if($row["nome"] == "Consulta"){
														echo "<tr><td><input type='radio' checked  />Consulta</td><td><input type='text' name='preco_consulta[]' value='".$row["preco"]."'></td></tr>";
														echo "<input type='hidden' name='consulta[]' value='".$row["id"]."'>";
													}else{
														echo "<tr>";
														$checked = null;
														if($row["id"] == $row["id_proc"])
															$checked = "checked";
														
														echo "<td><input type='checkbox' $checked name='proc_".$a."[]' value='".$row["id"]."'> ".$row["nome"]."</td>";
														echo "<td><input type='text' name='preco_".$a."[]' value='".$row["preco"]."'> </td>";
														echo "</tr>";
													}
												}
												echo "</table>";
												$a++;
												echo "<label>Novo Procedimento para ".$col["nome"]." </label>";
												echo "<input type='text' name='novo_proc[]' class='form-control' />";
												echo "<label>Preço (R$) </label>";
												echo "<input type='number' name='novo_preco[]' class='form-control' style='width:10%' />";
											?>
											</div>
										</div>
							<?php
									echo "<input type='hidden' name='id_espec[]' value='".$col["id"]."' />";
									}
									
								?>
							
							
                </div>
				
				
				<div class="form-group">
                  <label>Nova Especialidade</label>
					  <select class="form-control" style="width: 100%;" onChange="listTespec(this.value);" onChange="listOutros(this.value);" name="especialidade">
						<option value=''></option>
						
						<?php 
								$sql_lab = "SELECT c.nome,c.id 
											FROM proc_clinica a 
											LEFT JOIN procedimento b ON b.id = a.id_proc
											LEFT JOIN especialidades c On c.id = b.id_espec
											LEFT JOIN (SELECT * FROM proc_clinica WHERE id_clinica=$clinina_usuario)as d ON d.id_proc = a.id_proc
											
											WHERE d.id_proc IS NULL
											GROUP BY c.id 
											ORDER BY c.nome ";
								
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
								$sql_lab = "SELECT a.*, b.id_plano FROM plano a
													LEFT JOIN (SELECT * FROM plano_clinica WHERE id_clinica=$clinina_usuario )as b ON b.id_plano = a.id
								ORDER BY nome ";

								$exec_sql_lab = mysqli_query($con, $sql_lab);
								echo "<table>";
								
								while($col = mysqli_fetch_array($exec_sql_lab)){
									echo "<tr>";
									$checked = null;
									if($col["id"] == $col["id_plano"])
										$checked = "checked";
									
									echo '<td> <input type="checkbox" class="flat-red" name="plano[]" value="'.$col["id"].'" '.$checked.' > '.$col["nome"].'</td> <td> <input type="text" name="produto[]" placeholder="Cite o produto (Opcional)" /></td>';
									echo "</tr>";
								}
								
								echo "</table>";

							?>
							

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
	
	<!-- bootstrap time picker-->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script> 