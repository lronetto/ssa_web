<?php
// Incluindo arquivo de conexão/configuração
require('conf/conexao.php');
require_once('conf/Login.php');
 
conectar('lronetto_ssa');
// Instanciando novo objeto da classe Login
$objLogin = new Login('usuario','Id','login','pass');
 
// Verificando se o usuário está logado, caso contrário será redirecionado para a página de login
if ($objLogin->verificar('')){
	$query = mysql_query("SELECT * FROM usuario WHERE Id = {$objLogin->getID()}");
	$usuario = mysql_fetch_object($query);
    	//echo "<script>window.location.href = 'index1.php'</script>";
	}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistema de sensoriamento e acionamento</title>
	<link rel="stylesheet" href="js/jquery-ui.css" />
	<script type="text/javascript" src="js/jquery-1.7.js"></script> 
	<script type="text/javascript" src="js/jquery.form.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js">
</script>
	<script>
	// Quando carregado a página
$(document).ready(
function() {
    // Quando enviado o formulário
    $('#frmLogin').submit(function() {
 
        // Limpando mensagem de erro
        $('#mensagem-erro').html('');
 
        // Mostrando loader
        $('div.loader').show();
 
        // Enviando informações do formulário via AJAX
        $.post('conf/logar.php', {login: $("#login").val(),
			     senha: $("#senha").val()},function(resposta){
				if(resposta!=false){
						$('div.loader').hide();
						window.location.href="index1.php";
						}
					else{
						$('div.loader').hide();	
						//$("#mensagem-erro").html(resposta);
						$("#mensagem-erro").html("usuario ou senha incorreto");
						}
						});
 
        });
     });

</script>
    </head>
    <body>
        <form id="frmLogin" action="javascript:func()" method="POST">
            <fieldset align=center>
                <legend align=center>Entrar</legend>
 
                <div class="loader" style="display: none;">
                    <img src="img/loader.gif" alt="Carregando" />
                </div>
                <div id="mensagem-erro"></div>
 
                <p>
                    <label for="login">Usuário</label> <br />
                    <input type="text" id="login" name="login" />
                </p>
 
                <p>
                    <label for="senha">Senha</label> <br />
                    <input type="password" id="senha" name="senha" />
                </p>
 
                <input type="submit" value="Entrar" />
            </fieldset>
        </form>
    </body>
</html>
