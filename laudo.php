<?php
		
	include('mpdf60/mpdf.php');
	include ('conexao.php');

	$pedido = base64_decode($_GET['p']);
	$exame = base64_decode($_GET['e']);

				

			$header = '
			<table cellspacing="0" width="100%" border="1">
					<thead>
						<tr>
							<td width="7%" class="tc" height="70"  align="center"  ><img width="50" height="50" src="../../dist/img/star.png"></td>
							<td width="23%" class="tc" align="center">Laudo </td>
						</tr>
					</thead>
					<tbody>					 
					</tbody>
					</table>';	
					
			$sql = "SELECT b.* ,a.`laudo`,a.`resultado`,c.`exame`,d.nome as 'clinica',e.`nome` AS 'plano'
					FROM `pedido_exame` a 
					LEFT JOIN `pedido` b ON b.`id` = a.`id_pedido`
					LEFT JOIN `exame_sus` c ON c.`codigo` = a.`id_exame`
					LEFT JOIN `clinica` d ON d.`id` = b.`id_clinica`
					LEFT JOIN `plano` e ON e.`id` = b.`convenio`
					where a.id_exame = $exame AND a.id_pedido = $pedido	";
			$exec = mysqli_query($con,$sql);
			$col = mysqli_fetch_array($exec);
					
			$html = 	"<table  cellspacing='0' width='100%' border='1'>
			<tbody>
				<tr>
					<td> <b>Clínica</b> <tb>
					<td> ".$col["clinica"]." </td>
				</tr>
				
				<tr>
					<td> <b>Paciente</b> <tb>
					<td> ".$col["paciente"]." </td>
				</tr>
				
				<tr>
					<td> <b>Médico</b> <tb>
					<td> ".$col["medico"]." </td>
				</tr>
				
				<tr>
					<td> <b>Convênio</b> <tb>
					<td> ".$col["plano"]." </td>
				</tr>
				
			
			</tbody>
			</table> <br>
			<h4>".$col["exame"]."</h4>
			<b>Resultado:</b>".$col["resultado"]."
			";	
			$footer = "LAUDO Page {PAGENO} of {nb}";





	$mpdf=new mPDF('utf-8','A4','','','15','15','50','18');
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->SetTitle("Laudo");
	$css = file_get_contents("../../css/estilo.css");
	//$mpdf->WriteHTML($css,1);
	$mpdf->SetHTMLHeader($header);
	$mpdf->SetHTMLFooter($footer );
	$mpdf->WriteHTML($html);
	$mpdf->Output($identTae.".pdf",'I');
	//$mpdf->Output($row["ident_taf"].".pdf",'F');I
	
	//$identTae, 'I'
	//echo "<script>  window.close(); </script>";
	//exit();
	//unlink("a.pdf");
	
	//header("Content-type: application/pdf");

//Nome que arquivo será salvo
//header("Content-Disposition: attachment; filename=".$identTae.".pdf");
	
?>