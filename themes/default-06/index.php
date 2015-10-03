<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<title><?=$cf['site_name']?></title>
<meta name="keywords" content="<?=$cf['page_keywords']?>" />
<meta name="description" content="<?=$cf['page_desc']?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript" src="data/js/ajax.js"></script>
<LINK href="themes/default/main.css" type=text/css rel=stylesheet> 
<META content="MSHTML 6.00.6000.21300" name=GENERATOR>
</HEAD>
<BODY>
<TABLE style="WIDTH: 770px" align=center border=0>
  <TBODY>
  <TR>
    <TD style="HEIGHT: 186px; TEXT-ALIGN: right" vAlign=top   background="themes/default/wscx.gif" colSpan=3>&nbsp; </TD></TR>
<TR align="center">
<TD height="29" colSpan=3>   
  <span id="tgs_result_str" style="display:inline-block;color:#FFFFFF;font-family:Arial;font-size:12pt;height:30px;width:750px;text-align:left; margin:10px 10px;">
	<?php echo $result_str;?></span>
</TD>
</TR>
  <TR>
    <TD style="HEIGHT: 162px; TEXT-ALIGN: left"><BR><STRONG><FONT 
      color=#ffffff size=2>　</FONT><FONT 
      color=#ffffff><span class="STYLE2">欢迎进入全国品牌产品验证中心</span></FONT><FONT 
      color=#ffffff size=2><BR>
        <BR>
    </FONT></STRONG>
      <TABLE class=wz width="90%" align=center border=0>
        <TBODY>
        <TR>
          <TD><span class="STYLE3">1、检查标贴的完好性，刮开标贴上面的涂层。</span></TD>
        </TR>
        <TR>
          <TD><span class="STYLE3">2、在右面的输入框内依次正确输入上面的防伪码。</span></TD>
        </TR>
        <TR>
          <TD><span class="STYLE3">3、核对输入框内的防伪码和标贴一致后点击查询按钮。</span></TD>
        </TR>
        <TR>
          <TD height=21><span class="STYLE3">4、稍后系统会显示出查询结果</span></TD>
        </TR></TBODY></TABLE></TD>
    <TD style="WIDTH: 253px; TEXT-ALIGN: left" colSpan=2>
      <P>&nbsp;</P>
      <P>&nbsp;</P>
      <P>&nbsp;</P>
      <P> 
      <P align=center>
	  <INPUT maxlength="22" type='text' name='bianhao' id="bianhao" style="background-color:White;font-family:Arial;font-size:12pt;height:22px;width:200px;" msg="请输入防伪码"/>
	  <BR> <BR><BR>
	  <input type="submit" name="ButOK" value="查 询" id="ButOK" style="height:28px;width:90px;" onClick="return GetQuery();" /><INPUT value='' type='hidden' name='search' id='search'> <INPUT value='<?=$cf['yzm_status']?>' type='hidden' name='yzm_status' id='yzm_status'>
      <BR><BR><BR>
      </P> 
      <P></P></TD></TR>
  <TR></TR></TBODY>
 </TABLE>
</BODY>
</HTML>