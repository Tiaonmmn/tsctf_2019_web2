<?php
include("admin.php");
include("../inc/fy.php");
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<link href="style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../js/gg.js"></script>
<?php
checkadminisdo("baojia");

$action=isset($_REQUEST["action"])?$_REQUEST["action"]:'';
if (!isset($page)){$page=1;}
checkid($page);

if (!isset($b)){$b=0;}
checkid($b,1);

$shenhe=isset($_REQUEST["shenhe"])?$_REQUEST["shenhe"]:'';
$keyword=isset($_REQUEST["keyword"])?$_REQUEST["keyword"]:'';
$kind=isset($_REQUEST["kind"])?$_REQUEST["kind"]:'';
$showwhat=isset($_REQUEST["showwhat"])?$_REQUEST["showwhat"]:'';

if ($action=="pass"){
if(!empty($_POST['id'])){
    for($i=0; $i<count($_POST['id']);$i++){
	$id=$_POST['id'][$i];
	checkid($id);
	$sql="select passed from caicaicms_baojia where id ='$id'";
	$rs = query($sql); 
	$row = fetch_array($rs);
	if ($row['passed']=='0'){
	query("update caicaicms_baojia set passed=1 where id ='$id'");
    }else{
	query("update caicaicms_baojia set passed=0 where id ='$id'");
	}
	
	}	
}else{
echo "<script lanage='javascript'>alert('操作失败！至少要选中一条信息。');history.back()</script>";
}
echo "<script>location.href='?keyword=".$keyword."&page=".$page."'</script>";
}
?>
</head>
<body>
<div class="admintitle">报价管理</div>
<div class="border">
<form name="form1" method="post" action="?">
	   <label><input type="radio" name="kind" value="cpmc" <?php if ($kind=="cpmc") { echo "checked";}?>>
        按产品名称 </label>
        <label><input name="kind" type="radio" value="tel" <?php if ($kind=="tel") { echo "checked";}?> >
        按电话 </label>
        <label><input type="radio" name="kind" value="editor" <?php if ($kind=="editor") { echo "checked";}?>>
        按发布人 </label>
        <input name="keyword" type="text" id="keyword2" value="<?php echo $keyword?>"> 
        <input type="submit" name="Submit" value="查找">
      </form>	
</div>
  <div class="border2">
  <?php	
$sql="select classid,classname from caicaicms_zsclass where parentid=0 order by xuhao";
$rs = query($sql); 
$row = num_rows($rs);
if (!$row){
echo '暂无分类';
}else{
while($row = fetch_array($rs)){
echo "<a href=?b=".$row['classid'].">";  
	if ($row["classid"]==$b) {
	echo "<b>".$row["classname"]."</b>";
	}else{
	echo $row["classname"];
	}
	echo "</a>";  
}
} 
?>
</div>
 
<?php
$page_size=pagesize_ht;  //每页多少条数据
$offset=($page-1)*$page_size;
$sql="select count(*) as total from caicaicms_baojia where id<>0 ";
$sql2='';
if ($shenhe=="no") {  		
$sql2=$sql2." and passed=0 ";
}
if ($b<>0) {
$sql2=$sql2." and classid='".$b."'";
}

if ($keyword<>"") {
	switch ($kind){
	case "editor";
	$sql2=$sql2. " and editor like '%".$keyword."%' ";
	break;
	case "cpmc";
	$sql2=$sql2. " and cp like '%".$keyword."%'";
	break;
	case "tel";
	$sql2=$sql2. " and tel like '%".$keyword."%'";
	break;		
	default:
	$sql2=$sql2. " and cp like '%".$keyword."%'";
	}
}

$rs =query($sql.$sql2); 
$row = fetch_array($rs);
$totlenum = $row['total'];
$totlepage=ceil($totlenum/$page_size);

$sql="select * from caicaicms_baojia where id<>0 ";
$sql=$sql.$sql2;
$sql=$sql . " order by id desc limit $offset,$page_size";
//$sql=$sql." and id>=(select id from caicaicms_baojia order by id limit $offset,1) order by id desc limit $page_size";
$rs = query($sql); 
if(!$totlenum){
echo "暂无信息";
}else{
?>
<form name="myform" id="myform" method="post" action="" onSubmit="return anyCheck(this.form)">
  <table width="100%" border="0" cellpadding="5" cellspacing="1">
    <tr class="trtitle"> 
      <td width="5%" align="center"> <label for="chkAll" style="cursor: pointer;">全选</label></td>
      <td width="10%">类别</td>
      <td width="10%">产品</td>
      <td width="10%">价格</td>
      <td width="10%">区域</td>
      <td width="10%">联系人</td>
      <td width="10%">电话</td>
      <td width="10%">发布人</td>
      <td width="10%">发布时间</td>
      <td width="10%" align="center">信息状态</td>
      <td width="5%" align="center">操作</td>
    </tr>
    <?php
while($row = fetch_array($rs)){
?>
    <tr class="trcontent"> 
      <td align="center"> <input name="id[]" type="checkbox"  value="<?php echo $row["id"]?>">     </td>
      <td><a href="?b=<?php echo $row["classid"]?>" >
	  <?php
			$rsn=query("select classname from caicaicms_zsclass where classid='".$row['classid']."'");
			if ($rsn){
			$r=fetch_array($rsn);
			echo $r["classname"];
			}
			 ?>
      </a></td>
      <td><a href="<?php echo getpageurl("baojia",$row["id"])?>" target="_blank"><?php echo $row["cp"] ?></a></td>
      <td><?php echo $row["price"] ?></td>
      <td><?php echo $row["province"].$row["city"]?></td>
      <td><?php echo $row["truename"]?></td>
      <td><?php echo $row["tel"]?></td>
      <td><?php if ($row["editor"]<>''){ echo  $row["editor"];}else{ echo '未登录用户';}?></td>
      <td><?php echo $row["sendtime"]?></td>
      <td align="center"> 
        <?php if ($row["passed"]==1) { echo"已审核";} else{ echo"<font color=red>未审核</font>";}?>         </td>
      <td align="center" class="docolor"> <a href="baojia_modify.php?id=<?php echo $row["id"]?>&page=<?php echo $page ?>">修改</a>      </td>
    </tr>
    <?php
}
?>
  </table> 
  <div class="border"> 
        <input name="chkAll" type="checkbox" id="chkAll" onClick="CheckAll(this.form)" value="checkbox">
         <label for="chkAll" style="cursor: pointer;">全选</label>
         <input name="submit5" type="submit"  onClick="myform.action='?action=pass';myform.target='_self'" value="【取消/审核】选中的信息"> 
        <input name="submit3" type="submit" onClick="myform.action='del.php';myform.target='_self';return ConfirmDel()" value="删除选中的信息"> 
      <input name="pagename" type="hidden"  value="baojia_manage.php?b=<?php echo $b?>&shenhe=<?php echo $shenhe?>&page=<?php echo $page ?>">
      <input name="tablename" type="hidden"  value="caicaicms_baojia">
  </div>
</form>
<div class="border center"><?php echo showpage_admin()?></div>
<?php
}
?>
</body>
</html>