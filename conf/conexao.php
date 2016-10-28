<?php
//mb_internal_encoding("UTF-8"); 
//mb_http_output( "iso-8859-1" );  
//ob_start("mb_output_handler");   

function conectar(){
$host="localhost";
$user="lronetto1";
$senha="********"; 
$conexao=mysql_connect($host,$user,$senha);
mysql_select_db("lronetto_ssa",$conexao);
return $conexao;
}
function db_update($tab,$id,$item,$val){
	$con=conectar("medicao");
	$sql="UPDATE ".$tab." SET ".$item."='".$val."' where id=".$id;
	mysql_query($sql,$con);
	}
function db_dell($tab,$id){
	$con=conectar("medicao");
	$sql="delete from ".$tab." where Id=".$id;
	mysql_query($sql,$con);
	return $sql;

	}
function db_query($sql){
	$con=conectar("medicao");
	$res=mysql_query($sql,$con);
	return $res;
	}
function item_tot($obra,$item,$med){
	if($med==0){
		$sql="select sum(i.qtd*i.var1*i.var2*i.var3) as tot, i.medicao, m.Id
				from item as i
				inner join medicao as m on i.medicao=m.Id
				where i.item=$item and m.Obra=$obra";
		}
	else{	
		$sql="select sum(i.qtd*i.var1*i.var2*i.var3) as tot, i.medicao, m.Id
				from item as i
				inner join medicao as m on i.medicao=m.Id
				where i.item=$item and m.Obra=$obra and i.medicao=$med";
		}
	$con=conectar("medicao");
	$res=mysql_query($sql,$con);
	$row=mysql_fetch_array($res); 
	return $row['tot'];
	}
function val_tot($obra,$item){
	$sql="select sum(Qtd) as qtd from planilha where Obra=$obra and item='$item' group by Item";
	$con=conectar("medicao");
	$res=mysql_query($sql,$con);
	$row=mysql_fetch_array($res); 
	return $row['qtd'];
	}
function saldo($obra,$item){
	$sql="select sum(i.qtd*i.var1*i.var2*i.var3) as medido, p.Item as it
	from item as i
	inner join medicao  as m on i.medicao=m.Id
	inner join planilha as p on (select Item from planilha where Id=i.item)=p.Item
	where m.obra=$obra and p.Id=$item group by i.item";
	$con1=conectar("medicao");
	$res=mysql_query($sql,$con1);
	$row=mysql_fetch_array($res); 
	return (val_tot($obra,$row['it'])-$row['medido']);
	}
function pega_dado_id($dado,$tab,$id){
	$con2=conectar("medicao");
	$res=mysql_query("select ".$dado." from ".$tab." where Id=".$id,$con2);
	$row=mysql_fetch_array($res); 
	return $row[$dado];
	} 
function ultimo_id($tab){
	$res=db_query("select max(id) as max from ".$tab."");
	$row=mysql_fetch_array($res); 
	return $row['max'];
	}
function get_id_img($id){
	$res=db_query("select foto from componentes where id=".$id);
	$row=mysql_fetch_array($res);
	$aux=explode("/",$row['foto']);
	return $aux[2];
	}
function id_img(){
	$id=rand();
	while(file_exists('/var/www/sgc/img/comp/'.$id)){
		$id=rand();
		}
	return $id;
	}
function pega_id($campo,$dado,$tab){
	$sql="select * from ".$tab." where ".$campo."='".$dado."'";
	$res=db_query($sql);
	$row=mysql_fetch_array($res);
	return $row['id'];
	}
function existe_dado($campo,$dado,$tab){
	$sql="select * from ".$tab." where ".$campo."='".$dado."'";
	$res=db_query($sql);
	echo mysql_error();
	$flag=0;
	while($row=mysql_fetch_array($res)) $flag++;
	return $flag;
	}
function dropdown($intIdField, $strNameField, $strTableName, $strOrderField, $strNameOrdinal, $strMethod="asc") {

   echo "<select name=\"$strNameOrdinal\" id=\"$strNameOrdinal\">\n";
   echo "<option value=\"NULL\">Select Value</option>\n";

   $strQuery = "select $intIdField, $strNameField
               from $strTableName
               order by $strOrderField $strMethod";
   $con=conectar("sgc");
   $rsrcResult = mysql_query($strQuery,$con);

   while($arrayRow = mysql_fetch_assoc($rsrcResult)) {
      $strA = $arrayRow["$intIdField"];
      $strB = $arrayRow["$strNameField"];
      echo "<option value=\"$strA\">$strB</option>\n";
   }

   echo "</select>";
}
function num_equip($num){
	$vet=split(",",$num);
	$out="";
	for($i=0;i<count($vet);$i++){
		$out.=pega_dado_id("nome","equipamento",$vet[$i])."<br>";
		}
	return $out;
	}	
?>

