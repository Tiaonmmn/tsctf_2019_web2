<?php
include("admin.php");
checkadminisdo("user");
$id=trim($_REQUEST["id"]);
$action=trim($_REQUEST["action"]);
$page=trim($_REQUEST["page"]);
if ($id<>"") {
	if ($action=="lock") {
		query("Update caicaicms_user set lockuser=1 where id='$id'");
		//锁定时审核此用户发布的信息（使之为0）
		query("Update caicaicms_main set passed=0 where editor=(select username from caicaicms_user where id='id')");
		query("Update caicaicms_pp set passed=0 where editor=(select username from caicaicms_user where id='id')");
		query("Update caicaicms_job set passed=0 where editor=(select username from caicaicms_user where id='id')");
		query("Update caicaicms_zh set passed=0 where editor=(select username from caicaicms_user where id='$id')");
		query("Update caicaicms_zx set passed=0 where editor=(select username from caicaicms_user where id='$id')");
		query("Update caicaicms_special set passed=0 where editor=(select username from caicaicms_user where id='id')");
	}else{
		query("Update caicaicms_user set lockuser=0 where id='$id'");
		//解锁时审核此用户发布的信息（使之为1）
		query("Update caicaicms_main set passed=1 where editor=(select username from caicaicms_user where id='$id')");
		query("Update caicaicms_pp set passed=1 where editor=(select username from caicaicms_user where id='id')");
		query("Update caicaicms_job set passed=1 where editor=(select username from caicaicms_user where id='id')");
		query("Update caicaicms_zh set passed=1 where editor=(select username from caicaicms_user where id='$id')");
		query("Update caicaicms_zx set passed=1 where editor=(select username from caicaicms_user where id='$id')");
		query("Update caicaicms_special set passed=1 where editor=(select username from caicaicms_user where id='id')");
	}      
}

echo "<script>location.href='usermanage.php?usersf=lockuser&page=".$page."'</script>";
?>