<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$cf['site_name']?></title>
<meta name="keywords" content="<?=$cf['page_keywords']?>" />
<meta name="description" content="<?=$cf['page_desc']?>" />
<SCRIPT type="text/javascript" src="data/js/ajax.js"></SCRIPT>
<style type="text/css">
<!--
body{ background-image:url(themes/default/images/bg.gif)}
.fwm{font-size:18px; color:#FFFFFF; vertical-align:middle;}
b{vertical-align:middle;}
.butOK{ width:50px; height:24px;background-color: #ecedee; color: #000; vertical-align:bottom;}
-->
</style>
</head>
<body>
<table border="0" cellspacing="0" cellpadding="0" width="875" align="center" height="209">
 <tr><td height="84"><p style = "text-align:center;  font-size:25px; font-weight:bold;"><?=$cf['site_name']?></p><!--img alt="" src="themes/default/images/home_01.gif" width="875" height="84"--> </td></tr>
 <tr><td height="19"><img alt="" src="themes/default/images/home_02.gif" width="875" height="19"></td></tr>
 <tr><td height="36"><img alt="" src="themes/default/images/home_03.gif" width="875" height="36"></td></tr>
 <tr><td height="37" background="themes/default/images/home_04.gif">
  <table border="0" cellspacing="0" cellpadding="0" width="95%" align="center">
   <tr><td height="20" width="600" align="middle" class="fwm">
   <b>防伪编码：</b><input onfocus="this.select();" maxlength="50" size="25" name="bianhao" id="bianhao" type='text'>&nbsp;&nbsp;<? if($cf['yzm_status']==1){?><b>验证码：</b><INPUT maxLength='4' type='text' name='yzm' id='yzm' size="6"/>&nbsp;&nbsp;<img src="data/code.php" alt="验证码" style="vertical-align:middle; height:22px; width:50px;"  onclick="window.location.reload()"/><? }?>&nbsp;&nbsp;<input value="查询" type="submit" name="ButOK" onClick="return GetQuery();" id="ButOK" class="butOK"><INPUT value='' type='hidden' name='search' id='search'><INPUT value='<?=$cf['yzm_status']?>' type='hidden' name='yzm_status' id='yzm_status'>                
                      </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <img alt="" src="themes/default/images/home_05.gif" width="875" height="33">
            </td>
        </tr>
    </table>

	<table border="0" cellspacing="0" cellpadding="0" width="875" align="center" style="padding:20px 10px;" background="themes/default/images/bg.gif">
        <tr>
            <td height="60" align="middle">
        <span id="tgs_result_str" style="display:inline-block;color:Blue;font-family:Arial;font-size:12pt;height:100%;width:790px;text-align:left; margin:15px 8px;">
	<?php echo $result_str;?></span>
            </td>
        </tr>
    </table>
    <table border="0" cellspacing="0" cellpadding="0" width="875" align="center">
        <tr>
            <td height="60" align="middle">
                Copyright 2014 防伪码查询中心 All Rights Reserved. 
            </td>
        </tr>
    </table>
</body>
</html>

