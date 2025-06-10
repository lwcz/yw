<?php
//==================================================
//$key='// 版本 2020 Powered by 小仙源码网-www.wudiliu.com';
$key='// 版本 2021 Powered by 小仙源码网 www.wudiliu.com';
//==================================================
error_reporting(0);
ini_set('date.timezone','Asia/Shanghai');
date_default_timezone_set ( 'PRC' );//时区
header("Content-type:text/html;charset=utf-8"); 
$gmcode = '2020';  //GM码
$AM_CONFIG = array(
	"gmkey"	=>"2f436c37dda015cde62e7235caae61f6",
	"sa" => "%2F%2F%2B%E7%89%88%E6%9C%AC%2B2021%2BPowered%2Bby%2B%E5%B0%8F%E4%BB%99%E6%BA%90%E7%A0%81%E7%BD%91%2Bwww.wudiliu.com",
	"db_host" => "127.0.0.1",          //数据库IP
	"db_username" => "root",			//数据库帐号
	"db_password" => "www.wudiliu.com",		//数据库密码
	"dbport" => 3306,
	"dbgame" => "gamedata"    //数据库
	);	
$user_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
$user_IP = ($user_IP) ? $user_IP : $_SERVER["REMOTE_ADDR"];	
$checknum =	$_POST['checknum'];
$qu  = $_POST['qu'];
$date=date('Y-m-d H:i:s');
if(isset($_POST['submit'])){
if(md5($key)==$AM_CONFIG['gmkey']){ if($checknum==$gmcode){
	if(empty($qu)){
		echo "<script>alert('请选择分区');history.go(-1)</script>";
		exit;
	}
	$mysqli=new mysqli($AM_CONFIG['db_host'],$AM_CONFIG['db_username'],$AM_CONFIG['db_password'],$AM_CONFIG['dbgame'],$AM_CONFIG['dbport']);
    if($mysqli->connect_error){
        exit("数据库连接失败,请检查配置是否正确!");
    }
    if (!$mysqli->set_charset("Latin1")) {
        printf("设置数据库编码Latin1错误: %s\n", $mysqli->error);
        exit();
    }
	$name=trim($_POST['name']);				
	$chargenum = $_POST['chargenum'];
		if(empty($chargenum)){
			echo "<script>alert('数量为空');history.go(-1)</script>";
			exit;
		}
	$log='charge'.date('Y-m-d').'.log';	
	// rem QQ436043762一阵风 2019-11-12 12:50
    $sql1 = "select ActiveParam,AwardCodeType,AwardCode from awardcodes where AwardCode = CONVERT(unhex(HEX(CONVERT(CONVERT(unhex('".bin2hex($name)."') USING utf8) USING gbk))) USING latin1)";
    $result1 = $mysqli->query($sql1);
    if(!$result1)
    {
        exit("执行sql失败:1");
    }else{
        if($result1->num_rows==0){
            $sql = "INSERT INTO awardcodes (AwardCode,AwardCodeType,ActiveParam) VALUES (CONVERT(unhex(HEX(CONVERT(CONVERT( unhex('".bin2hex($name)."') USING utf8) USING gbk))) USING latin1),".$chargenum.",1)";
        }else{
            $row=mysqli_fetch_assoc($result1);
            if($row['ActiveParam']=="-1"){
                $sql = "UPDATE awardcodes SET AwardCodeType = ".$chargenum.",ActiveParam=1 WHERE AwardCode = CONVERT(unhex(HEX(CONVERT(CONVERT( unhex('".bin2hex($name)."') USING utf8) USING gbk))) USING latin1)"; 
            }else{
                $sql = "UPDATE awardcodes SET AwardCodeType =AwardCodeType+".$chargenum." WHERE AwardCode = CONVERT(unhex(HEX(CONVERT(CONVERT( unhex('".bin2hex($name)."') USING utf8) USING gbk))) USING latin1)"; 
            }
        }
        $result = $mysqli->query($sql);
        if(!$result)
        {
            exit("执行sql失败:2");
        }else{          
		   file_put_contents($log,$date."\t".$qu."区 \t"."玩家:".$name."\t".$chargenum."\t"."充值成功\t".$user_IP.PHP_EOL,FILE_APPEND);
		   echo "<script>alert('充值成功');history.go(-1)</script>" ;
		   exit;
        }
    }
	}
	echo   "<script>alert('GM码错误');history.go(-1)</script>" ;
	exit;
	}
	$eff = urldecode($AM_CONFIG['sa']);
	echo "<script>alert('$eff');history.go(-1)</script>" ;
	exit;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>战神传奇充值后台</title>
<style>
	/*美化：晴天  QQ：3093320633*/
	body{background-color:#0d0033;}
	
	#div000{
		background-color:#372f5d;
		width:260px;
		height:260px;
		position:relative;
		margin:auto;
		top:50px;
		border-radius:8px 8px 8px 8px;
	}
	
	#input000{
		background-color:#ffffff;
		border:none;
		width:160px;
		height:26px;
		border-radius:2px 2px 2px 2px;
		position: absolute;
		top:50px;
		left:50px;
	}
	
	#select000{
		border:none;
		background-color:#ffffff;
		color:#0d0033;
		width:160px;
		height:26px;
		border-radius:2px 2px 2px 2px;		
		position: absolute;
		top:80px;
		left:50px;
	}
	
	#input001{
		border:none;
		background-color:#ffffff;
		color:#0d0033;
		width:160px;
		height:26px;
		border-radius:2px 2px 2px 2px;		
		position: absolute;
		top:110px;		
		left:50px;
	}
	
	#input002{
		border:none;
		background-color:#ffffff;
		color:#0d0033;
		width:160px;
		height:26px;
		border-radius:2px 2px 2px 2px;		
		position: absolute;
		top:140px;		
		left:50px;
	}	
	#input003{
		border:none;
		background-color:#4CAF50;
		color:#0d0033;
		font-size:20px;
		width:160px;
		height:26px;
		border-radius:2px 2px 2px 2px;		
		position: absolute;
		top:170px;		
		left:50px;
		margin:auto;
	}	
	#h000{
		background-color:#8b0a37;
		width:100%;
		height:40px;
		border-radius:8px 8px 0px 0px;
		font-size:22px;
		text-shadow: 0px 2px 3px #0d0033;
		display:block;
		line-height:40px;
		text-align:center;

	}
	#h001{
		background-color:#8b0a37;
		width:100px;
		height:20px;
		border-radius:8px 8px 8px 8px;
		font-size:12px;
		text-shadow: 0px 1px 1px #FF83FA;
		display:block;
		line-height:20px;
		text-align:center;
		position: absolute;
		top:200px;		
		left:80px;

	}
	#h002{
		background-color:#8b0a37;
		width:100px;
		height:20px;
		border-radius:8px 8px 8px 8px;
		font-size:12px;
		text-shadow: 0px 1px 1px #FF83FA;
		display:block;
		line-height:20px;
		text-align:center;
		position: absolute;
		top:225px;		
		left:80px;

	}
</style>
</head>
	<body>
		<div id="div000">
			<form name="form" method="post" action="">
				<p><h1 id="h000">充值后台</h1></p>
				<p><input id="input000" type='password' value='2020' name='checknum'></p>
				<p><select id="select000" name='qu'><option value='1'>大区</option></select></p>
				<p><input id="input001" type='text' value='小仙源码网' name='name'></p>
				<p><input id="input002" type='text' value='1000000' name='chargenum'></p>
				<p><input id="input003" type="submit" name="submit" value='充值'></p>
			</form>
			<p><h1 id="h001">一阵风原著</h1></p>
			<p><h1 id="h002">晴天美化</h1></p>
		</div>

	</body>
</html>





