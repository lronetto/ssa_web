<?php
// Incluindo arquivo de conexão/configuração
require('conf/conexao.php');
require_once('conf/Login.php');
 
// Instanciando novo objeto da classe Login
$db=conectar("ssa");
$objLogin = new Login('usuario','Id','login','pass');
 
// Verificando se o usuário está logado, caso contrário será redirecionado para a página de login
$objLogin->verificar('');
$query = mysql_query("SELECT * FROM usuario WHERE Id = {$objLogin->getID()}");
$usuario = mysql_fetch_object($query);

?>
<html>
<head>
<script type="text/javascript" src="js/jquery-1.8.2.js"></script> 
<script type="text/javascript" src="js/jquery-ui.js"></script> 
<link rel="stylesheet" href="../js/jquery-ui.css" />
<script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"/></script>
<script type="text/javascript" src="js/jquery.fileupload/jquery.fileupload.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="highslide/highslide/highslide.js"></script>
<link rel="stylesheet" type="text/css" href="highslide/highslide/highslide.css" />
<script type="text/javascript">
	hs.graphicsDir = 'highslide/highslide/graphics/';
	hs.wrapperClassName = 'wide-border';

</script>
<style type="text/css" media="screen">

		div#menu {
			width: 100%;
			background: #FFFFFF;
			position: fixed; /*Fixa o elemento nas coordenadas seguintes*/
			top: 0px;
			right: 0px;
			color: white;
		}
</style>
<meta http-equiv="content-Type" content="text/html; charset=utf-8" />

<script>
$(document).ready(
	function() {
		$("#menu").find("a").click(
			function(){
				$("#conteudo").load(this.href);
				return false;
			});
		$("#sair").click(
			function(){
				window.location.href='conf/sair.php';
				});
	

		});
</script>
<title>Sistema de Sensoriamento e Acionamento</title>
</head>
<body>
<br><br>
<div id="menu">
<center>
[<a href="modulos/conf_var">Configuração Variaveis</a>]
[<a href="modulos/conf_disp">Configuração Dispositivos</a>]
[<a href="modulos/var">Variaveis</a>]
[<a href="modulos/fornecedores">Fornecedores</a>]
<hr>
</div>
<br>
<div id="conteudo"></div>
