<?php
include("../inc/conn.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>发布<?php echo channeldl?>信息</title>
<link href="/template/<?php echo siteskin?>/style.css" rel="stylesheet" type="text/css">
<script>
function check_truename(){
if (document.myform.truename.value !=""){
    var re=/^[\u4e00-\u9fa5]{2,10}$/; //只输入汉字的正则
    if(document.myform.truename.value.search(re)==-1){
	alert("联系人只能为汉字，字符介于2到10个。");
	document.myform.truename.value="";
	document.myform.truename.focus();
	}
}
}

function check_tel(){
if (document.myform.tel.value !=""){	
	var phone = /^1([38]\d|4[57]|5[0-35-9]|7[06-8]|8[89])\d{8}$/;
	if(!phone.test(document.myform.tel.value)){
	alert("您的电话号码不正确！");
	document.myform.tel.focus();
	}
} 
}

function CheckForm(){
if (document.myform.cp.value==""){
    alert("请填写您要<?php echo channeldl?>的产品名称！");
	document.myform.cp.focus();
	return false;
  }
if (document.myform.classid.value==""){
    alert("请选择产品类别！");
	document.myform.classid.focus();
	return false;
  }  
if (document.myform.province.value=="请选择省份"){
    alert("请选择要<?php echo channeldl?>的省份！");
	document.myform.province.focus();
	return false;
  }
  if (document.myform.content.value==""){
    alert("请填写<?php echo channeldl?>商介绍！");
	document.myform.content.focus();
	return false;
  }
  
if (document.myform.truename.value==""){
    alert("请填写真实姓名！");
	document.myform.truename.focus();
	return false;
}  
if (document.myform.tel.value==""){
    alert("请填写代联系电话！");
	document.myform.tel.focus();
	return false;
}  
if (document.myform.yzm.value==""){
    alert("请输入验证问题的答案！");
	document.myform.yzm.focus();
	return false;
}
  
var v = '';
for(var i = 0; i < document.myform.destList.length; i++){
if(i==0){
v = document.myform.destList.options[i].text;
}else{
v += ','+document.myform.destList.options[i].text;
}
}
//alert(v);
document.myform.cityforadd.value=v;
}

function showsubmenu(sid){
whichEl = eval("submenu" + sid);
if (whichEl.style.display == "none"){
eval("submenu" + sid + ".style.display=\"\";");
}
}
function hidesubmenu(sid){
whichEl = eval("submenu" + sid);
if (whichEl.style.display == ""){
eval("submenu" + sid + ".style.display=\"none\";");
}
}
</SCRIPT>
</head>
<body>

<div class="main">
<?php
include("../inc/top2.php");
echo sitetop();
?>
<div class="pagebody">
<div class="titles">发布<?php echo channeldl?>信息</div>
<div class="content">
<form action="?" method="post" name="myform" id="myform" onSubmit="return CheckForm();">      
  <table width="100%" border="0" cellpadding="3" cellspacing="1">
    <tr> 
      <td align="right" class="border">想要<?php echo channeldl?>的产品 <font color="#FF0000">*</font></td>
      <td class="border"> <input name="cp" type="text" id="cp" size="45" maxlength="45">      </td>
    </tr>
    <tr> 
      <td align="right" class="border2">产品类别 <font color="#FF0000">*</font></td>
      <td class="border2">
	   <select name="classid">
          <option value="" selected>请选择类别</option>
          <?php
		$sql="select classid,classname from caicaicms_zsclass where parentid=0";
		$rs=query($sql);
		while($row= fetch_array($rs)){
			?>
          <option value="<?php echo $row["classid"]?>"<?php if (@$_SESSION['bigclassid']==$row["classid"]){echo 'selected';}?>><?php echo $row["classname"]?></option>
          <?php
		  }
		  ?>
        </select> </td>
    </tr>
    <tr> 
      <td width="130" align="right" class="border"><?php echo channeldl?>区域 <font color="#FF0000">*</font></td>
            <td class="border"><table border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td><script language="JavaScript" type="text/javascript">
function addSrcToDestList() {
destList = window.document.myform.destList;
city = window.document.myform.xiancheng;
var len = destList.length;
for(var i = 0; i < city.length; i++) {
if ((city.options[i] != null) && (city.options[i].selected)) {
var found = false;
for(var count = 0; count < len; count++) {
if (destList.options[count] != null) {
if (city.options[i].text == destList.options[count].text) {
found = true;
break;
}
}
}
if (found != true) {
destList.options[len] = new Option(city.options[i].text);
len++;
}
}
}
}
function deleteFromDestList() {
var destList = window.document.myform.destList;
var len = destList.options.length;
for(var i = (len-1); i >= 0; i--) {
if ((destList.options[i] != null) && (destList.options[i].selected == true)) {
destList.options[i] = null;
}
}
} 
            </script>
                   
<select name="province" id="province"></select>
<select name="city" id="city"></select>
<select name="xiancheng" id="xiancheng" onChange="addSrcToDestList()"></select>
<script src="/js/area.js"></script>
<script type="text/javascript">
new PCAS('province', 'city', 'xiancheng', '<?php echo @$_SESSION['province']?>', '<?php echo @$_SESSION["city"]?>', '');
</script>                </td>
               
                <td  align="center" valign="top">已选城市<br />
                  <select name="destList" size="3" multiple="multiple" style='width:100px'>
                    </select>
                    <input name="cityforadd" type="hidden" id="cityforadd" />
                    <br />
                  <input name="button" type="button" onClick="javascript:deleteFromDestList();" value="删除已选城市" /></td>
              </tr>
            </table></td>
    </tr>
    <tr> 
      <td width="130" align="right" class="border2"><?php echo channeldl?>商介绍 <font color="#FF0000">*</font></td>
      <td class="border2"> <textarea name="content" cols="45" rows="6" id="content"><?php echo @$_SESSION["content"]?></textarea>      </td>
    </tr>
	<?php
	if (isset($_COOKIE["UserName"])){
	$sql="select * from caicaicms_user where username='".$_COOKIE["UserName"]."'";
	$rs=query($sql);
	$row= fetch_array($rs);
	?>
    <tr> 
      <td align="right" class="border"><?php echo channeldl?>身份：</td>
      <td class="border"><input name="dlsf" id="dlsf_company" type="radio" value="公司" onClick="showsubmenu(1)">
         <label for="dlsf_company">公司 </label>
        <input name="dlsf" type="radio" id="dlsf_person" onClick="hidesubmenu(1)" value="个人" checked>
          <label for="dlsf_person">个人</label></td>
    </tr>
    <tr style="display:none" id='submenu1'>
      <td align="right" class="border">公司名称：</td>
      <td class="border"><input name="company" type="text" id="yzm2" value="<?php echo $row["comane"]?>" size="45" maxlength="255" /></td>
    </tr>
    <tr> 
      <td align="right" class="border2">真实姓名 <font color="#FF0000">*</font></td>
      <td class="border2">
<input name="truename" type="text" id="truename" value="<?php echo $row["somane"]?>" size="45" maxlength="255" onBlur="check_truename"/></td>
    </tr>
    <tr> 
      <td align="right" class="border">手机 <font color="#FF0000">*</font></td>
      <td class="border"><input name="tel" type="text" id="tel" value="<?php echo $row["phone"]?>" size="45" maxlength="255" onBlur="check_tel"/></td>
    </tr>
    <tr> 
      <td align="right" class="border2">地址：</td>
      <td class="border2">
<input name="address" type="text" id="address" value="<?php echo $row["address"]?>" size="45" maxlength="255" /></td>
    </tr>
    <tr> 
      <td align="right" class="border">E-mail：</td>
      <td class="border"><input name="email" type="text" id="email" value="<?php echo $row["email"]?>" size="45" maxlength="255" /></td>
    </tr>
	<?php }else{?>
	 <tr> 
      <td align="right" class="border"><?php echo channeldl?>身份：</td>
      <td class="border"><input name="dlsf" id="dlsf_company" type="radio" value="公司" onClick="showsubmenu(1)">
         <label for="dlsf_company">公司 </label>
        <input name="dlsf" type="radio" id="dlsf_person" onClick="hidesubmenu(1)" value="个人" checked>
          <label for="dlsf_person">个人</label></td>
    </tr>
    <tr style="display:none" id='submenu1'>
      <td align="right" class="border">公司名称：</td>
      <td class="border"><input name="company" type="text"  size="45" maxlength="255" /></td>
    </tr>
    <tr> 
      <td align="right" class="border2">真实姓名 <font color="#FF0000">*</font></td>
      <td class="border2">
<input name="truename" type="text" id="truename"  size="45" maxlength="255" onBlur="check_truename()"/></td>
    </tr>
    <tr> 
      <td align="right" class="border">手机 <font color="#FF0000">*</font></td>
      <td class="border"><input name="tel" type="text" id="tel"  size="45" maxlength="255" onBlur="check_tel()"/></td>
    </tr>
    <tr> 
      <td align="right" class="border2">地址：</td>
      <td class="border2">
<input name="address" type="text" id="address"  size="45" maxlength="255" /></td>
    </tr>
    <tr> 
      <td align="right" class="border">E-mail：</td>
      <td class="border"><input name="email" type="text" id="email" size="45" maxlength="255" /></td>
    </tr>
	<?php 
	}
	?>
    <tr> 
      <td align="right" class="border">&nbsp;</td>
      <td class="border"> 
        <input name="Submit" type="submit" class="buttons" value="发 布">
        <input name="action" type="hidden" id="action3" value="add"></td>
    </tr>
  </table>
</form>
<?php
if (isset($_POST["action"])){
$classid=$_POST["classid"];
$city=$_POST["cityforadd"];
$companyname=isset($_POST["companyname"])?$_POST["companyname"]:'';
if ($dlsf=="个人" ){$companyname="";}

checkstr($truename,'quanhanzi');
checkstr($tel,'tel');

if ($cp<>'' && $truename<>'' && $tel<>''){
$isok=query("Insert into caicaicms_dl(classid,cpid,cp,province,city,content,company,companyname,dlsname,tel,address,email,sendtime,editor) values('$classid',0,'$cp','$province','$city','$content','$dlsf','$companyname','$truename','$tel','$address','$email','".date('Y-m-d H:i:s')."','".@$_COOKIE["UserName"]."')") ;
}  
if ($isok){
echo showmsg('发布成功，审核后显示。');
}else{
echo showmsg('发布失败！');
}

}	
?>
</div>
</div>
</div>
<?php
include("../inc/bottom.php");
echo sitebottom();
?>
</body>
</html>