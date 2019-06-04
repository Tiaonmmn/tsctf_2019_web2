<?php
error_reporting(0);
define('caicaicmsroot', str_replace("\\", '/', substr(dirname(__FILE__), 0, -3)));//-3截除当前目录inc
ini_set("date.timezone","Asia/Chongqing");//设时区。php.ini里date.timezone选项，默认情况下是关闭的
include(caicaicmsroot."/inc/config.php");
include(caicaicmsroot."/inc/wjt.php");
include(caicaicmsroot."/inc/function.php");
include(caicaicmsroot."/inc/zsclass.php");//分类招商在里面
include(caicaicmsroot."/inc/stopsqlin.php");
include(caicaicmsroot."/inc/area.php");
if (opensite=='No') {
	if (@checkadminlogin<>1) {
	WriteErrMsg(showwordwhenclose);
	exit();
	}
}
$file=caicaicmsroot."/install/install.lock";//是否存在安装标识文件
$installdir=caicaicmsroot."install";
if (file_exists($file)==false && is_dir($installdir) ){//同时检测安装目录install，如果删除安装目录后，则不再提示
WriteErrMsg("未检测到安装标识文件，<a href='http://".$_SERVER['HTTP_HOST']."/install/index.php'>点击运行安装向导</a>");
exit();
}

$conn=mysql_connect(sqlhost.':'.sqlport,sqluser,sqlpwd) or showmsg ("数据库链接失败");
mysql_query("SET NAMES 'utf8'",$conn); //必不可少，用来设置客户端送给MySQL服务器的数据的字符集
mysql_select_db(sqldb,$conn) or showmsg ("没有".sqldb."这个数据库,或是被管理员断开了链接,请稍后再试");
//lockip();
//if (isset($_COOKIE["admin"])){
//admindo();//如果管理员登录，记录管理员操作记录
//}

 
function query($sql){   
global $conn;
$rs = mysql_query($sql,$conn);
echo mysql_error();
return $rs;
}  

function num_rows($rs) {
return mysql_num_rows($rs);
} 

function fetch_array($rs) {
return mysql_fetch_array($rs);
}

function insert_id($conn) {
global $conn;
return mysql_insert_id($conn);
}
?>