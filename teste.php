<?php 
	include "bootstrap.php";
	include "funcao.php";
	include "conexao.php";
	
?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<form action="" method="post">
<label><input type="checkbox" class="minimal" name="p[]" value="aaa"></label>
<label><input type="checkbox" class="minimal" name="p[]" value="bbb"></label>
<label><input type="checkbox" class="minimal" name="p[]" value="ccc"></label>
<label><input type="checkbox" class="minimal" name="p[]" value="ddd"></label>
<label><input type="checkbox" class="minimal" name="p[]" value="eee"></label>
		
<input type="submit" name="tetes" />
</form>

<?php 
$valor = "2019-07-03 22:48:00";
//echo date("Y-m-d H:i:s");
$diferenca = strtotime(date("Y-m-d H:i:s")) - strtotime($valor);
		
		$unity = "segundos";
		$convert = $diferenca;
		
		if($diferenca>60){
			$unity = "minutos";
			$convert = floor($diferenca/60);
			if($convert == 1)
				$unity = "minuto";
		}
		
		if($diferenca>3600){
			$unity = "horas";
			$convert = floor($diferenca/3600);
			if($convert == 1)
				$unity = "hora";
		}
			
		if($diferenca>86400){
			$unity = "dias";
			$convert = floor($diferenca/86400);
			if($convert == 1)
				$unity = "dia";
		}
		
		
		echo $convert." $unity atrás";
?>