<?php
include("../inc/conn.php");
include("../inc/top.php");
include("../inc/bottom.php");
include("../inc/fy.php");
include("subwangkan.php");
include("../label.php");
$fp="../template/".$siteskin."/wangkan_search.htm";
$f = fopen($fp,'r');
$strout = fread($f,filesize($fp));
fclose($f);
if (isset($_GET["page_size"])){
$page_size=$_GET["page_size"];
checkid($page_size);
setcookie("page_size_wangkan",$page_size,time()+3600*24*360);
}else{
$page_size=isset($_COOKIE['page_size_wangkan'])?$_COOKIE['page_size_wangkan']:pagesize_qt;
}

$keyword=isset($_GET['keyword'])?$_GET['keyword']:'';
$b=isset($_GET['b'])?$_GET['b']:0;
checkid($b,1);

$bigclassname='';
if ($b<>0){
$sql="select classname from caicaicms_wangkanclass where classid='".$b."' ";
$rs=query($sql);
$row=fetch_array($rs);
$bigclassname=$row["classname"];
}

$pagetitle=sitename;
$pagekeyword=sitename;
$pagedescription=sitename;

function formbigclass($b){
$sql = "select classid,classname from caicaicms_wangkanclass  ";
$rs=query($sql);
$str="<option value='0'>不限类别</option>";
	while($row=fetch_array($rs)){
		if ($row["bigclassid"]==$b){
		$str=$str."<option value='".$row["classid"]."' selected>".$row["classname"]."</option>";
		}else{
		$str=$str."<option value='".$row["classid"]."'>".$row["classname"]."</option>";
		}
	}
return $str;
}

$sql="select count(*) as total from caicaicms_wangkan where passed<>0 ";
$sql2='';
if ($keyword<>"") {
$sql2=$sql2." and title like '%".$keyword."%' ";
}	

if ($b<>0){
$sql2=$sql2." and bigclassid ='".$b."' ";
}
if( isset($_GET["page"]) && $_GET["page"]!="") {$page=$_GET['page'];}else{$page=1;}
checkid($page);
$list=strbetween($strout,"{loop}","{/loop}");

$rs =query($sql.$sql2); 
$row = fetch_array($rs);
$totlenum = $row['total'];
$offset=($page-1)*$page_size;//$page_size在上面被设为COOKIESS
$totlepage=ceil($totlenum/$page_size);

$sql="select id,title,img,sendtime,elite from caicaicms_wangkan where passed=1 ";
$sql=$sql.$sql2;
$sql=$sql." order by id desc limit $offset,$page_size";
$rs = query($sql); 

if(!$totlenum){
	$strout=str_replace("{loop}".$list."{/loop}","暂无信息",$strout) ;
	$strout=str_replace("{#fenyei}","",$strout) ;
}else{
$i=0;
$list2="";
while($row= fetch_array($rs)){
$list2 = $list2. str_replace("{#link}" ,getpageurl("wangkan",$row["id"]),$list) ;
$list2 =str_replace("{#title}",$row["title"],$list2) ;
$list2 =str_replace("{#imgbig}",$row["img"],$list2) ;
$list2 =str_replace("{#img}",getsmallimg($row["img"]),$list2) ;
$list2 =str_replace("{#sendtime}" ,date("Y-m-d",strtotime($row["sendtime"])),$list2) ;
$i=$i+1;
}
$strout=str_replace("{loop}".$list."{/loop}",$list2,$strout) ;
$strout=str_replace("{#fenyei}",showpage1("wangkan"),$strout) ;
}

$strout=str_replace("{#siteskin}",$siteskin,$strout) ;
$strout=str_replace("{#sitename}",sitename,$strout) ;
$strout=str_replace("{#pagetitle}",$pagetitle,$strout) ;
$strout=str_replace("{#pagekeywords}",$pagekeyword,$strout);
$strout=str_replace("{#pagedescription}",$pagedescription,$strout);
$strout=str_replace("{#keyword}",$keyword,$strout);
$strout=str_replace("{#station}",getstation($b,$bigclassname,0,"","","","wangkan"),$strout) ;
$strout=str_replace("{#formbigclass}",formbigclass($b),$strout);
$strout=str_replace("{#sitebottom}",sitebottom(),$strout);
$strout=str_replace("{#sitetop}",sitetop(),$strout);
$strout=showlabel($strout);
echo  $strout;	
?>