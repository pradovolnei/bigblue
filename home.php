<!DOCTYPE html>
<html>
<head>
	
	<?php 
		include "bootstrap.php";
		include "funcao.php";
		include "conexao.php";
		include "sessao.php";
	?>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BIG BLUE</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
	
	
</head>
<body class="hold-transition sidebar-mini fixed sidebar-collapse" style="padding-top: 50px;">
<div class="wrapper">

	<?php include "header.php"; ?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#111155">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!--<div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>-->
        <div class="info">
          <a href="#" class="d-block"><?php echo $nome_usuario; ?></a>
        </div>
      </div>

		<?php include "menu.php"; ?>
	
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
		<?php include "body.php"; ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php // include "footer.php"; ?>
</div>
<!-- ./wrapper -->

</body>


<!-- bootstrap time picker-->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script src="plugins/iCheck/icheck.min.js"></script> 
</html>
