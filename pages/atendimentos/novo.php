
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-2">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Unidades</li>
            </ol>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

	
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
		

				<form action="" method="post">
		<!-- SELECT2 EXAMPLE -->
        <?php 
			if(isset($_POST["list"]))
				echo '<div class="card card-default">';
			else
				echo '<div class="card card-default collapsed-card">';
		?>
		<a href="#" data-widget="collapse" style="text-decoration:none;color:#000;">
          <div class="card-header">
            <h3 class="card-title">Filtro de busca</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" >\/</button>
            </div>
          </div>
		</a>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Estado</label>
                  <select class="form-control" style="width: 100%;" onChange="listCity(this.value)" name="estado">
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
					  <select class="form-control" name="cidade" onChange="listLab(this.value, '') ">
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
				
				<div id="labs">
				<div class="form-group">
                  <label>Clínica</label>
                  <select class="form-control" style="width: 100%;" onChange="listWork(this.value)" name="clinica">
					<option value=''>Todas as clínicas</option>
                    <?php 
						$sql_lab = "SELECT * FROM clinica";
						if($clinina_usuario)
							$sql_lab .= " WHERE id=".$clinina_usuario;
						
						$exec_sql_lab = mysqli_query($con, $sql_lab);
						
						while($col = mysqli_fetch_array($exec_sql_lab)){
							if(isset($_POST["clinica"]) && $_POST["clinica"] == $col["id"])
								echo "<option value='".$col["id"]."' selected > ".$col["nome"]." </option>";
							else
								echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
							
						}
					?>
                  </select>
                </div>
				</div>
				
				<div id="procs">
				<div class="form-group">
                  <label>Procedimento</label>
                  <select class="form-control" style="width: 100%;" name="proc">
					<option value=''>Todas os procedimentos</option>
                    <?php 
						$sql_lab = "SELECT * FROM procedimento";
						$exec_sql_lab = mysqli_query($con, $sql_lab);
						
						while($col = mysqli_fetch_array($exec_sql_lab)){
							if(isset($_POST["proc"]) && $_POST["proc"] == $col["id"])
								echo "<option value='".$col["id"]."' selected > ".$col["nome"]." </option>";
							else
								echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
						}
					?>
                  </select>
                </div>
				</div>
               
              </div>
			  
			  
			  <div class="col-md-6">
                <div class="form-group">
                  <label>Plano</label>
                  <select class="form-control" style="width: 100%;" name="plano" onChange="listCity(this.value)">
                   
                    <?php 
						$sql_plano = "SELECT * FROM plano";
						$exec_sql_plano = mysqli_query($con, $sql_plano);
						echo "<option value=''> todos os planos </option>";
						while($col = mysqli_fetch_array($exec_sql_plano)){
							if(isset($_POST["plano"]) && $_POST["plano"] == $col["id"])
								echo "<option value='".$col["id"]."' selected > ".$col["nome"]." </option>";
							else
								echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
						}
					?>
                  </select>
                </div>
				
				
				 <!-- /.form-group -->
					<div class="form-group">
					  <label>Avaliação</label>
					  <select class="form-control" name="notas" style="width: 100%;">
						<option value=""> Todas as notas</option>
						<?php 
							$bom = null;
							$medio = null;
							$ruim = null;
							
							if(isset($_POST["notas"])){
								if($_POST["notas"] == "4-5")
									$bom = "selected";
								if($_POST["notas"] == "3-4")
									$medio = "selected";
								if($_POST["notas"] == "0-3")
									$ruim = "selected";
							}
						?>
						<option value="4-5" <?php echo $bom; ?> > 4 - 5</option>
						<option value="3-4" <?php echo $medio; ?> > 3 - 4</option>
						<option value="0-3" <?php echo $ruim; ?> > Abaixo de 3</option>
					  </select>
					</div>
					<!-- /.form-group -->
					
				<div id="works">
				<div class="form-group">
                  <label>Especialidade</label>
                  <select class="form-control" style="width: 100%;" name="especialidade" onChange="listProcs(this.value)">
					
                    <?php 
						$sql_lab = "SELECT * FROM especialidades";
						$exec_sql_lab = mysqli_query($con, $sql_lab);
						echo "<option value=''> todos as especialidades </option>";
						while($col = mysqli_fetch_array($exec_sql_lab)){
							if(isset($_POST["especialidade"]) && $_POST["especialidade"] == $col["id"])
								echo "<option value='".$col["id"]."' selected > ".$col["nome"]." </option>";
							else
								echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
						}
					?>
                  </select>
                </div>
				</div>
				
               
              </div>
              
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <input type="submit" value="Listar" class="btn btn-block btn-success btn-sm pull-right add-mobile" name="list" />
          </div>
        </div>
        <!-- /.card -->
		</form>
		
		
			<?php 
					$sql_especs = "SELECT b.nome AS 'proc', c.nome AS 'clinica', e.nota ,c.bairro, c.endereco, c.id, c.telefone, c.email 
									FROM proc_clinica a
									LEFT JOIN procedimento b ON b.id = a.id_proc
									LEFT JOIN clinica c ON c.id= a.id_clinica
									LEFT JOIN plano_clinica d ON d.id_clinica = a.id_clinica
									LEFT JOIN (SELECT COALESCE(AVG(nota),0) as 'nota',id_clinica FROM atendimentos GROUP BY id_clinica )as e ON e.id_clinica = a.id_clinica
									WHERE a.id_proc IS NOT NULL ";
					
					if(isset($_POST["list"])){
						if($_POST["estado"])
							$sql_especs .= " AND c.uf='".$_POST["estado"]."'";
						
						if($_POST["plano"])
							$sql_especs .= " AND d.id_plano='".$_POST["plano"]."'";
						
						if($_POST["clinica"])
							$sql_especs .= " AND c.id=".$_POST["clinica"];
						
						if(isset($_POST["cidade"]) && $_POST["cidade"])
							$sql_especs .= " AND c.cidade='".$_POST["cidade"]."'";
						
						if($_POST["proc"])
							$sql_especs .= " AND b.id='".$_POST["proc"]."'";
						
						
						if($_POST["notas"]){
							
							$notas = explode("-", $_POST["notas"]);
							
							$sql_especs .= " AND e.nota >= ".$notas[0]." AND e.nota <= ".$notas[1];
						}
							
						
					}

					if($clinina_usuario)	
						$sql_especs .= " AND c.id=".$clinina_usuario;
					
					$sql_especs .= " GROUP BY c.id";
					$sql_especs .= " ORDER BY e.nota DESC ";
					
					if(!isset($_POST["list"])){
						$sql_especs .= " LIMIT 10";
					}
						
					$exec_sql_especs = mysqli_query($con,$sql_especs) or die(mysqli_error($con));
					if(mysqli_num_rows($exec_sql_especs) > 0){
						while($col = mysqli_fetch_array($exec_sql_especs)){
							
						?>						
						<a href="?l=<?php echo base64_encode(5); ?>&cl=<?php echo base64_encode($col["id"]); ?>&nm=<?php echo base64_encode($col["clinica"]); ?>" style="text-decoration:none;color:#000;">
						<div class="card card-info" >
						
						  <div class="card-header" style="background-image: linear-gradient(to bottom right, #00FFFF, #00BFFF) !important;">
							<h3 class="card-title"><?php echo $col["clinica"]; ?> <img src="dist/img/star.png" class="aval-mobile" /> <?php if($col["nota"]>0) echo valorDecimal($col["nota"], "view"); else echo "Sem Nota"; ?> </h3> 
						  </div>
						
						  
						  <div class="card-body">
						  
							
							<?php 
								echo $col["bairro"]." -- ".$col["endereco"]."<br>"; 
								echo "Telefone: ".$col["telefone"]."<br>"; 
								echo "Email: ".$col["email"]."<br>"; 
							?>
							
							
						  </div>
						  <!-- /.card-body -->
						</div>
						<!-- /.card -->
						</a>
						<?php
						}
					}else{
						echo "<h3> Nenhuma rede encontrada... </h3>";
					}
					
						?>
		
       

		
		
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->