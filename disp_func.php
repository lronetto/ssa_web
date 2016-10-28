<?php
// Incluindo arquivo de conexão/configuração
require('conf/conexao.php');
 
conectar();

$act=$_GET['act'];
//echo $act;


if($act=='nome'){
	$id=$_GET['id'];
	$sql="select * from disp where Id=$id";
	$res=mysql_query($sql);
	$row=mysql_fetch_array($res); 
	echo $row['nome'];
	//return $row['nome'];
}

if($act=='atu'){
		$id=$_GET['id'];
		$nome=$_GET['nome'];
		mysql_query("update disp set nome='$nome' where Id=$id");
		echo mysql_error();
}
if($act=='dat'){
	$sql="select tipo.tipo, estado, nome, rssi, disp.atu, disp.bat_val, disp.Id from disp ";
	$sql.="inner join disp_tipo as tipo on disp.tipo=tipo.Id ";
	$sql.="order by disp.atu desc";
	$res=mysql_query($sql);
	?>
<table border=1>
<tr><td>Nome</td><td>Tipo</td><td>Estado</td><td>RSSI</td><td>Ultimo dado</td><td>Bateria</td><td>Editar</td>
</tr>
<?php
	while($row=mysql_fetch_array($res)){
		echo "<tr><td>".$row['nome']."</td><td>".$row['tipo']."</td><td>";
		if($row['estado']=='1') echo "Ativo";
		else echo "Inativo";
		echo "</td><td>";
		if($row['rssi']=='0') 
			echo "N/A";
		else 
			echo $row['rssi']."dB";
		echo "</td><td>";
		echo $row['atu']."</td><td>".$row['bat_val']."</td>";
		echo "<td><a href='#' onclick=disp_edit(".$row['Id'].")>Editar</a></td></tr>";
		}
	echo "</table>";
}

?>