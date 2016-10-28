<?php
$smtp="-xu engetel@engetelengenharia.com.br -xp en0429 -s smtp.engetelengenharia.com.br:25 -o tls=yes -f \"engetel@engetelengenharia.com.br\"";
$dest="-t ".$_GET['dest'];
$asunt="-u ".$_GET['asunt'];
$mens="-m ".$_GET['mens'];
if($_GET['a']!='') $anexo="-a ".$_GET['a'];
else $anexo="";
$str="./sendEmail $smtp $dest $asunt $mens $anexo";
echo $str."<br>";
echo system($str);
?>

