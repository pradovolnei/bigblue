<!-- Sidebar Menu -->
<nav class="mt-2">
	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
	  <!-- Add icons to the links using the .nav-icon class
		   with font-awesome or any other icon font library -->
	  <li class="nav-item">
		<a href="home.php" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Home
		  </p>
		</a>
	  </li>

	  <li class="nav-item has-treeview">
		<a href="#" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Atendimentos
			<i class="right fa fa-angle-left"></i>
		  </p>
		</a>
		<ul class="nav nav-treeview">
		  <li class="nav-item">
			<a href="?l=<?php echo base64_encode(1); ?>" class="nav-link">
			  <i class="fa fa-circle-o nav-icon"></i>
			  <p>Guias</p>
			</a>
		  </li>
		  <li class="nav-item">
			<a href="?l=<?php echo base64_encode(24); ?>" class="nav-link">
			  <i class="fa fa-circle-o nav-icon"></i>
			  <p>Orçamentos</p>
			</a>
		  </li>
		</ul>
	  </li>
	  <?php /*if(!$clinina_usuario){ ?>
	  <li class="nav-item">
		<a href="?l=<?php echo base64_encode(4); ?>" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Unidades
		  </p>
		</a>
	  </li>
	  <?php }*/ ?>
	  <?php if($perfil_usuario == 1 || $perfil_usuario == 5){ ?>
	  <li class="nav-item has-treeview">
		<a href="#" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Cadastro
			<i class="right fa fa-angle-left"></i>
		  </p>
		</a>
		<ul class="nav nav-treeview">
		<?php if($perfil_usuario == 1){ ?>
		  <li class="nav-item">
			<a href="?l=<?php echo base64_encode(8); ?>" class="nav-link">
			  <i class="fa fa-circle-o nav-icon"></i>
			  <p>Unidades</p>
			</a>
		  </li>
		<?php } ?>
		<?php if($perfil_usuario == 1){ ?>
		  <li class="nav-item">
			<a href="?l=<?php echo base64_encode(9); ?>" class="nav-link">
			  <i class="fa fa-circle-o nav-icon"></i>
			  <p>Usuários</p>
			</a>
		  </li>
		 <?php } ?>
		   <li class="nav-item">
			<a href="?l=<?php echo base64_encode(25); ?>" class="nav-link">
			  <i class="fa fa-circle-o nav-icon"></i>
			  <p>Novos Exames</p>
			</a>
		  </li>
		</ul>
	  </li>
	  <?php } ?>	  	  <?php if($perfil_usuario == 1 || $perfil_usuario == 5){ ?>	
	  <li class="nav-item has-treeview">		
	  <a href="#" class="nav-link">		 
	  <i class="nav-icon fa fa-th"></i>		  <p>			Financeiro			<i class="right fa fa-angle-left"></i>		  </p>		
	  </a>		
	  <ul class="nav nav-treeview">		  
	  <li class="nav-item">			
	  <a href="?l=<?php echo base64_encode(17); ?>" class="nav-link">			  <i class="fa fa-circle-o nav-icon"></i>			  <p>Faturamento Diário</p>			</a>		  
	  </li>		  		  
	  <li class="nav-item">			
	  <a href="?l=<?php echo base64_encode(18); ?>" class="nav-link">			  <i class="fa fa-circle-o nav-icon"></i>			  <p>Faturamento Mensal</p>			</a>
	  </li>		 
	   <li class="nav-item">			
	  <a href="?l=<?php echo base64_encode(27); ?>" class="nav-link">			  <i class="fa fa-circle-o nav-icon"></i>			  <p>Despesa Mensal</p>			</a>
	  </li>	

 <li class="nav-item">			
	  <a href="?l=<?php echo base64_encode(28); ?>" class="nav-link">			  <i class="fa fa-circle-o nav-icon"></i>			  <p>Liquido</p>			</a>
	  </li>		  
	
	  </ul>	  
	  </li>	  <?php } ?>
	  <?php /*if($perfil_usuario == 1 || $perfil_usuario == 5){ ?>
	  <li class="nav-item has-treeview">
		<a href="#" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Carga XML
			<i class="right fa fa-angle-left"></i>
		  </p>
		</a>
		<ul class="nav nav-treeview">
		  <li class="nav-item">
			<a href="?l=<?php echo base64_encode(13); ?>" class="nav-link">
			  <i class="fa fa-circle-o nav-icon"></i>
			  <p>Dados</p>
			</a>
		  </li>
		  
		  <li class="nav-item">
			<a href="?l=<?php echo base64_encode(25); ?>" class="nav-link">
			  <i class="fa fa-circle-o nav-icon"></i>
			  <p>Exames</p>
			</a>
		  </li>

		</ul>
	  </li>
	  <?php }*/ ?>
	  <?php if($perfil_usuario == 1 || $perfil_usuario == 5){ ?>
	  <li class="nav-item">
		<a href="?l=<?php echo base64_encode(26); ?>" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Estoque
		  </p>
		</a>
	  </li>
	  <?php } ?>
	  <li class="nav-item">
		<a href="?l=<?php echo base64_encode(7); ?>" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Fale conosco
		  </p>
		</a>
	  </li>
	  
	  <li class="nav-item">
		<a href="?l=<?php echo base64_encode(11); ?>" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Perfil
		  </p>
		</a>
	  </li>
	  <?php if($perfil_usuario == 2){ ?>
	  <li class="nav-item">
		<a href="?l=<?php echo base64_encode(10); ?>" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Perfil Clínica
		  </p>
		</a>
	  </li>
	  <?php } ?>
	  <li class="nav-item">
		<a href="logout.php" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Sair
		  </p>
		</a>
	  </li>
	</ul>
</nav>
<!-- /.sidebar-menu -->