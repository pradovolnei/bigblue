
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker         : true,
      timePickerIncrement: 30,
      format             : 'MM/DD/YYYY h:mm A'
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  });
  
  
  // FUNÇÃO PARA BUSCA NOTICIA
function listCity(uf) {
 
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
 //var campo = document.getElementById("status_etapa").getAttribute('name');
// Arquivo PHP juntamente com o valor digitado no campo (método GET)


var url = "pages/jquery/lists.php?name=uf&uf="+uf;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {
 
	// Exibe a mensagem "Buscando Noticias..." enquanto carrega
	if(req.readyState == 1) {
		document.getElementById('citys').innerHTML = 'Buscando Cidades...';
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req.readyState == 4 && req.status == 200) {
 
	// Resposta retornada pelo busca.php
	var resposta = req.responseText;
 
	// Abaixo colocamos a(s) resposta(s) na div resultado
	document.getElementById('citys').innerHTML = resposta;
	}
}
req.send(null);


// Verificando Browser
if(window.XMLHttpRequest) {
   req2 = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req2 = new ActiveXObject("Microsoft.XMLHTTP");
}
 //var campo = document.getElementById("status_etapa").getAttribute('name');
// Arquivo PHP juntamente com o valor digitado no campo (método GET)

var url2 = "pages/jquery/lists.php?name=lab&uf="+uf;
 
// Chamada do método open para processar a requisição
req2.open("Get", url2, true);
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req2.onreadystatechange = function() {
 
	// Exibe a mensagem "Buscando Noticias..." enquanto carrega
	if(req2.readyState == 1) {
		document.getElementById('labs').innerHTML = 'Buscando Cidades...';
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req2.readyState == 4 && req2.status == 200) {
 
	// Resposta retornada pelo busca.php
	var resposta = req2.responseText;
 
	// Abaixo colocamos a(s) resposta(s) na div resultado
	document.getElementById('labs').innerHTML = resposta;
	}
}
req2.send(null);
}




  // FUNÇÃO PARA BUSCA NOTICIA
function listLab(city, uf) {
 
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
 //var campo = document.getElementById("status_etapa").getAttribute('name');
// Arquivo PHP juntamente com o valor digitado no campo (método GET)


var url = "pages/jquery/lists.php?name=lab&city="+city+"&uf="+uf;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {
 
	// Exibe a mensagem "Buscando Noticias..." enquanto carrega
	if(req.readyState == 1) {
		document.getElementById('labs').innerHTML = 'Buscando Clínicas...';
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req.readyState == 4 && req.status == 200) {
 
	// Resposta retornada pelo busca.php
	var resposta = req.responseText;
 
	// Abaixo colocamos a(s) resposta(s) na div resultado
	document.getElementById('labs').innerHTML = resposta;
	}
}
req.send(null);
}



  // FUNÇÃO PARA BUSCA NOTICIA
function listWork(lab) {
 
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
 //var campo = document.getElementById("status_etapa").getAttribute('name');
// Arquivo PHP juntamente com o valor digitado no campo (método GET)


var url = "pages/jquery/lists.php?name=work&id_clinica="+lab;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {
 
	// Exibe a mensagem "Buscando Noticias..." enquanto carrega
	if(req.readyState == 1) {
		document.getElementById('works').innerHTML = 'Buscando Espacialidades...';
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req.readyState == 4 && req.status == 200) {
 
	// Resposta retornada pelo busca.php
	var resposta = req.responseText;
 
	// Abaixo colocamos a(s) resposta(s) na div resultado
	document.getElementById('works').innerHTML = resposta;
	}
}
req.send(null);
}

// FUNÇÃO PARA BUSCA NOTICIA
function listProcs(espec) {
 
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
 //var campo = document.getElementById("status_etapa").getAttribute('name');
// Arquivo PHP juntamente com o valor digitado no campo (método GET)


var url = "pages/jquery/lists.php?name=proc&id="+espec;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {
 
	// Exibe a mensagem "Buscando Noticias..." enquanto carrega
	if(req.readyState == 1) {
		document.getElementById('procs').innerHTML = 'Buscando Procedimentos...';
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req.readyState == 4 && req.status == 200) {
 
	// Resposta retornada pelo busca.php
	var resposta = req.responseText;
 
	// Abaixo colocamos a(s) resposta(s) na div resultado
	document.getElementById('procs').innerHTML = resposta;
	}
}
req.send(null);
}

// FUNÇÃO PARA BUSCA NOTICIA
function listPlans(proc, clinica) {
 
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
 //var campo = document.getElementById("status_etapa").getAttribute('name');
// Arquivo PHP juntamente com o valor digitado no campo (método GET)


var url = "pages/jquery/lists.php?name=plans&proc="+proc+"&cli="+clinica;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {
 
	// Exibe a mensagem "Buscando Noticias..." enquanto carrega
	if(req.readyState == 1) {
		document.getElementById('planos').innerHTML = 'Buscando Planos...';
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req.readyState == 4 && req.status == 200) {
 
	// Resposta retornada pelo busca.php
	var resposta = req.responseText;
 
	// Abaixo colocamos a(s) resposta(s) na div resultado
	document.getElementById('planos').innerHTML = resposta;
	}
}
req.send(null);
}


// FUNÇÃO PARA BUSCA NOTICIA
function listTespec(id) {
 
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
 //var campo = document.getElementById("status_etapa").getAttribute('name');
// Arquivo PHP juntamente com o valor digitado no campo (método GET)


var url = "pages/jquery/lists.php?name=listp&id="+id;
var url2 = "pages/jquery/lists.php?name=listou&id="+id;

// Chamada do método open para processar a requisição
req.open("Get", url, true);
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {
 
	// Exibe a mensagem "Buscando Noticias..." enquanto carrega
	if(req.readyState == 1) {
		document.getElementById('div_procs').innerHTML = 'Buscando Procedimentos...';
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req.readyState == 4 && req.status == 200) {
 
	// Resposta retornada pelo busca.php
	var resposta = req.responseText;
 
	// Abaixo colocamos a(s) resposta(s) na div resultado
	document.getElementById('div_procs').innerHTML = resposta;
	}
}



req.send(null);

// Verificando Browser
if(window.XMLHttpRequest) {
   req2 = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req2 = new ActiveXObject("Microsoft.XMLHTTP");
}


req2.open("Get", url2, true);
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req2.onreadystatechange = function() {
 
	// Exibe a mensagem "Buscando Noticias..." enquanto carrega
	if(req2.readyState == 1) {
		document.getElementById('outros').innerHTML = 'Buscando Procedimentos...';
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req2.readyState == 4 && req2.status == 200) {
 
	// Resposta retornada pelo busca.php
	var resposta = req2.responseText;
 
	// Abaixo colocamos a(s) resposta(s) na div resultado
	document.getElementById('outros').innerHTML = resposta;
	}
}

req2.send(null);
}

// FUNÇÃO PARA BUSCA NOTICIA
function listOutros(id) {
 
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
 //var campo = document.getElementById("status_etapa").getAttribute('name');
// Arquivo PHP juntamente com o valor digitado no campo (método GET)


var url = "pages/jquery/lists.php?name=listou&id="+id;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {
 
	// Exibe a mensagem "Buscando Noticias..." enquanto carrega
	if(req.readyState == 1) {
		document.getElementById('outros').innerHTML = 'Buscando Procedimentos...';
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req.readyState == 4 && req.status == 200) {
 
	// Resposta retornada pelo busca.php
	var resposta = req.responseText;
 
	// Abaixo colocamos a(s) resposta(s) na div resultado
	document.getElementById('outros').innerHTML = resposta;
	}
}
req.send(null);
}