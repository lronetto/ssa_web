
<?php
require('../conf/conexao.php');
$act=$_POST['act'];
$mac=$_POST['mac'];
$pass=$_POST['pass'];
$tipo=$_POST['tipo'];
$rssi=$_POST['rssi'];
$type=$_POST['type'];
$id=$_POST['id'];

//echo "act=$act mac=$mac";

//echo "teste";
$ap=0;
conectar(); 
/*$res=mysql_query("select * from access where pass=PASSWORD('$pass') and disp=0");
$row=mysql_fetch_array($res);
if(mysql_num_rows($res)){
	$ap=1;
	}*/
function atu($mac){
	$id=mac_id($mac);
	$sql="select var_atu.disp, var_conf.tempo,var_conf.disp_var,var_conf.media,disp.mac,var_atu.id from var_atu ";
	$sql.="inner join var_conf on var_conf.id=var_atu.var ";
	$sql.="inner join disp on disp.id=var_atu.disp ";
	$sql.="where var_atu.disp=$id";
	$qtd1=0;
	$res=mysql_query($sql);
	if($res){
		if(mysql_num_rows($res)){
			while($row=mysql_fetch_array($res)){
				$disp[$qtd1]['tempo']=$row['tempo'];
				$disp[$qtd1]['media']=$row['media'];
				$disp[$qtd1]['var']=$row['disp_var'];
				mysql_query("delete from var_atu where id=".$row['id']);
				$qtd1++;
				}
			}
		}
	if($qtd1>0){
		$str="$$".$qtd1.';'.$mac;
		for($i=0;$i<$qtd1;$i++)
			$str.=';'.$disp[$i]['var'].';'.$disp[$i]['tempo'].';'.$disp[$i]['media'];
			echo $str.';&';
	}
	else echo "$$0;&";
}
function mac_id($mac){
	$res=mysql_query("select * from disp where mac='$mac'");
	if($res){
		if(mysql_num_rows($res)){
			$row=mysql_fetch_array($res);
			return $row['Id'];
			}
		}
	else return 0;
		
}
function var_id($disp,$var){
	$res=mysql_query("select * from var_conf where disp=$disp and disp_var=$var");
	if($res){
		if(mysql_num_rows($res)){
			$row=mysql_fetch_array($res);
			return $row['Id'];
			}
		else return 0;
		}
	else echo 0;
		
}
function tem_out($disp,$out){
	$res=mysql_query("select * from aci where disp='$disp' and out=$out");
	if($res){
		if(mysql_num_rows($res)){
			$row=mysql_fetch_array($res);
			return $row['Id'];
			}
		else return 0;
		}
	else return 0;
}
function n_cnt($disp){
	//conectar();
	$res=mysql_query("select * from disp where mac='$disp'");
	if($res){
		$row=mysql_fetch_array($res);
		return $row['cnt'];
		}
	else '0';
}
if($act=="teste") echo "teste";

if($act=="cnt"){
	if($type==5){
		mysql_query("update disp set cnt=cnt+1 where Id=$id");
	}else{
		//conectar();
		$cnt=n_cnt($mac)+1;
		mysql_query("update disp set cnt=$cnt where mac='$mac'");
		}
	}
if($act=="init"){
	if($type==5){
		if(($id=mac_id($mac))==0){
			mysql_query("insert into disp(tipo,estado,nome,mac,atu) values(5,1,'gateway novo','$mac',NOW())");
			echo "$$".mysql_insert_id().'&';
		} 
		else{
			mysql_query("update disp set estado=1,atu=NOW() where mac='$mac'");
			echo '$$'.mac_id($mac).'&';
		}
	}
}
	/*
	$qtdvar=$_POST['qtdvar'];
	if($qtdvar){
		$var_tipo=array();
		$var_tempo=array();
		$var_nome=array();
		for($i=0;$i<$qtdvar;$i++){
			$var_tipo[$i]=$_POST['vart'.$i];
			$var_tempo[$i]=$_POST['vartp'.$i];
			$var_nome[$i]=$_POST['varn'.$i];
		}
	}
	
	$res=mysql_query("select * from disp where mac='$mac'");
	if(mysql_num_rows($res)){
		$cnt=n_cnt($mac)+1;
		mysql_query("update disp set cnt=$cnt, rssi='$rssi' where mac='$mac'");
		$res=mysql_query("select * from disp where mac='$mac'");
		$row=mysql_fetch_array($res);
		$rssi=$row['Id'];
		echo "u;".$row['Id'].";";
		}
	else{
		mysql_query("insert into disp(tipo,local,mac,rssi) values($tipo,1,'$mac','$rssi')");
		$disp=mysql_insert_id();
		$str="";
		for($i=0;$i<$qtdvar;$i++){
			$sql="insert into var_conf(disp,nome,ativo,tempo,disp_var,var_tipo) values($disp,'".$var_nome[$i]."',1,".$var_tempo[$i].",$i,".$var_tipo[$i].")";
			//echo $sql;
			mysql_query("insert into var_conf(disp,nome,ativo,tempo,disp_var,var_tipo) values($disp,'".$var_nome[$i]."',1,".$var_tempo[$i].",$i,".$var_tipo[$i].")");
			$var_id[$i]=mysql_insert_id();
			$str.=";".$var_id[$i];
			}
		echo "i;".$disp.$str.";";
		}  */
if($act=="var"){
		$qtd=$_POST['qtd'];
		$var_id=array();
		$var_val=array();
		for($i=0;$i<$qtd;$i++){
			$var_id[$i]=$_POST['vari'.$i];
			$var_val[$i]=$_POST['varv'.$i];
			$sql="insert into var_val(date,var,val) values(NOW(),".$var_id[$i].",'".$var_val[$i]."');";
			mysql_query($sql);
		}
		echo "ok";
		
	}
if($act=="var1"){
	$qtd=$_POST['qtd'];
	$type=$_POST['disptype'];
	if(!($id=mac_id($mac))){
		$sql="insert into disp(tipo,estado,nome,mac,atu) values($type,1,'novo disp','$mac',NOW())";
		mysql_query($sql);
		$id=mysql_insert_id();
		}
	for($i=0;$i<$qtd;$i++){
		$var_id=$_POST['id'.$i];
		$tempo=$_POST['tempo'.$i];
		$val=$_POST['val'.$i];
		$type=$_POST['type'.$i];
		$media=$_POST['media'.$i];
		if(!($id_var=var_id($id,$var_id))){
			$sql="insert into var_conf(disp,ativo,tempo,disp_var,var_tipo,nome,media) values($id,1,$tempo,$var_id,$type,'variavel nova',$media)";
			mysql_query($sql);
			$id_var=mysql_insert_id();
			}
		mysql_query("update disp set atu=NOW(), cnt=cnt+1 where Id=$id");
		$sql="insert into var_val(var,date,val) values($id_var,NOW(),'$val')";
		mysql_query($sql);
		}
	atu($mac);
	}
if($act=="rssi"){
	$rssi=$_POST['rssi'];
	mysql_query("update disp set rssi=-$rssi where mac='$mac'");
	atu($mac);
	
}
if($act=="ativo"){
	$bat=$_POST['bat'];
	mysql_query("update disp set cnt=cnt+1, bat_val='$bat', atu=NOW() , rssi=$rssi where Id=$id");
	$res=mysql_query("select * from var_atu where disp=$id");
	$str="n";
	if($qtd=mysql_num_rows($res)){
		$str="s;".$qtd.";";
		while($row=mysql_fetch_array($res)){
			mysql_query("delete from var_atu where Id=".$row['Id']);
			$sql="select * from var_conf where disp_var=".$row['var'];
			//echo $sql;
			$res1=mysql_query("select * from var_conf where Id=".$row['var']);
			$row1=mysql_fetch_array($res1);
			$str.=$row1['disp_var'].";".$row1['nome'].";".$row1['tempo'].";".$row1['ativo'].";".$row1['Id'].";";
			}
		}
	echo $str;
}
if($act=="est"){
	$out=$_POST['out'];
	$est=$_POST['est'];
	$id=mac_id($mac);
	if($id=mac_id($mac)){
		if($out_id=tem_out($id,$out)){
			$sql="update aci set est=$est where disp=$id and out=$out_id";
			echo $sql;
			mysql_query($sql);
		}
		else
			$sql="insert into aci(disp,out,est) values($id,$out,$est)";
			echo $sql;
			mysql_query($sql);
		}
	else{
		//mysql_query("insert into disp(tipo,");	
		}
}
if($act=="discover"){
	$qtd=$_POST['qtd'];
	$id_gate=mac_id($mac);
	mysql_query("delete from gateway_disp where gateway=$id_gate");
	$qtd1=0;
	for($i=0;$i<$qtd;$i++){
		$mac=$_POST['mac'.$i];
		if(!($id=mac_id($mac))){
			$sql="insert into disp(tipo,estado,nome,mac) values(3,1,'novo xbee','$mac')";
			mysql_query($sql);
			$id=mysql_insert_id();
			}	
		//atualiza dispositivos do gateway
		mysql_query("insert into gateway_disp(disp,mac,gateway) values($id,'$mac',$id_gate)");
		//incremento do contador para verificação de estado
		mysql_query("update disp set cnt=cnt+1 , atu=NOW() where Id=$id");
		}
		//verifica se tem alguma atualização para ser enviada para o dispositivo
		
	mysql_query("update disp set cnt=cnt+1, atu=NOW() where Id=$id_gate");
	echo '$$ok&';
}
?>