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
				<th> Convenio </th>
				<th> Valor </th>
				<th> Situação </th>
			</tr>
		</thead>
		<?php 
		
			$clinica = null;
			
			if($id_clinica)
				$clinica = $id_clinica;
			
			if(isset($_POST["clinica"]))
				$clinica = $_POST["clinica"];
			
			$total = 0;
			$atrasado =0;
			$recebido = 0;
			
			/*$sql = "SELECT  e.`nome` AS 'exame',f.`nome` AS 'espec',b.`preco`
			FROM `pedido_exame` a
			LEFT JOIN `proc_clinica` b ON b.`id_proc` = a.`id_exame`
			LEFT JOIN `pedido` c ON c.`id` = a.`id_pedido`
			LEFT JOIN `procedimento` e ON e.id = a.id_exame
			LEFT JOIN `especialidades` f ON f.id = e.id_espec
			WHERE c.`dt_cadastro` >= CURDATE()";
			
			$sql = "SELECT d.exame,b.paciente,e.nome as 'convenio',c.preco
			FROM `pedido_exame` a 
LEFT JOIN `pedido` b ON b.`id` = a.`id_pedido`
LEFT JOIN (SELECT * FROM `exame_convenio` WHERE id_clinica=$clinica)AS c ON c.`id_exame` = a.`id_exame` 
LEFT JOIN exame_sus d ON d.codigo = a.id_exame
LEFT JOIN plano e on e.id = b.convenio
WHERE c.`dt_cadastro` >= CURDATE()
";*/

$sql ="SELECT SUM(c.preco) AS 'soma',b.`convenio`,b.`pago`,d.nome as 'plano',d.id as 'id_plano'
FROM `pedido_exame` a 
LEFT JOIN `pedido` b ON b.`id` = a.`id_pedido`
LEFT JOIN (SELECT * FROM `exame_convenio` WHERE id_clinica=1)AS c ON c.id_exame = a.`id_exame`
LEFT JOIN `plano` d ON d.`id` = b.`convenio`
WHERE b.id_clinica = $clinica AND dt_cadastro>=CURDATE()
GROUP BY b.`convenio`";
//echo $sql;
			$exec = mysqli_query($con,$sql);
			while($col = mysqli_fetch_array($exec)){
				//echo $col["espec"]." - ".$col["exame"]." : R$ ".$col["preco"]." <br>";
				echo "<tr>";
				
				echo "<td><a href='relatorio.php?p=".base64_encode($col["id_plano"])."&c=".base64_encode($clinica)."&pl=".base64_encode($col["plano"])."' target='_blank'>".$col["plano"]."</a></td>";
				echo "<td> R$".number_format($col["soma"], 2, ',', ' ')."</td>";
				//echo "<td>".$col["situacao"]."</td>";
				
				if($col["pago"] == 1){
					$pago += $col["soma"];
					echo "<td>Pago</td>";
				}else{
					$atrasado += $col["soma"];
					echo "<td>Não Pago</td>";
				}
				echo "</tr>";
				$total += $col["soma"];
			}
			
			
		?>
		
		</table>
		<?php 
			echo "<h3>R$ ".number_format($pago, 2, ',', ' ')." RECEBIDO </h3>"; 
			echo "<h3> R$ ".number_format($atrasado, 2, ',', ' ')." A RECEBER </h3>"; 
			echo "<h3>TOTAL R$ ".number_format($total, 2, ',', ' ')." </h3>"; 
		?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->