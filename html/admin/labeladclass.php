<?php
include("admin.php");
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="style.css" rel="stylesheet" type="text/css">
<title></title>
<script language = "JavaScript">
function CheckForm(){
var re=/^[0-9a-zA-Z_]{1,20}$/; //只输入数字和字母的正则
if (document.myform.title.value==""){
    alert("标签名称不能为空！");
	document.myform.title.focus();
	return false;
  }
if(document.myform.title.value.search(re)==-1)  {
    alert("标签名称只能用字母，数字，_ 。且长度小于20个字符！");
	document.myform.title.focus();
	return false;
  }       
}  
</script>
<?php
checkadminisdo("label");
$action = isset($_REQUEST['action'])?$_REQUEST['action']:"";
$classname = isset($_REQUEST['classname'])?$_REQUEST['classname']:"";
if ($action=="add") {
checkadminisdo("label_add");
$title=nostr(trim($_POST["title"]));
checkstr($numbers,'num','调用记录数');
checkstr($column,'num','列数');
$start=stripfxg($_POST["start"],true);
$mids=stripfxg($_POST["mids"],true);
$ends=stripfxg($_POST["ends"],true);

$f="../template/".siteskin."/label/adclass/".$title.".txt";
$fp=fopen($f,"w+");//fopen()的其它开关请参看相关函数
$str=$title . "|||".$bigclassid . "|||"  . $numbers . "|||" . $column . "|||" . $start . "|||" . $mids . "|||" . $ends;
fputs($fp,$str);
fclose($fp);
$title==$title_old ?$msg='修改成功':$msg='添加成功';
echo "<script>alert('".$msg."');location.href='?labelname=".$title.".txt'</script>";
}

if ($action=="del") {
checkadminisdo("label_del");
$f="../template/".siteskin."/label/adclass/".nostr(trim($_POST["title"])).".txt";
	if (file_exists($f)){
	unlink($f);
	}else{
	echo "<script>alert('请选择要删除的标签');history.back()</script>";
	}	
}
?>
</head>
<body>
<div class="admintitle">广告类别标签添加</div>
<form action="" method="post" name="myform" id="myform" onSubmit="return CheckForm();">      
  <table width="100%" border="0" cellpadding="5" cellspacing="0">
    <tr> 
      <td width="150" align="right" class="border" >现有标签</td>
      <td class="border" > 
	  <div class="boxlink">
        <?php
$labelname="";
if (isset($_GET['labelname'])){
$labelname=$_GET['labelname'];
if (substr($labelname,-3)!='txt'){
showmsg('只能是txt这种格式');//防止直接输入php 文件地址显示PHP代码
}
}

if (file_exists("../template/".siteskin."/label/adclass")==false){
echo '文件不存在';
}else{	
	$dir = opendir("../template/".siteskin."/label/adclass");
	while(($file = readdir($dir))!=false){
	if ($file!="." && $file!="..") { //不读取. ..
    //$f = explode('.', $file);//用$f[0]可只取文件名不取后缀。
		if ($labelname==$file){
  		echo "<li><a href='?labelname=".$file."' style='color:#000000;background-color:#FFFFFF'>".$file."</a></li>";
		}else{
		echo "<li><a href='?labelname=".$file."'>".$file."</a></li>";
		}
	} 
	}
closedir($dir);
}
$title='';$bigclassid='';$numbers='';$column='';$start='';$mids='';$ends='';	
//读取现有标签中的内容
if ($labelname!=''){
$fp="../template/".siteskin."/label/adclass/".$labelname;
$f=fopen($fp,"r");
$fcontent=fread($f,filesize($fp));
fclose($f);
$fcontent=removeBOM($fcontent);//去除BOM信息，使修改时不用再重写标签名
$f=explode("|||",$fcontent) ;
$title=$f[0];$bigclassid=$f[1];$numbers=$f[2];$column=$f[3];$start=$f[4];$mids=$f[5];$ends=$f[6];	
} 

	   ?>
	   </div>      </td>
    </tr>
    <tr> 
      <td align="right" class="border" >标签名称</td>
      <td class="border" >
<input name="title" type="text" id="title" value="<?php echo $title?>" size="50" maxlength="255">
<input name="title_old" type="hidden" id="title_old" value="<?php echo $title?>" size="50" maxlength="255">      </td>
    </tr>
    <tr> 
      <td align="right" class="border" >调用内容</td>
      <td class="border" ><select name="bigclassid">
          <option value="empty" selected>不指定大类</option>
          <?php
       $sql = "select * from caicaicms_adclass where parentid='A'order by xuhao asc";
       $rs=query($sql);
		   while($r=fetch_array($rs)){
			?>
          <option value="<?php echo $r["classname"]?>" <?php if ($r["classname"]==$bigclassid) { echo "selected";}?>> <?php echo trim($r["classname"])?></option>
          <?php   
    	     }	
		 ?>
        </select></td>
    </tr>
    <tr>
      <td align="right" class="border" >调用记录条数</td>
      <td class="border" ><input name="numbers" type="text"  value="<?php echo $numbers?>" size="10" maxlength="255"></td>
    </tr>
    <tr> 
      <td align="right" class="border" >列数</td>
      <td class="border" > <input name="column" type="text" id="column" value="<?php echo $column?>" size="20" maxlength="255">
        （分几列显示）</td>
    </tr>
    <tr> 
      <td align="right" class="border" >解释（开始）</td>
      <td class="border" ><textarea name="start" cols="100" rows="6" id="start" style="width:100%"><?php echo $start?></textarea></td>
    </tr>
    <tr> 
      <td align="right" class="border" >解释（循环）</td>
      <td class="border" ><textarea name="mids" cols="100" rows="6" id="mids" style="width:100%"><?php echo $mids?></textarea>      </td>
    </tr>
    <tr> 
      <td align="right" class="border" >解释（结束）</td>
      <td class="border" ><textarea name="ends" cols="100" rows="6" id="ends" style="width:100%"><?php echo $ends?></textarea></td>
    </tr>
    <tr> 
      <td align="right" class="border" >&nbsp;</td>
      <td class="border" > <input type="submit" name="Submit" value="添加/修改" onClick="myform.action='?action=add'"> 
        <input type="submit" name="Submit2" value="删除选中的标签" onClick="myform.action='?action=del'">      </td>
    </tr>
  </table>
</form>
</body>
</html>