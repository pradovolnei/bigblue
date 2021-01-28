<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>

<?php 
if(isset($_POST["cad"])){
	$sql ="INSERT INTO exame_convenio VALUES(".$_POST["new_exame"].",".$_POST["convenio"].",".$_POST["clinica"].",".$_POST["preco"].")";
	mysqli_query($con,$sql);
}
$selects = "";
//print_r($_POST);
											$sql = "SELECT b.*
													FROM `exame_convenio` a
													LEFT JOIN `exame_sus` b ON b.`codigo` = a.`id_exame`
													WHERE a.id_convenio=".$_POST["convenio"];
												
											if($_POST["clinica"])
											$sql .= " AND a.id_clinica=".$_POST["clinica"];
											// echo $sql;

											$exec = mysqli_query($con,$sql);
											while($col = mysqli_fetch_array($exec)){
											$selects .= "<div data-value=".$col["codigo"].">".$col["codigo"]." - ".$col["exame"]."</div>";
											}
											$input = "<div class=form-group><label>Exame '+i+'</label><div class=bfh-selectbox data-name=exames[] data-filter=true ><div data-value=>Selecione o Exame</div> ".$selects."	</div>".'<a href="#" class=linkRemover><img src="dist/img/delete.png" class="plus-mobile">Remover</a></div></div>';
											?>
<script>
	$(function () {
    var divContent = $('#formulario');
    var botaoAdicionar = $('a[data-id="1"]');
    var i = 6;

    //Ao clicar em adicionar ele cria uma linha com novos campos
    $(botaoAdicionar).click(function () {
		$('<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.min.css" rel="stylesheet">').appendTo(divContent);
		$('<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js" />').appendTo(divContent);
		<?php echo "$('<div class=conteudoIndividual>".$input."').appendTo(divContent);"; ?>
        
        //$('<div class=form-group><label>Exame '+i+'</label><div class=bfh-selectbox data-name=exames[] data-filter=true ><div data-value=>Selecione o Exame</div>	</div></div><a href=# class=linkRemover>- Remover Campos</a></div>').appendTo(divContent);
        $('#removehidden').remove();
        i++;
        $('<input type="hidden" name="quantidadeCampos" value="' + i + '" id="removehidden">').appendTo(divContent);
		document.getElementById('#add_ex').focus();
    });

    //Cliquando em remover a linha é eliminada
    $('#formulario').on('click', '.linkRemover', function () {
        $(this).parents('.conteudoIndividual').remove();
        i--;
    });
});
</script>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-8">
            <ol class="breadcrumb float-sm-left">
			  <li class="breadcrumb-item"><a href="?l=<?php echo base64_encode(4); ?>" >Novo Atendimento</a></li>
              <li class="breadcrumb-item active">Exame</li>
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
					<h3 class="card-title">Dados do Exame </h3> 
				</div>
				<form action="?l=<?php echo base64_encode(23); ?>" method="post">
				<?php 
				// echo "<input type='hidden' name='clinica' value='".$_POST["clinica"]."'>"; 
					foreach($_POST as $valor => $post){
						echo "<input type='hidden' name='$valor' value='$post' />";
					}
				?>
				
				 <div class="card-body">
						  
						<div class="card-body">
						
						<div class="row">
									<div class="col-md-6" id="formulario">
									<a href="#"  data-toggle='modal' data-target='#novo'><img src="dist/img/add.png" class="plus-mobile">Cadastrar Novo Exame</a>
									<?php for($a=1;$a<=5;$a++){ ?>
										<div class=form-group>
											<label>Exame <?php echo $a; ?></label>
											<div class=bfh-selectbox data-name=exames[] data-filter=true >
											<div data-value=>Selecione o Exame</div>
											
											<?php 
											$sql = "SELECT b.*
													FROM `exame_convenio` a
													LEFT JOIN `exame_sus` b ON b.`codigo` = a.`id_exame`
													WHERE a.id_convenio=".$_POST["convenio"];
												
											if($_POST["clinica"])
											$sql .=  " AND a.id_clinica=".$_POST["clinica"];
											// echo $sql;

											$exec = mysqli_query($con,$sql) or die(mysqli_error($error));
											while($col = mysqli_fetch_array($exec)){
											echo "<div data-value='".$col["codigo"]."'>".$col["codigo"]." - ".$col["exame"]."</div>";
											}
											?>
											</div>
										</div>
									<?php } ?>
									
										
									</div>	
									<div class="col-md-12" id="add_ex">
									<div class=form-group>
									<a href="#" data-id="1" id="adicionarCampo"><img src="dist/img/add.png" class="plus-mobile" /> Adicionar Exame</a>
									</div>
									</div>
									
									<?php //echo $sql; ?>
									
						</div>
						
						<?php if($_POST["acao"] == "guia"){ ?>
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
										<label>Material</label>
										<input type="text" class="form-control" name="material"  />
									</div>
									
									<div class="col-md-6">
										<label>Conservante</label>
										<input type="text" class="form-control" name="conservante"  />
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
								<?php } ?>
								
								
								
						</div>
						<input type="submit" value="Salvar" />
				</div>
				
				</form>
			</div>
			

			
		</div><!-- /.container-fluid -->
	</section>
	
	<form action="" method="post" enctype="multipart/form-data" >
				<div class="modal fade" id="novo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Novo Exame </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <?php 
						// echo "<input type='hidden' name='clinica' value='".$_POST["clinica"]."'>"; 
							foreach($_POST as $valor => $post){
								echo "<input type='hidden' name='$valor' value='$post' />";
							}
						?>
					  <div class="modal-body">
					  <div class="form-group">
						  <label>Clínica</label>
						  <?php 
							$sql = "select * FROM clinica WHERE id=".$_POST["clinica"];
							//echo $sql;
							$exec = mysqli_query($con,$sql);
							$col = mysqli_fetch_array($exec);
							$nome_clinica = $col["nome"];
							echo $nome_clinica;
						  ?>
						 
						</div>
						
						<div class="form-group">
						  <label>Convênio</label>
						  <?php 
							$sql = "select * FROM plano WHERE id=".$_POST["convenio"];
							$exec = mysqli_query($con,$sql);
							$col = mysqli_fetch_array($exec);
							$nome_convenio = $col["nome"];
							echo $nome_convenio;
						  ?>
						 
						</div>
						<div class="form-group">
						  
											<label>Exame </label>
											<div class=bfh-selectbox data-name="new_exame" data-filter=true >
											<div data-value=>Selecione o Exame</div>
											
											<?php 
											$sql = "SELECT * FROM exame_sus";
												
											//if($_POST["clinica"])
											//$sql .=  " AND a.id_clinica=".$_POST["clinica"];
											 //echo $sql;

											$exec = mysqli_query($con,$sql) or die(mysqli_error($error));
											while($col = mysqli_fetch_array($exec)){
											echo "<div data-value='".$col["codigo"]."'>".$col["codigo"]." - ".$col["exame"]."</div>";
											}
											?>
											</div>


						</div>
						
						<div class="form-group">
						  
											<label>Preço <?php if($_POST["convenio"] != 999) echo " a ser cobrado do convenio"; ?> </label>
											<input type="text" name="preco" class="form-control" />


						</div>
						
						
						
						
					  </div>
					  <div class="modal-footer">
						<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
						<input type="submit" class="btn btn-success" value='Cadastrar' name="cad" />
					  </div>
					</div>
				  </div>
				</div>
				</form>