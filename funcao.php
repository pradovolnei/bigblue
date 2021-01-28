<?php 

	function encripta($senha){
		$salt = md5("@SGC.19.vp");
		$codifica = crypt($senha,$salt);
		$codifica = hash('sha512',$codifica);
		return $codifica;
	}
	
	function dataAmericana($data){
		if($data){
			$dataAmericana = explode("/", $data);
			$data = array_reverse($dataAmericana);
			$dataAmericana = implode("-", $data);
			return $dataAmericana;
		}
	}
	
	function dataBrasileira($data){
		if($data){
			$dataBrasileira = date("d/m/Y", strtotime($data));
			return($dataBrasileira);
		}
	}
	
	function dataChat($data){
		if($data){
			$dataBrasileira = date("d/m/Y H:i", strtotime($data));
			return($dataBrasileira);
		}
	}
	
	function valorDecimal($valor, $fonte){
		$valorDecimal = number_format($valor, 2, '.', '');
		
		if($fonte == "view")
		$valorDecimal = number_format($valor, 2, ',', '.');
	
		return $valorDecimal;
	}
	
	function perfilUsuario($valor){
		if($valor == 1)
			return "Administrador";
		if($valor == 2)
			return "Gestor";
		if($valor == 3)
			return "Funcionário";
		if($valor == 4)
			return "Paciente";
	}
	
	function clinica($valor){
		$con = mysqli_connect('localhost', "root", '');
		mysqli_select_db($con, 'sgc');
		
		ini_set('default_charset','UTF-8');
		mysqli_set_charset($con, "utf8");
		
		$sql = "SELECT b.nome FROM usuarios a
				LEFT JOIN clinica b on b.id = a.id_clinica
				WHERE a.id=".$valor;
		$exec = mysqli_query($con,$sql);
		$col = mysqli_fetch_array($exec);
		
		if($col["nome"])
			return $col["nome"];
	}

	function msgLimit($valor){
		$texto = $valor;
		$tam = strlen($valor);
		$max = 30;
		if($tam > $max)
			$texto = substr_replace($valor, "...", $max, $tam - $max);
		
		
		return $texto;
	}
	
	function diferencaTempo($valor){
		$diferenca = strtotime(date("Y-m-d H:i:s")) - strtotime($valor);
		
		if($_SERVER["REMOTE_ADDR"] == "127.0.0.1")
			$diferenca = strtotime(date("Y-m-d H:i:s")."- 5 hours") - strtotime($valor);
		
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
		
		
		return $convert." $unity";
	}
?>