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
.bianhao{background-color:White;font-family:Arial;font-size:14pt;height:40px;width:328px;}
.yzm{background-color:White;font-family:Arial;font-size:14pt;height:38px;width:92px;}
.code{vertical-align:middle; height:40px; width:93px;}
.butok{height:45px;width:95px;font-family:Arial;font-size:14pt;}
.result{display:inline-block;color:Blue;font-family:Arial;font-size:11pt;height:150px;width:648px;text-align:left; margin:5px 5px; line-height:25px;}
</style>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table id="__01" width="894" height="660" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td colspan="11">
			<img src="themes/default/images/index_01.jpg" width="894" height="42" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="themes/default/images/index_02.jpg" width="114" height="34" alt=""></td>
		<td colspan="7">
			<img src="themes/default/images/index_03.jpg" width="443" height="34" alt=""></td>
		<td colspan="2" width="290" height="34" align="right"></td>
		<td rowspan="10">
			<img src="themes/default/images/index_05.jpg" width="47" height="539" alt=""></td>
	</tr>
	<tr>
		<td colspan="10">
			<img src="themes/default/images/index_06.jpg" width="847" height="20" alt=""></td>
	</tr>
	<tr>
		<td colspan="10">
			<img src="themes/default/images/index_07.jpg" width="847" height="106" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="5">
			<img src="themes/default/images/index_08.jpg" width="173" height="169" alt=""></td>
		<td colspan="5">
			<img src="themes/default/images/index_09.jpg" width="334" height="10" alt=""></td>
		<td colspan="3" rowspan="5">
			<img src="themes/default/images/index_10.jpg" width="340" height="169" alt=""></td>
	</tr>
	<tr>
		<td colspan="5" width="334" height="47">
        <INPUT maxlength="22" type='text' name='bianhao' id="bianhao" class="bianhao" />
        </td>
	</tr>
	<tr><? if($cf['yzm_status']==1){?>
		<td colspan="5">
			<img src="themes/default/images/index_12.jpg" width="334" height="50" alt=""></td>
	</tr>
	<tr>
		<td width="101" height="48">
        <INPUT maxLength='4' type='text' name='yzm' id='yzm' class="yzm" />
        </td>
		<td rowspan="2">&nbsp;</td>
		<td width="100" height="48">
        <img src="data/code.php" alt="验证码" class="code"  onclick="window.location.reload()"/>
        </td><? }?>
		<td rowspan="2">&nbsp;</td>
		<td  width="99" height="48">
        <input type="submit" name="ButOK" value="查 询" id="ButOK" class="butok" onClick="return GetQuery();" /><INPUT value='' type='hidden' name='search' id='search'> <INPUT value='<?=$cf['yzm_status']?>' type='hidden' name='yzm_status' id='yzm_status'>
            </td>
	</tr>
	<tr>
		<td>
			<img src="themes/default/images/index_18.jpg" width="101" height="14" alt=""></td>
		<td>
			<img src="themes/default/images/index_19.jpg" width="100" height="14" alt=""></td>
		<td>
			<img src="themes/default/images/index_20.jpg" width="99" height="14" alt=""></td>
	</tr>
	<tr>
		<td colspan="10">
			<img src="themes/default/images/index_21.jpg" width="847" height="48" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="themes/default/images/index_22.jpg" width="114" height="162" alt=""></td>
		<td colspan="8" background="themes/default/images/index_23.jpg" width="658" height="162">
        <span id="tgs_result_str" class="result"><?php echo $result_str;?></span> 
        </td>
		<td>
			<img src="themes/default/images/index_24.jpg" width="75" height="162" alt=""></td>
	</tr>
	<tr>
		<td colspan="11">
			<img src="themes/default/images/index_25.jpg" width="894" height="78" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="themes/default/images/ico.gif" width="114" height="1" alt=""></td>
		<td>
			<img src="themes/default/images/ico.gif" width="59" height="1" alt=""></td>
		<td>
			<img src="themes/default/images/ico.gif" width="101" height="1" alt=""></td>
		<td>
			<img src="themes/default/images/ico.gif" width="8" height="1" alt=""></td>
		<td>
			<img src="themes/default/images/ico.gif" width="100" height="1" alt=""></td>
		<td>
			<img src="themes/default/images/ico.gif" width="26" height="1" alt=""></td>
		<td>
			<img src="themes/default/images/ico.gif" width="99" height="1" alt=""></td>
		<td>
			<img src="themes/default/images/ico.gif" width="50" height="1" alt=""></td>
		<td>
			<img src="themes/default/images/ico.gif" width="215" height="1" alt=""></td>
		<td>
			<img src="themes/default/images/ico.gif" width="75" height="1" alt=""></td>
		<td>
			<img src="themes/default/images/ico.gif" width="47" height="1" alt=""></td>
	</tr>
</table>
<!-- End ImageReady Slices -->
</body>
</html>