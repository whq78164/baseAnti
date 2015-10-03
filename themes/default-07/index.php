<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?=$cf['site_name']?></title>
<meta name="keywords" content="<?=$cf['page_keywords']?>" />
<meta name="description" content="<?=$cf['page_desc']?>" />
<SCRIPT type="text/javascript" src="data/js/ajax.js"></SCRIPT>
<link href="themes/default/images/style.css" rel="Stylesheet" type="text/css" />
<style type="text/css">
<!--
.title {font-size: 20px}
-->
</style>
</head>
<body>
<div id="box">
<div id="top"><div class="top_l"></div>
<div class="top_c title">某某产品防伪查询系统</div>
<div class="top_r"></div></div>
<ul id="content">
<li style="text-align:left; padding-left:55px;">请在下面输产品防伪码</li>
<li style="text-align:left; padding-left:55px;">
<input name='bianhao' id="bianhao" type="text" class='pm' onkeydown=gbcount(this.form.p,this.form.total,this.form.used,this.form.remain); onkeyup=gbcount(this.form.p,this.form.total,this.form.used,this.form.remain);></li>
<? if($cf['yzm_status']==1){?>
<li style="text-align:left; padding-left:55px;">验证码：<input name='yzm' id='yzm' type="text" class="kuang" maxlength="4" />&nbsp;<img src="data/code.php" alt="验证码" style="vertical-align:middle; height:22px; width:50px;"  onclick="window.location.reload()"/></li><? }?>
<li style="text-align:center; padding-top:10px"><input type="button" value="立即查询" class="input_send" id="ButOK" onClick="return GetQuery();" /><INPUT value='' type='hidden' name='search' id='search'> <INPUT value='<?=$cf['yzm_status']?>' type='hidden' name='yzm_status' id='yzm_status'>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="重新查询" onClick="location.reload()" class="input_send"></li>
</ul>
<div id="test" style="background:#DBEDF7;border-left:1px #1E5288 solid;border-right:1px #1E5288 solid;margin:0px; padding-left:10px; padding-right:5px; padding-bottom:8px;">
<div id="tgs_result_str"><?php echo $result_str;?></div>
</div>
<div id="foot"></div>
<div id="footer"> <a href="http://www.itbiao.com/" target="_blank">版权所有：</a><a href="http://www.itbiao.com">www.itbiao.com</a></div>
</div>
</body>
</html>



