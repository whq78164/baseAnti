<?php
require("conn.php");
require("function.php");
$conn = mysql_connect($db_host, $db_user,$db_pwd);
if(!$conn)
{
   die("错误提示: 无法连接到数据库，请检查数据库。");
}
mysql_select_db($db_name,$conn);

$sql="set names 'utf-8'";
mysql_query($sql);
$cf = get_site_config(1);
$GLOBALS['tgs']['cur_ip']    = $_SERVER["REMOTE_ADDR"];
$GLOBALS['tgs']['cur_time']  = date($cf['time_format'],(time()+$cf['timezone']*3600));
?>