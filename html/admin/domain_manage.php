<?php
include("admin.php");
include("../inc/fy.php");
checkadminisdo("user");
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../js/gg.js"></script>
</head>
<body>
<?php
$action=isset($_REQUEST["action"])?$_REQUEST["action"]:'';
if (!isset($page)){$page=1;}
checkid($page);
$shenhe=isset($_REQUEST["shenhe"])?$_REQUEST["shenhe"]:'';
$keyword=isset($_REQUEST["keyword"])?$_REQUEST["keyword"]:'';
$kind=isset($_REQUEST["kind"])?$_REQUEST["kind"]:'title';

if ($action=="pass"){
if(!empty($_POST['id'])){
    for($i=0; $i<count($_POST['id']);$i++){
    $id=$_POST['id'][$i];
	checkid($id);
	$sql="select passed from caicaicms_userdomain where id ='$id'";
	$rs = query($sql); 
	$row = fetch_array($rs);
		if ($row['passed']=='0'){
		query("update caicaicms_userdomain set passed=1 where id ='$id'");
		}else{
		query("update caicaicms_userdomain set passed=0 where id ='$id'");
		}
	}
}else{
echo "<script>alert('操作失败！至少要选中一条信息。');history.back()</script>";
}
echo "<script>location.href='?keyword=".$keyword."&page=".$page."'</script>";	
}
?>

<div class="admintitle">绑定域名</div>
<?php
$page_size=pagesize_ht;  //每页多少条数据
$offset=($page-1)*$page_size;
$sql="select count(*) as total from caicaicms_userdomain where id<>0 ";
$sql2='';
if ($shenhe=="no") {  		
$sql2=$sql2." and passed=0 ";
}

if ($keyword<>"") {
	switch ($kind){
	case "editor";
	$sql2=$sql2. " and username like '%".$keyword."%' ";
	break;
	case "title";
	$sql2=$sql2. " and domain like '%".$keyword."%'";
	break;
	default:
	$sql2=$sql2. " and domain like '%".$keyword."%'";
	}
}
$rs =query($sql.$sql2); 
$row = fetch_array($rs);
$totlenum = $row['total']; 
$totlepage=ceil($totlenum/$page_size);

$sql="select * from caicaicms_userdomain where id<>0 ";
$sql=$sql.$sql2;
$sql=$sql . " order by id desc limit $offset,$page_size";
$rs = query($sql); 
if(!$totlenum){
echo "暂无信息";
}else{

?>
<div class="border2">
<form name="form1" method="post" action="?">
			<label><input type="radio" name="kind" value="editor" <?php if ($kind=="editor") { echo "checked";}?>>
              按审请人</label>
               <label><input type="radio" name="kind" value="title" <?php if ($kind=="title") { echo "checked";}?>>
             按域名 </label>
              <input name="keyword" type="text" id="keyword2" value="<?php echo $keyword?>"> 
              <input type="submit" name="Submit" value="查找"> 
			  </form>
</div>
<form name="myform" method="post" action="" onSubmit="return anyCheck(this.form)">
  <table width="100%" border="0" cellpadding="3" cellspacing="1">
  <tr class="trtitle"> 
 <td width="5%" align="center" ><label for="chkAll" style="cursor: pointer;">全选</label></td>
 <td width="20%" align="center" >域名</td>
 <td width="20%" align="center" >状态</td>
 <td width="5%" height="20" align="center">操作</td>
  </tr>
  <?php
while($row = fetch_array($rs)){
?>
 <tr class="trcontent">  
    <td  align="center" ><input name="id[]" type="checkbox" id="id" value="<?php echo $row["id"]?>"></td>
    <td  align="center" ><?php echo $row["domain"]?></td>
	<td  align="center" ><?php 
	 if ($row["passed"]==1 ){ echo  '已生效';}else{echo '审请中...';}
	 ?></td>
    <td align="center"> 
	<a href="domain.php?action=modify&id=<?php echo $row["id"]?>">修改</a></td>
  </tr>
<?php
}
?>
</table>
  <div class="border"> <input name="chkAll" type="checkbox" id="chkAll" onClick="CheckAll(this.form)" value="checkbox">
        <label for="chkAll" style="cursor: pointer;">全选</label> 
        <input type="submit" onClick="myform.action='?action=pass'" value="【取消/审核】选中的信息">
        <input name="submit42" type="submit" onClick="myform.action='del.php';myform.target='_self';return ConfirmDel()" value="删除选中的信息"> 
      <input name="pagename" type="hidden"  value="domain_manage.php?shenhe=<?php echo $shenhe?>&page=<?php echo $page ?>">
      <input name="tablename" type="hidden"  value="caicaicms_userdomain">
  </div>
</form>
<div class="border center"><?php echo showpage_admin()?></div>
<?php
}
?>
</body>
</html>