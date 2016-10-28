<?php
$arquivo = 'soudev.xls';
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename={$arquivo}" );
header ("Content-Description: PHP Generated Data" ); 

require('conf/conexao.php');
 
$query = "SELECT * FROM var_val where var=174 order by Id DESC limit 1000";
conectar();
$res= mysql_query($query);
$num = mysql_num_rows($res);
 
echo "<table><tr><td>i</td><td>val</td><td>Data</td></tr>";
$i=0;
while($row = mysql_fetch_array($res)){
	echo "<tr><td>".$i."</td><td>".$row['val']."</td><td>".$row['date']."</td></tr>";
	$i++;
}
echo "</table>" ;
/*
for($i=0;$i<1;$i++){   
$html[$i] = "";
    $html[$i] .= "<table>";
    $html[$i] .= "<tr>";
    $html[$i] .= "<td><b>Nome</b></td>";
    $html[$i] .= "<td><b>addres</b></td>";
    $html[$i] .= "</tr>";
    $html[$i] .= "</table>";
}
   
$i = 1;
while($row = mysql_fetch_array($res)){
	$retorno_nome = $row['nome'];
	$retorno_twitter = $row['address'];
    $html[$i] .= "<table>";
    $html[$i] .= "<tr>";
    $html[$i] .= "<td>$retorno_nome</td>";
    $html[$i] .= "<td>$retorno_twitter</td>";
    $html[$i] .= "</tr>";
    $html[$i] .= "</table>";
    $i++;
}
 

 
for($i=0;$i<=$contar;$i++){  
    echo $html[$i];
}*/
?>