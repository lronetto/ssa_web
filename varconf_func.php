<?php
// Incluindo arquivo de conexão/configuração
require('conf/conexao.php');
 
conectar('lronetto_ssa');

$act=$_GET['act'];
if($act=="disp"){
	$res=mysql_query("select * from disp");
	echo "<option selected value=0>Todos</option>";
	while($row=mysql_fetch_array($res)){
		echo "<option value=".$row['Id'].">".$row['nome']."</option>";
		}
}
if($act=="tab"){
	$disp=$_GET['disp'];
	//echo $disp;
	if($disp==0){
		$sql="select disp.nome as disp, var_conf.nome,var_conf.media, ativo, tempo, var_tipo.tipo as tipo, var_conf.Id from var_conf ";
		$sql.="inner join disp on disp.Id=var_conf.disp ";
		$sql.="inner join var_tipo on var_tipo.Id=var_conf.var_tipo ";
		}
	else{
		$sql="select disp.nome as disp, var_conf.nome,var_conf.media, ativo, tempo, var_tipo.tipo as tipo, var_conf.Id from var_conf ";
		$sql.="inner join disp on disp.Id=var_conf.disp ";
		$sql.="inner join var_tipo on var_tipo.Id=var_conf.var_tipo ";
		$sql.="where var_conf.disp=$disp ";
		}
		$res=mysql_query($sql);
	//echo $sql;
	echo "<table border=1>";
	echo "<tr><td>Dispositivo</td><td>Nome</td><td>Tempo(segundos)</td><td>Medias</td><td>Ativo</td><td>Tipo</td><td>Ultimo valor</td><td>Editar</td><td>Apagar</td></tr>";
	while($row=mysql_fetch_array($res)){
		echo "<tr><td>".$row['disp']."</td><td>".$row['nome']."</td><td>".$row['tempo']."</td><td>";
		echo $row['media']."</td><td>";
		if($row['ativo']=='1')
			echo "<a href='#' onclick='javascript:varconf_ativo(".$row['Id'].")'>Ativo</a></td>";
		else
			echo "<a href='#' onclick='javascript:varconf_ativo(".$row['Id'].")'>Inativo</a></td>";
		echo "<td>".$row['tipo']."</td>";
		$sql="select date, val from var_val ";
		$sql.="inner join var_conf on var_val.var=var_conf.Id ";
		$sql.="where var_conf.Id=".$row['Id']." order by var_val.Id DESC limit 1";
		$res1=mysql_query($sql);
		$row1=mysql_fetch_array($res1);
		echo "<td>".$row1['date']." - ".$row1['val']."</td>";
		echo "<td><a href='#' onclick=javascript:varconf_edit(".$row['Id'].")>Editar</a></td>";
		echo "<td><a href='#' onclick=javascript:varconf_del(".$row['Id'].")>Apagar</a></td></tr>";
		
		}
	echo "</table>";
	}
if($act=="ativo"){
	$id=$_GET['id'];
	mysql_query("update var_conf set ativo=1-ativo where Id=$id");
	//mysql_query("insert into var_atu(disp,var) values((select disp from var_conf where Id=$id),$id)");
}
if($act=='edit'){
	$id=$_GET['id'];
	$sql="select * from var_conf where Id=$id";
	$res=mysql_query($sql);
	$row=mysql_fetch_array($res); 
	
	echo json_encode($row);
	//return $row['nome'];
}
if($act=='del'){
	$id=$_GET['id'];
	mysql_query("delete from var_conf where id=$id");
	mysql_query("delete from var_val where var=$id");
}
if($act=='salva'){
	$id=$_GET['id'];
	$sql="update var_conf set nome='".$_GET['nome']."', tempo=".$_GET['tempo'].", media=".$_GET['media']." where Id=".$_GET['id'];
	mysql_query($sql);
	echo mysql_error();
	mysql_query("insert into var_atu(disp,var) values((select disp from var_conf where Id=$id),$id)");
	
}
?>
