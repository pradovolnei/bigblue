<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js"></script>

<?php 

	$nome = null;
	$email = null;
	$sexo = null;
	$data_nascimento = null;
	$peso = null;
	$altura = null;
	$etnia = null;
	$rg = null;
	$cpf = null;
	$cns = null;
	$inscricao = null;
	$nome_mae = null;
	$obs = null;
	$telefone = null;
	
	$usuario = "novo";
	
	if(isset($_POST["cad"])){
		$sql = "SELECT a.email,b.* FROM usuarios a 
			LEFT JOIN paciente b on b.id_usuario = a.id
		WHERE a.id=".$_POST["user"];
		
		$exec = mysqli_query($con,$sql);
		$col = mysqli_fetch_array($exec);
		$nome = $col["nome"];
		$email = $col["email"];
		$sexo = $col["sexo"];
		$data_nascimento = $col["data_nascimento"];
		$peso = $col["peso"];
		$altura = $col["altura"];
		$etnia = $col["etnia"];
		$rg = $col["rg"];
		$cpf = $col["cpf"];
		$cns = $col["cns"];
		$inscricao = $col["inscricao"];
		$nome_mae = $col["nome_mae"];
		$obs = $col["obs"];
		$telefone = $col["telefone"];
		
		$usuario = "antigo";
	}
	
?>

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-8">
            <ol class="breadcrumb float-sm-left">
			  <li class="breadcrumb-item"><a href="?l=<?php echo base64_encode(4); ?>" >Novo Atendimento</a></li>
              <li class="breadcrumb-item active">Paciente</li>
            </ol>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

	
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

			<div class="card card-info" >
				<div class="card-header" style="background-image: linear-gradient(to bottom right, #0077FF, #00BFFF) !important;">
					<h3 class="card-title">Dados do Paciente </h3> 
				</div>
				<form action="?l=<?php echo base64_encode(22); ?>" method="post">
				<?php //echo "<input type='hidden' name='clinica' value='".base64_decode($_GET["cl"])."'>"; ?>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Paciente</label> <a href="#" data-toggle='modal' data-target='#old'> <img src="dist/img/user.png" class="user" /> Paciente Antigo </a>
								<input type="text" name="paciente" class="form-control" value="<?php echo $nome; ?>" />
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Telefone</label>
								<input type="text" name="telefone" class="form-control" value="<?php echo $telefone; ?>" />
							</div>
						</div>
					</div> 
					
					<div class="row">
					<?php if($perfil_usuario == 1){ ?>
						<div class="col-md-6">
							<div class="form-group">
								<label>Clínica</label>
								<div class="bfh-selectbox" data-name="clinica" data-filter="true" >
									<div data-value="">Selecione a Clinica</div>
									
									<?php 
										$sql = "SELECT * FROM clinica WHERE id=1";
												
					
											 
											
										$exec = mysqli_query($con,$sql);
										while($col = mysqli_fetch_array($exec)){
											echo "<div data-value='".$col["id"]."'>".$col["nome"]."</div>";
										}
									?>
								</div>
							</div>
						</div>
					<?php }else{
						echo "<input type='hidden' name='clinica' value='$id_clinica' />";
					} ?>	
						<div class="col-md-6">
							<div class="form-group">
								<label>Convênio</label>
								<div class="bfh-selectbox" data-name="convenio" data-filter="true" >
									<div data-value="">Selecione o Convênio</div>
									<div data-value="999">Particular</div>
									<?php 
										$sql = "SELECT * FROM plano ";
												
					
											 
											
										$exec = mysqli_query($con,$sql);
										while($col = mysqli_fetch_array($exec)){
											echo "<div data-value='".$col["id"]."'>".$col["nome"]."</div>";
										}
									?>
								</div>
							</div>
						</div>
					</div> 
					
					
					<?php 
						if(isset($_GET["g"])){
							echo "<input type='hidden' name='acao' value='guia' />";
					?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="email" class="form-control" value="<?php echo $email; ?>" />
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Nome da Mãe</label>
								<input type="text" name='nome_mae' class="form-control" value="<?php echo $nome_mae; ?>" > 
							</div>
						</div>
						
						
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Sexo</label>
								<select name="sexo" class="form-control" >
									<option value="Masculino"> Masculino</option>
									<option value="Feminino"> Feminino</option>
									<option value="Outros"> Outros</option>
								</select>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Data de Nascimento</label>
								<input type="date" name='data_nascimento' class="form-control" value="<?php echo $data_nascimento; ?>" >
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Altura</label>
								<input type="text" name='altura' class="form-control" value="<?php echo $altura; ?>">
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Peso</label>
								<input type="text" name='peso' class="form-control" value="<?php echo $peso; ?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>RG</label>
								<input type="text" name='rg' class="form-control" value="<?php echo $rg; ?>">
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label>CPF</label>
								<input type="text" name='cpf' class="form-control" value="<?php echo $cpf; ?>">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>CNS</label>
								<input type="text" name='cns' class="form-control" value="<?php echo $cns; ?>">
							</div>
						</div>
						
						
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>OBS</label>
								<textarea name='obs' class="form-control"><?php echo $obs; ?></textarea>
							</div>
						</div>
						
						
					</div>
					<?php
							
						}else{
							echo "<input type='hidden' name='acao' value='orcamento' />";
						}
						echo "<input type='hidden' name='status' value='$usuario' >";
					?>
					<input type="submit" value="Próximo">
				</div>
				</form>
			</div>
		


		<form action="" method="post" enctype="multipart/form-data" >
				<div class="modal fade" id="old" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Pesquisar Usuário </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  
					  <div class="modal-body">

	
						<div class="form-group">
						  
											<label>Usuário </label>
											<div class=bfh-selectbox data-name="user" data-filter=true >
											<div data-value=>Selecione o Usuário</div>
											
											<?php 
											$sql = "SELECT * FROM usuarios WHERE perfil=2";
												
											//if($_POST["clinica"])
											//$sql .=  " AND a.id_clinica=".$_POST["clinica"];
											 //echo $sql;

											$exec = mysqli_query($con,$sql) or die(mysqli_error($error));
											while($col = mysqli_fetch_array($exec)){
											echo "<div data-value='".$col["id"]."'>".$col["nome"]."</div>";
											}
											?>
											</div>


						</div>						
						
						
					  </div>
					  <div class="modal-footer">
						<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
						<input type="submit" class="btn btn-success" value='Adicionar' name="cad" />
					  </div>
					</div>
				  </div>
				</div>
				</form>

		


		</div><!-- /.container-fluid -->
	</section>