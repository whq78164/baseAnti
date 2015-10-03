<?php
error_reporting(0);
session_start();
require("../data/head.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>防伪码查询系统登陆</title>
<style type="text/css">
body { font:12px/1.5 Tahoma, Geneva, sans-serif; background:#ffffff;}
body,h1,form,ul,li,p { margin:0; padding:0;}
li { list-style:none; line-height:30px; height:30px; margin-BOTTOM:10px;}
ul { padding:95px 0 15px 170px;}
#admin { width:376px;height:231px; border:3px solid #fff; background:#D8E899; background:url(../data/images/login.gif) no-repeat; position:relative; margin: 150px auto 0;}
.int { border-style:solid; padding:3px 2px; border-width:1px 1px 1px 1px; background-color:#ffffff; border-color:#ddd #ddd #ddd #ddd; width:146px; font-family:Tahoma, Geneva, sans-serif;}
.int:focus { background:#fff;}
.btn { width:98px; height:33px; margin:0 auto; display:block; position:relative; left:0px; border:none; padding:0; overflow:hidden; text-indent:-9999px; background:url(../data/images/btn.gif); cursor:pointer;}
label { float:left; height:30px; line-height:30px; width:60px; text-align:right; cursor:pointer; padding-right:5px;}
p.error { padding: 0 10px; text-align:center;}
</style>
<script language=javascript>
<!--
function CheckForm()
{
	if(document.Login.Username.value == "")
	{
		alert("请输入用户名！");
		document.Login.Username.focus();
		return false;
	}
	if(document.Login.Password.value == "")
	{
		alert("请输入密码！");
		document.Login.Password.focus();
		return false;
	}	
}
//-->
</script>
</head>
<body>
<?php
$act = $_REQUEST["act"];
if ($act == "adminlogin")
{
  $username = trim($_POST["Username"]);
  $password = trim($_POST["Password"]);
   $sql="select * from tgs_admin where username='".$username."' and password='".md5($password)."'";
   $res=mysql_query($sql);
   $b=mysql_fetch_array($res);
   if(!$b[0])
	{
	     echo "<script>alert('管理员帐户或密码错误,请重新输入!');location.href='index.php';</script>";
	     exit();
    }
    else
    {
		 $_SESSION["Adminname"] = $username;
		 mysql_query( "update tgs_admin set logins=logins+1 where username='$username' limit 1");
		  
		 echo "<script>location.href='admin.php';</script>"; 
		 exit;
	 }
} 
if ($act=="logout")
{
session_unregister("Adminname");
echo "<script>location.href='index.php';</script>"; 
} 
?>
<div id="admin">
<form name="Login" action="?act=adminlogin" method="post" onSubmit="return CheckForm();">
 <ul>
  <li><input type="text" name="Username" id="item1" class="int" autocomplete="off"></li>
  <li><input type="password" name="Password" id="item2"  value="" class="int" autocomplete="off"></li>
  <li><input type="submit" name="B1" value="" class="btn" /></li>
 </ul>
</form>
</div>
</body>
</html>