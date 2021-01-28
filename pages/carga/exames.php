 <!-- Content Header (Page header) -->
 <?php  
	if(isset($_POST["cad"])){
		//$sql = "INSERT INTO exame_convenio VALUES(".$_POST["new_exame"].",".$_POST["new_convenio"].",".$_POST["new_clinica"].",".$_POST["preco"].")";
		$sql = "INSERT INTO carrinho VALUES(NULL,".$_POST["new_exame"].",".$_POST["new_convenio"].",".$_POST["new_clinica"].",".$_POST["preco"].",$id_usuario)";
		mysqli_query($con,$sql);
	}
	
	if(isset($_POST["finalizar"])){
		$sql = "SELECT * FROM carrinho 
						WHERE id_usuario=$id_usuario
						";
				$exec = mysqli_query($con,$sql);
				while($col = mysqli_fetch_array($exec)){
					$sql_save = "INSERT INTO exame_convenio VALUES(".$col["id_exame"].",".$col["id_convenio"].",".$col["id_clinica"].",".$col["preco"].")";
					mysqli_query($con,$sql_save);
				}
		$sql_remove = "delete FROM carrinho 
						WHERE id_usuario=$id_usuario";
		mysqli_query($con,$sql_remove);
		
		echo "<script>alert('Exames Cadastrados'); window.location='home.php?l=".base64_encode(25)."'</script>";
	}
 ?>

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

		<div class="col-sm-8">

            <ol class="breadcrumb float-sm-left">

			  <li class="breadcrumb-item"><a href="home.php" >Home</a></li>

              <li class="breadcrumb-item active">Carga de Exames</li>

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

                <h3 class="card-title">Carga XML</h3>

              </div>

			  <form action="" method="post" enctype="multipart/form-data">

			      <a href="xml/modelo_carga_exames.xml" download > Arquivo Modelo </a><br>

			  <label> Arquivo XML </label>

			  <input type="file" name="file" /><br>

			  <input type="submit" value="Carregar" name="carga" />

              <!-- /.card-header -->

				

			  </form>
			   <?php 

					if(isset($_POST["carga"])){

						//$rota = "xml/conservante.xml";

						$rota = $_FILES["file"]["tmp_name"];

						$xml = simplexml_load_file($rota);

						//print_r($xml->children());

						foreach($xml->children() as $dados){

							$codigo_exame_sus = $dados->codigo_exame_sus;
							$codigo_convenio = $dados->codigo_convenio;
							$preco = $dados->preco;
							
							$sql = "INSERT INTO carrinho VALUES(NULL,$codigo_exame_sus,$codigo_convenio,$clinica,$preco,$id_usuario)";
							mysqli_query($con,$sql);
							

						}

					}

				?>
				<a href="#"  data-toggle='modal' data-target='#novo'><img src="dist/img/add.png" class="plus-mobile">Importar Manualmente</a>
				 <form action="" method="post">
				 <input type="submit" name='finalizar' value="Finalizar" />
			  </form>
			  <table>
			  <thead>
				<tr>
					<th> Exame </th>
					<th> Código do Exame </th>
					<th> Convênio </th>
					<th> Preço </th>
				</tr>
			  </thead>
			 <tbody>
			 <?php
				$sql = "SELECT a.*,b.exame FROM carrinho a 
						LEFT JOIN exame_sus b on b.codigo = a.id_exame
						WHERE a.id_usuario=$id_usuario
						";
				$exec = mysqli_query($con,$sql);
				while($col = mysqli_fetch_array($exec)){
					echo "<tr>";
					
					echo "<td>".$col["exame"]."</td>";
					echo "<td>".$col["id_exame"]."</td>";
					echo "<td>".$col["id_convenio"]."</td>";
					echo "<td>".$col["preco"]."</td>";
					
					echo "</tr>";
				}
			 ?>
			 </tbody>
			  </table>
			 
            </div>

            <!-- /.card -->



          </div>

          <!--/.col (left) -->

        </div>

        <!-- /.row -->			

		

      </div><!-- /.container-fluid -->

    </section>

    <!-- /.content -->
	
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
							if($id_clinica){
							$sql = "select * FROM clinica WHERE id=".$id_clinica;
							//echo $sql;
							$exec = mysqli_query($con,$sql);
							$col = mysqli_fetch_array($exec);
							$nome_clinica = $col["nome"];
							echo $nome_clinica;
							echo "<input type='hidden' name='new_clinica' value='$id_clinica' />";
							}else{
						  ?>
						  <div class=bfh-selectbox data-name="new_clinica" data-filter=true >
											<div data-value=>Selecione a Clinica</div>
											
											<?php 
											$sql = "SELECT * FROM clinica";
												
											//if($_POST["clinica"])
											//$sql .=  " AND a.id_clinica=".$_POST["clinica"];
											 //echo $sql;

											$exec = mysqli_query($con,$sql) or die(mysqli_error($error));
											while($col = mysqli_fetch_array($exec)){
											echo "<div data-value='".$col["id"]."'>".$col["nome"]."</div>";
											}
											?>
											</div>
							<?php } ?>
						</div>
						
						<div class="form-group">
						  <label>Convênio</label>
						  <div class=bfh-selectbox data-name="new_convenio" data-filter=true >
											<div data-value=>Selecione o Plano</div>
											
											<?php 
											$sql = "SELECT * FROM plano";
												
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

	

	<!-- bootstrap time picker-->

<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

<script src="plugins/iCheck/icheck.min.js"></script> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js"></script>