	<?php 
		//include "pages/atendimentos/consulta_controller.php";
	?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-2">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Financeiro</li>
            </ol>
          </div>

		  
		  
          
        </div>
		
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
	  <?php if(!$id_clinica){ ?>
	  <form action="" method="post">
	  <label>Clinica</label>
		<select name="clinica">
			<?php 
				$sql = "SELECT * FROM clinica where id=1 ORDER BY nome";
				$exec = mysqli_query($con,$sql);
				while($col = mysqli_fetch_array($exec)){
					if(isset($_POST["clinica"]) && $_POST["clinica"] == $col["id"])
						echo "<option value='".$col["id"]."' selected>".$col["nome"]."</option>";
					else
						echo "<option value='".$col["id"]."' >".$col["nome"]."</option>";

				}
			?>
		</select>
		<input type="submit" value="Listar" />
	  </form>
	  <?php } ?>
	  <table border=2>
		<thead>
			<tr>
				<th>Produto </th>
                  <th>Quantidade</th>
                  <th>Preço(R$)</th>
                  <th>Descrição</th>
			</tr>
		</thead>
		<?php 
		
			$clinica = 0;
			
			if($id_clinica)
				$clinica = $id_clinica;
			
			if(isset($_POST["clinica"]))
				$clinica = $_POST["clinica"];
			
			$total = 0;
			$atrasado =0;
			$recebido = 0;
			
	
$sql ="SELECT a.*,b.produto FROM historico_estoque a 
		LEFT JOIN produtos b ON b.id = a.id_produto
		WHERE a.id_clinica = $clinica AND month(a.data)=month(CURDATE()) AND acao='add'
		";
//echo $sql;
			$exec = mysqli_query($con,$sql);
			while($col = mysqli_fetch_array($exec)){
				//echo $col["espec"]." - ".$col["exame"]." : R$ ".$col["preco"]." <br>";
				echo "<tr>";
				
				echo "<td>".$col["produto"]."  </td>";
				echo "<td>".$col["qtd"]."</td>";
				echo "<td>R$ ".number_format($col["preco"], 2, ',', ' ')."</td>";
				echo "<td>".$col["obs"]."</td>";
				echo "</tr>";
				$total += ($col["preco"]*$col["qtd"]);
			}
			
			
		?>
		
		</table>
		<?php 
			echo "<h3>R$ ".number_format($total, 2, ',', ' ')." GASTOS </h3>"; 

		?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->