<?php
require('../conf/conexao.php');
$con=conectar();
$res=mysql_query("select * from var_val where var=".$_GET['var']." order by Id ASC ");
$i=0;
while($row=mysql_fetch_array($res)){
	$orders[] = array(
		'date'=>$row['date'], //row['date'],
		'val'=>$row['val']	);
		$i++;
	}
echo json_encode($orders);
?>

