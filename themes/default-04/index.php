<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table id="__01" width="809" height="266" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td colspan="2">
			<img src="themes/default/images/red_01.jpg" width="809" height="17"></td>
	</tr>
	<tr>
		<td>
			<img src="themes/default/images/red_02.jpg" width="215" height="44"></td>
		<td background="themes/default/images/red_03.jpg" width="594" height="44">
        <INPUT maxlength="22" type='text' name='bianhao' id="bianhao" class="put1" />&nbsp;&nbsp;&nbsp;<? if($cf['yzm_status']==1){?><font color="#FFFFFF" size="4"><b>验证码：</b></font><INPUT maxLength='4' type='text' name='yzm' id='yzm' class="put2" />&nbsp;&nbsp;&nbsp;<img src="data/code.php" alt="验证码" style="vertical-align:middle; height:22px; width:50px;"  onclick="window.location.reload()"/><? }?>&nbsp;&nbsp;&nbsp;<input type="submit" name="ButOK" value="查 询" id="ButOK" class="but" onClick="return GetQuery();" /><INPUT value='' type='hidden' name='search' id='search'> <INPUT value='<?=$cf['yzm_status']?>' type='hidden' name='yzm_status' id='yzm_status'>
        </td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="themes/default/images/red_04.jpg" width="809" height="52"></td>
	</tr>
	<tr>
		<td colspan="2" background="themes/default/images/red_05.jpg" width="809" height="100%">
        <span id="tgs_result_str" style="display:inline-block;color:Blue;font-family:Arial;font-size:12pt;height:100%;width:790px;text-align:left; margin:15px 8px;">
	<?php echo $result_str;?></span>
        </td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="themes/default/images/red_06.jpg" width="809" height="9"></td>
	</tr>
</table>
</body>
</html>