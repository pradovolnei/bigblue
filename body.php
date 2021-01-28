<?php 

	if(isset($_GET["l"])){
		$link = base64_decode($_GET["l"]);
		$pag[1]="pages/atendimentos/consulta.php";
		$pag[4]="pages/atendimentos/novo.php";
		$pag[2]="helpdesk/consulta.php";
		$pag[3]="perfil/consulta.php";
		$pag[5]="pages/atendimentos/espec.php";
		$pag[6]="pages/atendimentos/solicitacao.php";
		$pag[7]="pages/chamados/call.php";
		$pag[8]="pages/cadastro/unidades.php";
		$pag[9]="pages/cadastro/usuarios.php";
		$pag[10]="pages/perfil/clinica.php";
		$pag[11]="pages/perfil/usuario.php";
		$pag[12]="pages/chat/list.php";
		$pag[13]="pages/carga/conservante.php";				
		$pag[14]="pages/atendimentos/paciente.php";				
		$pag[15]="pages/atendimentos/salvar.php";				
		$pag[16]="pages/atendimentos/save.php";
		$pag[17]="pages/financeiro/diario.php";
		$pag[18]="pages/financeiro/mensal.php";
		$pag[19]="pages/financeiro/pagar.php";
		$pag[20]="pages/financeiro/receber.php";
		$pag[21]="pages/atendimentos/ficha_paciente.php";
		$pag[22]="pages/atendimentos/dados_exame.php";
		$pag[23]="pages/atendimentos/save_exame.php";
		$pag[24]="pages/atendimentos/orcamentos.php";
		$pag[25]="pages/carga/exames.php";
		$pag[26]="pages/estoque/estoque.php";
		$pag[27]="pages/financeiro/despesa_mensal.php";
		$pag[28]="pages/financeiro/liquido.php";

	}

	if(!empty($link))
	{			
		if (file_exists($pag[$link]))
		{
			
			include $pag[$link];
			
		}
		else
		{
			print "a pagina nao foi encontrada";
		}
			
	}else{
		include "notificacoes.php";
	}
?>
	
 