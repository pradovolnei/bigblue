<?php 
	if(isset($_POST["send"])){
		$sql = "UPDATE chat SET status=1 WHERE id_receptor=$id_usuario AND id_remetente=".$_POST["receptor"];
		mysqli_query($con,$sql);
		
		$sql = "INSERT INTO chat VALUES($id_usuario, ".$_POST["receptor"].", '".$_POST["message"]."', NOW(), NULL)";
		mysqli_query($con,$sql);
	}
	
	if(isset($_GET["rm"])){
		$up = "UPDATE chat SET status=1 WHERE id_receptor=$id_usuario AND id_remetente=".$_GET["rm"];
		mysqli_query($con,$up);
	}
?>  

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Chat</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
<!-- Main content -->
<section class="content">
<div class="container-fluid">
<!-- Small boxes (Stat box) -->


<?php
	$sql_remetente = "SELECT a.id_remetente,b.nome, c.total,b.id_clinica FROM chat a  
								LEFT JOIN usuarios b ON b.id = a.id_remetente
								LEFT JOIN (SELECT COUNT(*) as 'total',id_remetente FROM chat where id_receptor=$id_usuario AND status IS NULL GROUP BY id_remetente) as c ON c.id_remetente = a.id_remetente
	where id_receptor=$id_usuario";
	
	if(isset($_GET["rm"])){
		$sql_remetente .= " AND a.id_remetente=".$_GET["rm"];
	}
	
	
	$sql_remetente .= " GROUP BY a.id_remetente
	ORDER BY a.data DESC";
	$exec = mysqli_query($con,$sql_remetente);
	
	while($col = mysqli_fetch_array($exec)){
?>

<div class="row">
  <div class="col-lg-12 col-6">
	<!-- DIRECT CHAT -->
	<?php 
		if(isset($_GET["rm"]))
			echo '<div class="card direct-chat direct-chat-primary">';
		else
			echo '<div class="card direct-chat direct-chat-primary collapsed-card">';
	?>
	
	  <a href="#" data-widget="collapse">
	  <div class="card-header">
		<h3 class="card-title"><?php if($col["id_clinica"]) echo clinica($col["id_remetente"]); else echo $col["nome"];?></h3>
		<div class="card-tools">
		  <?php 
		  if($col["total"]>0)
		  echo '<span data-toggle="tooltip" class="badge badge-primary">'.$col["total"].'</span>'; 
		  
		  ?>
		  <button type="button" class="btn btn-tool" data-widget="collapse">
			<i class="fa fa-minus"></i>
		  </button>
		</div>
	  </div>
	  <!-- /.card-header -->
	  </a>
	  <div class="card-body">
		<!-- Conversations are loaded here -->
		<div class="direct-chat-messages">
		
		<?php 
			$sql_chat = "SELECT * FROM chat WHERE id_remetente in (".$col["id_remetente"].",$id_usuario) AND id_receptor in (".$col["id_remetente"].",$id_usuario) ORDER BY data DESC";
			$exec_chat = mysqli_query($con,$sql_chat);
			
			while($row = mysqli_fetch_array($exec_chat)){
				if($row["id_remetente"] == $id_usuario){
					echo '<div class="direct-chat-msg">
							<div class="direct-chat-info clearfix">
							  <span class="direct-chat-name float-left">'.$nome_usuario.'</span>
							  <span class="direct-chat-timestamp float-right">'.dataChat($row["data"]).'</span>
							</div>
							
							<div class="direct-chat-text">
							  '.$row["mensagem"].'
							</div>
						  </div>';
				}else{
					echo '<div class="direct-chat-msg right" >
							<div class="direct-chat-info clearfix">
							  <span class="direct-chat-name float-right">'.clinica($col["id_remetente"]).'</span>
							  <span class="direct-chat-timestamp float-left">'.dataChat($row["data"]).'</span>
							</div>
							
							<div class="direct-chat-text">
							  '.$row["mensagem"].'
							</div>
						  </div>';
				}
			}
		?>
		</div>
		<!--/.direct-chat-messages-->

	  </div>
	  <!-- /.card-body -->
	  <div class="card-footer">
		<form action="" method="post">
		  <div class="input-group">
			<input type="text" name="message" placeholder="Digite a Mensagem ..." class="form-control">
			<input type="hidden" name="receptor" value="<?php echo $col["id_remetente"];?>" />
			<span class="input-group-append">
			  <input type="submit" class="btn btn-primary" name="send" value="Enviar">
			</span>
		  </div>
		</form>
	  </div>
	  <!-- /.card-footer-->
	</div>
	<!--/.direct-chat -->
	</div>
</div>

<?php		
	}
?>

  </div><!-- /.container-fluid -->
</section>