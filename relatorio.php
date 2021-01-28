<?php 


		include "conexao.php";
		header ('Cache-Control: no-cache, must-revalidate');
		header ('Pragma: no-cache');
		header('Content-Type: application/x-msexcel');
		header ("Content-Disposition: attachment; filename=\Relatorio.xls");
		


	?>
	<table border=1>
	<thead>
		<tr>
			<th> Plano </th>
			<th> Exame </th>
			<th> Paciente </th>
			<th> Data </th>
			<th> Valor </th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$sql = "SELECT d.exame,b.paciente,b.dt_cadastro,c.preco FROM pedido_exame a 
					LEFT JOIN pedido b on b.id = a.id_pedido
					LEFT JOIN (SELECT * FROM exame_convenio WHERE id_convenio=".base64_decode($_GET["p"])." AND id_clinica=".base64_decode($_GET["c"]).")as c ON c.id_exame = a.id_exame
					LEFT JOIN exame_sus d ON d.codigo = a.id_exame
					WHERE b.id_clinica=".base64_decode($_GET["c"])." AND b.convenio=".base64_decode($_GET["p"]);
			$exec = mysqli_query($con,$sql);
			while($col = mysqli_fetch_array($exec)){
				echo "<tr>";
				
				echo "<td> ".base64_decode($_GET["pl"])." </td>";
				echo "<td> ".$col["exame"]." </td>";
				echo "<td> ".$col["paciente"]." </td>";
				echo "<td> ".$col["dt_cadastro"]." </td>";
				echo "<td> R$ ".number_format($col["preco"], 2, ',', ' ')." </td>";
				
				echo "</tr>";
			}
		?>
	</tbody>
	
	</table>