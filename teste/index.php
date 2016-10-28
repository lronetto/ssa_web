<html>
<head>
    <meta charset="utf-8" />
    <title>Calend�rio jQuery</title>   
	<link rel="stylesheet" href="../js/jquery-ui.css" />
	<script type="text/javascript" src="../js/jquery-1.7.js"></script> 
	<script type="text/javascript" src="../js/jquery.form.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.js">
</script>
<script>
$(function() {
    $("#calendario").datepicker({
	   changeMonth: true,
        changeYear: true,
        dateFormat: 'yyyy-mm-dd',
        dayNames: ['Domingo','Segunda','Ter�a','Quarta','Quinta','Sexta','S�bado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','S�b','Dom'],
        monthNames: ['Janeiro','Fevereiro','Mar�o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });

});
</script>
</head>
<body>
    <p>Data: <input type="text" id="calendario" /></p>
 </body>
</html>

	
