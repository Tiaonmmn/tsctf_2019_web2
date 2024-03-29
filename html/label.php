<?php
function showlabel($str){
global $b;//zsshow需要从zs/class.php获取$b；zxshow从s/class.php获取$b；
checkver($str);
//固定标签=========================
$channels=array('ad','zs','dl','zx','pp','job','zh','announce','cookiezs','zsclass','keyword','province','sitecount');
foreach ($channels as $value) {
if (strpos($str,"{#show".$value.":")!==false){
$n=count(explode("{#show".$value.":",$str));//循环之前取值
	for ($i=1;$i<$n;$i++){ 
	$cs=strbetween($str,"{#show".$value.":","}");
	if ($cs<>''){$str=str_replace("{#show".$value.":".$cs."}",fixed($cs,$value),$str);}	//$cs直接做为一个整体字符串参数传入，调用时再转成数组遍历每项值
	}	
}
}
//自定义标签=========================
$channels='zs,dl,zx,pp,job,wangkan,zh,company,special,baojia,ask,link,ad,about,guestbook,help';
$channel = explode(",",$channels);
for ($a=0; $a< count($channel);$a++){
//类别标签
if (strpos($str,"{@".$channel[$a]."class.")!==false) {
	$n=count(explode("{@".$channel[$a]."class.",$str));//循环之前取值
	for ($i=1;$i<$n;$i++){ 
	$mylabel=strbetween($str,"{@".$channel[$a]."class.","}");
	$str=str_replace("{@".$channel[$a]."class.".$mylabel."}",labelclass($mylabel,$channel[$a]),$str);
	}
}
//内容标签
if (strpos($str,"{@".$channel[$a]."show.")!==false) {
	$n=count(explode("{@".$channel[$a]."show.",$str));//循环之前取值
	for ($i=1;$i<$n;$i++){ 
	$mylabel=strbetween($str,"{@".$channel[$a]."show.","}");
	$str=str_replace("{@".$channel[$a]."show.".$mylabel."}",labelshow($mylabel,$b,$channel[$a]),$str);
	}
}
}
return $str;
}

function writecache($channel,$classzm,$labelname,$str){//$classid,$labelname 这两个参数在外部函数的参数里，没有在函数内部无法通过global获取到。
global $siteskin,$provincezm;
	if ($classzm!=''){
	$fpath=caicaicmsroot."cache/".$siteskin."/".$channel."/".$classzm."-".$labelname.".txt";
	}elseif($provincezm<>''){//area.php中调用zs,dl,company三个频道中用到这个条件。
	$fpath=caicaicmsroot."cache/".$siteskin."/".$channel."/".$provincezm."-".$labelname.".txt";
	}else{
	$fpath=caicaicmsroot."cache/".$siteskin."/".$channel."/".$labelname.".txt";
	}
	if (!file_exists(caicaicmsroot."cache/".$siteskin."/".$channel)) {mkdir(caicaicmsroot."cache/".$siteskin."/".$channel,0777,true);}
	//echo caicaicmsroot."cache/".$siteskin."/".$channel;
	$fp=fopen($fpath,"w+");//fopen()的其它开关请参看相关函数
	fputs($fp,stripfxg($str));//写入文件
	fclose($fp);	
}

function fixed($cs,$channel){
switch ($channel){
case 'ad':return showad($cs); break;
case 'zs':return showzs($cs); break;
case 'dl':return showdl($cs); break;
case 'pp':return showpp($cs); break;
case 'job':return showjob($cs); break;
case 'zx':return showzx($cs); break;
case 'zh':return showzh($cs); break;
case 'announce':return showannounce($cs); break;
case 'cookiezs':return showcookiezs($cs); break;
case 'zsclass':return showzsclass($cs); break;
case 'keyword':return showkeyword($cs); break;
case 'province':return showprovince($cs); break;
case 'sitecount':return showsitecount($cs); break;
}
}

function labelshow($mylabel,$b,$channel){
switch ($channel){
case 'zs':return zsshow($mylabel,$b); break;
case 'dl':return dlshow($mylabel,''); break;
case 'pp':return ppshow($mylabel,$b); break;
case 'job':return jobshow($mylabel,$b); break;
case 'zh':return zhshow($mylabel,''); break;
case 'zx':return zxshow($mylabel,$b,0); break;
case 'company':return companyshow($mylabel,''); break;
case 'wangkan':return wangkanshow($mylabel,$b,0); break;
case 'baojia':return baojiashow($mylabel,$b,0); break;
case 'ask':return askshow($mylabel,$b,0); break;
case 'special':return specialshow($mylabel,$b,0); break;
case 'ad':return adshow($mylabel,$b,0); break;
case 'help':return helpshow($mylabel); break;
case 'link':return linkshow($mylabel,''); break;
case 'about':return aboutshow($mylabel); break;
case 'guestbook':return guestbookshow($mylabel); break;
}
}

function labelclass($labelname,$channel){
global $siteskin,$b;//取外部值，供演示模板用,$b资讯和专题用到$b
if (!isset($siteskin)){$siteskin=siteskin;}
$fpath=caicaicmsroot."/template/".$siteskin."/label/".$channel."class/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/".$channel."class/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$startnumber = $f[1];$numbers = $f[2];$column = $f[3];$start = $f[4];$mids = $f[5];

if($channel=="zx" || $channel=="special" || $channel=="ask"){
	$mids = str_replace($channel.".php?b={#bigclassid}","/".$channel."/".$channel.".php?b={#bigclassid}",$mids);//后有小类的同样会被转换前面加/
	}

if ( whtml == "Yes"){
$mids = str_replace($channel.".php?b={#classid}", "{#classid}",$mids);
	if($channel=="zs"){
	$mids = str_replace("class.php?b={#classid}", "{#classid}.htm",$mids);
	}
	if($channel=="zx" || $channel=="special" || $channel=="ask"){
	$mids = str_replace("/".$channel."/".$channel.".php?b={#bigclassid}&s={#smallclassid}","/".$channel."/{#bigclassid}/{#smallclassid}",$mids);
	$mids = str_replace("/".$channel."/".$channel.".php?b={#bigclassid}","/".$channel."/{#bigclassid}",$mids);
	}
	if($channel=="special"){
	$mids = str_replace("class.php?b={#bigclassid}","/special/class/{#bigclassid}",$mids);
	}
}
$ends = $f[6];
if ($channel=='zs' || $channel=='pp'|| $channel=='dl'|| $channel=='baojia'){
$sql ="select classid,classname,classzm from caicaicms_zsclass where parentid=0 order by xuhao limit $startnumber,$numbers ";
}elseif($channel=='job'){
$sql ="select * from caicaicms_jobclass where parentid='0' order by xuhao limit $startnumber,$numbers ";
}elseif($channel=="zh" || $channel=="link"|| $channel=="wangkan"){
$sql ="select * from caicaicms_".$channel."class order by xuhao limit $startnumber,$numbers ";
}elseif($channel=="company"){
$sql ="select * from caicaicms_userclass where  parentid='0' order by xuhao limit $startnumber,$numbers ";
}elseif($channel=="zx" || $channel=="special" || $channel=="ask"){
	if ($b<>""){
	$sql ="select * from caicaicms_".$channel."class where  parentid='".$b."' order by xuhao limit $startnumber,$numbers ";
	}else{
	$sql ="select * from caicaicms_".$channel."class where  isshow=1 and parentid=0 order by xuhao limit $startnumber,$numbers ";
	}
}
$rs=query($sql);
$str="";$i = 1;$mylabel1="";$mids3='';
if (count(explode("{@".$channel."show.",$mids))==2) {
	$mylabel1=strbetween($mids,"{@".$channel."show.","}");
}
$mylabel2="";
if (count(explode("{@".$channel."show.",$mids))==3) {
	$mylabel1=strbetween($mids,"{@".$channel."show.","}");
	$mids2 = str_replace("{@".$channel."show." . $mylabel1 . "}", "",$mids); //把第一个标签换空,方可找出第二个标签
	$mylabel2=strbetween($mids2,"{@".$channel."show.","}");	
}
while($r=fetch_array($rs)){	
if ($channel=='zs'){
$zssmallclass_num=strbetween($mids,"{#zssmallclass:","}");
$mids3=$mids3.str_replace("{#zssmallclass:".$zssmallclass_num."}",showzssmallclass($r["classzm"],'',$zssmallclass_num),str_replace("{@zsshow." . $mylabel2 . "}", zsshow($mylabel2,$r["classzm"]),str_replace("{@zsshow." . $mylabel1 . "}", zsshow($mylabel1,$r["classzm"]),str_replace("{#classname}",$r["classname"],str_replace("{#classid}",$r["classzm"],$mids)))));
if ($i==1){
$mids3=str_replace("{#title_style}","class=current1",$mids3);
$mids3=str_replace("{#content_style}","style=display:block",$mids3);
}else{
$mids3=str_replace("{#title_style}","",$mids3);
$mids3=str_replace("{#content_style}","style=display:none",$mids3);
}

}elseif($channel=='pp'){
$mids3=$mids3.str_replace("{@ppshow." . $mylabel2 . "}", ppshow($mylabel2,$r["classzm"]),str_replace("{@ppshow." . $mylabel1 . "}", ppshow($mylabel1,$r["classzm"]),str_replace("{#classname}",$r["classname"],str_replace("{#classid}",$r["classzm"],$mids))));
}elseif($channel=='job'){
$mids3=$mids3.str_replace("{@jobshow." . $mylabel2 . "}", jobshow($mylabel2,$r["classid"]),str_replace("{@jobshow." . $mylabel1 . "}", jobshow($mylabel1,$r["classid"]),str_replace("{#classname}",$r["classname"],str_replace("{#classid}",$r["classid"],$mids))));
}elseif($channel=="dl"){
$mids3=$mids3.str_replace("{@dlshow." . $mylabel2 . "}", dlshow($mylabel2,$r["classzm"]),str_replace("{@dlshow." . $mylabel1 . "}", dlshow($mylabel1,$r["classzm"]),str_replace("{#classname}",$r["classname"],str_replace("{#classid}",$r["classzm"],$mids))));
}elseif($channel=="zh"){
$mids3=$mids3.str_replace("{@zhshow." . $mylabel2 . "}",zhshow($mylabel2,$r["classid"]),str_replace("{@zhshow." . $mylabel1 . "}", zhshow($mylabel1,$r["classid"]),str_replace("{#classname}",$r["classname"],str_replace("{#classid}",$r["classid"],$mids))));
}elseif($channel=="wangkan"){
$mids3=$mids3.str_replace("{@wangkanshow." . $mylabel2 . "}",wangkanshow($mylabel2,$r["classid"]),str_replace("{@wangkanshow." . $mylabel1 . "}", wangkanshow($mylabel1,$r["classid"]),str_replace("{#classname}",$r["classname"],str_replace("{#classid}",$r["classid"],$mids))));
}elseif($channel=="baojia"){
$mids3=$mids3.str_replace("{@baojiashow." . $mylabel2 . "}", baojiashow($mylabel2,$r["classzm"]),str_replace("{@baojiashow." . $mylabel1 . "}", baojiashow($mylabel1,$r["classzm"]),str_replace("{#classname}",$r["classname"],str_replace("{#classid}",$r["classzm"],$mids))));
}elseif($channel=="link"){
$mids3=$mids3.str_replace("{@linkshow." . $mylabel2 . "}", linkshow($mylabel2,$r["classid"]),str_replace("{@linkshow." . $mylabel1 . "}", linkshow($mylabel1,$r["classid"]),str_replace("{#classname}",$r["classname"],str_replace("{#classid}",$r["classid"],$mids))));
}elseif($channel=="company"){
$mids3=$mids3.str_replace("{@companyshow." . $mylabel2 . "}", companyshow($mylabel2,$r["classid"]),str_replace("{@companyshow." . $mylabel1 . "}", companyshow($mylabel1,$r["classid"]),str_replace("{#classname}",$r["classname"],str_replace("{#classid}",$r["classid"],$mids))));
}elseif($channel=="zx"){
	if ($b<>""){//父类不为空，调出的classid为小类
	$mids3=$mids3.str_replace("{@zxshow." . $mylabel1 . "}", zxshow($mylabel1,$b,$r["classid"]),$mids);//注意这里用首次替换已把$mids赋值给$mids3了，	
	$mids3=str_replace("{@zxshow." . $mylabel2 . "}", zxshow($mylabel2,$b,$r["classid"]),$mids3);//这里替换$mids3里的内容
	$mids3=str_replace("{#classname}",$r["classname"],$mids3);
	$mids3=str_replace("{#bigclassid}",$b,$mids3);
	$mids3=str_replace("{#smallclassid}",$r["classid"],$mids3);
	}else{//父类为空，只调出的为大类就行了
	$mids3=$mids3.str_replace("{@zxshow." . $mylabel1 . "}", zxshow($mylabel1,$r["classid"],0),$mids);	
	$mids3=str_replace("{@zxshow." . $mylabel2 . "}", zxshow($mylabel2,$r["classid"],0),$mids3);
	$mids3=str_replace("{#classname}",$r["classname"],$mids3);
	$mids3=str_replace("{#bigclassid}",$r["classid"],$mids3);
	}
}elseif($channel=="special"){
	if ($b<>""){//父类不为空，调出的classid为小类
	$mids3=$mids3.str_replace("{@specialshow." . $mylabel1 . "}", specialshow($mylabel1,$b,$r["classname"]),$mids);//注意这里用首次替换已把$mids赋值给$mids3了，	
	$mids3=str_replace("{@specialshow." . $mylabel2 . "}", specialshow($mylabel2,$b,$r["classname"]),$mids3);//这里替换$mids3里的内容
	$mids3=str_replace("{#classname}",$r["classname"],$mids3);
	$mids3=str_replace("{#bigclassid}",$b,$mids3);
	$mids3=str_replace("{#smallclassid}",$r["classid"],$mids3);
	}else{//父类为空，只调出的为大类就行了
	$mids3=$mids3.str_replace("{@specialshow." . $mylabel1 . "}", specialshow($mylabel1,$r["classid"],0),$mids);	
	$mids3=str_replace("{@specialshow." . $mylabel2 . "}", specialshow($mylabel2,$r["classid"],0),$mids3);
	$mids3=str_replace("{#classname}",$r["classname"],$mids3);
	$mids3=str_replace("{#bigclassid}",$r["classid"],$mids3);
	}
}elseif($channel=="ask"){
	if ($b<>""){//父类不为空，调出的classid为小类
	$mids3=$mids3.str_replace("{@askshow." . $mylabel1 . "}", askshow($mylabel1,$b,$r["classname"]),$mids);//注意这里用首次替换已把$mids赋值给$mids3了，	
	$mids3=str_replace("{@askshow." . $mylabel2 . "}", askshow($mylabel2,$b,$r["classname"]),$mids3);//这里替换$mids3里的内容
	$mids3=str_replace("{#classname}",$r["classname"],$mids3);
	$mids3=str_replace("{#bigclassid}",$b,$mids3);
	$mids3=str_replace("{#smallclassid}",$r["classid"],$mids3);
	}else{//父类为空，只调出的为大类就行了
	$mids3=$mids3.str_replace("{@askshow." . $mylabel1 . "}", askshow($mylabel1,$r["classid"],0),$mids);	
	$mids3=str_replace("{@askshow." . $mylabel2 . "}", askshow($mylabel2,$r["classid"],0),$mids3);
	$mids3=str_replace("{#classname}",$r["classname"],$mids3);
	$mids3=str_replace("{#bigclassid}",$r["classid"],$mids3);
	}
}
$mids3=str_replace("{#i}", $i,$mids3);//类别标签中序号用i，内容标签中用n,以区别开，这样在内容标签中可以调用i
	if ($column <> "" && $column >0){
		if ($i % $column == 0) {$mids3 = $mids3 . "</tr>";}
	}
$i = $i + 1;
}
$str = $start.$mids3 . $ends;
$str = showlabel($str);
if ($mids3==''){$str='暂无信息';}
return $str;
}
}

function zsshow($labelname,$classzm){
global $siteskin,$province,$provincezm;//取外部值，供演示模板，手机模板用
setcookie("province","xxx",1);//搜索页的cookie值会影响到province的值
if (!$siteskin){$siteskin=siteskin;}
if ($classzm!=''){$fpath=caicaicmsroot."cache/".$siteskin."/zs/".$classzm."-".$labelname.".txt";
}elseif($provincezm<>''){$fpath=caicaicmsroot."cache/".$siteskin."/zs/".$provincezm."-".$labelname.".txt";
}else{$fpath=caicaicmsroot."cache/".$siteskin."/zs/".$labelname.".txt";}

if (cache_update_time!=0 && file_exists($fpath)!==false && time()-filemtime($fpath)<3600*24*cache_update_time){
	return file_get_contents($fpath);
}else{
$fpath=caicaicmsroot."/template/".$siteskin."/label/zsshow/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/zsshow/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$title=$f[0];$bigclassid =$f[1];$smallclassid = $f[2];

if ($classzm <> "") {//不为空的情况是嵌套在zsclass中时，接收的大类值。
	$rs=query("select classid from caicaicms_zsclass where classzm='".$classzm."'");
	$row=fetch_array($rs);
	if ($row){
	$bigclassid=$row["classid"];//使大类值等于接收到的值
	}
	$smallclassid = 0; //以下有条件判断，此处必设值
}

$groupid =$f[3];$pic =$f[4];$flv =$f[5];$elite = $f[6];$numbers = $f[7];$orderby =$f[8];$titlenum = $f[9];$column = $f[10];$start =$f[11];$mids = $f[12];
$mids = str_replace("show.php?id={#id}", "/zs/show.php?id={#id}",$mids);
if (whtml == "Yes") {$mids = str_replace("/zs/show.php?id={#id}", "/zs/show-{#id}.htm",$mids);}
$ends = $f[13];
$sql = "select id,proname,link,bigclassid,prouse,shuxing_value,sendtime,img,flv,hit,city,editor from caicaicms_main where passed=1 ";
	if ( $bigclassid <> 0) {$sql = $sql . " and bigclassid='" . $bigclassid . "'";}
	if ( $smallclassid <> 0) {$sql = $sql . " and smallclassid='" . $smallclassid . "'";}
	if ( $groupid <> 0) {$sql = $sql . " and groupid>=$groupid ";}    
	if ( $pic == 1) {$sql = $sql . " and img is not null and img<>'/image/nopic.gif'";}
	if ( $flv == 1) {$sql = $sql . " and flv is not null and flv<>'' ";} 	    
	if ( $elite == 1) {$sql = $sql . " and elite>0";}
	if ( $province != '') {$sql = $sql . " and province='$province'";}
	if ( $orderby == "hit") {$sql = $sql . " order by hit desc limit 0,$numbers ";
	}elseif ($orderby == "id") {$sql = $sql . " order by id desc limit 0,$numbers ";
	}elseif ($orderby == "sendtime") {$sql = $sql . " order by sendtime desc limit 0,$numbers ";
	}elseif ($orderby == "rand") {
	$sqln="select count(*) as total from caicaicms_main where passed<>0 ";
	$rsn=query($sqln);
	$rown = fetch_array($rsn);
	$totlenum = $rown['total'];
		if (!$totlenum){
		$shuijishu=0;
		}else{
		$shuijishu=rand(1,$totlenum-$numbers);
		if ($shuijishu<0){$shuijishu=0;}
		}
	$sql = $sql . " limit $shuijishu,$numbers";
	}
//echo $sql;
$rs=query($sql);
$str="";$xuhao=1;$n = 1;$mids2='';
while($r=fetch_array($rs)){
$mids2 = $mids2 . str_replace("{#hit}", $r["hit"],str_replace("{#n}", $n,str_replace("{#sendtime}", date("Y-m-d",strtotime($r['sendtime'])),str_replace("{#imgbig}",$r["img"],str_replace("{#img}",getsmallimg($r["img"]),str_replace("{#proname}",cutstr($r["proname"],$titlenum),$mids))))));
	
	if ($r["link"]<>''){//当为外链时
		if (whtml=="Yes"){
		$mids2=str_replace("/zs/show-{#id}.htm", addhttp($r["link"]),$mids2);
		}else{
		$mids2=str_replace("/zs/show.php?id={#id}",addhttp($r["link"]),$mids2);
		}
	}
	
	$mids2 =str_replace("{#id}", $r["id"],$mids2);
	$mids2 =str_replace("{#prouse}", cutstr($r["prouse"],$titlenum*5),$mids2);
	$mids2 =str_replace("{#flv}", $r["flv"],$mids2);
	$mids2 =str_replace("{#city}", $r["city"],$mids2);
	
	if ($r["shuxing_value"]==''){
	for ($a=0; $a< 6;$a++){
	$mids2=str_replace("{#shuxing".$a."}",'',$mids2);
	}
	}else{
	$shuxing_value = explode("|||",$r["shuxing_value"]);
	for ($a=0; $a< count($shuxing_value);$a++){
	$mids2=str_replace("{#shuxing".$a."}",$shuxing_value[$a],$mids2);
	}
	}
	
	$mids2 =str_replace("{#bigclasszm}", $r["bigclassid"],$mids2);//如排行页用来区分不同类别
	//$mids2 =str_replace("{#tz}", $r["tz"],$mids2);
	if ($n==1){$mids2=str_replace("display:none","",$mids2);}
	require(caicaicmsroot.'inc/mid2.php');
$n = $n + 1;
$xuhao++;
}
$str = $start.$mids2.$ends;
if ($mids2==''){$str='暂无信息';}
if (cache_update_time!=0){writecache("zs",$classzm,$labelname,$str);}
return $str;
}//end if file_exists($fpath)==true
}//end if (cache_update_time!=0 && file_exists($fpath)!==false && time()-filemtime($fpath)<3600*24*cache_update_time)
}

function ppshow($labelname,$classzm){
global $siteskin;//取外部值，供演示模板用
if (!$siteskin){$siteskin=siteskin;}
if ($classzm!=""){
$fpath=caicaicmsroot."/cache/".$siteskin."/pp/".$classzm."-".$labelname.".txt";
}else{
$fpath=caicaicmsroot."/cache/".$siteskin."/pp/".$labelname.".txt";
}
if (cache_update_time!=0 && file_exists($fpath)!==false && time()-filemtime($fpath)<3600*24*cache_update_time){
	return file_get_contents($fpath);
}else{
$fpath=caicaicmsroot."/template/".$siteskin."/label/ppshow/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/ppshow/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$title=$f[0];
$bigclassid=$f[1];$smallclassid = $f[2];

if ($classzm <> "") {//不为空的情况是嵌套在zsclass中时，接收的大类值。
	$rs=query("select classid from caicaicms_zsclass where classzm='".$classzm."'");
	$row=fetch_array($rs);
	if ($row){
	$bigclassid=$row["classid"];//使大类值等于接收到的值
	}
	$smallclassid = 0; //以下有条件判断，此处必设值
}

$pic =$f[3];$numbers = $f[4];$orderby =$f[5];$titlenum = $f[6];$column = $f[7];$start =$f[8];$mids = $f[9];
$mids = str_replace("show.php?id={#id}", "/pp/show.php?id={#id}",$mids);
if (whtml == "Yes") {$mids = str_replace("/pp/show.php?id={#id}", "/pp/show-{#id}.htm",$mids);}
$ends = $f[10];
$sql = "select id,ppname,sendtime,img,hit,editor from caicaicms_pp where passed=1 ";
	if ( $bigclassid <> 0) {$sql = $sql . " and bigclassid='" . $bigclassid . "'";}
	if ( $smallclassid <> 0) {$sql = $sql . " and smallclassid='" . $smallclassid . "'";}
	if ( $pic == 1) {$sql = $sql . " and img is not null and img<>'/image/nopic.gif'";}
	if ( $orderby == "hit") {$sql = $sql . " order by hit desc limit 0,$numbers ";
	}elseif ($orderby == "id") {$sql = $sql . " order by id desc limit 0,$numbers ";
	}elseif ($orderby == "sendtime") {$sql = $sql . " order by sendtime desc limit 0,$numbers ";
	}elseif ($orderby == "rand") {
	$sqln="select count(*) as total from caicaicms_pp where passed<>0 ";
	$rsn=query($sqln);
	$rown = fetch_array($rsn);
	$totlenum = $rown['total'];
	if (!$totlenum){$shuijishu=0;}else{$shuijishu=rand(1,$totlenum-$numbers);}
	$sql = $sql . " limit $shuijishu,$numbers";
	}
$rs=query($sql);
$str="";$xuhao=1;$n = 1;$mids2='';
while($r=fetch_array($rs)){
	$mids2 = $mids2 . str_replace("{#hit}", $r["hit"],str_replace("{#n}", $n,str_replace("{#sendtime}", date("Y-m-d",strtotime($r['sendtime'])),str_replace("{#imgbig}",$r["img"],str_replace("{#img}",getsmallimg($r["img"]),str_replace("{#id}", $r["id"],str_replace("{#title}",cutstr($r["ppname"],$titlenum),$mids)))))));
	require(caicaicmsroot.'inc/mid2.php');
$n = $n + 1;
$xuhao++;
}
$str = $start.$mids2.$ends;
if ($mids2==''){$str='暂无信息';}
if (cache_update_time!=0){writecache("pp",$classzm,$labelname,$str);}	
return $str;
}//end if file_exists($fpath)==true
}//end if (file_exists($fpath)!==false)
}

function jobshow($labelname,$classid){
global $siteskin;//取外部值，供演示模板用
if (!$siteskin){$siteskin=siteskin;}
if ($classid!='empty' && $classid!=''){
$fpath=caicaicmsroot."/cache/".$siteskin."/job/".$classid."-".$labelname.".txt";
}else{
$fpath=caicaicmsroot."/cache/".$siteskin."/job/".$labelname.".txt";
}
if (cache_update_time!=0 && file_exists($fpath)!==false && time()-filemtime($fpath)<3600*24*cache_update_time){
	return file_get_contents($fpath);
}else{
$fpath=caicaicmsroot."/template/".$siteskin."/label/jobshow/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/jobshow/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$title=$f[0];$bigclassid=$f[1];$smallclassid = $f[2];
	if ($classid <> "") {//不为空的情况是嵌套在zsclass中时，接收的大类值。
	$bigclassid = $classid; //使大类值等于接收到的值
	$smallclassid = "empty"; //以下有条件判断，此处必设值
	}
$numbers = $f[3];$orderby =$f[4];$titlenum = $f[5];$column = $f[6];$start =$f[7];$mids = $f[8];
$mids = str_replace("show.php?id={#id}", "/job/show.php?id={#id}",$mids);
if (whtml == "Yes") {$mids = str_replace("/job/show.php?id={#id}", "/job/show-{#id}.htm",$mids);}
$ends = $f[9];
$sql = "select * from caicaicms_job where passed=1 ";
	if ( $bigclassid <> "empty") {$sql = $sql . " and bigclassid='" . $bigclassid . "'";}
	if ( $smallclassid <> "empty") {$sql = $sql . " and smallclassid='" . $smallclassid . "'";}
	if ( $orderby == "hit") {$sql = $sql . " order by hit desc limit 0,$numbers ";
	}elseif ($orderby == "id") {$sql = $sql . " order by id desc limit 0,$numbers ";
	}elseif ($orderby == "sendtime") {$sql = $sql . " order by sendtime desc limit 0,$numbers ";
	}elseif ($orderby == "rand") {
	
	$sqln="select count(*) as total from caicaicms_job where passed<>0 ";
	$rsn=query($sqln);
	$rown = fetch_array($rsn);
	$totlenum = $rown['total'];
	if (!$totlenum){$shuijishu=0;}else{$shuijishu=rand(1,$r-$numbers);}
	$sql = $sql . " limit $shuijishu,$numbers";
	}	
$rs=query($sql);
$str="";$xuhao=1;$n = 1;$mids2='';
while($r=fetch_array($rs)){
	$mids2 = $mids2 . str_replace("{#province}", $r["province"],str_replace("{#city}", $r["city"],str_replace("{#hit}", $r["hit"],str_replace("{#n}", $n,str_replace("{#sendtime}", date("Y-m-d",strtotime($r['sendtime'])),str_replace("{#comane}",$r["comane"],str_replace("{#id}", $r["id"],str_replace("{#title}",cutstr($r["jobname"],$titlenum),$mids))))))));
require(caicaicmsroot.'inc/mid2.php');
$n = $n + 1;
$xuhao++;
}
$str = $start.$mids2.$ends;
if ($mids2==''){$str='暂无信息';}
if (cache_update_time!=0){writecache("job",$classid,$labelname,$str);}
return $str;
}//end if file_exists($fpath)==true
}//end if (file_exists($fpath)!==false)
}

function dlshow($labelname,$classzm){
global $siteskin,$province,$provincezm;//取外部值，供演示模板用,$province在area/show.php中已被转成了汉字，所以加了$provincezm
setcookie("province","xxx",1);//搜索页的cookie值会影响到province的值
if (!$siteskin){$siteskin=siteskin;}
if ($classzm!=""){
$fpath=caicaicmsroot."/cache/".$siteskin."/dl/".$classzm."-".$labelname.".txt";
}elseif($provincezm<>''){
$fpath=caicaicmsroot."/cache/".$siteskin."/dl/".$provincezm."-".$labelname.".txt";
}else{
$fpath=caicaicmsroot."/cache/".$siteskin."/dl/".$labelname.".txt";
}
if (cache_update_time!=0 && file_exists($fpath)!==false && time()-filemtime($fpath)<3600*24*cache_update_time){
	return file_get_contents($fpath);
}else{
$fpath=caicaicmsroot."/template/".$siteskin."/label/dlshow/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/dlshow/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$title=$f[0];$b = $f[1];

if ($classzm <> "") {//不为空的情况是嵌套在zsclass中时，接收的大类值。
	$rs=query("select classid from caicaicms_zsclass where classzm='".$classzm."'");
	$row=fetch_array($rs);
	if ($row){
	$b=$row["classid"];//使大类值等于接收到的值
	}
}

$saver = $f[2];$numbers = $f[3];$orderby =$f[4];$titlenum = $f[5];$column = $f[6];$start =$f[7];$mids = $f[8];
$mids = str_replace("show.php?id={#id}", "/dl/show.php?id={#id}",$mids);
if (whtml == "Yes") {$mids = str_replace("/dl/show.php?id={#id}", "/dl/show-{#id}.htm",$mids);}
$ends = $f[9];

if ( $b <> 0) {
$sql = "select id,cp,sendtime,editor,dlsname,city,saver,tel from caicaicms_dl where classid=$b ";
}else{
$sql = "select id,cp,sendtime,editor,dlsname,city,saver,tel from caicaicms_dl where passed<>0 ";
}

if ($saver==1){$sql = $sql . " and saver is not null ";}
//if ( $province !='') {$sql = $sql . " and province='$province' ";}
if ( $orderby == "hit") {$sql =$sql. " order by hit desc";
}elseif ($orderby == "id") {$sql =$sql. " order by id desc";
}elseif ($orderby == "sendtime") {$sql =$sql. " order by sendtime desc";}
$sql =$sql. " limit 0,$numbers ";	
//echo $sql;
$rs=query($sql);
$str="";$xuhao = 1;$n = 1;$mids2='';
while($row=fetch_array($rs)){
	$mids2 = $mids2 . str_replace("{#name}", $row["dlsname"],str_replace("{#n}", $n,str_replace("{#sendtime}", date("Y-m-d",strtotime($row['sendtime'])),str_replace("{#cp}",cutstr($row["cp"],$titlenum),$mids))));
	$mids2=str_replace("{#id}",$row['id'],$mids2);
	$mids2=str_replace("{#mobile}",str_replace(substr($row['tel'],3,4),"****",$row['tel']),$mids2);
	if (strpos($mids,'{#companyname}')!==false || strpos($mids,'{#companyimg}')!==false || strpos($mids,'{#companyimgbig}')!==false){
		$rsn=query("select id,username,img,comane from caicaicms_user where username='".$row['saver']."' ");
		if ($rsn){
		$rown=fetch_array($rsn);
		if (sdomain=="Yes"){$mids2= str_replace("{#zturl}","http://".$rown['username'].".".substr(siteurl,strpos(siteurl,".")+1),$mids2);}
		if (whtml == "Yes") {$mids2 = str_replace("{#zturl}","/zt/show-".$rown['id'].".htm",$mids2);}//需要从company目录转到zt}
		$mids2 = str_replace("{#zturl}","/zt/show.php?id=".$rown['id'],$mids2);//需要从company目录转到zt
		
		$companyname_long=strbetween($mids2,"{#companyname:","}");
		if ($companyname_long!=''){
		$mids2 =str_replace("{#companyname:".$companyname_long."}",cutstr($rown['comane'],$companyname_long),$mids2) ;
		}else{
		$mids2=str_replace("{#companyname}",$rown['comane'],$mids2);
		}
		$mids2=str_replace("{#companyimg}", getsmallimg($rown['img']),$mids2);
		$mids2=str_replace("{#companyimgbig}", $rown['img'],$mids2);
		}else{
		$mids2=str_replace("{#companyname}",'意向公司用户已不存在',$mids2);//不存在时加提示
		}
	}
	$mids2=str_replace("{#city}", cutstr($row["city"],$titlenum),$mids2);
	require(caicaicmsroot.'inc/mid2.php');
$n = $n + 1;
$xuhao++;
}
$str = $start.$mids2.$ends;
if ($mids2==''){$str='暂无信息';}
if (cache_update_time!=0){writecache("dl",$classzm,$labelname,$str);}
return $str;
}//end if file_exists($fpath)==true
}//end if (file_exists($fpath)!==false)
}

function baojiashow($labelname,$classzm){
global $siteskin,$province,$provincezm;//取外部值，供演示模板用,$province在area/show.php中已被转成了汉字，所以加了$provincezm
if (!$siteskin){$siteskin=siteskin;}
if ($classzm!=""){
$fpath=caicaicmsroot."/cache/".$siteskin."/baojia/".$classzm."-".$labelname.".txt";
}elseif($provincezm<>''){
$fpath=caicaicmsroot."/cache/".$siteskin."/baojia/".$provincezm."-".$labelname.".txt";
}else{
$fpath=caicaicmsroot."/cache/".$siteskin."/baojia/".$labelname.".txt";
}
if (cache_update_time!=0 && file_exists($fpath)!==false && time()-filemtime($fpath)<3600*24*cache_update_time){
	return file_get_contents($fpath);
}else{
$fpath=caicaicmsroot."/template/".$siteskin."/label/baojiashow/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/baojiashow/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$title=$f[0];$b = $f[1];

if ($classzm <> "") {//不为空的情况是嵌套在zsclass中时，接收的大类值。
	$rs=query("select classid from caicaicms_zsclass where classzm='".$classzm."'");
	$row=fetch_array($rs);
	if ($row){
	$b=$row["classid"];//使大类值等于接收到的值
	}
}

$numbers = $f[2];$orderby =$f[3];$titlenum = $f[4];$column = $f[5];$start =$f[6];$mids = $f[7];
$mids = str_replace("show.php?id={#id}", "/baojia/show.php?id={#id}",$mids);
if (whtml == "Yes") {$mids = str_replace("/baojia/show.php?id={#id}", "/baojia/show-{#id}.htm",$mids);}
$ends = $f[8];
$sql2='';
	if ( $province !='') {$sql2 = $sql2 . " and province='$province' ";}
	if ( $b !=0) {$sql2 = $sql2 . " and classid='$b' ";}
	if ( $orderby == "hit") {$sql3 = " order by hit desc";
	}elseif ($orderby == "id") {$sql3 = " order by id desc";
	}elseif ($orderby == "sendtime") {$sql3 = " order by sendtime desc";}
	$sql4 = " limit 0,$numbers ";	
$sql = "select id,cp,sendtime,editor,truename,city,price,danwei,tel from caicaicms_baojia where passed<>0 ";
$rs=query($sql.$sql2.$sql3.$sql4);
//echo $sql.$sql2.$sql3.$sql4;
$str="";$xuhao = 1;$n = 1;$mids2='';
while($row=fetch_array($rs)){
	$mids2 = $mids2 . str_replace("{#name}", $row["truename"],str_replace("{#n}", $n,str_replace("{#sendtime}", date("Y-m-d",strtotime($row['sendtime'])),str_replace("{#cp}",cutstr($row["cp"],$titlenum),$mids))));
	$mids2=str_replace("{#id}",$row['id'],$mids2);
	$mids2=str_replace("{#price}",$row['price'],$mids2);
	$mids2=str_replace("{#danwei}",$row['danwei'],$mids2);
	$mids2=str_replace("{#mobile}",str_replace(substr($row['tel'],3,4),"****",$row['tel']),$mids2);
	$mids2=str_replace("{#city}", cutstr($row["city"],$titlenum),$mids2);
	require(caicaicmsroot.'inc/mid2.php');
$n = $n + 1;
$xuhao++;
}
$str = $start.$mids2.$ends;
if ($mids2==''){$str='暂无信息';}
if (cache_update_time!=0){writecache("baojia",$classzm,$labelname,$str);}
return $str;
}//end if file_exists($fpath)==true
}//end if (file_exists($fpath)!==false)
}

function guestbookshow($labelname){
global $siteskin;
if (!$siteskin){$siteskin=siteskin;}
$fpath=caicaicmsroot."/cache/".$siteskin."/guestbook/".$labelname.".txt";
if (cache_update_time!=0 && file_exists($fpath)!==false && time()-filemtime($fpath)<3600*24*cache_update_time){
	return file_get_contents($fpath);
}else{
$fpath=caicaicmsroot."/template/".$siteskin."/label/guestbookshow/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/guestbookshow/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$title=$f[0];$numbers = $f[1];$titlenum = $f[2];$column = $f[3];$start =$f[4];$mids = $f[5];$ends = $f[6];
$sql = "select id,title,content,sendtime,linkmen,phone,email,saver from caicaicms_guestbook where passed<>0 order by id desc limit 0,$numbers ";
$rs=query($sql);
$str="";$xuhao = 1;$n = 1;$mids2='';
while($row=fetch_array($rs)){
	$mids2 = $mids2 . str_replace("{#name}", $row["linkmen"],str_replace("{#n}", $n,str_replace("{#sendtime}", date("Y-m-d",strtotime($row['sendtime'])),str_replace("{#id}", $row["id"],str_replace("{#content}",cutstr($row["content"],$titlenum),$mids)))));
	$mids2=str_replace("{#mobile}",str_replace(substr($row['phone'],3,4),"****",$row['phone']),$mids2);
	if (strpos($mids,'{#companyname}')!==false || strpos($mids,'{#companyimg}')!==false){
	$rsn=query("select id,username,img,comane from caicaicms_user where username='".$row['saver']."' ");
	if ($rsn){
	$rown=fetch_array($rsn);
	if (sdomain=="Yes"){$mids2= str_replace("{#zturl}","http://".$rown['username'].".".substr(siteurl,strpos(siteurl,".")+1),$mids2);}//
	if (whtml == "Yes") {$mids2 = str_replace("{#zturl}","/zt/show-".$rown['id'].".htm",$mids2);}//需要从company目录转到zt}
	$mids2 = str_replace("{#zturl}","/zt/show.php?id=".$rown['id'],$mids2);//需要从company目录转到zt
	
	$companyname_long=strbetween($mids2,"{#companyname:","}");
	if ($companyname_long!=''){
	$mids2 =str_replace("{#companyname:".$companyname_long."}",cutstr($rown['comane'],$companyname_long),$mids2) ;
	}else{
	$mids2=str_replace("{#companyname}",$rown['comane'],$mids2);
	}
	$mids2=str_replace("{#companyimg}", $rown['img'],$mids2);
	}
	}
	require(caicaicmsroot.'inc/mid2.php');
$n = $n + 1;
$xuhao++;
}
$str = $start.$mids2.$ends;
if ($mids2==''){$str='暂无信息';}
if (cache_update_time!=0){writecache("guestbook",'',$labelname,$str);}
return $str;
}//end if file_exists($fpath)==true
}//end if (file_exists($fpath)!==false)
}

function companyshow($labelname,$classid){
global $siteskin,$province,$provincezm;//取外部值，供演示模板用;$province,目前就用在了area/show.php中
if (!$siteskin){$siteskin=siteskin;}
if ($classid!='empty' && $classid!=''){
$fpath=caicaicmsroot."cache/".$siteskin."/company/".$classid."-".$labelname.".txt";
}elseif($provincezm<>''){
$fpath=caicaicmsroot."cache/".$siteskin."/company/".$provincezm."-".$labelname.".txt";
}else{
$fpath=caicaicmsroot."cache/".$siteskin."/company/".$labelname.".txt";
}
if (cache_update_time!=0 && file_exists($fpath)!==false && time()-filemtime($fpath)<3600*24*cache_update_time){
	return file_get_contents($fpath);
}else{
$fpath=caicaicmsroot."/template/".$siteskin."/label/companyshow/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/companyshow/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$title=$f[0];
if ($classid <> ""){$bigclassid = $classid;}else{$bigclassid =$f[1];}
$groupid = $f[2];$pic =$f[3];$flv =$f[4];$elite = $f[5];$numbers = $f[6];$orderby =$f[7];$titlenum = $f[8];$column = $f[9];$start =$f[10];$mids = $f[11];
	if (sdomain=="Yes"){$mids= str_replace("show.php?id={#id}","http://{#username}.".substr(siteurl,strpos(siteurl,".")+1),$mids);}
	$mids = str_replace("show.php?id={#id}", "/zt/show.php?id={#id}",$mids);//需要从company目录转到zt,注意顺序这个要放在上面
	if (whtml == "Yes") {$mids = str_replace("/zt/show.php?id={#id}", "/zt/show-{#id}.htm",$mids);}
$ends = $f[12];
$sql = "select id,comane,regdate,img,flv,content,username from caicaicms_user  where passed=1 and usersf='公司' and comane<>'' and lockuser=0";
	if ($bigclassid<> 0){$sql =$sql . " and bigclassid='" . $bigclassid . "'";}
    if ($groupid <> 0) {$sql = $sql . " and groupid=" . $groupid . "";}
    if ($pic == 1) {$sql = $sql . " and img is not null and img <>'' and img <> '/image/nopic.gif' ";}
	if ($flv == 1) {$sql = $sql . " and flv is not null and flv <>'' ";}
    if ($elite == 1){$sql = $sql . " and elite>0 ";}
    if ($province <>''){$sql = $sql . " and province='$province' ";}
	if ( $orderby == "id") {$sql = $sql . " order by id desc";
	}elseif ($orderby == "lastlogintime") {$sql = $sql . " order by lastlogintime desc";}
	$sql = $sql . " limit 0,$numbers ";
$rs=query($sql);
$str="";$xuhao = 1;$n = 1;$mids2='';
while($r=fetch_array($rs)){
	$mids2 = $mids2 . str_replace("{#sendtime}", $r["regdate"],str_replace("{#content}", cutstr(nohtml(stripfxg($r["content"],true)),$titlenum*4),str_replace("{#imgbig}",$r["img"],str_replace("{#img}",getsmallimg($r["img"]),str_replace("{#title}",cutstr($r["comane"],$titlenum),$mids)))));
	$mids2 =str_replace("{#n}", $n,$mids2);
	$mids2=str_replace("{#id}", $r["id"],$mids2);
	$mids2=str_replace("{#username}", $r["username"],$mids2);
	$mids2=str_replace("{#flv}", $r["flv"],$mids2);
	require(caicaicmsroot.'inc/mid2.php');
$n = $n + 1;
$xuhao++;
}
$str = $start.$mids2.$ends;
if ($mids2==''){$str='暂无信息';}
if (cache_update_time!=0){writecache("company",$classid,$labelname,$str);}
return $str;
}//end if file_exists($fpath)==true
}//end if (file_exists($fpath)!==false)
}

function zhshow($labelname,$classid){
global $siteskin;//取外部值，供演示模板用
if (!$siteskin){$siteskin=siteskin;}
if ($classid!='empty' && $classid!=''){
$fpath=caicaicmsroot."/cache/".$siteskin."/zh/".$classid."-".$labelname.".txt";
}else{
$fpath=caicaicmsroot."/cache/".$siteskin."/zh/".$labelname.".txt";
}
if (cache_update_time!=0 && file_exists($fpath)!==false && time()-filemtime($fpath)<3600*24*cache_update_time){
	return file_get_contents($fpath);
}else{
$fpath=caicaicmsroot."/template/".$siteskin."/label/zhshow/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/zhshow/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$title=$f[0];
if ($classid <> ""){$bigclassid = $classid;}else{$bigclassid = $f[1];}
$elite = $f[2];$numbers = $f[3];$orderby =$f[4];$titlenum = $f[5];$column = $f[6];$start =$f[7];$mids = $f[8];
$mids = str_replace("show.php?id={#id}", "/zh/show.php?id={#id}",$mids);
if (whtml == "Yes") {$mids = str_replace("/zh/show.php?id={#id}", "/zh/show-{#id}.htm",$mids);}
$ends = $f[9];
$sql = "select id,title,sendtime,timestart,timeend,address,editor,elite from caicaicms_zh where passed=1 ";
	if ($bigclassid <> 0) {$sql = $sql . " and bigclassid='" . $bigclassid . "'";}	
	$sql = $sql . " order by elite desc,";
	if ( $orderby == "hit") {$sql = $sql . "hit desc";
	}elseif ($orderby == "id") {$sql = $sql . "id desc";
	}elseif ($orderby = "sendtime") {$sql = $sql . "sendtime desc";}
	$sql = $sql . " limit 0,$numbers ";
$rs=query($sql);
$str="";$xuhao =1;$n = 1;$mids2='';
while($r=fetch_array($rs)){
	$mids2 = $mids2 . str_replace("{#address}", cutstr($r["address"],$titlenum),str_replace("{#n}", $n,str_replace("{#sendtime}", date("Y-m-d",strtotime($r['sendtime'])),str_replace("{#timestart}", date("Y-m-d",strtotime($r["timestart"])),str_replace("{#timeend}",date("Y-m-d",strtotime($r["timeend"])) ,str_replace("{#id}", $r["id"],$mids))))));
	if ($r["elite"]>0){
	$mids2=str_replace("{#title}",cutstr($r["title"],$titlenum)."<img alt='置顶' src='/image/ding.gif' border='0'>",$mids2);
	}else{
	$mids2=str_replace("{#title}",cutstr($r["title"],$titlenum),$mids2);
	}
	require(caicaicmsroot.'inc/mid2.php');
$n = $n + 1;
$xuhao++;
}
$str = $start.$mids2.$ends;
if ($mids2==''){$str='暂无信息';}
if (cache_update_time!=0){writecache("zh",$classid,$labelname,$str);}
return $str;
}//end if file_exists($fpath)==true
}//end if (file_exists($fpath)!==false)
}

function wangkanshow($labelname,$classid){
global $siteskin;//取外部值，供演示模板用
if (!$siteskin){$siteskin=siteskin;}
if ($classid!='empty' && $classid!=''){
$fpath=caicaicmsroot."/cache/".$siteskin."/wangkan/".$classid."-".$labelname.".txt";
}else{
$fpath=caicaicmsroot."/cache/".$siteskin."/wangkan/".$labelname.".txt";
}
if (cache_update_time!=0 && file_exists($fpath)!==false && time()-filemtime($fpath)<3600*24*cache_update_time){
	return file_get_contents($fpath);
}else{
$fpath=caicaicmsroot."/template/".$siteskin."/label/wangkanshow/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/wangkanshow/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$title=$f[0];
if ($classid <> ""){$bigclassid = $classid;}else{$bigclassid = $f[1];}
$elite = $f[2];$numbers = $f[3];$orderby =$f[4];$titlenum = $f[5];$column = $f[6];$start =$f[7];$mids = $f[8];
$mids = str_replace("show.php?id={#id}", "/wangkan/show.php?id={#id}",$mids);
if (whtml == "Yes") {$mids = str_replace("/wangkan/show.php?id={#id}", "/wangkan/show-{#id}.htm",$mids);}
$ends = $f[9];
$sql = "select id,title,img,sendtime,hit,editor,elite from caicaicms_wangkan where passed=1 ";
	if ($bigclassid <> 0) {$sql = $sql . " and bigclassid='" . $bigclassid . "'";}	
	$sql = $sql . " order by elite desc,";
	if ( $orderby == "hit") {$sql = $sql . "hit desc";
	}elseif ($orderby == "id") {$sql = $sql . "id desc";
	}elseif ($orderby = "sendtime") {$sql = $sql . "sendtime desc";}
	$sql = $sql . " limit 0,$numbers ";
$rs=query($sql);
$str="";$xuhao =1;$n = 1;$mids2='';
while($r=fetch_array($rs)){
	$mids2 = $mids2 . str_replace("{#n}", $n,str_replace("{#sendtime}", date("Y-m-d",strtotime($r['sendtime'])),str_replace("{#id}", $r["id"],$mids)));
	if ($r["elite"]>0){
	$mids2=str_replace("{#title}",cutstr($r["title"],$titlenum)."<img alt='置顶' src='/image/ding.gif' border='0'>",$mids2);
	}else{
	$mids2=str_replace("{#title}",cutstr($r["title"],$titlenum),$mids2);
	}
	$mids2=str_replace("{#imgbig}",$r["img"],$mids2);
	$mids2=str_replace("{#img}",getsmallimg($r["img"]),$mids2);
	$mids2=str_replace("{#hit}",$r["hit"],$mids2);
	require(caicaicmsroot.'inc/mid2.php');
$n = $n + 1;
$xuhao++;
}
$str = $start.$mids2.$ends;
if ($mids2==''){$str='暂无信息';}

if (cache_update_time!=0){writecache("wangkan",$classid,$labelname,$str);}
return $str;
}//end if file_exists($fpath)==true
}//end if (file_exists($fpath)!==false)
}

function zxshow($labelname,$bid,$sid){
global $siteskin,$b;//取外部值，供演示模板用,这里的$b为了接收zsclass下大类值
if (!$siteskin){$siteskin=siteskin;}
if ($sid!=0){
$fpath=caicaicmsroot."/cache/".$siteskin."/zx/".$bid."-".$sid."-".$labelname.".txt";
}elseif ($bid!='empty' && $bid!=''){
$fpath=caicaicmsroot."/cache/".$siteskin."/zx/".$bid."-".$labelname.".txt";
}else{
$fpath=caicaicmsroot."/cache/".$siteskin."/zx/".$labelname.".txt";
}
if (cache_update_time!=0 && file_exists($fpath)!==false && time()-filemtime($fpath)<3600*24*cache_update_time){
	return file_get_contents($fpath);
}else{
$fpath=caicaicmsroot."/template/".$siteskin."/label/zxshow/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/zxshow/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$title=$f[0];
if ($bid <> "") {$bid = $bid;}else{$bid= $f[1];}
if ($sid <> 0) {$sid = $sid;}else{$sid = $f[2];}
$pic =$f[3];$elite = $f[4];$numbers = $f[5];$orderby =$f[6];$titlenum = $f[7];$cnum = $f[8];$column = $f[9];$start =$f[10];$mids = $f[11];
$mids = str_replace("show.php?id={#id}", "/zx/show.php?id={#id}",$mids);
	if (whtml == "Yes") {
	$mids = str_replace("/zx/show.php?id={#id}", "/zx/show-{#id}.htm",$mids);
	$mids = str_replace("/zx/zx.php?b={#bigclassid}&s={#smallclassid}","/zx/{#bigclassid}/{#smallclassid}",$mids);
	$mids = str_replace("/zx/zx.php?b={#bigclassid}","/zx/{#bigclassid}",$mids);
	}
$ends = $f[12];
$sql = "select id,bigclassid,bigclassname,smallclassid,smallclassname,title,link,sendtime,img,editor,hit,content,elite from caicaicms_zx where passed=1 ";
if ($b<>'' && is_numeric($b)==false){//接收的zsclass大类值
	$sql2="select classname from caicaicms_zsclass where classzm='".$b."'";
	$rs2=query($sql2);
	$row2=fetch_array($rs2);
	$classname='';
	if ($row2){
	$classname=$row2["classname"];
	}
	$bid = $classname;//大类用外部的值，把类别字母转换为类别名称
 	$sql = $sql . " and bigclassname='".$bid."' ";
	if ($sid<>'empty'){
	$sql = $sql . " and smallclassid='".$sid."' ";//小类不为空时，调用小类，用于zsclass下显示同名大类资讯下的小类资讯
	}
}else{
	if ($bid == 0) {//当大类为0时，取所有显示大类的信息
	$sql = $sql . "and bigclassid in (select classid from caicaicms_zxclass where isshow=1 and parentid=0) ";
	}else{
    	if ($bid <> 0) {$sql = $sql . " and bigclassid='".$bid."'";}
    	if ($sid <> 0) {$sql = $sql . " and smallclassid='".$sid."'";}
	}
}	
 	if ($pic == 1) {$sql = $sql . " and img is not null and img <>''";}
    if ($elite == 1){$sql = $sql . " and elite>0";}
	//$sql = $sql . " order by elite desc,";
	$sql = $sql . " order by ";
	if ( $orderby == "hit") {$sql = $sql . "hit desc";
	}elseif ($orderby == "id") {$sql = $sql . "id desc";
	}elseif ($orderby = "timefororder") {$sql = $sql . "sendtime desc";}
	$sql = $sql . " limit 0,$numbers ";
//echo $sql ."<br>";
$rs=query($sql);
$str = ''; $n = 1;$xuhao = 1;$mids2='';
while($r=fetch_array($rs)){
	if ($r["img"] <> ""){
    $mids2=$mids2.str_replace('{#img}',getsmallimg($r["img"]),str_replace("{#imgbig}", $r["img"],$mids)); 
    }else{
    $mids2=$mids2.str_replace("{#img}","",str_replace("{#imgbig}", "",$mids));
	}
	if ($r["link"]<>''){//当为外链时
		if (whtml=="Yes"){
		$mids2=str_replace("/zx/show-{#id}.htm", addhttp($r["link"]),$mids2);
		}else{
		$mids2=str_replace("/zx/show.php?id={#id}",addhttp($r["link"]),$mids2);
		}
	}
	$mids2=str_replace("{#bigclassname}", $r["bigclassname"],str_replace("{#bigclassid}", $r["bigclassid"],$mids2));
	$mids2=str_replace("{#sendtime}", date("Y-m-d",strtotime($r['sendtime'])),$mids2);
	$mids2=str_replace("{#content}", cutstr(nohtml(stripfxg($r["content"],true)),$cnum),$mids2);
	$mids2=str_replace("{#smallclassid}", $r["smallclassid"],$mids2);
	$mids2=str_replace("{#smallclassname}", $r["smallclassname"],$mids2);
	$mids2=str_replace("{#hit}", $r["hit"],$mids2);
	$mids2=str_replace("{#id}", $r["id"],$mids2);
	$mids2=str_replace("{#n}", $n,$mids2);
	$mids2=str_replace("{#title}",cutstr($r["title"],$titlenum),$mids2);
	//if ($r["elite"]>0){
	//$mids2 =str_replace("{#title}" ,cutstr($r["title"],$titlenum)."<img alt='置顶' src='/image/ding.gif' border='0'>",$mids2) ;
	//}else{
	//$mids2 =str_replace("{#title}" ,cutstr($r["title"],$titlenum),$mids2) ;
	//}
	require(caicaicmsroot.'inc/mid2.php');
$n = $n + 1;
$xuhao++;
}
$str = $start.$mids2.$ends;
if ($mids2==''){$str='暂无信息';}
if (cache_update_time!=0){
	if ($sid!=0){
	$fpath=caicaicmsroot."cache/".$siteskin."/zx/".$bid."-".$sid."-".$labelname.".txt";
	}elseif ($bid!='empty' && $bid!=''){
	$fpath=caicaicmsroot."cache/".$siteskin."/zx/".$bid."-".$labelname.".txt";
	}else{
	$fpath=caicaicmsroot."cache/".$siteskin."/zx/".$labelname.".txt";
	}
	if (!file_exists(caicaicmsroot."cache/".$siteskin."/zx")) {mkdir(caicaicmsroot."cache/".$siteskin."/zx",0777,true);}
	$fp=fopen($fpath,"w+");//fopen()的其它开关请参看相关函数
	fputs($fp,stripfxg($str));//写入文件
	fclose($fp);
}
return $str;
}//end if file_exists($fpath)==true
}//end if (file_exists($fpath)!==false)
}

function specialshow($labelname,$bid,$sid){
global $siteskin,$b;//取外部值，供演示模板用,这里的$b为了接收zsclass下大类值
if (!$siteskin){$siteskin=siteskin;}
if ($sid!=0){
$fpath=caicaicmsroot."/cache/special/".$bid."-".$sid."-".$labelname.".txt";
}elseif ($bid!='empty' && $bid!=''){
$fpath=caicaicmsroot."/cache/special/".$bid."-".$labelname.".txt";
}else{
$fpath=caicaicmsroot."/cache/special/".$labelname.".txt";
}
if (cache_update_time!=0 && file_exists($fpath)!==false && time()-filemtime($fpath)<3600*24*cache_update_time){
	return file_get_contents($fpath);
}else{
$fpath=caicaicmsroot."/template/".$siteskin."/label/specialshow/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/specialshow/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$title=$f[0];
if ($b){//自动获取外部大类值的情况
$bid = $b;//大类用外部的值
if ($sid<>''){$sid = $sid;}else{$sid = $f[2];}//小类用指定的类别名，自动根据大类参数调用相应大类下的小类，小类名要相同
}elseif($bid<>0){//嵌套在specialclass内的情况
$bid=$bid;
}else{//直接使用标签内的值
$bid = $f[1];$sid = $f[2];
}
$pic =$f[3];$elite = $f[4];$numbers = $f[5];$orderby =$f[6];$titlenum = $f[7];$cnum = $f[8];$column = $f[9];$start =$f[10];$mids = $f[11];
$mids = str_replace("show.php?id={#id}", "/special/show.php?id={#id}",$mids);
	if (whtml == "Yes") {
	$mids = str_replace("/special/show.php?id={#id}", "/special/show-{#id}.htm",$mids);
	$mids = str_replace("class.php?b={#bigclassid}","/special/class/{#bigclassid}",$mids);
	$mids = str_replace("special.php?b={#bigclassid}&s={#smallclassid}","/special/{#bigclassid}/{#smallclassid}",$mids);
	$mids = str_replace("special.php?b={#bigclassid}","/special/{#bigclassid}",$mids);
	}
$ends = $f[12];
$sql = "select id,bigclassid,bigclassname,smallclassid,smallclassname,title,link,sendtime,img,editor,hit,content,elite from caicaicms_special where passed=1 ";
	if ($bid == 0) {//当大类为0时，取所有显示大类,小类的信息
	$sql = $sql . "and bigclassid in (select classid from caicaicms_specialclass where isshow=1)  ";
	}else{
    	if ($bid <> 0) {$sql = $sql . " and bigclassid='".$bid."'";}
    	if ($sid <> '' && $sid <>'empty') {//这里是按小类名取值的，显示不同大类，但小类名相同的信息，如按ID不能达到这种效果，原理同广告调用。
    	$sql = $sql . " and smallclassname='".$sid."'";
		}
	}
 	if ($pic == 1) {$sql = $sql . " and img is not null and img <>''";}
    if ($elite == 1){$sql = $sql . " and elite>0";}
	$sql = $sql . " order by ";
	if ( $orderby == "hit") {$sql = $sql . "hit desc";
	}elseif ($orderby == "id") {$sql = $sql . "id desc";
	}elseif ($orderby = "timefororder") {$sql = $sql . "sendtime desc";}
	$sql = $sql . " limit 0,$numbers ";
//echo $sql ."<br>"; 
$rs=query($sql);
$str="";$n = 1;$xuhao = 1;$mids2='';
while($r=fetch_array($rs)){
	if ($r["img"] <> ""){
    $mids2=$mids2.str_replace('{#img}',getsmallimg($r["img"]),str_replace("{#imgbig}", $r["img"],$mids));  
    }else{
    $mids2=$mids2.str_replace("{#img}","",str_replace("{#imgbig}", "",$mids));
	}
	if ($r["link"]<>''){//当为外链时
		if (whtml=="Yes"){
		$mids2=str_replace("/special/show-{#id}.htm",$r["link"],$mids2);
		}else{
		$mids2=str_replace("/special/show.php?id={#id}",$r["link"],$mids2);
		}
	}
	$mids2=str_replace("{#bigclassname}", $r["bigclassname"],str_replace("{#bigclassid}", $r["bigclassid"],$mids2));
	$mids2=str_replace("{#sendtime}", date("Y-m-d",strtotime($r['sendtime'])),$mids2);
	$mids2=str_replace("{#content}", cutstr(nohtml($r["content"]),$cnum),$mids2);
	$mids2=str_replace("{#smallclassid}", $r["smallclassid"],$mids2);
	$mids2=str_replace("{#smallclassname}", $r["smallclassname"],$mids2);
	$mids2=str_replace("{#hit}", $r["hit"],$mids2);
	$mids2=str_replace("{#id}", $r["id"],$mids2);
	$mids2=str_replace("{#n}", $n,$mids2);
	$mids2=str_replace("{#title}",cutstr($r["title"],$titlenum),$mids2);
	require(caicaicmsroot.'inc/mid2.php');
$n = $n + 1;
$xuhao++;
}
$str = $start.$mids2.$ends;
if ($mids2==''){$str='暂无信息';}
if (cache_update_time!=0){
	if ($sid!=0){
	$fpath=caicaicmsroot."cache/".$siteskin."/special/".$bid."-".$sid."-".$labelname.".txt";
	}elseif ($bid!='empty' && $bid!=''){
	$fpath=caicaicmsroot."cache/".$siteskin."/special/".$bid."-".$labelname.".txt";
	}else{
	$fpath=caicaicmsroot."cache/".$siteskin."/special/".$labelname.".txt";
	}
	if (!file_exists(caicaicmsroot."cache/".$siteskin."/special")) {mkdir(caicaicmsroot."cache/".$siteskin."/special",0777,true);}
	$fp=fopen($fpath,"w+");//fopen()的其它开关请参看相关函数
	fputs($fp,stripfxg($str));//写入文件
	fclose($fp);
}
return $str;
}//end if file_exists($fpath)==true
}//end if (file_exists($fpath)!==false)
}

function askshow($labelname,$bid,$sid){
global $siteskin;//取外部值，供演示模板用,
if (!$siteskin){$siteskin=siteskin;}
if ($sid!=0){
$fpath=caicaicmsroot."/cache/ask/".$bid."-".$sid."-".$labelname.".txt";
}elseif ($bid!='empty' && $bid!=''){
$fpath=caicaicmsroot."/cache/ask/".$bid."-".$labelname.".txt";
}else{
$fpath=caicaicmsroot."/cache/ask/".$labelname.".txt";
}
if (cache_update_time!=0 && file_exists($fpath)!==false && time()-filemtime($fpath)<3600*24*cache_update_time){
	return file_get_contents($fpath);
}else{
$fpath=caicaicmsroot."/template/".$siteskin."/label/askshow/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/askshow/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$title=$f[0];$bid = $f[1];$sid = $f[2];
$pic =$f[3];$elite = $f[4];$typeid = $f[5];$numbers = $f[6];$orderby =$f[7];$titlenum = $f[8];$cnum = $f[9];$column = $f[10];$start =$f[11];$mids = $f[12];
$mids = str_replace("show.php?id={#id}", "/ask/show.php?id={#id}",$mids);
	if (whtml == "Yes") {
	$mids = str_replace("/ask/show.php?id={#id}", "/ask/show-{#id}.htm",$mids);
	$mids = str_replace("class.php?b={#bigclassid}","/ask/class/{#bigclassid}",$mids);
	$mids = str_replace("ask.php?b={#bigclassid}&s={#smallclassid}","/ask/{#bigclassid}/{#smallclassid}",$mids);
	$mids = str_replace("ask.php?b={#bigclassid}","/ask/{#bigclassid}",$mids);
	}
$ends = $f[13];
$sql = "select * from caicaicms_ask where passed=1 ";
	if ($bid == 0) {//当大类为0时，取所有显示大类,小类的信息
		$sql = $sql . "and bigclassid in (select classid from caicaicms_askclass where isshow=1)  ";
	}else{
    	if ($bid <> 0) {$sql = $sql . " and bigclassid='".$bid."'";}
    	if ($sid <> 0) {$sql = $sql . " and smallclassid='".$sid."'";}
	}
 	if ($pic == 1) {$sql = $sql . " and img is not null and img <>''";}
    if ($elite == 1){$sql = $sql . " and elite>0";}
	if ($typeid != 999){$sql = $sql . " and typeid='".$typeid."' ";}
	$sql = $sql . " order by ";
	if ( $orderby == "hit") {$sql = $sql . "hit desc";
	}elseif ($orderby == "id") {$sql = $sql . "id desc";
	}elseif ($orderby = "timefororder") {$sql = $sql . "sendtime desc";}
	$sql = $sql . " limit 0,$numbers ";
//echo $sql ."<br>";
$rs=query($sql);
$str=""; $n = 1;$xuhao = 1;$mids2='';
while($r=fetch_array($rs)){
	if ($r["img"] <> ""){
    $mids2=$mids2.str_replace('{#img}',getsmallimg($r["img"]),str_replace("{#imgbig}", $r["img"],$mids));  
    }else{
    $mids2=$mids2.str_replace("{#img}","",str_replace("{#imgbig}", "",$mids));
	}
	$mids2=str_replace("{#bigclassid}", $r["bigclassid"],$mids2);
	$mids2=str_replace("{#sendtime}", date("Y-m-d",strtotime($r['sendtime'])),$mids2);
	$mids2=str_replace("{#content}", cutstr(nohtml($r["content"]),$cnum),$mids2);
	$mids2=str_replace("{#smallclassid}", $r["smallclassid"],$mids2);
	$mids2=str_replace("{#hit}", $r["hit"],$mids2);
	$mids2=str_replace("{#id}", $r["id"],$mids2);
	$mids2=str_replace("{#n}", $n,$mids2);
	$mids2=str_replace("{#title}",cutstr($r["title"],$titlenum),$mids2);
	
	$rs_answer_num = query("select count(*) as total from caicaicms_answer where about='".$r["id"]."' ");
	$row_answer_num = fetch_array($rs_answer_num);
	$answer_num = $row_answer_num['total'];
	$mids2=str_replace("{#answer_num}", $answer_num,$mids2);
	
	$zhuangtai_biaozhi='';
	if ($r["typeid"]==1){
	$zhuangtai_biaozhi="<img src='/image/dui2.png' title='已解决'>";
	}elseif ($r["typeid"]==0){
	$zhuangtai_biaozhi="<img src='/image/wenhao.png' title='待解决'>";
	}
	
	$mids2=str_replace("{#zhuangtai}", $zhuangtai_biaozhi,$mids2);
	require(caicaicmsroot.'inc/mid2.php');
$n = $n + 1;
$xuhao++;
}
$str = $start.$mids2.$ends;
if ($mids2==''){$str='暂无信息';}
if (cache_update_time!=0){
	if ($sid!=0){
	$fpath=caicaicmsroot."cache/".$siteskin."/ask/".$bid."-".$sid."-".$labelname.".txt";
	}elseif ($bid!='empty' && $bid!=''){
	$fpath=caicaicmsroot."cache/".$siteskin."/ask/".$bid."-".$labelname.".txt";
	}else{
	$fpath=caicaicmsroot."cache/".$siteskin."/ask/".$labelname.".txt";
	}
	if (!file_exists(caicaicmsroot."cache/".$siteskin."/ask")) {mkdir(caicaicmsroot."cache/".$siteskin."/ask",0777,true);}
	$fp=fopen($fpath,"w+");//fopen()的其它开关请参看相关函数
	fputs($fp,stripfxg($str));//写入文件
	fclose($fp);
}
return $str;
}//end if file_exists($fpath)==true
}//end if (file_exists($fpath)!==false)
}

function helpshow($labelname){
global $siteskin;//取外部值，供演示模板用
if (!$siteskin){$siteskin=siteskin;}
$fpath=caicaicmsroot."/template/".$siteskin."/label/helpshow/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/helpshow/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$title=$f[0];$elite = $f[1];$numbers = $f[2];$orderby =$f[3];$titlenum = $f[4];$cnum = $f[5];$column = $f[6];$start =$f[7];$mids = $f[8];
$mids = str_replace("help.php#{#id}", "/one/help.php#{#id}",$mids);
if (whtml == "Yes") {$mids = str_replace("/one/help.php#{#id}", "/help.htm#{#id}",$mids);}
$ends = $f[9];
$sql = "select id,title,sendtime,img,content,elite from caicaicms_help where classid=1";
    if ($elite == 1){$sql = $sql . " and elite>0";}
	$sql = $sql . " order by ";
	if ($orderby == "id") {$sql = $sql . "id desc";
	}elseif ($orderby = "timefororder") {$sql = $sql . "sendtime desc";}
	$sql = $sql . " limit 0,$numbers ";
//echo $sql ."<br>"; 
$rs=query($sql);
$str="";$n = 1;$xuhao = 1;$mids2='';
while($r=fetch_array($rs)){
	if ($r["img"] <> ""){
    $mids2=$mids2.str_replace('{#img}',getsmallimg($r["img"]),str_replace("{#imgbig}", $r["img"],$mids)); 
    }else{
    $mids2=$mids2.str_replace("{#img}","",str_replace("{#imgbig}", "",$mids));
	}
	$mids2=str_replace("{#sendtime}", date("Y-m-d",strtotime($r['sendtime'])),$mids2);
	if ($cnum==0){
	$mids2=str_replace("{#content}",stripfxg($r["content"],true),$mids2);
	}else{
	$mids2=str_replace("{#content}", cutstr(nohtml($r["content"]),$cnum),$mids2);
	}
	$mids2=str_replace("{#id}", $r["id"],$mids2);
	$mids2=str_replace("{#n}", $n,$mids2);
	$mids2=str_replace("{#title}",cutstr($r["title"],$titlenum),$mids2);
	require(caicaicmsroot.'inc/mid2.php');
$n = $n + 1;
$xuhao++;
}
$str = $start.$mids2.$ends;
if ($mids2==''){$str='暂无信息';}
return $str;
}
}

function linkshow($labelname,$classid){
global $siteskin;//取外部值，供演示模板用
if (!$siteskin){$siteskin=siteskin;}
$fpath=caicaicmsroot."/template/".$siteskin."/label/linkshow/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/linkshow/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$title=$f[0];
if ($classid<>""){$bigclassid=$classid;}else{$bigclassid=$f[1];}
$pic =$f[2];$elite = $f[3];$numbers = $f[4];$titlenum = $f[5];$column = $f[6];$start=$f[7];$mids = $f[8];$ends = $f[9];
$sql = "select * from caicaicms_link where passed=1 ";
if ($bigclassid <> 0 ){$sql = $sql ." and bigclassid='" . $bigclassid . "'";}
if ($pic == 1) {$sql = $sql . " and logo is not null and logo <>''";}
if ($elite == 1){$sql = $sql . " and elite>0";}
$sql = $sql . " limit 0,$numbers ";
$rs=query($sql);
$str="";$mids2 ='';$n = 1;$xuhao=1;
while($r=fetch_array($rs)){
	$mids2 = $mids2 . str_replace("{#url}",addhttp($r["url"]),str_replace("{#logo}", $r["logo"],str_replace("{#sitename}",cutstr($r["sitename"],$titlenum),$mids)));
	require(caicaicmsroot.'inc/mid2.php');
$n = $n + 1;
$xuhao++;
}
$str = $start.$mids2.$ends;
if ($mids2==''){$str='暂无信息';}
return $str;
}
}

function adclass($labelname){
global $siteskin;
if (!$siteskin){$siteskin=siteskin;}
$fpath=caicaicmsroot."/template/".$siteskin."/label/adclass/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/adclass/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$b = $f[1];$numbers = $f[2];$column = $f[3];$start = $f[4];$mids = $f[5];$ends = $f[6];
$sql ="select * from caicaicms_adclass where  parentid='".$b."' order by xuhao limit 0,$numbers ";
$rs=query($sql);
$str="";$i = 1;$mids3='';$mylabel1="";$mylabel2="";
if (count(explode("{@adshow.",$mids))==2) {
	$mylabel1=strbetween($mids,"{@adshow.","}");
}
if (count(explode("{@adshow.",$mids))==3) {
	$mylabel1=strbetween($mids,"{@adshow.","}");
	$mids2 = str_replace("{@adshow." . $mylabel1 . "}", "",$mids); //把第一个标签换空,方可找出第二个标签
	$mylabel2=strbetween($mids2,"{@adshow.","}");
}
//echo $mylabel2;
while($r=fetch_array($rs)){
if ($b<>""){//父类不为空，调出的classid为小类
$mids3=$mids3.str_replace("{@adshow." . $mylabel1 . "}", adshow($mylabel1,$b,$r["classname"]),$mids);//注意这里用首次替换已把$mids赋值给$mids3了，	
$mids3=str_replace("{@adshow." . $mylabel2 . "}", adshow($mylabel2,$b,$r["classname"]),$mids3);//这里替换$mids3里的内容
$mids3=str_replace("{#classname}",$r["classname"],$mids3);
}
	if ($column <> "" && $column > 0){
		if ($i % $column == 0) {$mids3 = $mids3 . "</tr>";}
	}
$i = $i + 1;
}
$str = $start .$mids3. $ends;
if ($mids3==''){$str='暂无信息';}
return $str;
}
}

function adshow($labelname,$bid,$sid){
global $siteskin,$b;//取外部值，供演示模板用
if (!$siteskin){$siteskin=siteskin;}
$fpath=caicaicmsroot."/template/".$siteskin."/label/adshow/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/adshow/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$title=$f[0];
if ($b){//自动获取外部大类值的情况
$sql="select classname from caicaicms_zsclass where classzm='".$b."'";
$rs=query($sql);
$row=fetch_array($rs);
$classname='';	
if ($row){$classname=$row["classname"];}
if ($f[1]=='首页'){
$bid = '首页';//当大类为首页时在所有内页中都显示
}else{
$bid = $classname;//大类用外部的值，把类别字母转换为类别名称
}
$sid = $f[2];//小类用指定的类别名，用户招商分类页，自动根据大类参数调用相应大类下的小类，小类名要相同
}elseif ($bid <> "" && $sid<>""){//套在adclass里面使用时
$bid = $bid;$sid = $sid;
}else{
$bid = $f[1];$sid = $f[2];
}
$numbers = $f[3];$titlenum = $f[4];$column = $f[5];$start =$f[6];$mids = $f[7];$ends = $f[8];
$sql= "select * from caicaicms_ad where bigclassname='".$bid."' and smallclassname='".$sid."' ";
if (isshowad_when_timeend=="No"){
$sql=$sql. "and endtime>= '".date('Y-m-d H:i:s')."' ";
}
$sql=$sql. "order by xuhao asc,id asc";
//echo $sql;
$rs=query($sql);
$str="";$mids2='';$n = 1;
while($r=fetch_array($rs)){
$mids2 =$mids2 .str_replace("{#link}", addhttp($r["link"]),str_replace("{#n}", addzero($n,2),str_replace("{#title}",cutstr($r["title"],$titlenum),$mids)));
	$mids2 =str_replace("{#titlecolor}",$r["titlecolor"],$mids2);
	if (($n + 4) % 8 == 0 || ($n + 5) % 8 == 0 ||  ($n + 6) % 8 == 0 ||  ($n + 7) % 8 == 0){
	$mids2 =str_replace("{#style}","textad1",$mids2);
	}else{
	$mids2 =str_replace("{#style}","textad2",$mids2);
	}
	if (strpos($labelname,"flash")!==false || strpos($labelname,"Flash")!==false){//没有加新参数，命名时焦点广告名里要有flash
	//焦点flash不支持远程，只能用相对路经，这样才能同时在www.或是没有www.两种域名下显示
	$mids2 = str_replace("{#img}",$r["img"],$mids2);
	}else{
	$mids2 = str_replace("{#img}",siteurl.$r["img"],$mids2);//当展厅开二级域名的情况下，前面必须得加网址
	}
	if ( $column <> "" && $column >0) {
		if ( $n % $column == 0) {$mids2 = $mids2 . "</tr>";}
	}
	$mids2 = $mids2 . "\r\n";
$n = $n + 1;
}
$str = $start.$mids2.$ends;
if ($mids2==''){$str='暂无信息';}
return $str;
}
}

function aboutshow($labelname){
global $siteskin;//取外部值，供演示模板用
if (!$siteskin){$siteskin=siteskin;}
$fpath=caicaicmsroot."cache/".$siteskin."/about/".$labelname.".txt";
if (cache_update_time!=0 && file_exists($fpath)!==false && time()-filemtime($fpath)<3600*24*cache_update_time){
	return file_get_contents($fpath);
}else{
$fpath=caicaicmsroot."template/".$siteskin."/label/aboutshow/".$labelname.".txt";
if (file_exists($fpath)==true){
if (filesize($fpath)<10){ showmsg(caicaicmsroot."template/".$siteskin."/label/aboutshow/".$labelname.".txt 内容为空");}//utf-8有文件头，空文件大小为3字节
$fcontent=file_get_contents($fpath);
$f=explode("|||",$fcontent) ;
$title=$f[0];$id=$f[1];$titlenum = $f[2];$contentnum = $f[3];$column = $f[4];$start =$f[5];$mids = $f[6];$ends = $f[7];
$sql = "select * from caicaicms_about  ";
if ($id <> 0 ){$sql = $sql ."where id='" . $id . "'";}
$sql = $sql ." order by id asc";
//echo $sql;
$rs=query($sql);
$str="";$mids2 ='';$n = 1;
while($r=fetch_array($rs)){
	$mids2 = $mids2 . str_replace("{#title}",cutstr($r["title"],$titlenum),$mids);
	$mids2=str_replace("{#content}", cutstr(stripfxg($r["content"],true),$contentnum),$mids2);
	if ( $column <> "" && $column >0) {
		if ( $n % $column == 0) {$mids2 = $mids2 . "</tr>";}
	}
	$mids2 = $mids2 . "\r\n";
$n = $n + 1;
}
$str = $start.$mids2.$ends;
if ($mids2==''){$str='暂无信息';}
if (cache_update_time!=0){writecache("about",'',$labelname,$str);}
return $str;
}//end if file_exists($fpath)==true
}//end if (cache_update_time!=0 && file_exists($fpath)!==false && time()-filemtime($fpath)<3600*24*cache_update_time)
}
?>