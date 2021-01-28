<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js"></script>

<?php 
	if(isset($_POST["cad"])){
		$preco = str_replace(",", ".", $_POST["preco"]);
		$qtd = str_replace(",", ".", $_POST["qtd"]);
		$obs = $_POST["obs"];
		$acao = $_POST["acao"];
		
		if($acao == "add")
			$diferenca = $_POST["antigo"]+$qtd;
		else
			$diferenca = $_POST["antigo"]-$qtd;
		
		$sql = "UPDATE estoque SET preco=$preco, quantidade=$diferenca, obs='$obs' WHERE id_clinica=".$_POST["clinica"]." AND id_produto=".$_POST["produto"];
		//echo $sql;
		mysqli_query($con,$sql) or die(mysqli_error($con));
		
		$sql_h = "INSERT INTO historico_estoque VALUES(".$_POST["produto"].",".$_POST["clinica"].",$preco,$qtd,'$obs','$acao',$id_usuario,NOW())";
		//echo $sql_h;
		mysqli_query($con,$sql_h)or die(mysqli_error($con));;
	}
	
	if(isset($_POST["cad_novo"])){
		$preco = str_replace(",", ".", $_POST["preco"]);
		$qtd = str_replace(",", ".", $_POST["qtd"]);
		$obs = $_POST["obs"];
		$acao = "novo";
		$produto = $_POST["produto"];
		if($_POST["produto"] == "novo"){
			$sql_ins = "INSERT INTO produtos VALUES(NULL,'".$_POST["novo_produto"]."')";
			mysqli_query($con,$sql_ins);
			$produto = mysqli_insert_id($con);
		}
		
		$sql = "INSERT INTO estoque VALUES(".$_POST["clinica"].",$produto,$preco,$qtd,'$obs')";
		//echo $sql;
		mysqli_query($con,$sql) or die(mysqli_error($con));
		
		$sql_h = "INSERT INTO historico_estoque VALUES(".$produto.",".$_POST["clinica"].",$preco,$qtd,'$obs','add',$id_usuario,NOW())";
		//echo $sql_h;
		mysqli_query($con,$sql_h)or die(mysqli_error($con));
	}
?>

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-8">
            <ol class="breadcrumb float-sm-left">
			  <li class="breadcrumb-item"><a href="home.php" >Home</a></li>
              <li class="breadcrumb-item active">Estoque</li>
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
					<h3 class="card-title">Estoque </h3> 
				</div>
				<!-- /.card-header -->
				
			<div class="card-body">
			<?php if(!$id_clinica){ ?>
			<form action="" method="post" >
			<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Lista de Clinicas </label>
								<div class="bfh-selectbox " data-name="clinica" data-filter=true >
											<div data-value=>Selecione a Clinica</div>
											
											
											<?php 
											$sql = "SELECT * FROM clinica WHERE id=1 order by nome";
												
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
						
						<div class="col-md-6">
							<div class="form-group"><br>
								<input class="btn btn-success" type="submit" value="Filtrar" />
							</div>
						</div>
					</div>
			</form>	
					<div class="form-group">
											<label>Lista de Clinicas </label>
											
											
										</div>
				
			<?php } ?>
			</div>
            <div class="card-body">
			<a href="#" data-toggle='modal' data-target='#novo'> <img src="dist/img/add.png" class="plus-mobile" /> Adicionar Novo Produto </a>
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Produto </th>
                  <th>Quantidade</th>
                  <th>Preço(R$)</th>
                  <th>Descrição</th>

                </tr>
                </thead>
                <tbody>
                <tr>
				<?php 
				
					$clinica = $id_clinica;
					
					if(isset($_POST["clinica"]))
						$clinica = $_POST["clinica"];
					
					$sql ="SELECT a.id_clinica,b.id,b.produto,a.preco,a.quantidade,a.obs FROM estoque a 
					LEFT JOIN produtos b on b.id = a.id_produto
					
					";
					if($clinica)
						$sql .= " WHERE a.id_clinica = $clinica";
					
					$exec = mysqli_query($con,$sql);
					while($col = mysqli_fetch_array($exec)){
						echo "<tr>";
						
						echo "<td>".$col["produto"]." <br><a href='#' data-toggle='modal' data-target='#upd".$col["id"]."'> <img src='dist/img/edit.png' class='plus-mobile'>Atualizar Produto </a> </td>";
						echo "<td>".$col["quantidade"]."</td>";
						echo "<td>R$ ".number_format($col["preco"], 2, ',', ' ')."</td>";
						echo "<td>".$col["obs"]."</td>";
						
						echo "</tr>";

					}
					
					
				?>
 				

                </tr>

                </tbody>
                
              </table>
            </div>
            <!-- /.card-body -->
				
			</div>


		</div><!-- /.container-fluid -->
	</section>
	<?php 
	$exec = mysqli_query($con,$sql);
					while($col = mysqli_fetch_array($exec)){

				?>
					<form action="" method="post" enctype="multipart/form-data" >
						<div class="modal fade" id="upd<?php echo $col["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Atualizar <b><?php echo $col["produto"]; ?></b> </h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									</div>

									<div class="modal-body">
										<div class="form-group">
											<label>Ação </label>
											<select name="acao" required class="form-control">
												<option value=""></option>
												<option value="add">Adicionar</option>
												<option value="del">Remover</option>
											</select>
										</div>	
										<div class="form-group">
											<label>Quantidade </label>
											<input type="number" name="qtd" value="<?php echo $col["quantidade"]; ?>" class="form-control" min=0 />
										</div>						
									
										<div class="form-group">
											<label>Preço(R$) Unitário </label>
											<input type="text" name="preco" value="<?php echo number_format($col["preco"], 2, ',', ' '); ?>" class="form-control" min=0 />
										</div>						

										<div class="form-group">
											<label>Descrição </label>
											<textarea name="obs" class="form-control"><?php echo $col["obs"]; ?></textarea>
										</div>		
										<input type="hidden" name="produto" value="<?php echo $col["id"]; ?>" />
										<input type="hidden" name="clinica" value="<?php echo $col["id_clinica"]; ?>" />
										<input type="hidden" name="antigo" value="<?php echo $col["quantidade"]; ?>" />
									</div>
									
									<div class="modal-footer">
										<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
										<input type="submit" class="btn btn-success" value='Salvar' name="cad" />
									</div>
								</div>
							</div>
						</div>
					</form>
				<?php

					}
				?>
<form action="" method="post" enctype="multipart/form-data" >
						<div class="modal fade" id="novo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Novo Produto</b> </h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									</div>

									<div class="modal-body">
										<div class="form-group">
											<label>Lista de Produtos </label>
											<div class=bfh-selectbox data-name="produto" data-filter=true >
											<div data-value=>Selecione o Produto</div>
											<div data-value="novo">Produto não está na lista</div>
											
											<?php 
											$sql = "SELECT * FROM produtos order by produto";
												
											//if($_POST["clinica"])
											//$sql .=  " AND a.id_clinica=".$_POST["clinica"];
											 //echo $sql;

											$exec = mysqli_query($con,$sql) or die(mysqli_error($error));
											while($col = mysqli_fetch_array($exec)){
											echo "<div data-value='".$col["id"]."'>".$col["produto"]."</div>";
											}
											?>
											</div>
										</div>	
										<div class="form-group">
											<label>Digite o nome do produto caso não esteja na lista </label>
											<input type="text" name="novo_produto" value="" class="form-control" />
										</div>	
										
										<div class="form-group">
											<label>Quantidade </label>
											<input type="number" name="qtd" value="<?php echo $col["quantidade"]; ?>" class="form-control" min=0 />
										</div>						
									
										<div class="form-group">
											<label>Preço(R$) Unitário </label>
											<input type="text" name="preco" value="<?php echo number_format($col["preco"], 2, ',', ' '); ?>" class="form-control" min=0 />
										</div>						

										<div class="form-group">
											<label>Descrição </label>
											<textarea name="obs" class="form-control"><?php echo $col["obs"]; ?></textarea>
										</div>		
										
										<input type="hidden" name="clinica" value="<?php echo $clinica; ?>" />

									</div>
									
									<div class="modal-footer">
										<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
										<input type="submit" class="btn btn-success" value='Salvar' name="cad_novo" />
									</div>
								</div>
							</div>
						</div>
					</form>
	<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
	  "lengthMenu": [[ 100000, -1], [ "Todas"]]
    });
  });
</script>