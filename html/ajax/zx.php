<?php
include("../inc/conn.php");
$last = isset($_POST['last'])?$_POST['last']:0;
$amount = isset($_POST['amount'])?$_POST['amount']:20;
$b=$_COOKIE['zx_b'];
$s=$_COOKIE['zx_s'];

$sql="select id,title,elite,sendtime,img,link,content,hit,editor from caicaicms_zx where passed=1";

if ($b<>'') {
$sql=$sql." and bigclassid='".$b."' ";
}
if ($s<>'') {
$sql=$sql." and smallclassid='".$s."' ";
}


$sql=$sql." order by elite desc,id desc limit $last,$amount";
$rs = query($sql); 
while($row= fetch_array($rs)){

if ($row["link"]<>""){
$link=$row["link"];
}else{
$link=getpageurl("zx",$row["id"]);	
}

if ($row["elite"]>0) {
$listimg="[置顶]&nbsp;";
}elseif (time()-strtotime($row["sendtime"])<3600*24){
$listimg="[最新]&nbsp;" ;
}elseif ($row["hit"]>=1000) {
$listimg="[热门]&nbsp;";					
}else{
$listimg="";
}

 $sayList[] = array(
        'title' => "<a href='".$link."'>".cutstr($row['title'],22)."</a>",
       'listimg' => $listimg,
        'sendtime' => $row['sendtime']
    );
}
echo json_encode($sayList);
?>