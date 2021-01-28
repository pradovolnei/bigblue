<?php 
	include "../../conexao.php";
	
	
?>
<meta charset="utf-8">
 <!-- /.form-group -->
<div class="form-group">
  <label>Cidade</label>
  <select class="form-control" name="cidade" style="width: 100%;">
	<?php 
		$sql_city = "SELECT * FROM cidades ";
		
		if($_GET["uf"])
		$sql_city .= " WHERE uf='".$_GET["uf"]."'";
	
		$sql_city .= " ORDER BY nome";
		
		$exec_sql_city = mysqli_query($con,$sql_city);
		echo "<option value=''> Todas as cidades </option>";
		while($col = mysqli_fetch_array($exec_sql_city)){
			echo "<option value='".$col["nome"]."'> ".$col["nome"]." </option>";
		}
	?>
  </select>
</div>
<!-- /.form-group -->