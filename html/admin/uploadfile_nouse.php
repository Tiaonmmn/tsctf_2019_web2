<?php
//set_time_limit(1800) ;
include("admin.php");
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<link href="style.css" rel="stylesheet" type="text/css"> 
</head>
<body>
<?php
$action=isset($_GET["action"])?$_GET["action"]:'';
$mlname=isset($_GET["mlname"])?$_GET["mlname"]:'';
?>
<div class="admintitle">删除无用的上传文件</div>

<div class="boxlink"> 
       <?php
$fp = opendir("../uploadfiles");
while(($file = readdir($fp))!=false){
	if ($file!="." && $file!=".." && $file!="test.txt") { //不读取. ..
    //$f = explode('.', $file);//用$f[0]可只取文件名不取后缀。
		if ($mlname==$file){
  		echo "<li><a href='?mlname=".$file."&action=del' style='color:#000000;background-color:#FFFFFF'>".$file."</a></li> ";
		}else{
		echo "<li><a href='?mlname=".$file."&action=del'>".$file."(点击清理)</a></li> ";
		}
	} 
}
closedir($fp);	 
  ?>
  </div>


<?php
if ($action=="del" ){
echo"<div class='border'> ";
checkadminisdo("uploadfiles");
$ml='../uploadfiles/'.$mlname;
    if (file_exists($ml)==false){
	echo "找不目录";
	}elseif(is_dir($ml)==false){
	echo '非目录';
	}else{
	echo "<b>执行结果如下：</b><br>";
	$fp = opendir($ml);
	$n=0;
	while(($file = readdir($fp))!=false){
  	if ($file!="." && $file!="..") { //不读取. ..
	$n++;
	$file="/uploadfiles/".$mlname.'/'.$file;
		$rs=query("select img from caicaicms_main where img='".$file."' or img='".str_replace("_small.",".",$file)."'");
		//or img='".str_replace("_small.",".",$file)."'" 使小图片也与img能匹配以免把小图片删除
    	$row=num_rows($rs);
	    if (!$row){
		$a=0;//caicaicms_main表中没有用到这个图片
		}else{
		$a=1;
		}
		
		$rs=query("select sm from caicaicms_main where sm like '%".$file."%' or sm like'%".str_replace("_small.",".",$file)."%'");
    	$row=num_rows($rs);
	    if (!$row){
		$a2=0;//caicaicms_main表中没有用到这个图片
		}else{
		$a2=1;
		}
		
		$rs=query("select flv from caicaicms_main where flv='".$file."' ");
    	$row=num_rows($rs);
	    if (!$row){
		$a1=0;//caicaicms_main表中没有用到这个图片
		}else{
		$a1=1;
		}
		
		$rs=query("select img from caicaicms_licence where img='".$file."' or img='".str_replace("_small.",".",$file)."'");
    	$row=num_rows($rs);
	    if (!$row){
		$b=0;//caicaicms_main表中没有用到这个图片
		}else{
		$b=1;
		}
		
		$rs=query("select img from caicaicms_user where img='".$file."' or img='".str_replace("_small.",".",$file)."'");
    	$row=num_rows($rs);
	    if (!$row){
		$c=0;//caicaicms_main表中没有用到这个图片
		}else{
		$c=1;
		}
		
		$rs=query("select flv from caicaicms_user where flv='".$file."'");
    	$row=num_rows($rs);
	    if (!$row){
		$c1=0;//caicaicms_main表中没有用到这个图片
		}else{
		$c1=1;
		}
		
		$rs=query("select content from caicaicms_user where content like '%".$file."%' or content like'%".str_replace("_small.",".",$file)."%'");
    	$row=num_rows($rs);
	    if (!$row){
		$c2=0;//caicaicms_user表content(公司简介)字段中没有用到这个图片
		}else{
		$c2=1;
		}
		
		$rs=query("select img from caicaicms_ad where img='".$file."' or img='".str_replace("_small.",".",$file)."'");
    	$row=num_rows($rs);
	    if (!$row){
		$d=0;//caicaicms_main表中没有用到这个图片
		}else{
		$d=1;
		}
		$rs=query("select img from caicaicms_zx where img='".$file."' or img='".str_replace("_small.",".",$file)."'");
    	$row=num_rows($rs);
	    if (!$row){
		$e=0;//caicaicms_zx表中没有用到这个图片
		}else{
		$e=1;
		}
		
		$rs=query("select content from caicaicms_zx where content like '%".$file."%' or content like'%".str_replace("_small.",".",$file)."%'");
    	$row=num_rows($rs);
	    if (!$row){
		$e1=0;//caicaicms_zx表中没有用到这个图片
		}else{
		$e1=1;
		}
		
		$rs=query("select img from caicaicms_help where img='".$file."' or img='".str_replace("_small.",".",$file)."'");
    	$row=num_rows($rs);
	    if (!$row){
		$f=0;//caicaicms_zx表中没有用到这个图片
		}else{
		$f=1;
		}
		
		$rs=query("select content from caicaicms_help where content like '%".$file."%' or content like'%".str_replace("_small.",".",$file)."%'");
    	$row=num_rows($rs);
	    if (!$row){
		$f1=0;//caicaicms_zx表中没有用到这个图片
		}else{
		$f1=1;
		}
		
		$rs=query("select bannerbg from caicaicms_usersetting where bannerbg='".$file."'");
    	$row=num_rows($rs);
	    if (!$row){
		$g=0;//caicaicms_usersetting表中没有用到这个图片
		}else{
		$g=1;
		}
		
		$rs=query("select img from caicaicms_pp where img='".$file."' or img='".str_replace("_small.",".",$file)."'");
    	$row=num_rows($rs);
	    if (!$row){
		$h=0;
		}else{
		$h=1;
		}
		
		$rs=query("select img from caicaicms_special where img='".$file."' or img='".str_replace("_small.",".",$file)."'");
    	$row=num_rows($rs);
	    if (!$row){
		$m=0;//caicaicms_special表中没有用到这个图片
		}else{
		$m=1;
		}
		
		$rs=query("select content from caicaicms_special where content like '%".$file."%' or content like'%".str_replace("_small.",".",$file)."%'");
    	$row=num_rows($rs);
	    if (!$row){
		$m1=0;//caicaicms_special表中没有用到这个图片
		}else{
		$m1=1;
		}
		
		if ($file!=logourl){
		$i=0;//不是上传的LOGO图片
		}else{
		$i=1;
		}
		$syurl='/'.syurl;
		if ($file!=$syurl){
		$j=0;//不是上传的LOGO图片
		}else{
		$j=1;
		}
		
		if ($a+$a1+$a2+$b+$c+$c1+$c2+$d+$e+$e1+$f+$f1+$g+$h+$i+$j+$m==0) {//如果在这几个表中都没有用到这个图片
		echo "<li style='color:red'>第".$n."个文件 " . $file ." 无用 处理结果：</li>"	;
		$ok=unlink("../".substr($file,1));//前面是../直接用/完法删除
			if ($ok){echo'成功删除';}else{echo'删除失败';}
		}else {
		echo "<li>第".$n."个文件 ".$file." 目前有用</li>";	
		}
	}
	}	
closedir($fp); 
	}
	$ok=@rmdir($ml);//删除空目录
	if ($ok){ 
	echo "<script>alert('".$mlname." 是空目录，已被删除');location.href='uploadfile_nouse.php'</script>";
	}
}
echo "</div>";
  ?>

</body>
</html>