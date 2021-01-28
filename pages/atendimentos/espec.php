	<?php 		
	if(isset($_GET["a"])){			
		if($_GET["a"] == 1){				
			$sql = "INSERT INTO orcamento VALUES(".base64_decode($_GET["e"]).",".base64_decode($_GET["c"]).", $id_usuario)";				
			//echo $sql;				
			mysqli_query($con,$sql);				
			echo "<script>window.location='home.php?l=NQ==';</script>";			
		}	

		if($_GET["a"] == 2){				
			$sql = "DELETE FROM orcamento WHERE exame=".base64_decode($_GET["ie"])." AND id_clinica=".base64_decode($_GET["ic"])." AND id_usuario = $id_usuario";				
		//echo $sql;				
			mysqli_query($con,$sql);				
			echo "<script>window.location='home.php?l=NQ==';</script>";			
		}
		
		if($_GET["a"] == 3){	
							
			$sql = "DELETE FROM orcamento WHERE id_usuario = $id_usuario";				
			//echo $sql;				
				mysqli_query($con,$sql);				
				echo "<script>window.location='home.php?l=MQ==';</script>";			
			
		}
		
		
	}	
	?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-8">
            <ol class="breadcrumb float-sm-left">
			  <li class="breadcrumb-item"><a href="?l=<?php echo base64_encode(4); ?>" >Novo Atendimento</a></li>
              <li class="breadcrumb-item active">Orçamento</li>
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
				
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Paciente</label>
								<input type="text" name="paciente" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Telefone</label>
								<input type="text" name="telefone" class="form-control" />
							</div>
						</div>
					</div> 
				</div>
				
			</div>
			
			<div class="card card-info" >
				<div class="card-header" style="background-image: linear-gradient(to bottom right, #0077FF, #00BFFF) !important;">
					<h3 class="card-title">Exames </h3> 
				</div>
				
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">



 <div class="bfh-selectbox bfh-countries" data-country="US" data-flags="true">
              <input type="hidden" name="country" value="">
              <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="Route{{'local'}}">
                <span class="bfh-selectbox-option input-medium" data-option=""></span>
                <b class="caret"></b>
              </a>
              <div class="bfh-selectbox-options">
                <input type="text" class="bfh-selectbox-filter">
                <div role="listbox">
                <ul role="option">aaa
                </ul>
                </div>
              </div>
          </div>




							</div>
						</div>
						

					</div> 
				</div>
				
			</div>


		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->