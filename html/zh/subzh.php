<?php
function showsj($column,$sj)
{
$str="<table width='100%' border='0' cellpadding='5' cellspacing='1' class='bgcolor3'>";
$str=$str."<tr>";
for($i=1;$i<=12;$i++){
if ($sj==$i  || date('m')==$i){
$str=$str."<td align='center' class='bgcolor3' >";
}else{
$str=$str."<td align='center' class='bgcolor1' >";
}
$str=$str."<a href='search.php?sj=".$i."'>".addzero($i,2)."月</a>";
$str=$str."</td>";
if ($i % $column==0) { 
$str=$str."</tr>";
}
}
$str=$str."</table>";
return $str;
}

function bigclass($b){
$str="";
$n=1;
$sql="select classname,classid from caicaicms_zhclass  order by xuhao";
$rs=query($sql);
$row=num_rows($rs);
if (!$row){
$str="暂无分类";
}else{

while ($row=fetch_array($rs)){
$str=$str."<li>";
	if($row['classid']==$b){
	$str=$str."<a href='".getpageurl2("zh",$row["classid"],"")."' class='current'>".$row["classname"]."</a>";
	}else{
	$str=$str."<a href='".getpageurl2("zh",$row["classid"],"")."'>".$row["classname"]."</a>";
	}
	$str=$str."</li>";
$n=$n+1;		
}
}
return $str;
}		
?>