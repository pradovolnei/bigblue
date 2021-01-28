<?php 
	include "../../conexao.php";
	include "../../funcao.php";
	
?>

<?php 
	if($_GET["name"] == "uf"){
?>
<meta charset="utf-8">
 <!-- /.form-group -->
<div class="form-group">
  <label>Cidade</label>
  <select class="form-control" name="cidade" style="width: 100%;" onChange="listLab(this.value, '<?php echo $_GET["uf"]; ?>')">
	<?php 
		$sql_city = "SELECT * FROM cidades ";
		
		if($_GET["uf"])
		$sql_city .= " WHERE uf='".$_GET["uf"]."'";
	
		$sql_city .= " ORDER BY nome";
		
		$exec_sql_city = mysqli_query($con,$sql_city);
		echo "<option value=''> Todas as cidades </option>";
		while($col = mysqli_fetch_array($exec_sql_city)){
			echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
		}
	?>
  </select>
</div>
<!-- /.form-group -->
<?php 
	}
?>

<?php 
	if($_GET["name"] == "lab"){
?>

<meta charset="utf-8">
 <!-- /.form-group -->
<div class="form-group">
  <label>Clínica </label>
  <select class="form-control" style="width: 100%;" onChange="listWork(this.value)" name="clinica">
	<option value=''>Todas as clínicas</option>
	<?php 
		$sql_lab = "SELECT * FROM clinica WHERE id IS NOT NULL ";
		if($_GET["uf"])
		$sql_lab .= " AND uf='".$_GET["uf"]."'";
		
		if($_GET["city"])
		$sql_lab .= " AND cidade=".$_GET["city"];
	
		$exec_sql_lab = mysqli_query($con, $sql_lab);
		
		while($col = mysqli_fetch_array($exec_sql_lab)){
			echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
		}
	?>
  </select>
</div>

<?php 
	}
?>


<?php 
	if($_GET["name"] == "work"){
?>

<meta charset="utf-8">
 <!-- /.form-group -->
<div class="form-group">
  <label>Especialidade</label>
  <select class="form-control" style="width: 100%;" name="especialidade">
	
	<?php 
		$sql_lab = "SELECT b.nome, b.id FROM espec_clinica a 
					LEFT JOIN especialidades b ON b.id = a.id_espec
					WHERE a.id_espec IS NOT NULL
					";
		if($_GET["id_clinica"])
			$sql_lab .= " AND a.id_clinica =".$_GET["id_clinica"];
		
		$exec_sql_lab = mysqli_query($con, $sql_lab);
		echo "<option value=''> todos as especialidades </option>";
		while($col = mysqli_fetch_array($exec_sql_lab)){
			echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
		}
	?>
  </select>
</div>

<?php 
	}
?>

<?php 
	if($_GET["name"] == "proc"){
?>

<meta charset="utf-8">
<div class="form-group">
  <label>Procedimento</label>
  <select class="form-control" style="width: 100%;" name="proc">
	<option value=''>Todas os procedimentos</option>
	<?php 
		$sql_lab = "SELECT * FROM procedimento ";
		if($_GET["id"])
			$sql_lab .= " WHERE id_espec=".$_GET["id"];
		
		$exec_sql_lab = mysqli_query($con, $sql_lab);
		
		while($col = mysqli_fetch_array($exec_sql_lab)){
			echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
		}
	?>
  </select>
</div>

<?php 
	}
?>

<?php 
	if($_GET["name"] == "plans"){
		
		$sql = "SELECT preco FROM proc_clinica WHERE id_proc='".$_GET["proc"]."' AND id_clinica='".$_GET["cli"]."'";
		$exec = mysqli_query($con, $sql);
		$col = mysqli_fetch_array($exec);
		if(mysqli_num_rows($exec)>0)
		$preco = valorDecimal($col["preco"], "view");
?>

<meta charset="utf-8">
<div class="form-group">
<label >Plano</label>
<select name="plano" class="form-control" required >
	<option value=""> Selecione o plano </option>
	<?php
		if(isset($preco))
			echo '<option value="NULL"> Particular R$'.$preco.' </option>'
	?>
	
	
	<?php 
		$sql_planos = "SELECT b.id,b.nome, a.produto 
						FROM plano_clinica a
						LEFT JOIN plano b ON b.id = a.id_plano

						WHERE a.id_clinica =".$_GET["cli"]." ORDER BY b.nome";
		$exec_sql_planos = mysqli_query($con, $sql_planos);
		
		while($col = mysqli_fetch_array($exec_sql_planos)){
			echo '<option value="'.$col["id"].'"> '.$col["nome"].' '.$col["produto"].' </option>';
		}
	?>
</select>
</div>

<?php 
	}
?>

<?php 
	if($_GET["name"] == "listp"){
		
?>

<meta charset="utf-8">
<div class="form-group">


		
	<?php 
		if($_GET["id"] != "outras"){
			
			$sql_planos = "SELECt * FROM procedimento WHERE id_espec=".$_GET["id"]." AND nome<>'Consulta'";
			$exec_sql_planos = mysqli_query($con, $sql_planos);
			if(mysqli_num_rows($exec_sql_planos)>0){
				echo "<label >Procedimentos<br></label>";
				while($col = mysqli_fetch_array($exec_sql_planos)){
					//echo '<option value="'.$col["id"].'"> '.$col["nome"].'</option>';
					echo '<br><label><input type="checkbox" class="flat-red" name="procedimento[]" value="'.$col["id"].'"> '.$col["nome"].' <input type="number" name="preco[]" placeholder="Preço (R$)" /></label>';
				}
			}
		}
		
	?>

</div>

<?php 
	}
?>

<?php 
	if($_GET["name"] == "listou"){
		
?>

<meta charset="utf-8">
<div class="form-group">

		
	<?php 
		if($_GET["id"] == "outras")
			echo "<br /><input type='text' name='outras' class='form-control' placeholder='Digite a especialidade' required  />";
	?>

</div>

<div class="form-group">
<?php

echo '<br><label><input type="radio" class="flat-red" name="procedimento" checked > Consulta <input type="number" name="preco" placeholder="Preço (R$)" /></label>';
?>
</div>
<?php 
	}
?>