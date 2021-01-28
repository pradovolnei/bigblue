	<?php 
		include "pages/atendimentos/consulta_controller.php";
	?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-2">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Orçamentos</li>
            </ol>
          </div>
		  <div class="col-sm-10">
			<?php 
				if($perfil_usuario == 1 || $perfil_usuario == 3 || $perfil_usuario == 5){
					echo '<a href="?l='.base64_encode(21).'&cl='.base64_encode($clinina_usuario).'&o" style="text-decoration:none;color:#000;">';
				
			?>
			
            <button type="button" class="btn btn-block btn-sm pull-right add-mobile" style="background-color:#48D1CC;" >Solicitar Orçamento</button>
			</a>
				<?php } ?>
          </div>
		  
		  
          
        </div>
		<div class="row mb-2">
			<div class="col-sm-2"></div>
			<div class="col-sm-10">
			<?php 
				if($perfil_usuario == 1 || $perfil_usuario == 3 || $perfil_usuario == 5){
					echo '<a href="?l='.base64_encode(21).'&cl='.base64_encode($clinina_usuario).'&g" style="text-decoration:none;color:#000;">';
				
					//echo '<a href="?l='.base64_encode(5).'&cl='.base64_encode($clinina_usuario).'" style="text-decoration:none;color:#000;">';
				
			?>
			
            <button type="button" class="btn btn-block btn-sm pull-right add-mobile" style="background-color:#48D1CC;" >Cadastrar Guia</button>
			</a>
				<?php } ?>
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
                
				
				<?php if($perfil_usuario == 1){ ?>
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
				<?php } ?>
				
				
               
              </div>
			  
			  
			  <div class="col-md-6">
                <div class="form-group">
                  <label>Convenio</label>
                  <select class="form-control" style="width: 100%;" name="plano" onChange="listCity(this.value)">
                   
                    <?php 
						$sql_plano = "SELECT * FROM plano";
						$exec_sql_plano = mysqli_query($con, $sql_plano);
						echo "<option value=''> todos os planos </option>";
						echo "<option value='zero'> Particular </option>";
						while($col = mysqli_fetch_array($exec_sql_plano)){
							if(isset($_POST["plano"]) && $_POST["plano"] == $col["id"])
								echo "<option value='".$col["id"]."' selected > ".$col["nome"]." </option>";
							else
								echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
						}
					?>
                  </select>
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
			$sql_atendimentos = "SELECT a.*,b.nome as 'clinica' FROM pedido a
			LEFT JOIN clinica b ON b.id = a.id_clinica

			WHERE a.telefone='orcamento' ";
			
			if($perfil_usuario == 4)
				$sql_atendimentos .= " AND medico='".$nome_usuario."' ";
			
			if($perfil_usuario == 5 || $perfil_usuario == 3)
				$sql_atendimentos .= " AND id_clinica=".$clinina_usuario;
			
			if($perfil_usuario == 2)
				$sql_atendimentos .= " AND paciente='".$nome_usuario."' ";
			
			
			
			/*if(isset($_POST["list"])){
				if($_POST["estado"])
					$sql_atendimentos .= " AND b.uf='".$_POST["estado"]."'";
				
				if($_POST["plano"])
					$sql_atendimentos .= " AND a.id_plano='".$_POST["plano"]."'";
				
				if($_POST["clinica"])
					$sql_atendimentos .= " AND b.id=".$_POST["clinica"];
				
				if(isset($_POST["cidade"]) && $_POST["cidade"])
					$sql_atendimentos .= " AND b.cidade='".$_POST["cidade"]."'";
				
				if($_POST["proc"])
					$sql_atendimentos .= " AND c.id='".$_POST["proc"]."'";
				
				
				if($_POST["notas"]){
					
					$notas = explode("-", $_POST["notas"]);
					
					$sql_atendimentos .= " AND a.nota >= ".$notas[0]." AND a.nota <= ".$notas[1];
				}
				
				if($_POST["status"])
					$sql_atendimentos .= " AND a.status='".$_POST["status"]."'";
					
				
			}*/
			
			$sql_atendimentos .= " ORDER BY dt_marcado ";
			
			//echo $sql_atendimentos;

			$exec_sql_atendimentos = mysqli_query($con, $sql_atendimentos);
			
			if(mysqli_num_rows($exec_sql_atendimentos) >= 1){
				while($row = mysqli_fetch_array($exec_sql_atendimentos)){
		?>
			
		<div class="row">
          <!-- /.col (left) -->
          <div class="col-md-12 ">

            <!-- iCheck -->
            <div class="card card-success card-default collapsed-card">
			<a href="#" data-widget="collapse" style="text-decoration:none;color:#000;">
              <div class="card-header" style="background-color:#48D1CC;">
                <h6 class="card-title">Orçamento - <?php echo str_pad($row["id"] , 6 , '0' , STR_PAD_LEFT);?></h6>
              </div>
			</a>
              <div class="card-body">
                <!-- Minimal style -->
				<div class="row">
					<div class="col-md-3">
						<!-- checkbox -->
						<div class="form-group">
						  <label>
							Clínica:
						  </label> <?php echo $row["clinica"]; ?>
						</div>
					</div>
					
					<div class="col-md-3">
						<!-- checkbox -->
						<div class="form-group">
						  <label>
							Data Agendada:
						  </label> <?php echo dataBrasileira($row["dt_marcado"]); ?>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="form-group">
						  <label>
							Paciente:
						  </label> <?php echo $row["paciente"]; ?>
						</div>
					</div>
					
				</div>
				
				
				
				 <!-- Minimal style -->
				<div class="row">
					<div class="col-md-6">
						<!-- checkbox -->
						<div class="form-group">
						  <label>
							Observação:
						  </label> <?php echo $row["obs"]; ?> <br> 
						</div>
					</div>
					<div class="col-md-6">
						<!-- checkbox -->
						<div class="form-group">
						  <label>
							Resultado:
						  </label> 
						</div>
					</div>					
					
				</div>
				
				 <!-- Minimal style -->
				<div class="row">
					<div class="col-md-6">
						<!-- checkbox -->
						<div class="form-group">
						  <label>
							Exames:
						  </label> <br>
						  <?php 
							$sql_exames="SELECT b.nome AS 'exame', c.nome AS 'espec'
								FROM pedido_exame a
								LEFT JOIN `procedimento` b ON b.id = a.id_exame
								LEFT JOIN `especialidades` c ON c.id = b.id_espec
								WHERE id_pedido = ".$row["id"];
							$exec_exames = mysqli_query($con,$sql_exames);
							while($cols = mysqli_fetch_array($exec_exames)){
								echo $cols["espec"].": ".$cols["exame"]."<br>";
							}
							?>  
						</div>
					</div>
										
					
				</div>
				
					<?php 
						if($row["status"] == "Aguardando Confirmação da Unidade"){
							echo "<div class='row'>";
							echo '<div class="col-md-3">';
							echo '<div class="form-group">';
							echo "<button class='btn btn-block btn-danger btn-sm pull-right '  data-toggle='modal' data-target='#cancel".$row["id"]."'> Cancelar </button> ";
							echo '</div>';
							echo '</div>';
							echo "</div>";
							
						?>
						<br />
						<form action="" method="post" >
						<div class="modal fade" id="cancel<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Cancelar atendimento <?php echo str_pad($row["id"] , 6 , '0' , STR_PAD_LEFT); ?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							  </div>
							  <div class="modal-body">
								<div class="form-group">
								  <label>Observação (Máximo 1000 caracteres)</label>
								  <textarea name="obs" class="form-control" maxlength=1000 required ></textarea>
								  <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
								 </div>
							  </div>
							  <div class="modal-footer">
								<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
								<input type="submit" class="btn btn-success" value='Confirmar' name="cancelar" />
							  </div>
							</div>
						  </div>
						</div>
						</form>
						
						<?php
						
						if($clinina_usuario){
						    echo "<div class='row'>";
							echo '<div class="col-md-3">';
							echo '<div class="form-group">';
							echo "<button class='btn btn-block btn-success btn-sm pull-right '  data-toggle='modal' data-target='#confirm".$row["id"]."'> Confirmar </button> ";
							echo '</div>';
							echo '</div>';
							echo "</div>";
							
						?>
						
						<form action="" method="post" >
						<div class="modal fade" id="confirm<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Confirmar atendimento <?php echo str_pad($row["id"] , 6 , '0' , STR_PAD_LEFT); ?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							  </div>
							  <div class="modal-body">
								<div class="form-group">
								  <label>Observação (Máximo 1000 caracteres)</label>
								  <textarea name="obs" class="form-control" maxlength=1000 ></textarea>
								  <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
								 </div>
							  </div>
							  <div class="modal-footer">
								<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
								<input type="submit" class="btn btn-success" value='Confirmar' name="confirm" />
							  </div>
							</div>
						  </div>
						</div>
						</form>
						<?php
						}
						
						}
					?>
					
					<?php 
						if($row["status"] == "Realizado" && $clinina_usuario){
							echo "<div class='row'>";
							echo '<div class="col-md-10">';
							echo '<div class="form-group">';
							//echo "<button class='btn btn-block btn-primary btn-sm add-mobile'  data-toggle='modal' data-target='#send".$row["id"]."'> Encaminhar </button> ";
							echo "<a href='?l=".base64_encode(6)."&cl=".base64_encode($clinina_usuario)."&sp=".base64_encode($row["id_espec"])."&sp2=".base64_encode($row["espec"])."&un=".base64_encode($row["nome_paciente"])."&ui=".$row["id_paciente"]."'><button class='btn btn-block btn-primary btn-sm add-mobile'> Encaminhar </button></a>";
							echo '</div>';
							echo '</div>';
							echo "</div>";
						}
					?>
				
				
				<?php 
						if($row["status"] == "Realizado" && $row["id_paciente"] == $id_usuario){
							echo "<div class='row'>";
							echo '<div class="col-md-10">';
							echo '<div class="form-group">';
							echo "<button class='btn btn-block btn-primary btn-sm add-mobile'  data-toggle='modal' data-target='#nota".$row["id"]."'> Avaliar </button> ";
				
							echo '</div>';
							echo '</div>';
							echo "</div>";
						}
						
						if($row["status"] == "Atendimento Confirmado" && $clinina_usuario){
							echo "<div class='row'>";
							echo '<div class="col-md-10">';
							echo '<div class="form-group">';
							echo "<button class='btn btn-block btn-primary btn-sm add-mobile'  data-toggle='modal' data-target='#result".$row["id"]."'> Fornecer resultado </button> ";
				
							echo '</div>';
							echo '</div>';
							echo "</div>";
						}
						
						if(($row["status"] == "Aguardando Confirmação da Unidade" || $row["status"] == "Atendimento Confirmado") && $clinina_usuario){
							echo "<div class='row'>";
							echo '<div class="col-md-10">';
							echo '<div class="form-group">';
							echo "<button class='btn btn-block btn-primary btn-sm add-mobile'  data-toggle='modal' data-target='#remarcar".$row["id"]."'> Remarcar </button> ";
				
							echo '</div>';
							echo '</div>';
							echo "</div>";
						}
						
						/*if($row["status"] != "Cancelado"){
							echo "<div class='row'>";
							echo '<div class="col-md-10">';
							echo '<div class="form-group">';
							echo "<button class='btn btn-block btn-primary btn-sm add-mobile'  data-toggle='modal' data-target='#chat".$row["id"]."'> Enviar Mensagem</button> ";
				
							echo '</div>';
							echo '</div>';
							echo "</div>";
						}*/
					?>
				
				<form action="" method="post" >
				<div class="modal fade" id="nota<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Avaliar atendimento <?php echo str_pad($row["id"] , 6 , '0' , STR_PAD_LEFT); ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						<div class="form-group">
						  <label>Nota de 1 a 5</label>
						  <input type="number" name="nota" class="form-control" max=5 min=1 required />
						  <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
						 </div>
					  </div>
					  <div class="modal-footer">
						<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
						<input type="submit" class="btn btn-success" value='Confirmar' name="avaliar" />
					  </div>
					</div>
				  </div>
				</div>
				</form>
				
				<form action="" method="post" enctype="multipart/form-data" >
				<div class="modal fade" id="result<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Resultado atendimento <?php echo str_pad($row["id"] , 6 , '0' , STR_PAD_LEFT); ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						<div class="form-group">
						  <label>Resultado</label>
						  <input type="text" name="resultado" required class="form-control" maxlength=1000 >
						  <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
						</div>
						
						<div class="form-group">
						  <label>Anexar laudo (Opcional)</label>
						  <input type="file" name="laudo" class="form-control" />
						 
						</div>
						
						<div class="form-group">
						  <label>Observação (Máximo 1000 caracteres)</label>
						  <textarea name="obs" class="form-control" maxlength=1000 ></textarea>
						  
						</div>
					  </div>
					  <div class="modal-footer">
						<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
						<input type="submit" class="btn btn-success" value='Confirmar' name="finalizar" />
					  </div>
					</div>
				  </div>
				</div>
				</form>
				
				
				<form action="" method="post" enctype="multipart/form-data" >
				<div class="modal fade" id="chat<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Enviar mensaegm para <?php echo $row["clinica"]; ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						
						<div class="form-group">
						  <label>Observação (Máximo 500 caracteres)</label>
						  <textarea name="obs" class="form-control" maxlength=500 ></textarea>
						  <?php 
							if($clinina_usuario){
								echo '<input type="hidden" name="receptor" value="'.$row["id_paciente"].'" />';
							}else{
								$sql_us = "SELECT id FROM usuarios WHERE id_clinica=".$row["id_clinica"]." ORDER BY RAND() LIMIT 1";
								$exec_us = mysqli_query($con,$sql_us);
								$col_us = mysqli_fetch_array($exec_us);
								echo '<input type="hidden" name="receptor" value="'.$col_us["id"].'" />';
							}
						  ?>
						  
						</div>
					  </div>
					  <div class="modal-footer">
						<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
						<input type="submit" class="btn btn-success" value='Enviar' name="send_chat" />
					  </div>
					</div>
				  </div>
				</div>
				</form>
				
				<form action="" method="post" enctype="multipart/form-data" >
				<div class="modal fade" id="remarcar<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Remarcar atendimento <?php echo str_pad($row["id"] , 6 , '0' , STR_PAD_LEFT); ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						
						<div class="form-group">
						  <label>Nova Data</label>
						  <input type="date" name="data" required class="form-control" min="<?php echo date("Y-m-d");?>" />
						  <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
						  
						</div>
						
						<div class="form-group">
						  <label>Horário</label>
						  <input type="time" name="hora" required class="form-control" />
						 
						</div>
					  </div>
					  <div class="modal-footer">
						<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
						<input type="submit" class="btn btn-success" value='Confirmar' name="remarcar" />
					  </div>
					</div>
				  </div>
				</div>
				</form>
				
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (right) -->
        </div>
		
        <!-- /.row -->
			
			
		<?php
				}
			}else{
				echo "<h5><u> Nenhum atendimento solicitado</u> </h5>";
			}
			
		?>

		
		
		
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->