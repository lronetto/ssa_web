<?php
// Incluindo arquivo de conexão/configuração
require('conf/conexao.php');
require_once('conf/Login.php');

//$db = new DB_CONNECT();
$objLogin = new Login('usuario','id','login','senha');
echo "ola";
?>