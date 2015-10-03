<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$cf['site_name']?></title>
<meta name="keywords" content="<?=$cf['page_keywords']?>" />
<meta name="description" content="<?=$cf['page_desc']?>" />
<meta name="author" content="www.958989.com" />
<SCRIPT type="text/javascript" src="data/js/ajax.js"></SCRIPT>
<style type="text/css">
<!--
.put1{background-color:White;font-family:Arial;font-size:12pt;height:18px;width:200px;vertical-align:middle;}
.put2{background-color:White;font-family:Arial;font-size:12pt;height:18px;width:60px;vertical-align:middle;}
.code{vertical-align:middle; height:24px; width:50px;}
.but{height:28px;width:70px; vertical-align:bottom; font-size:14px; font-weight:bold;}
b{ vertical-align:middle;}
-->
</style>
</head>
<body bgcolor="#EEEEEC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table id="__01" width="980" height="351" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td colspan="4"><img src="themes/default/images/bg_01.jpg" width="980" height="83" alt=""></td>
	</tr>
	<tr>
		<td colspan="4"><img src="themes/default/images/bg_02.jpg" width="980" height="19" alt=""></td>
	</tr>
	<tr>
		<td colspan="2"><img src="themes/default/images/bg_03.jpg" width="307" height="47" alt=""></td>
		<td colspan="2" background="themes/default/images/bg_04.jpg" width="673" height="47">
        <INPUT maxlength="22" type='text' name='bianhao' id="bianhao" class="put1" />&nbsp;&nbsp;<? if($cf['yzm_status']==1){?><font color="#FFFFFF" size="4"><b>验证码：</b></font><INPUT maxLength='4' type='text' name='yzm' id='yzm' class="put2" />&nbsp;&nbsp;<img src="data/code.php" alt="验证码" class="code"  onclick="window.location.reload()"/><? }?>&nbsp;&nbsp;<input type="submit" name="ButOK" value="查 询" id="ButOK" class="but" onClick="return GetQuery();" /><INPUT value='' type='hidden' name='search' id='search'> <INPUT value='<?=$cf['yzm_status']?>' type='hidden' name='yzm_status' id='yzm_status'>
        </td>
	</tr>
	<tr>
		<td colspan="2"><img src="themes/default/images/bg_05.jpg" width="307" height="44" alt=""></td>
		<td colspan="2"><img src="themes/default/images/bg_06.jpg" width="673" height="44" alt=""></td>
	</tr>
	<tr>
		<td><img src="themes/default/images/bg_07.jpg" width="106" height="157" alt=""></td>
		<td colspan="2" background="themes/default/images/bg_08.jpg" width="793" height="157">
        <span id="tgs_result_str" style="display:inline-block;color:Blue;font-family:Arial;font-size:12pt;height:130px;width:750px;text-align:left; margin:5px 10px;">
	<?php echo $result_str;?></span>
        </td>
		<td><img src="themes/default/images/bg_09.jpg" width="81" height="157" alt=""></td>
	</tr>
	<tr>
		<td><img src="themes/default/images/0.gif" width="106" height="1" alt=""></td>
		<td><img src="themes/default/images/0.gif" width="201" height="1" alt=""></td>
		<td><img src="themes/default/images/0.gif" width="592" height="1" alt=""></td>
		<td><img src="themes/default/images/0.gif" width="81" height="1" alt=""></td>
	</tr>
</table>
</body>
</html>