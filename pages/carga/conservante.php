 <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-8">
            <ol class="breadcrumb float-sm-left">
			  <li class="breadcrumb-item"><a href="home.php" >Home</a></li>
              <li class="breadcrumb-item active">Carga XML</li>
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
			      <a href="xml/modelo.xml" download> Arquivo Modelo </a><br>
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
							echo $dados->exameCodigo;
							foreach($dados->conservante as $dados2){
								echo $dados2->nome;
							}
							
						}
					}
				?>
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