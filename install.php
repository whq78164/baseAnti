<?php
error_reporting(0);
session_start();
require("data/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>防伪查询系统在线安装</title>
<link href="data/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
 ///判断安装文件 
 if (file_exists("data/conn.php"))
    {
        echo "<br><br><br><span class='red'><center><b>防伪程序已安装过，如需重新安装，请先删除文件data文件夹下的conn.php文件</b></center></span>";
		exit;
    }
?>
<table align="center" cellpadding="3" cellspacing="1" class="table_50">
 <tr>
  <td height="30" colspan="2" align="center" class="td_2">防伪查询系统在线安装</td>
 </tr>
</table>
<?php
$step = $_GET['step'];
if($step == ""){    
	$checking_dirs = array('upload');
	$msgs = array('result' => 'OK', 'detail' => array());
    foreach ($checking_dirs AS $dir){
        if (!file_exists($dir))
        {
            $msgs['result'] = 'ERROR';
            $msgs['detail'][] = array($dir, "文件夹".$dir."不存在");
            continue;
        }
        if (file_mode_info($dir) < 2)
        {
            $msgs['result'] = 'ERROR';
            $msgs['detail'][] = array($dir, "文件夹".$dir."没有写权限");
        }
        else
        {
            $msgs['detail'][] = array($dir, "文件夹为可读写权限");
        }
    }
?>
  <form id="form1" name="form1" method="post" action="?step=step1">
	  <table align="center" cellpadding="3" cellspacing="1" class="table_50">		 
		<tr>
		  <td height="21" colspan="2" align="center" class="td3"> 系统环境检测</td>
		</tr>
		<tr>
		  <td>操作系统及版本:</td>
		  <td><?php echo PHP_OS;?></td>
		</tr>
		<tr>
		  <td>是否支持Mysql:</td>
		  <td><?php echo function_exists(mysql_close) ? "支持" : "不支持";?></td>
		</tr>
		<tr>
		  <td>file文件夹权限:</td>
		  <td><?=$msgs['result'].$result['detail'];?></td>
		</tr>
		 <tr>
		   <td height="27" colspan="2"><input type="submit" name="Submit3" value=" 下一步 " /></td>
		  </tr>
	  </table>
	</form>
<?php
}/////第一步，配置数据库连接参数
elseif($step == "step1")
{
	$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
	$site_url = dirname($url)."/";
?>
	<form id="form1" name="form1" method="post" action="?step=step2">
	  <table align="center" cellpadding="3" cellspacing="1" class="table_50">		 
		<tr>
		  <td height="21" colspan="2" align="center" class="td_1"> 数据库帐户</td>
		</tr>
		<tr>
		  <td width="17%">数据库主机：</td>
		  <td width="83%"><input name="db_host" type="text" id="db_host"  value="localhost" /></td>
		</tr>
		<tr>
		  <td>端口号：</td>
		  <td><input name="db_port" type="text" id="db_port" value="3306" />
		</td>
		</tr>
		<tr>
		  <td>数据库：</td>
		  <td><input name="db_name" type="text" id="db_name" value="" />(如果没有数据库，将新建一个数据库)
		</td>
		</tr>
		<tr>
		  <td>用户名：</td>
		  <td><input name="db_user" type="text" id="db_user" value="" />(请确认用户名有此数据库读写权限)</td>
		</tr>
		<tr>
		  <td>密码:</td>
		  <td><input type="password" name="db_pwd" id="db_pwd" /></td>
		</tr>
		<tr>
		  <td height="21" colspan="2" align="center" class="td_1"> 管理员帐户</td>
		</tr>
		<tr>
		  <td width="17%">管理员用户名：</td>
		  <td width="83%"><input name="username" type="text" id="username"  value="admin" /></td>
		</tr>
		<tr>
		  <td>密码:</td>
		  <td><input type="password" name="password" id="password" value="admin" /></td>
		</tr>
		<tr>
		  <td>确认密码:</td>
		  <td><input type="password" name="repassword" id="repassword" value="admin" /></td>
		</tr>
		<tr>
		  <td height="21" colspan="2" align="center" class="td_1"> 系统配置信息</td>
		</tr>
		<tr>
		  <td width="17%">系统名称：</td>
		  <td width="83%"><input name="cf[site_name]" type="text" id="site_name"  value="防伪码查询系统" /></td>
		</tr>
		<tr>
		  <td>系统网址:</td>
		  <td><input type="text" name="cf[site_url]" id="site_url" value="<?=$site_url?>" /></td>
		</tr>
		<tr>
		  <td>搜索页是否使用验证码:</td>
		  <td><input type="checkbox" name="cf[yzm_status]" id="yzm_status" value="1" /></td>
		</tr>
		 <tr>
		   <td height="27" colspan="2"><input type="submit" name="Submit3" value=" 下一步 " /></td>
		  </tr>
	  </table>
	</form>
<?php
////创建数据库和表
}elseif($step == "step2"){
      
     $db_host  = trim($_POST['db_host']);
	 $db_name  = trim($_POST['db_name']);
	 $db_port  = trim($_POST['db_port']);
	 $db_user  = trim($_POST['db_user']);
	 $db_pwd   = trim($_POST['db_pwd']);	 
	 $s        = 1;
	 $_SESSION = "";
	 $con = mysql_connect($db_host.":".$db_port,$db_user,$db_pwd);
	 if(!$con)
	  {
	    $_SESSION['msg'] .= ('Could not connect: ' . mysql_error()."<br />");
		$s = 0;
	  }
	  if ($s == 1 && mysql_query("CREATE DATABASE ".$db_name,$con))
	  {
	     $_SESSION['msg'] .= "数据库创建成功";
	  }      
	  if($s == 1){
	    mysql_select_db($db_name,$con);
	    $sql="set names 'utf-8'";
        mysql_query($sql);
	  }
	  if($s == 1){	  
		$sql="DROP TABLE IF EXISTS tgs_admin;";
		mysql_query($sql);		
		$sql="CREATE TABLE `tgs_admin` (
		  `id` tinyint(3) NOT NULL auto_increment,
		  `username` varchar(20) NOT NULL,
		  `password` varchar(40) NOT NULL,
		  `logins` mediumint(8) default '1',
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
		mysql_query($sql) or $_SESSION['msg'] .= "创建tgs_admin失败<br />";
        $sql = "DROP TABLE IF EXISTS `tgs_code`;";
		mysql_query($sql);
		$sql = "CREATE TABLE `tgs_code` (
		  `id` int(11) NOT NULL auto_increment,
		  `bianhao` varchar(50) default NULL,
		  `riqi` varchar(30) default NULL,
		  `product` varchar(100) default NULL,
		  `zd1` varchar(250) default NULL,
		  `zd2` varchar(250) default NULL,
		  `hits` int(8) default '0',
		  `query_time` datetime default NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
		mysql_query($sql) or $_SESSION['msg'] .= "创建tgs_code失败<br />"; 
		$sql = "DROP TABLE IF EXISTS `tgs_config`;";
		mysql_query($sql);		
		$sql= "CREATE TABLE `tgs_config` (
		  `id` mediumint(6) NOT NULL auto_increment,
		  `parentid` smallint(5) NOT NULL default '1',
		  `code` varchar(30) NOT NULL,
		  `code_name` varchar(30) NOT NULL,
		  `code_value` text,
		  `store_range` varchar(50) default NULL,
		  `type` varchar(20) default NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;";
		mysql_query($sql) or $_SESSION['msg'] .= "创建tgs_config失败<br />";

		$sql="INSERT INTO `tgs_config` (`id`, `parentid`, `code`, `code_name`, `code_value`, `store_range`, `type`) VALUES 
		(2, 1, 'site_url', '系统网址', 'http://www.itbiao.com', NULL, 'text'),
		(1, 1, 'site_name', '系统名称', '防伪码查询系统', NULL, 'text'),
		(3, 1, 'timezone', '系统所在时区', '0', NULL, 'text'),
		(4, 1, 'time_format', '时间格式', 'Y-m-d H:i:s', NULL, 'text'),
		(5, 1, 'yzm_status', '搜索时是否使用验证码', '0', NULL, 'checkbox'),
		(6, 1, 'page_title', '网页标题', NULL, NULL, 'text'),
		(7, 1, 'page_keywords', '网页关键字', NULL, NULL, 'text'),
		(8, 1, 'page_desc', '网页描述', NULL, NULL, 'text'),
		(9, 1, 'site_close', '网站关闭状态', NULL, NULL, 'text'),
		(10, 1, 'site_close_reason', '网站关闭原因', NULL, NULL, 'text'),
		(11, 1, 'notices', '系统通知', '请刮开防伪标签上灰色涂层，在输入框内依次输入16位防伪码，然后点查询键即可。<br>查询显示结果如下：<br>1、如果正确，提示为“尊敬的顾客您好，您购买的是****生产的产品，属于正品，请放心使用”。<br>2、如果错误，提示为“您输入的防伪码不存在，谨防假冒”。<br>3、如果查询过，提示为“该商品已经被查询过,本次是第*次查询,谨防假冒”。', NULL, 'text'),
		(12, 1, 'text_type', '系统类型', '1', NULL, 'text'),
		(13, 1, 'site_themes', '系统界面路径', 'default', NULL, 'text'),
		(14, 1, 'notice_1', '查询结果为真时', '尊敬的顾客您好，您购买的是本公司生产的产品{{product}},有效服务期限为{{riqi}}，{{zd1}},{{zd2}},属于正品，请放心使用。', NULL, 'text'),
		(15, 1, 'notice_2', '查询结果为真且非第一次查询时', '该商品已经被查询过,本次是第{{hits}}次查询, 谨防假冒。', NULL, 'text'),
		(16, 1, 'notice_3', '查询结果为空时', '您输入的防伪码{{bianhao}}不存在，谨防假冒。', NULL, 'text'),
		(17, 1, 'site_lang', '系统语言包', 'zh_cn', NULL, 'text'),
		(18, 1, 'list_num', '后台防伪码单页记录数', '100', NULL, 'text');";
        mysql_query('SET NAMES UTF8');
		mysql_query($sql) or $_SESSION['msg'] .= "参数保存失败<br />";		
		
		$sql = "DROP TABLE IF EXISTS `tgs_history`;";
		mysql_query($sql);
		
		$sql="CREATE TABLE `tgs_history` (
        `id` int(11) NOT NULL auto_increment,
        `keyword` varchar(50) default NULL,
         `addtime` datetime default '0000-00-00 00:00:00',
         `addip` varchar(40) default NULL,
         `results` tinyint(2) default '0',
          PRIMARY KEY  (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
       mysql_query($sql) or $_SESSION['msg'] .= "创建tgs_history失败<br />";

		$_SESSION['msg'] .= "数据库导入成功<br />";		
	 }
				
      if($s == 1)
	  {
		//\'生成网站配置文件
		  $content="";
		  $content.="<?php "."\n";

		  $content.="$"."db_host =\"$db_host\";\n";
		  $content.="$"."db_name =\"$db_name\";\n";
		  $content.="$"."db_port =\"$db_port\";\n";
		  $content.="$"."db_user =\"$db_user\";\n";
		  $content.="$"."db_pwd  =\"$db_pwd\";\n";
		 
		  $content.="?>";

        $fp = fopen ("data/conn.php","w");
		if (fwrite ($fp,$content)){
		  fclose ($fp);
		} else { 
		  fclose ($fp); 
		  $_SESSION['msg'] .= "生成数据配置文件失败,data文件夹权限不够!<br />";
		  $s = 0;
		}
	  }

       if($s == 1)
	   {
			////网站管理员
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);
			$repassword = trim($_POST['repassword']);
			
			if($username == "")
			{
			  $username = "admin";
			}
			if($password == "")
			{
			  $password = "123456";
			}
			
			if($password != $repassword)
			{
			  $_SESSION['msg'] .= "两次输入的密码不一致,初始密码设为: 123456<br >";
			  //$s = 0;
			  $password = "tgwl";
			}
			//if($s == 1){
			  $sql= "INSERT INTO `tgs_admin` (`username`, `password`) VALUES ('".$username."','".md5($password)."')";
			  mysql_query($sql) or  die("ERR:66");
			//}		
		}
		
		if($s == 1)
		{
			/////网站初始化
			$arr = array();
			$sql = "SELECT id, code_value FROM tgs_config";
			$res = mysql_query($sql);
			while($row = mysql_fetch_array($res))
			{
				$arr[$row['id']] = $row['value'];
			}
			 foreach ($_POST['cf'] AS $key => $val)
			{
				if($arr[$key] != $val)
				{ 
				  $sql="update tgs_config set code_value='".trim($val)."' where code='".$key."' limit 1";
				  mysql_query($sql) or die("err:".$sql);
				}
			}

			  $cc ="<table align='center' cellpadding='3' cellspacing='1' class='table_50'>";
			  $cc .="<tr><td>";
			  $cc .= $_SESSION['msg'];
			  $cc .= "<br />成功完成配置，点击此处<a href='./'>浏览系统首页</a>，<a href='admin/index.php'>登陆管理页</a>";
			  $cc .="</td></tr>";
			  $cc .="<table>";
	  
	  }else{
	   $cc ="<table align='center' cellpadding='3' cellspacing='1' class='table_50'>";
	   $cc .="<tr><td>";
       $cc .= $_SESSION['msg'];
	   $cc .= "<br />点击此处<a href='install.php'>返回</a>";
	   $cc .="</td></tr>";
	   $cc .="<table>";
	  }
	  echo $cc;
}
?>
</body>
</html>