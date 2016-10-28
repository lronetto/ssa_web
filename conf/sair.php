<?
// Incluindo arquivo de conexão/configuração
require('conexao.php');
require_once('Login.php');
 
// Instanciando novo objeto da classe Login
$db=conectar("ssa");
$objLogin = new Login('usuario','id','login','senha');

$objLogin->logout('../index.php');
?>
