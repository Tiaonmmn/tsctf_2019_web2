<?php
include("../inc/conn.php");
include("../inc/fy.php");
include("../inc/top.php");
include("../inc/bottom.php");
include("subpp.php");
include("../label.php");

$fp="../template/".$siteskin."/pp.htm";
$f = fopen($fp,'r');
$strout = fread($f,filesize($fp));
fclose($f);

if (isset($_GET["page_size"])){
$page_size=$_GET["page_size"];
checkid($page_size);
setcookie("page_size_pp",$page_size,time()+3600*24*360);
}else{
$page_size=isset($_COOKIE["page_size_pp"])?$_COOKIE["page_size_pp"]:pagesize_qt;
}

$b = isset($_GET['b'])?$_GET['b']:"";
$s = isset($_GET['s'])?$_GET['s']:"";

$bigclassname='';
if ($b<>""){
$sql="select classname,classid from caicaicms_zsclass where classzm='".$b."'";
$rs=query($sql);
$row=fetch_array($rs);
$bigclassname=$row["classname"];
$bigclassid=$row["classid"];
}

$smallclassname='';
if ($s<>"") {
$sql="select classname,classid from caicaicms_zsclass where classzm='".$s."'";
$rs=query($sql);
$row=fetch_array($rs);
$smallclassname=$row["classname"];
$smallclassid=$row["classid"];
}

$pagetitle=pplisttitle;
$pagekeyword=pplistkeyword;
$pagedescription=pplistdescription;
$station=getstation($b,$bigclassname,$s,$smallclassname,"","","pp");

$page=isset($page)?$page:1;
checkid($page);

if ($b=="") {
$ppclass=bigclass($b);
}else{
$ppclass= showppsmallclass($b,$s,8,'');
}

$list=strbetween($strout,"{loop}","{/loop}");

$sql="select count(*) as total from caicaicms_pp where passed<>0 ";
$sql2='';
if ($b<>""){
$sql2=$sql2. "and bigclassid='".$bigclassid."' ";
}
if ($s<>"") {
$sql2=$sql2." and smallclassid ='".$smallclassid."'  ";
}
$rs =query($sql.$sql2); 
$row = fetch_array($rs);
$totlenum = $row['total'];
$offset=($page-1)*$page_size;//$page_size在上面被设为COOKIESS 
$totlepage=ceil($totlenum/$page_size);

$sql="select * from caicaicms_pp where passed=1 ";
$sql=$sql.$sql2;
$sql=$sql." order by id desc limit $offset,$page_size";
$rs = query($sql); 
if(!$totlenum){
$strout=str_replace("{#fenyei}","",$strout) ;
$strout=str_replace("{loop}".$list."{/loop}","暂无信息",$strout) ;
}else{
$list2='';
$i=0;
$title_num=strbetween($list,"{#title:","}");
$content_num=strbetween($list,"{#content:","}");
while($row= fetch_array($rs)){
$list2 = $list2. str_replace("{#img}",getsmallimg($row['img']),$list) ;
$list2 =str_replace("{#imgbig}",$row['img'],$list2) ;
$list2 =str_replace("{#title:".$title_num."}",cutstr($row["ppname"],$title_num),$list2) ;
$list2 =str_replace("{#title}",$row["ppname"],$list2) ;
$list2 =str_replace("{#content:".$content_num."}",cutstr($row["sm"],$content_num),$list2) ;
$list2 =str_replace("{#content}",$row["sm"],$list2) ;
$list2 =str_replace("{#url}",getpageurl("pp",$row['id']),$list2) ;
$list2 =str_replace("{#comane}",$row["comane"],$list2) ;
$list2 =str_replace("{#companyurl}",getpageurlzt($row['editor'],$row['userid']),$list2) ;
$list2 =str_replace("{#sendtime}",$row["sendtime"],$list2) ;
$i=$i+1;
}
$strout=str_replace("{loop}".$list."{/loop}",$list2,$strout) ;
$strout=str_replace("{#fenyei}",showpage2("pp"),$strout) ;
}
$strout=str_replace("{#siteskin}",$siteskin,$strout) ;
$strout=str_replace("{#sitename}",sitename,$strout) ;
$strout=str_replace("{#station}",$station,$strout) ;
$strout=str_replace("{#ppclass}",$ppclass,$strout) ;
$strout=str_replace("{#pagetitle}",$pagetitle,$strout);
$strout=str_replace("{#pagekeywords}",$pagekeyword,$strout);
$strout=str_replace("{#pagedescription}",$pagedescription,$strout);
$strout=str_replace("{#sitebottom}",sitebottom(),$strout);
$strout=str_replace("{#sitetop}",sitetop(),$strout);
$strout=showlabel($strout);
echo  $strout;
?>