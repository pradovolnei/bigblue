
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-8">
            <ol class="breadcrumb float-sm-left">
			  <li class="breadcrumb-item"><a href="?l=<?php echo base64_encode(4); ?>" >Novo Atendimento</a></li>
              <li class="breadcrumb-item active">Ficha do Paciente</li>
            </ol>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

	
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
		
		<form action="?l=<?php echo base64_encode(16);?>" method="post">
		<div class="card card-info" >
						
						  <div class="card-header" style="background-image: linear-gradient(to bottom right, #0077FF, #00BFFF) !important;">
							<h3 class="card-title">Dados do Paciente </h3> 
						  </div>
						
						  
						  <div class="card-body">
						  
							
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Nome</label>
											<input type="text" class="form-control" name="nome" required />
										</div>
									</div>	
									<div class="col-md-6">
										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-control" name="email" />
										</div>
									</div>
								</div>	
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Sexo</label>
											<select name="sexo" class="form-control" required >
												<option value=""> </option>
												<option value="Masculino"> Masculino </option>
												<option value="Feminino"> Feminino </option>
												<option value="Outros"> Outros </option>
											</select>
										</div>
									</div>	
									<div class="col-md-6">
										<div class="form-group">
											<label>Data de Nascimento</label>
											<input type="date" class="form-control" name="data_nascimento" required />
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Peso</label>
											<input type="number" class="form-control" name="peso"  />
										</div>
									</div>	
									<div class="col-md-6">
										<div class="form-group">
											<label>Altura</label>
											<input type="number" class="form-control" name="altura"  />
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Etnia</label>
											<input type="text" class="form-control" name="etnia"  />
										</div>
									</div>	
									<div class="col-md-6">
										<div class="form-group">
											<label>CNS</label>
											<input type="text" class="form-control" name="cns"  />
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>RG</label>
											<input type="text" class="form-control" name="rg"  />
										</div>
									</div>	
									<div class="col-md-6">
										<div class="form-group">
											<label>CPF</label>
											<input type="text" class="form-control" name="cpf"  />
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Inscrição(Convênio)</label>
											<input type="text" class="form-control" name="inscricao"  />
										</div>
									</div>	
									<div class="col-md-6">
										<div class="form-group">
											<label>Nome da Mãe</label>
											<input type="text" class="form-control" name="nome_mae"  />
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Referência (identificação do paciente no apoiado) </label>
											<input type="text" class="form-control" name="referencia"  />
										</div>
									</div>	
									<div class="col-md-6">
										<div class="form-group">
											<label>Observação</label>
											<textarea class="form-control" name="obs"  ></textarea>
										</div>
									</div>	
									
								</div>
							</div>
						  <!-- /.card-body -->
						</div>
		
		
      </div><!-- /.container-fluid -->
	 
	  
	  
	  		<div class="card card-info" >
						
						  <div class="card-header" style="background-image: linear-gradient(to bottom right, #0077FF, #00BFFF) !important;">
							<h3 class="card-title">Dados do Exame </h3> 
						  </div>
						
						  
						  <div class="card-body">
						  
							
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Referência(identificador do pedido no apoiado)</label>
											<input type="text" class="form-control" name="referencia"  />
										</div>
									</div>	
									<div class="col-md-6">
										<div class="form-group">
											<label>Médico</label>
											<select name="medico" class="form-control">
												<option value=""></option>
												<?php
													$sql = "SELECT * FROM usuarios WHERE perfil=4 AND status=1 ORDER BY nome";
													$exec = mysqli_query($con,$sql);
													while($col = mysqli_fetch_array($exec)){
														echo '<option value="'.$col["nome"].'">'.$col["nome"].'</option>';
													}
												?>
											</select>
										</div>
									</div>
								</div>	
								
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Última Menstruação</label>
											<input type="date" class="form-control" name="dum"  />
										</div>
									</div>	
									<div class="col-md-6">
										<div class="form-group">
											<label>Jejum</label>
											<input type="time" class="form-control" name="jejum"  />
										</div>
									</div>
								</div>	
								
								<div class="row">
									<div class="col-md-6">
										<label>Medicamentos</label>
										<input type="time" class="form-control" name="medicamentos"  />
									</div>
									
									<div class="col-md-6">
										<label>Marcar para a data</label>
										<input type="date" class="form-control" name="dt_marcado"  />
									</div>
									
								</div>	
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Observação Exame</label>
											<textarea class="form-control" name="obs_exame"  ></textarea>
										</div>
									</div>	
								</div>
								
							</div>
						  <!-- /.card-body -->
						</div>
		
		
      </div><!-- /.container-fluid -->
	  
			<input type="hidden" name="clinica" value="<?php echo $_POST["clinica"]; ?>" />
			<div class="row">
				<div class="col-md-6">
					<input class="form-control"  type="submit" value="Salvar" />
				</div>
			</div>

		
	   </form>
	  </div>
    </section>
    <!-- /.content -->