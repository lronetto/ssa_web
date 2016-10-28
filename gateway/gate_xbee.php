
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
//inicia o gateway
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
//recebe dados das variaveis e retorna se tiver atualização do dispositivo
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
//recebe o rssi do dispositivo
if($act=="rssi"){
	$rssi=$_POST['rssi'];
	mysql_query("update disp set rssi=-$rssi where mac='$mac'");
	atu($mac);
	
}
//recebe o estado da entrada digital do dispositivo
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
//atualiza a tabela de dispositivos em cada gateway
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