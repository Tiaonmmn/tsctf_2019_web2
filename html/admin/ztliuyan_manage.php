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
</head>
<body>
<?php
checkadminisdo("guestbook");
$action=isset($_REQUEST["action"])?$_REQUEST["action"]:'';
if (!isset($page)){$page=1;}
checkid($page);
$shenhe=isset($_REQUEST["shenhe"])?$_REQUEST["shenhe"]:'';
$keyword=isset($_REQUEST["keyword"])?$_REQUEST["keyword"]:'';

if ($action=="pass"){
if(!empty($_POST['id'])){
    for($i=0; $i<count($_POST['id']);$i++){
    $id=$_POST['id'][$i];
	checkid($id);
	$sql="select passed from caicaicms_guestbook where id ='$id'";
	$rs = query($sql); 
	$row = fetch_array($rs);
		if ($row['passed']=='0'){
		query("update caicaicms_guestbook set passed=1 where id ='$id'");
		}else{
		query("update caicaicms_guestbook set passed=0 where id ='$id'");
		}
	}
}else{
echo "<script>alert('操作失败！至少要选中一条信息。');history.back()</script>";
}
echo "<script>location.href='?keyword=".$keyword."&page=".$page."'</script>";	
}
?>
<div class="admintitle">展厅留言本</div>
<form name="form1" method="post" action="?">
<div class="border2"> 接收人： <input name="keyword" type="text" id="keyword" value="<?php echo $keyword?>"> <input type="submit" name="Submit" value="查找"></div>
  </form>
   <?php
$page_size=pagesize_ht;  //每页多少条数据
$offset=($page-1)*$page_size;
$sql="select count(*) as total from caicaicms_guestbook where id<>0 ";
$sql2='';
if ($shenhe=="no") {  		
$sql2=$sql2." and passed=0 ";
}
if ($keyword<>"") {
	$sql2=$sql2. " and saver like '%".$keyword."%'";
}
$rs =query($sql.$sql2); 
$row = fetch_array($rs);
$totlenum = $row['total']; 
$totlepage=ceil($totlenum/$page_size);

$sql="select * from caicaicms_guestbook where id<>0 ";
$sql=$sql.$sql2;
$sql=$sql . " order by id desc limit $offset,$page_size";
$rs = query($sql); 
if(!$totlenum){
echo "暂无信息";
}else{
?>
<form name="myform" method="post" action="" onSubmit="return anyCheck(this.form)">
  <table width="100%" border="0" cellpadding="5" cellspacing="1">
    <tr  class="trtitle"> 
      <td width="5%" align="center"> <label for="chkAll" style="cursor: pointer;">全选</label></td>
      <td width="10%">内容</td>
      <td width="10%">姓名</td>
      <td width="10%">电话</td>
      <td width="10%">E-mail</td>
      <td width="10%">收件人</td>
      <td width="10%">留言时间</td>
      <td width="5%" align="center">信息状态</td>
    </tr>
<?php
while($row = fetch_array($rs)){
?>
    <tr class="trcontent"> 
      <td align="center"> 
        <input name="id[]" type="checkbox" id="id" value="<?php echo $row["id"]?>">      </td>
      <td title="<?php echo $row["content"]?>"><?php echo cutstr($row["content"],30)?></td>
      <td><?php echo $row["linkmen"]?></td>
      <td><?php echo $row["phone"]?></td>
      <td><?php echo $row["email"]?></td>
      <td><a href="usermanage.php?keyword=<?php echo $row["saver"]?> " target="_blank"><?php echo $row["saver"]?></a></td>
      <td><?php echo $row["sendtime"]?></td>
      <td align="center"> 
	  <?php if ($row["looked"]==1) { echo"已查看";} else{ echo"<font color=red>未查看</font>";}?>
        <br> 
		 <?php if ($row["passed"]==1) { echo"已审核";} else{ echo"<font color=red>未审核</font>";}?>      </td>
    </tr>
<?php
}
?>
  </table>

      <div class="border"><input name="chkAll" type="checkbox" id="chkAll" onClick="CheckAll(this.form)" value="checkbox" />
          <label for="chkAll" style="cursor: pointer;">全选</label>
          <input  type="submit"  onClick="myform.action='?action=pass';myform.target='_self'" value="【取消/审核】选中的信息">
          <input  type="submit" onClick="myform.action='del.php';myform.target='_self';return ConfirmDel()" value="删除选中的信息">
          <input  type="submit" onClick="myform.action='ztliuyan_sendmail.php';myform.target='_blank' "  value="给接收者发邮件提醒">
          <input name="pagename" type="hidden"  value="ztliuyan_manage.php?shenhe=<?php echo $shenhe?>&page=<?php echo $page ?>">
          <input name="tablename" type="hidden"  value="caicaicms_guestbook"></div>

</form>
<div class="border center"><?php echo showpage_admin()?></div>
<?php
}
?>
</body>
</html>