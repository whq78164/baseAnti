<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<title><?=$cf['site_name']?></title>
<meta name="keywords" content="<?=$cf['page_keywords']?>" />
<meta name="description" content="<?=$cf['page_desc']?>" />
<meta name="author" content="www.tgwl.net" />
<META content="text/html; charset=utf-8" http-equiv="Content-Type">
<SCRIPT type="text/javascript" src="data/js/ajax.js"></SCRIPT>
<STYLE type=text/css>BODY {MARGIN: 0px}
TD {LINE-HEIGHT: 150%; COLOR: #34618b; FONT-SIZE: 12px}
.font1 {FONT-FAMILY: "宋体"; HEIGHT: 20px; FONT-SIZE: 18px; FONT-WEIGHT: bold}
.STYLE1 {COLOR: #ff0000; FONT-SIZE: 14px}
</STYLE>
<BODY bgColor="#eef9ff">
<TABLE border='0' cellSpacing='0' cellPadding='0' width='200' align='center'>
  <TBODY>
  <TR>
    <TD colSpan=2><IMG src="themes/default/images/search_01.png" width='988' height='90'></TD></TR>
  <TR>
    <TD vAlign='top' width='415'>
      <TABLE border='0' cellSpacing='0' cellPadding='0' width='200'>
        <TBODY>
        <TR>
          <TD width=115><IMG src="themes/default/images/search_02.png" width=115 height=350></TD>
          <TD width=56><IMG src="themes/default/images/search_03.png" width=106 height=350></TD>
          <TD width=13><IMG src="themes/default/images/search_04.png" width=104 height=350></TD>
          <TD width=16><IMG src="themes/default/images/search_05.png" width=89 height=37><IMG src="themes/default/images/search_07.png" width=89 height=313></TD></TR></TBODY></TABLE></TD>
    <TD vAlign='top' width='551'>
      <TABLE border=0 cellSpacing='0' cellPadding='0' width='200'>
        <TBODY>
        <TR>
          <TD><IMG alt="" src="themes/default/images/search_06.png" width='574' height='37'></TD></TR>
        <TR>
          <TD><IMG src="themes/default/images/search_08.png" width='574' height='48'></TD></TR>
        <TR>
          <TD height=50 background='themes/default/images/search_10.png'>
            <TABLE border='0' cellSpacing='0' cellPadding='0' width='508'>
              <FORM id='form1' method='post' name='form1' action='?'>
              <TBODY>
              <TR>
                <TD width='81' align='middle'>请输入防伪码</TD>
                <TD width='401'><INPUT class='font1' size="40" maxlength="24" type='text' name='bianhao' id="bianhao" ></TD>
                <TD width='26'></TD>
              </TR>
				<? if($cf['yzm_status']==1){?>
				<TR>
                <TD width='81' align='middle'>验证码</TD>
                <TD width='401'><INPUT class='font1' maxLength='4' size='5' type='text' name='yzm' id='yzm' >&nbsp;&nbsp;<img src="data/code.php" /></TD>
                <TD width='26'></TD>
				</TR>
				 <? }?>
				 <TR>
                <TD width='81' align='middle'></TD>
                <TD width='401'><img src="themes/default/images/search.gif" name='imageField' onClick="return GetQuery();" >
                  <INPUT value='' type='hidden' name='search' id='search'> <INPUT value='<?=$cf['yzm_status']?>' type='hidden' name='yzm_status' id='yzm_status'>			  
				</TD>
                <TD width='26'></TD>
				 </TR>
				</FORM>
				</TABLE></TD></TR>
        <TR>
          <TD><IMG alt="" src="themes/default/images/search_11.png" width='574' height='35'></TD></TR>
        <TR>
          <TD height='180' background='themes/default/images/search_12.png'>			
			<TABLE border='0' cellSpacing='0' cellPadding='0' width="93%" align='center'>
              <TBODY>
              <TR>
                <TD id="tgs_result_str">
				<?php echo $result_str;?>
				  </TD>
			  </TR>
			 </TBODY>
			 </TABLE>				  
		</TD></TR></TBODY></TABLE>
	</TD></TR>
  <TR>
    <TD background='themes/default/images/search_14.png' colSpan='2' align='right'><SPAN class='STYLE1'></SPAN></TD></TR>
    <TR><TD background='themes/default/images/search_14.png' colSpan='2' align='middle'>&nbsp;</TD></TR></TBODY></TABLE>
</BODY>
</HTML>