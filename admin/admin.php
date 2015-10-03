<?php
error_reporting(0);
require("../data/session.php");
require("../data/head.php");
require('../data/reader.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$cf['site_name']?></title>
<link href="../data/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<br />
<?php 
 if (file_exists("../install.php")){
        echo "<br><br><br><span class='red'><center><b>请删除或更改防伪程序的安装文件  install.php</b></center></span>";
		exit;
}
?>
<table class="table_list_98" align="center" cellpadding="0" cellspacing="1">
  <tr>
    <td align="left" class="td_1"><a href="?">商品防伪码管理</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?act=query_record">查询记录</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="?act=config">配置信息</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="?act=superadmin">管理员帐户</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?act=logout">安全退出</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../" target="_blank">前台首页</a></td>
  </tr>
</table>
<br>
<?php
$act = $_GET["act"];
if($act == "")
{
?>
<SCRIPT language="javascript">
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.Name != "chkAll"&&e.disabled==false)
       e.checked = form.chkAll.checked;
    }
  }
function CheckAll2(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.Name != "chkAll2"&&e.disabled==false)
       e.checked = form.chkAll2.checked;
    }
  }   
function ConfirmDel()
{
	if(document.myform.Action.value=="delete")
	{
		document.myform.action="?act=delart";
		if(confirm("确定要删除选中的记录吗？本操作不可恢复！"))
		    return true;
		else
			return false;
	}else if(document.myform.Action.value=="export_code"){
	  document.myform.action="?act=export_code";
	
	}
}
</SCRIPT>
<table align="center" cellpadding="0" cellspacing="1" class="table_98"> 
  <tr>
    <td ><a href="?"><strong>商品防伪码管理</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?act=import">商品防伪码导入</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?act=add">商品防伪码添加</a>
    </td>
  </tr>
</table>
<br>
<?php		
        $code_list = array();
		$bianhao = trim($_REQUEST["bianhao"]);
		$product = trim($_REQUEST['product']);
		$zd1     = trim($_REQUEST['zd1']);
		$zd2     = trim($_REQUEST['zd2']);
		$h       = trim($_REQUEST["h"]);
		$pz      = trim($_REQUEST['pz']);
		$sql="select * from tgs_code where 1";		
		if($bianhao!=""){
		 $sql.=" and bianhao like '%$bianhao%'";
		}
		if($product != ""){
		 $sql.=" and product like '%$product%'";
		}
		if($zd1!=""){
		 $sql.=" and zd1 like '%$zd1%'";
		}
		if($zd2!=""){
		 $sql.=" and zd2 like '%$zd2%'";
		}
		if($h == "1"){
		$sql.=" order by hits desc,id desc";
		}elseif($h=="0"){
		$sql.=" order by hits asc,id desc";
		}else{
		$sql.=" order by id desc";
		}
		$result = mysql_query($sql);

	   if($pz == ""){
         $pagesize = $cf['list_num'];
		 $pz       = $cf['list_num'];
	   }else{
	     $pagesize = $pz;
	   }
       $total    = mysql_num_rows($result); 	
       $filename = "?bianhao=".$bianhao."&product=".$product."&zd1=".$zd1."&zd2=".$zd2."&h=".$h."&pz=".$pz."";
    
      $currpage  = intval($_REQUEST["page"]);
      if(!is_int($currpage))
	    $currpage=1;
	  if(intval($currpage)<1)$currpage=1;
      if(intval($currpage-1)*$pagesize>$total)$currpage=1;

	  if(($total%$pagesize)==0)
	   {
		   $totalpage=intval($total/$pagesize); 
	   }
	  else
	    $totalpage=intval($total/$pagesize)+1;
	  if ($total!=0&&$currpage>1)
       mysql_data_seek($result,(($currpage-1)*$pagesize));

       $i=0;
     while($arr=mysql_fetch_array($result)) 
     { 
     $i++;
     if($i>$pagesize)break; 
         
		 $code_list[] = $arr;
	 }
?>
<table align="center" cellpadding="0" cellspacing="0" class="table_list_98">
  <tr>
    <td valign="top">
		
		<table cellpadding="3" cellspacing="0" class="table_98">
		 <form action="?" method="post" name="form1">
		  <tr>
			<td >防伪码：<input type="text" name="bianhao" size="20" value="<?=$bianhao?>" />产品类型：<input type="text" name="product" size="10"  value="<?=$product?>">保留字段1：<input type="text" name="zd1" size="10" value="<?=$zd1?>">保留字段2：<input type="text" name="zd2" size="10" value="<?=$zd2?>" />
			  <input type="hidden" name="pz" id="pz" value="<?=$pz?>" />
			  <input name="submit" type="submit" id="submit" value="查找"> </td>
		  </tr>
		 </form>
		</table>	
	<form method="post" name="myform" id="myform" action="?" onsubmit="return ConfirmDel();">	
	<input type="hidden" name="bianhao" value="<?=$bianhao?>" />
	<input type="hidden" name="product" value="<?=$product?>" />
	<input type="hidden" name="zd1" value="<?=$zd1?>" />
	<input type="hidden" name="zd2" value="<?=$zd2?>" />
	<input type="hidden" name="h" value="<?=$h?>" />
	<table cellpadding="3" cellspacing="0" class="table_98">
        <tr>
          <td height="20"><input name="check" type='submit' value='删除选定的记录' onclick="document.myform.Action.value='delete'" >
		  <input name="check1" type='submit' value='导出选定的记录' onclick="document.myform.Action.value='export_code'" >
		  </td>
		  <td align="right">
		     显示条数 <input type="text" name="pz" id="pz" value="<?=$pagesize?>" size="8" onchange="javascript:submit()" /> &nbsp;&nbsp;&nbsp;&nbsp;
		     
		      当前第<?=$currpage?>页, 共<?=$totalpage?>页/<?php  echo $total;?>个记录&nbsp;
              <?php if($currpage==1){?>
              首页&nbsp;上一页&nbsp;
              <?php } else {?>
              <a href="<?php echo $filename;?>&page=1">首页</a>&nbsp;<a href="<?php echo $filename;?>&page=<?php echo ($currpage-1);?>">上一页</a>&nbsp;
              <?php }
			  if($currpage==$totalpage)
			  {?>
			  下一页&nbsp;尾页&nbsp;
              <?php }else{?>
              <a href="<?php echo $filename;?>&page=<?php echo ($currpage+1);?>">下一页</a>&nbsp;<a href="<?php echo $filename;?>&page=<?php echo  $totalpage;?>">尾页</a>&nbsp;
              <?php }?>
			  <select name='page' size='1' id="page" onchange='javascript:submit()'>
			  <?php
			  for($i=1;$i<=$totalpage;$i++)
			  {
			  ?>
			   <option value="<?php echo $i; ?>" <?php if ($currpage==$i) echo "selected"; ?>> 第<?php echo $i;?>页</option>
			   <?php }?>
			   </select>
			  </td>
        </tr>
    </table>
      <table cellpadding="3" cellspacing="1" class="table_98">        
		<tr>
          <td width="7%"><INPUT TYPE="checkbox" NAME="chkAll" id="chkAll" title="全选"  onclick="CheckAll(this.form)">&nbsp;全选</td>
          <td width="5%">本页序号</td>
		  <td width="6%">记录号</td>
		  <td width="11%">防伪码</td>
          <td width="14%">产品名称</td>
          <td width="12%">有效日期</td>
		  <td width="13%">保留字段1</td>
		  <td width="15%">保留字段2</td>
		  <td width="15%">
		  <?php
		  if($_GET["h"]==1){
		  ?>
		  <a href="?bianhao=<?=$bianhao?>&product=<?=$product?>&zd1=<?=$zd1?>&zd2=<?=$zd2?>&h=0&pz=<?=$pz?>&page=<?=$currpage?>">查询次数</a>
		  <? }else{ ?>
		  <a href="?bianhao=<?=$bianhao?>&product=<?=$product?>&zd1=<?=$zd1?>&zd2=<?=$zd2?>&h=1&pz=<?=$pz?>&page=<?=$currpage?>">查询次数</a>
		  <?
		  }
		  ?>
		  </td>
		</tr>
		<?php for($i=0;$i<count($code_list);$i++){?>
        <tr >
          <td><input name="chk[]" type="checkbox" id="chk[]" value="<? echo $code_list[$i]["id"];?>"></td>
		  <td><?=$i+1?></td>
		  <td><?=$code_list[$i]['id']?></td>
          <td><a href="?act=edit&id=<? echo $code_list[$i]["id"];?>" title="编辑本条防伪码"><?php echo $code_list[$i]["bianhao"];?></a></td>
          <td><?php echo $code_list[$i]["product"]?></td>
          <td><?php echo $code_list[$i]["riqi"]?></td>
          
          <td><?php echo $code_list[$i]["zd1"]?>&nbsp;</td>
          <td><?php echo $code_list[$i]["zd2"]?>&nbsp;</td>
          <td><? echo $code_list[$i]["hits"];?>&nbsp;</td>
        </tr>
		<?php
		}
		?>
		</table>

		<table cellpadding="3" cellspacing="0" class="table_98">
		<tr><td >
		<INPUT TYPE="checkbox" NAME="chkAll2" id="chkAll2" title="全选"  onclick="CheckAll2(this.form)">&nbsp;全选
			  <input name="check2" type='submit' value='删除选定的记录' onclick="document.myform.Action.value='delete'" >
			  <input name="Action" type="hidden" id="Action" value="">
			  <input name="check3" type='submit' value='导出选定的记录' onclick="document.myform.Action.value='export_code'" >
	       </td>
		   <td align="right">
              
			  当前第<?=$currpage?>页,&nbsp;共<?=$totalpage?>页/<?php  echo $total;?>个记录&nbsp;
              <?php if($currpage==1){?>
              首页&nbsp;上一页&nbsp;
              <?php } else {?>
              <a href="<?php echo $filename;?>&page=1">首页</a>&nbsp;<a href="<?php echo $filename;?>&page=<?php echo ($currpage-1);?>">上一页</a>&nbsp;
              <?php }
			  if($currpage==$totalpage)
			  {?>
			  下一页&nbsp;尾页&nbsp;
              <?php }else{?>
              <a href="<?php echo $filename;?>&page=<?php echo ($currpage+1);?>">下一页</a>&nbsp;<a href="<?php echo $filename;?>&page=<?php echo  $totalpage;?>">尾页</a>&nbsp;
              <?php }?>
			  </td>
		</tr>
		
      </table>
	
	  </FORM>

	  <table align="center" cellpadding="3" cellspacing="0" class="table_98">
		  <tr>
			<td>

			  <form action="?" method="post" name="form1">
			  <input type="hidden" name="pz" id="pz" value="<?=$pz?>" />
			  防伪码：<input type="text" name="bianhao" size="10" value="<?=$bianhao?>" />产品类型：<input type="text" name="product" size="10"  value="<?=$product?>">保留字段1：<input type="text" name="zd1" size="10" value="<?=$zd1?>">保留字段2：<input type="text" name="zd2" size="10" value="<?=$zd2?>" />
				<input name="submit" type="submit" id="submit" value="模糊查找">
			  </form>
			 
			 </td>
		  </tr>

		</table>
    
	</td>
  </tr>
</table>


<?php
}

if($act == "export_code")
{
?>
<table align="center" cellpadding="3" cellspacing="1" class="table_98">
 
  <tr>
    <td><a href="?"><strong>商品防伪码管理</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?act=import">商品防伪码导入</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?act=add">商品防伪码添加</a>
    </td>
  </tr>
</table>
<br>
<table align="center" cellpadding="3" cellspacing="1" class="table_98">
  <tr>
    <td><b>商品防伪码导出提示</b></td>
  </tr>
  <tr>
    <td>
	<ul class="exli">
	 <li>1、“导出”方式直接生成CSV格式文档。</li>
	 <li>2、请注意导入的文档编码，支持“ANSI简体中文”和“UTF-8”编码两种文档，请使用Ms Excel、 Notepad++、 EditPlus等软件打开和编辑文档。</li>
	 <li>3、csv文档均以英文逗号做为分隔符。</li>
	 <li>4、如果你是备份防伪码，下边的选项请全部选择。</li>
	 </ul>
	</td>
  </tr>
  <tr>
    <td><form name="form1" enctype="multipart/form-data" method="post" action="export.php?act=export_code" target="_blank">
      <label>
        <input type="hidden" name="chk" id="chk" value="<?=implode(",",$_POST['chk'])?>" />
		<input type="checkbox" name="field_bianhao" id="field_bianhao" value="1" checked="checked" />防伪码
		<input type="checkbox" name="field_product" id="field_product" value="1" checked="checked" />产品类型
		<input type="checkbox" name="field_riqi" id="field_riqi" value="1" checked="checked" />有效日期
		<input type="checkbox" name="field_zd1" id="field_zd1" value="1" checked="checked" />保留字段1
		<input type="checkbox" name="field_zd2" id="field_zd2" value="1" checked="checked" />保留字段2
        </label>

		,文档编码：
		<label>
		<select name="file_encoding">
			<option value="gbk">简体中文</option>
			<option value="utf8">UTF-8</option>
		</select>
		</label>
      <label>
      <input type="submit" name="Submit" value=" 确认导出 ">
      </label>
    </form>
    </td>
  </tr>
  
</table>
<?php
}

if($act =="import"){
?>

<table align="center" cellpadding="3" cellspacing="1" class="table_98">
 
  <tr>
    <td><a href="?">商品防伪码管理</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?act=import"><strong>商品防伪码导入</strong></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?act=add">商品防伪码添加</a>
    </td>
  </tr>
</table>
<br>
<table align="center" cellpadding="3" cellspacing="1" class="table_98">
  <tr>
    <td><b>商品防伪码导入提示</b></td>
  </tr>
  <tr>
    <td>
	<ul class="exli">
	<li>1、“导入”方式支持 XLS、CSV、TXT三种格式文档，请按：<b><a href="../data/exemple/xls_product_list.xls"><span class="red">XLS格式文件</span></a></b>、<b><a href="../data/exemple/csv_product_list.csv"><span class="red">CSV格式文件</span></a></b>、<b><a href="../data/exemple/txt_product_list.txt"><span class="red">TXT格式文件</span></a></b>，制作合适导入的标准文档,如果下载文档时是打开网页那请使用“右键另存为”下载文档。</li>
	<li>2、上述三个文档均为 “ANSI” 简体中文编码文档，在“导入”时选择“文档编码”为"UTF－8"导入时会有乱码。</li>
	<li>3、csv和txt文档均以英文逗号做为分隔符。</li>
	<li>4、程序对上传的文件大小不做限制，但一般空间都会有一个默认限制，一般为2M，所以上传的文件尽量小于2M,新生成的防伪码尽量分批上传。建议每次上传1000条。</li>
	<li>5、三个格式文档第一行的标题栏请不要删除，程序在导入过程中自动省略第一行。 </li>
	<li>6、如何批量生成防伪码？</li>
	<li>答：</li>
	<li>(1)、可使用Excel中的自动生成防伪码功能，生成新的防伪码，然后导入到系统中。</li>
	<li>(2)、使用“商品防伪码添加”中的“批量生成防伪码”，自动批量生成。</li>
	<li>7、如果用之前“导出选定的记录”导出的文档且是标准五项参数的文档，可直接导入。</li>
	</ul>
	   </td>
  </tr>
  <tr>
    <td><form name="form1" enctype="multipart/form-data" method="post" action="?act=save_add">
        文档编码：
		<label>
		<select name="file_encoding">
			<option value="gbk">简体中文</option>
			<option value="utf8">UTF-8</option>
		</select>
		</label>
		<label>
		<input type="file" name="file">
        </label>
      <label>
      <input type="submit" name="Submit" value="确认上传">
      </label>
    </form>
    </td>
  </tr>
  
</table>
<?
}

if($act == "save_add"){

	if($_FILES['file']['size']>0 && $_FILES['file']['name']!="")
	{
	    $file_size_max    = 3072000; 
		$store_dir        = "../upload/";
		$ext_arr          = array('csv','xls','txt');
		$accept_overwrite = true;
		$date1            = date("YmdHis");
		$file_type        = extend($_FILES['file']['name']);
		$newname          = $date1.".".$file_type;		
		if (in_array($file_type,$ext_arr) === false){
		  echo "<script>alert('上传的文件格式错误，请按要求的文件格式上传');history.back()</script>";
		  exit;
	   }
		if ($_FILES['file']['size'] > $file_size_max) {
		  echo "<script>alert('对不起，你上传的文件大于3000k');history.back()</script>";
		  exit;
		}
		
		if (file_exists($store_dir.$_FILES['file']['name'])&&!$accept_overwrite)
		{
		  echo "<script>alert('文件已存在，不能新建');history.back()</script>";
		  exit;
		}
		if (!move_uploaded_file($_FILES['file']['tmp_name'],$store_dir.$newname)) {
		  echo "<script>alert('复制文件失败');history.back()</script>";
		  exit;
		}
	  $filepath = $store_dir.$newname;
	  
	 }else{
	   $filepath = "";
	   
	 }
	 if($filepath == ""){

	    echo "<script>alert('请先选择要上传的文件');history.back()</script>";
		exit;
	 }
	
	$file_encoding = $_POST["file_encoding"];

	if($file_type == "xls"){
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('utf-8');
		$data->read($filepath);
		for ($i = 2; $i < $data->sheets[0]['numRows']; $i++) {
			$sql = "select id from tgs_code where bianhao='".$data->sheets[0]['cells'][$i][1]."' limit 1";	
			$res = mysql_query($sql);	
			$arr = mysql_fetch_array($res);	
			if(mysql_num_rows($res)>0){
			echo "<script>alert('该防伪码已存在，请修正你的防伪码！');location.href='?act=edit&id=".$arr["id"]."'</script>";
			exit;
			}
			$sql = "INSERT INTO tgs_code (bianhao,riqi,product,zd1,zd2)VALUES('".
			$data->sheets[0]['cells'][$i][1]."','".
			$data->sheets[0]['cells'][$i][2]."','".
			$data->sheets[0]['cells'][$i][3]."','".
			$data->sheets[0]['cells'][$i][4]."','".
			$data->sheets[0]['cells'][$i][5]."')";
		    mysql_query($sql);
		}
	  
	  $k=$i-2;
	}elseif($file_type == "csv"){	   
	  setlocale(LC_ALL, 'zh_CN.UTF-8');
	   $file  = fopen($filepath,"r");  
	   $k     = 1;
	   while(!feof($file) && $data = __fgetcsv($file))
	   {
		 $result = array();  
		   if($k>1 && !empty($data))
		   {  
			  for($i=0;$i<5;$i++)
			  {
				  array_push($result,$data[$i]);
			  }			  
		      if($file_encoding == "gbk"){			   
			   $result_1 = iconv("gbk", "utf-8"."//IGNORE", $result[1]);
			   $result_2 = iconv("gbk", "utf-8"."//IGNORE", $result[2]);
			   $result_3 = iconv("gbk", "utf-8"."//IGNORE", $result[3]);
			   $result_4 = iconv("gbk", "utf-8"."//IGNORE", $result[4]);			  
			  }else{			  
			   $result_1 = $result[1];
			   $result_2 = $result[2];
			   $result_3 = $result[3];
			   $result_4 = $result[4];
			  }  			  
			$sql = "select id from tgs_code where bianhao='".$result[0]."' limit 1";	
			$res = mysql_query($sql);	
			$arr = mysql_fetch_array($res);	
			if(mysql_num_rows($res)>0){
			echo "<script>alert('该防伪码已存在，请修正你的防伪码！');location.href='?act=edit&id=".$arr["id"]."'</script>";
			exit;
			}else{
			$sql = "insert into tgs_code (bianhao,riqi,product,zd1,zd2) values ('".$result[0]."','".$result_1."','".$result_2."','".$result_3."','".$result_4."')";
			mysql_query($sql) or die("ERR:".$sql);
			}
		  }  
		 $k++;  
		 }
		 $k=$k-2;
		 fclose($file);
	}elseif($file_type == "txt"){	    
		$row = file($filepath); 
		$k   = 1;
		for ($i=1;$i<count($row);$i++) 
		{ 
			$result = explode(",",$row[$i]);
			if($file_encoding == "gbk"){			   
			   $result_1 = iconv("gbk", "utf-8"."//IGNORE", $result[1]);
			   $result_2 = iconv("gbk", "utf-8"."//IGNORE", $result[2]);
			   $result_3 = iconv("gbk", "utf-8"."//IGNORE", $result[3]);
			   $result_4 = iconv("gbk", "utf-8"."//IGNORE", $result[4]);			  
		    }else{			  
			   $result_1 = $result[1];
			   $result_2 = $result[2];
			   $result_3 = $result[3];
			   $result_4 = $result[4];
		    }  
			if($result_1 ==""){
				$result_1="2020-12-30";
			}
			if($result_2 ==""){
				$result_2="产品名称";
			}
			if($result_3 ==""){
				$result_3="备用A";
			}
			if($result_4 ==""){
				$result_4="备用B";
			}
			$sql = "select id from tgs_code where bianhao='".$result[0]."' limit 1";	
			$res = mysql_query($sql);	
			$arr = mysql_fetch_array($res);	
			if(mysql_num_rows($res)>0){
			echo "<script>alert('该防伪码已存在，请修正你的防伪码！');location.href='?act=edit&id=".$arr["id"]."'</script>";
			exit;
			}else{
			$sql = "insert into tgs_code (bianhao,riqi,product,zd1,zd2) values ('".$result[0]."','".$result_1."','".$result_2."','".$result_3."','".$result_4."')";
			mysql_query($sql);
			$k++;
			}
		}
		$k=$k-1;
		fclose($row);
	}
	$msg= "上传成功".$k."条记录";
	@unlink($filepath);
	echo "<script>alert('".$msg."');location.href='?'</script>";
	exit;
}

if($act == "add"){

?>
<table align="center" cellpadding="3" cellspacing="1" class="table_98"> 
  <tr>
    <td><a href="?">商品防伪码管理</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?act=import">商品防伪码导入</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?act=add"><strong>商品防伪码添加</strong></a>
    </td>
  </tr>
</table>
<br>
<table align="center" cellpadding="0" cellspacing="0"  class="table_98">
  <tr>
    <td valign="top">
	<form name="form1" method="post" action="?act=save_create">
        <table cellpadding="3" cellspacing="1"  class="table_50">
          <tr>
            <td colspan="2" align="center">批量生成防伪码</td>
		  </tr>
          <tr >
            <td width="20%"> 防伪码长度：</td>
            <td width="80%"><input name="code_length" type="text" id="code_length" size="20" value="12">（建议8-18以内）</td>
          </tr>
          <tr >
            <td>防伪码前缀：</td>
            <td><input type="text" name="code_pre" value="" maxlength="4">（建议2-4位） </td>
          </tr>
		  <tr >
            <td>防伪码形式：</td>
            <td><select name="code_type">
			    <option value="0">前缀+数字和字母</option>
				<option value="1">前缀+字母(不限大小写)</option>
				<option value="2">前缀+数字</option>
				<option value="3">前缀+字母(大写)</option>
				</select></td>
          </tr>

		  <tr>
            <td>生成数量：</td>
            <td><input type="text" name="code_count" value="50">（一次过多可能会造成数据库处理变慢，建议1000条以内）</td>
          </tr>

		  <tr >
            <td>产品类型：</td>
            <td><input type="text" name="product" value=""></td>
          </tr>
		  
		  <tr>
            <td>有效日期：</td>
            <td><input type="text" name="riqi" value=""></td>
          </tr>
		   <tr >
            <td>保留字段1：</td>
            <td><input type="text" name="zd1" value=""></td>
          </tr>
		  <tr >
            <td>保留字段2：</td>
            <td><input type="text" name="zd2" value=""></td>
          </tr>

          
          <tr >
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value=" 批 量 生 成 " ></td>
          </tr>
        </table>
      
	  </form>
	  <br />
	<form name="form1" method="post" enctype="multipart/form-data" action="?act=save_add2">
	  
        <table cellpadding="3" cellspacing="1"  class="table_50">
          <tr>
            <td colspan="2" align="center">添加单个防伪码</td>
		  </tr>
          <tr >
            <td width="20%"> 防伪码：</td>
            <td width="80%"><input name="bianhao" type="text" id="bianhao" value=""></td>
          </tr>
          <tr >
            <td>有期日期：</td>
            <td><input type="text" name="riqi" value=""></td>
          </tr>
		  <tr >
            <td> 产品类型：</td>
            <td><input name="product" type="text" value=""></td>
          </tr>

		  <tr >
            <td>保留字段1：</td>
            <td><input type="text" name="zd1" value="<? echo $zd1?>"></td>
          </tr>
		  <tr >
            <td>保留字段2：</td>
            <td><input type="text" name="zd2" value="<? echo $zd2?>"></td>
          </tr>
          
          <tr >
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value=" 确 定 " ></td>
          </tr>
        </table>
      
	  </form>
	  
	  </td>
  </tr>
</table>
<?
}

if($act == "save_add2"){   
    $bianhao      = trim($_REQUEST["bianhao"]);	
	$riqi         = trim($_REQUEST["riqi"]);
	$product      = strreplace(trim($_REQUEST["product"]));
	$zd1          = strreplace($_REQUEST["zd1"]);
	$zd2          = strreplace($_REQUEST["zd2"]);	

	if($bianhao=="")
	{
	  echo "<script>alert('防伪码不能为空');location.href='?act=add'</script>";
	  exit;
	}
	$sql = "select id from tgs_code where bianhao='".$bianhao."' limit 1";
	$res = mysql_query($sql);
	$arr = mysql_fetch_array($res);
	if(mysql_num_rows($res)>0){

	  echo "<script>alert('防伪码已存在');location.href='?act=edit&id=".$arr["id"]."'</script>";
	  exit;
	}
    if($product == "")
	{
	  $product = "产品名称";
	}
	if($riqi == "")
	{
	  $riqi = "2020-12-31";
	}
	if($zd1 == "")
	{
	  $zd1 = "备注A";
	}
	if($zd2 == "")
	{
	  $zd2 = "备注B";
	}
	$sql="insert into tgs_code (bianhao,riqi,product,zd1,zd2)values('$bianhao','$riqi','$product','$zd1','$zd2')";
	mysql_query($sql);
	echo "<script>alert('添加成功');location.href='?'</script>";
	exit;
	

}
if($act == "save_create")
{
    $code_length = trim($_POST['code_length']);
	$code_pre    = trim($_POST['code_pre']);
	$code_type   = $_POST['code_type'];
	$code_count  = trim($_POST['code_count']);	
	$riqi        = trim($_POST['riqi']);
	$product     = strreplace(trim($_POST['product']));
	$zd1         = strreplace($_POST['zd1']);
	$zd2         = strreplace($_POST['zd2']);
	if(strlen($code_pre)>= $code_length)
	{
	  echo "<script>alert('防伪码前缀的长度不能大于等于防伪码长度');location.href='?act=add'</script>";
	  exit;
	}
	
	if(!is_numeric($code_length))
	{
	  echo "<script>alert('防伪码长度请输入数字');location.href='?act=add'</script>";
	  exit;
	}
	if($code_length<4)
	{
	  echo "<script>alert('防伪码长度最少为4位');location.href='?act=add'</script>";
	  exit;
	}
	if($product == "")
	{
	  $product = "产品名称";
	}
	if($riqi == "")
	{
	  $riqi = "2020-12-31";
	}
	if($zd1 == "")
	{
	  $zd1 = "备注A";
	}
	if($zd2 == "")
	{
	  $zd2 = "备注B";
	}
	
	$new_code_length = $code_length-strlen($code_pre);
	
	for($i=1;$i<=$code_count;$i++)
	{
	   $bianhao  = $code_pre.genRandomString($new_code_length,$code_type);
	   $sql = "insert into tgs_code set bianhao = '".$bianhao."',product='".$product."',riqi='".$riqi."',zd1='".$zd1."',zd2='".$zd2."'";
	   mysql_query($sql);
	}
	
	echo "<script>alert('批量生成".$code_count."成功');location.href='?'</script>";
	exit;
}

if($act == "edit"){   
       $editid = $_GET["id"];
		$sql="select * from tgs_code where id='$editid' limit 1";
		$result=mysql_query($sql);
		$arr=mysql_fetch_array($result);		
		$bianhao    = $arr["bianhao"];
		$riqi       = $arr["riqi"];
		$product    = $arr["product"];
		$zd1        = $arr["zd1"];
		$zd2        = $arr["zd2"];		
		$rn         = "修改商品防伪码";
?>

<table align="center" cellpadding="3" cellspacing="1" class="table_98">
 
  <tr>
    <td><a href="?">商品防伪码管理</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?act=import">商品防伪码导入</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?act=add">商品防伪码添加</a>
    </td>
  </tr>
</table>
<br>
<table align="center" cellpadding="0" cellspacing="0" class="table_98">
  <tr>
    <td valign="top">
	
	<form name="form1" method="post" enctype="multipart/form-data" action="?act=save_edit">
    
		<table cellpadding="3" cellspacing="1" class="table_50">
          <tr>
            <td colspan="2" align="left"><? echo $rn?>
            <input name="editid" type="hidden" id="editid" value="<? echo $editid?>"></td></tr>
          <tr >
            <td width="20%"> 防伪码：</td>
            <td width="80%" ><input name="bianhao" type="text" id="bianhao" value="<? echo $bianhao?>"></td>
          </tr>
          <tr >
            <td>有效日期：</td>
            <td><input type="text" name="riqi" value="<? echo $riqi?>"></td>
          </tr>
		  <tr >
            <td> 产品类型：</td>
            <td><input type="text" name="product" value="<? echo $product?>" /></td>
          </tr>

		  <tr >
            <td>保留字段１：</td>
            <td><input type="text" name="zd1" value="<? echo $zd1?>"></td>
          </tr>
		  <tr >
            <td>保留字段2：</td>
            <td><input type="text" name="zd2" value="<? echo $zd2?>"></td>
          </tr>          
          
          <tr >
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value=" 确 定 " ></td>
          </tr>
        </table>
      
	  </form>
	  
	  </td>
  </tr>
</table>
<?
}

//////////////////////////////////////////
if($act == "save_edit"){

    $editid     = $_REQUEST["editid"]; 
    $bianhao    = trim($_REQUEST["bianhao"]);
	
	$riqi          = trim($_REQUEST["riqi"]);
	$product       = strreplace(trim($_REQUEST["product"]));	
	$zd1           = strreplace($_REQUEST["zd1"]);
	$zd2           = strreplace($_REQUEST["zd2"]);
	

	if($editid == "")
	{
	  echo "<script>alert('ID参数有误');location.href='?'</script>";
	  exit;
	}
	if($bianhao=="")
	{
	  echo "<script>alert('防伪码不能为空');location.href='?act=edit&id=".$editid."'</script>";
	  exit;
	}

	$sql="update tgs_code set bianhao='$bianhao',riqi='$riqi',product='$product',zd1='$zd1',zd2='$zd2' where id='$editid' limit 1";
	mysql_query($sql);

	echo "<script>alert('修改成功');location.href='?'</script>";
	exit; 

}

if($act == "delart"){

	$chk = $_REQUEST["chk"];
	if(count($chk)>0){

	  $countchk = count($chk);
		for($i=0;$i<=$countchk;$i++)  
		{  
		  mysql_query("delete from tgs_code where id='$chk[$i]' limit 1");  
		  
		} 
		echo "<script>alert('删除成功');location.href='?'</script>";
	}
}

if($act == "query_record")
{ 
  $code_list = array();
  $key       = trim($_REQUEST["key"]);
  $qupz        = trim($_REQUEST['qupz']);
  $sql="select * from tgs_history where 1";
  if($key != ""){
    $sql.=" and keyword like '%$key%'";
  }  
  $sql.=" order by id desc";
  $result=mysql_query($sql); 
  if($qupz == ""){ 
    $pagesize = $cf['list_num'];
	$qupz       = $cf['list_num'];
  }else{
	$pagesize = $qupz;
  }
  $total    = mysql_num_rows($result); 	
  $filename = "?act=query_record&keyword=".$key."&qupz=".$qupz."";
  $currpage  = intval($_REQUEST["page"]);
  if(!is_int($currpage))
	$currpage=1;
	if(intval($currpage)<1)$currpage=1;
    if(intval($currpage-1)*$pagesize>$total)$currpage=1;

	if(($total%$pagesize)==0){
	  $totalpage=intval($total/$pagesize); 
	}
	else
	  $totalpage=intval($total/$pagesize)+1;
	  if ($total!=0&&$currpage>1)
       mysql_data_seek($result,(($currpage-1)*$pagesize));
     $i=0;
     while($arr=mysql_fetch_array($result)) 
     { 
     $i++;
     if($i>$pagesize)break; 
         
		 $code_list[] = $arr;
	 }
?>

<SCRIPT language="javascript">
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.Name != "chkAll"&&e.disabled==false)
       e.checked = form.chkAll.checked;
    }
  }
function CheckAll2(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.Name != "chkAll2"&&e.disabled==false)
       e.checked = form.chkAll2.checked;
    }
  }  
  
function ConfirmDel()
{
	if(document.myform.Action.value=="delete_history")
	{
		document.myform.action="?act=delete_history";
		if(confirm("确定要删除选中的记录吗？本操作不可恢复！"))
		    return true;
		else
			return false;
	}	
}

</SCRIPT>
<table align="center" cellpadding="0" cellspacing="0" class="table_list_98">
  <tr>
    <td valign="top">
		
		<table cellpadding="3" cellspacing="0" class="table_98">
		 <form action="?act=query_record" method="post" name="form1">
		  <tr>
			<td>查询记录&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 关键字：<input type="text" name="key"> <input name="submit" type="submit" id="submit" value="查找"> </td>
		  </tr>
		 </form>
		</table>
	
	<form method="post" name="myform" id="myform" action="?act=query_record" onsubmit="return ConfirmDel();">
	<input type="hidden" name="key" value="<?=$key?>" />
	<table cellpadding="3" cellspacing="0" class="table_98">
        <tr>
          <td height="20"><input name="check" type='submit' value='删除选定的记录' onclick="document.myform.Action.value='delete_history'" ><span class='red'>(*请定期清理查询记录)</span></td>
		  <td align="right">
		      显示条数 <input type="text" name="qupz" id="qupz" value="<?=$pagesize?>" size="8" onchange="javascript:submit()" /> &nbsp;&nbsp;&nbsp;&nbsp;
		     
		      当前第<?=$currpage?>页, 共<?=$totalpage?>页/<?php  echo $total;?>个记录&nbsp;
              <?php if($currpage==1){?>
              首页&nbsp;上一页&nbsp;
              <?php } else {?>
              <a href="<?php echo $filename;?>&page=1">首页</a>&nbsp;<a href="<?php echo $filename;?>&page=<?php echo ($currpage-1);?>">上一页</a>&nbsp;
              <?php }
			  if($currpage==$totalpage)
			  {?>
			  下一页&nbsp;尾页&nbsp;
              <?php }else{?>
              <a href="<?php echo $filename;?>&page=<?php echo ($currpage+1);?>">下一页</a>&nbsp;<a href="<?php echo $filename;?>&page=<?php echo  $totalpage;?>">尾页</a>&nbsp;
              <?php }?>
			  <select name='page' size='1' id="page" onchange='javascript:submit()'>
			  <?php
			  for($i=1;$i<=$totalpage;$i++)
			  {
			  ?>
			   <option value="<?php echo $i; ?>" <?php if ($currpage==$i) echo "selected"; ?>> 第<?php echo $i;?>页</option>
			   <?php }?>
			   </select>
		  </td>
        </tr>
    </table>

      <table cellpadding="3" cellspacing="1" class="table_98">        
		<tr>
          <td width="10%"><INPUT TYPE="checkbox" NAME="chkAll" id="chkAll" title="全选"  onclick="CheckAll(this.form)">&nbsp;全选</td>
		  <td width="10%">序号</td>
          <td width="20%">搜索关键字</td>
          <td width="20%">搜索日期</td>
          <td width="20%">搜索IP</td>
		</tr>
		<?php for($i=0;$i<count($code_list);$i++){?>
        <tr >
          <td><input name="chk[]" type="checkbox" id="chk[]" value="<? echo $code_list[$i]["id"];?>">&nbsp;</td>
		  <td><? echo $i+1;?></td>
          <td><?php echo $code_list[$i]["keyword"];?></td>
          <td><?php echo $code_list[$i]["addtime"]?></td>
          <td>IP地址：<?php echo $code_list[$i]["addip"]?></td>
        </tr>
		<?php
		}
		?>
		</table>

		<table cellpadding="3" cellspacing="0" class="table_98">
		<tr>
		   <td>
		      <INPUT TYPE="checkbox" NAME="chkAll2" id="chkAll2" title="全选"  onclick="CheckAll2(this.form)">&nbsp;全选
			  <input name="check" type='submit' value='删除选定的记录' onclick="document.myform.Action.value='delete_history'" >
			  <input name="Action" type="hidden" id="Action" value="">
	       </td>
		   <td align="right">
			  当前第<?=$currpage?>页,&nbsp;共<?=$totalpage?>页/<?php  echo $total;?>个记录&nbsp;
              <?php if($currpage==1){?>
              首页&nbsp;上一页&nbsp;
              <?php } else {?>
              <a href="<?php echo $filename;?>&page=1">首页</a>&nbsp;<a href="<?php echo $filename;?>&page=<?php echo ($currpage-1);?>">上一页</a>&nbsp;
              <?php }
			  if($currpage==$totalpage)
			  {?>
			  下一页&nbsp;尾页&nbsp;
              <?php }else{?>
              <a href="<?php echo $filename;?>&page=<?php echo ($currpage+1);?>">下一页</a>&nbsp;<a href="<?php echo $filename;?>&page=<?php echo  $totalpage;?>">尾页</a>&nbsp;
              <?php }?>
			</td>
		</tr>		
      </table>	
	  </FORM>
    
	</td>
  </tr>
</table>
<?php
}

if($act == "delete_history")
{

	$chk = $_REQUEST["chk"];
	if(count($chk)>0){

	  $countchk = count($chk);
		for($i=0;$i<=$countchk;$i++)  
		{  
		  mysql_query("delete from tgs_history where id='$chk[$i]' limit 1");		  
		} 
		echo "<script>alert('删除成功');location.href='?act=query_record'</script>";
	}
}
?>
<?php
if($act == "config"){  
?>
<table align="center" cellpadding="0" cellspacing="0" class="table_98">
  <tr>
    <td valign="top">	
	<form name="form1" method="post" enctype="multipart/form-data" action="?act=save_config">    
		<table cellpadding="3" cellspacing="1" class="table_98">
          <tr>
            <td colspan="3" align="center">配置信息</td></tr>
          <tr >
            <td width="10%"> 系统名称：</td>
            <td width="40%" ><input name="cf[site_name]" type="text" id="cf[site_name]" size="50" value="<? echo $cf['site_name']?>"></td>
			<td width="50%" > </td>
          </tr>
          <tr >
            <td>系统网址：</td>
            <td><input type="text" name="cf[site_url]" value="<? echo $cf['site_url']?>" size="50"></td>
			<td > </td>
          </tr>
		  <tr >
            <td> 首页网页关键字(keywords)：</td>
            <td><textarea name="cf[page_keywords]" cols="65" rows="5"><? echo $cf['page_keywords']?></textarea></td>
			<td > </td>
          </tr>
		  <tr >
            <td> 首页网页描述(description)：</td>
            <td><textarea name="cf[page_desc]" cols="65" rows="5"><? echo $cf['page_desc']?></textarea></td>
			<td > </td>
          </tr>		  
		   <tr >
            <td> 首页搜索时是否显示验证码：</td>
            <td><input type="radio" name="cf[yzm_status]" value="1" <? if($cf['yzm_status']==1) echo "checked='checked'"?> />显示 <input type="radio" name="cf[yzm_status]" value="0" <? if($cf['yzm_status']==0) echo "checked='checked'"?> />不显示	</td>
			<td >
			<?php $arr1_gd_info = gd_info();
			       if(!$arr1_gd_info['PNG Support'])
					   {
					   echo "(<span class='red'>当前操作系统的GD库不支持PNG格式的图片,验证码无法生成</span>)";
					   }
			 ?>
			</td>
          </tr>
		   <tr >
            <td>默认每页显示数量</td>
            <td><input type="text" name="cf[list_num]" id="list_num" value="<?=$cf['list_num']?>" /></td>
			<td></td>
          </tr>

		  <tr>
				  <td width="10%">系统时区：</td>
				  <td><select name="cf[timezone]">
					<option value="-12" <? if($cf['timezone']=='-12') echo "selected='selected'";?>>(GMT -12:00) Eniwetok, Kwajalein</option>
					<option value="-11" <? if($cf['timezone']=='-11') echo "selected='selected'";?>>(GMT -11:00) Midway Island, Samoa</option>
					<option value="-10" <? if($cf['timezone']=='-10') echo "selected='selected'";?>>(GMT -10:00) Hawaii</option>
					<option value="-9" <? if($cf['timezone']=='-9') echo "selected='selected'";?>>(GMT -09:00) Alaska</option>
					<option value="-8" <? if($cf['timezone']=='-8') echo "selected='selected'";?>>(GMT -08:00) Pacific Time (US &amp; Canada), Tijuana</option>
					<option value="-7" <? if($cf['timezone']=='-7') echo "selected='selected'";?>>(GMT -07:00) Mountain Time (US &amp; Canada), Arizona</option>
					<option value="-6" <? if($cf['timezone']=='-6') echo "selected='selected'";?>>(GMT -06:00) Central Time (US &amp; Canada), Mexico City</option>
					<option value="-5" <? if($cf['timezone']=='-6') echo "selected='selected'";?>>(GMT -05:00) Eastern Time (US &amp; Canada), Bogota, Lima, Quito</option>
					<option value="-4" <? if($cf['timezone']=='-4') echo "selected='selected'";?>>(GMT -04:00) Atlantic Time (Canada), Caracas, La Paz</option>
					<option value="-3.5" <? if($cf['timezone']=='-3.5') echo "selected='selected'";?>>(GMT -03:30) Newfoundland</option>
					<option value="-3" <? if($cf['timezone']=='-3') echo "selected='selected'";?>>(GMT -03:00) Brassila, Buenos Aires, Georgetown, Falkland Is</option>
					<option value="-2" <? if($cf['timezone']=='-2') echo "selected='selected'";?>>(GMT -02:00) Mid-Atlantic, Ascension Is., St. Helena</option>
					<option value="-1" <? if($cf['timezone']=='-1') echo "selected='selected'";?>>(GMT -01:00) Azores, Cape Verde Islands</option>
					<option value="0" <? if($cf['timezone']=='0') echo "selected='selected'";?>>(GMT) Casablanca, Dublin, Edinburgh, London, Lisbon, Monrovia</option>
					<option value="1" <? if($cf['timezone']=='1') echo "selected='selected'";?>>(GMT +01:00) Amsterdam, Berlin, Brussels, Madrid, Paris, Rome</option>
					<option value="2" <? if($cf['timezone']=='2') echo "selected='selected'";?>>(GMT +02:00) Cairo, Helsinki, Kaliningrad, South Africa</option>
					<option value="3" <? if($cf['timezone']=='3') echo "selected='selected'";?>>(GMT +03:00) Baghdad, Riyadh, Moscow, Nairobi</option>
					<option value="3.5" <? if($cf['timezone']=='3.5') echo "selected='selected'";?>>(GMT +03:30) Tehran</option>
					<option value="4" <? if($cf['timezone']=='4') echo "selected='selected'";?>>(GMT +04:00) Abu Dhabi, Baku, Muscat, Tbilisi</option>
					<option value="4.5" <? if($cf['timezone']=='4.5') echo "selected='selected'";?>>(GMT +04:30) Kabul</option>
					<option value="5" <? if($cf['timezone']=='5') echo "selected='selected'";?>>(GMT +05:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
					<option value="5.5" <? if($cf['timezone']=='5.5') echo "selected='selected'";?>>(GMT +05:30) Bombay, Calcutta, Madras, New Delhi</option>
					<option value="5.75" <? if($cf['timezone']=='5.75') echo "selected='selected'";?>>(GMT +05:45) Katmandu</option>
					<option value="6" <? if($cf['timezone']=='6') echo "selected='selected'";?>>(GMT +06:00) Almaty, Colombo, Dhaka, Novosibirsk</option>
					<option value="6.5" <? if($cf['timezone']=='6.5') echo "selected='selected'";?>>(GMT +06:30) Rangoon</option>
					<option value="7" <? if($cf['timezone']=='7') echo "selected='selected'";?>>(GMT +07:00) Bangkok, Hanoi, Jakarta</option>
					<option value="8" <? if($cf['timezone']=='8') echo "selected='selected'";?>>(GMT +08:00) Beijing, Hong Kong, Perth, Singapore, Taipei</option>
					<option value="9" <? if($cf['timezone']=='9') echo "selected='selected'";?>>(GMT +09:00) Osaka, Sapporo, Seoul, Tokyo, Yakutsk</option>
					<option value="9.5" <? if($cf['timezone']=='9.5') echo "selected='selected'";?>>(GMT +09:30) Adelaide, Darwin</option>
					<option value="10" <? if($cf['timezone']=='10') echo "selected='selected'";?>>(GMT +10:00) Canberra, Guam, Melbourne, Sydney, Vladivostok</option>
					<option value="11" <? if($cf['timezone']=='11') echo "selected='selected'";?>>(GMT +11:00) Magadan, New Caledonia, Solomon Islands</option>
					<option value="12" <? if($cf['timezone']=='12') echo "selected='selected'";?>>(GMT +12:00) Auckland, Wellington, Fiji, Marshall Island</option>
					<option value="13" <? if($cf['timezone']=='13') echo "selected='selected'";?>>(GMT +13:00) Nukualofa</option>
				  </select>
				  </td>
				  <td></td>
		  </tr>

				<tr>
				  <td>系统时间格式：</td>
				  <td><input name="cf[time_format]" type="text" size="12" value="<? echo $cf['time_format'];?>"></td>
				  <td>服务器时间：<?=date($cf['time_format'],time());?><br />
				      程序时间:<?=$GLOBALS['tgs']['cur_time'];?>
				  </td>
				</tr>
		  <tr >
            <td> 查询结果为真时：<br /></td>
            <td><textarea name="cf[notice_1]" id="cf[notice_1]" cols="65" rows="5"><? echo ($cf['notice_1'])?></textarea></td>
			<td > (内容可自由编辑成您要的文字，其中{{bianhao}},{{product}},{{riqi}},{{hits}},{{zd1}},{{zd2}}等"系统类字符串"可自由组合，如保留一定要是完整“系统类字符串”)</td>			
          </tr>
		  <tr >
            <td> 查询结果为真且非第一次查询时：</td>
            <td><textarea name="cf[notice_2]" id="cf[notice_2]" cols="65" rows="5"><? echo $cf['notice_2']?></textarea>			    
		</td>
            <td >
		(内容可自由编辑成您要的文字，其中{{bianhao}},{{product}},{{riqi}},{{hits}},{{zd1}},{{zd2}}等"系统类字符串"可自由组合，如保留一定要是完整“系统类字符串”)
			 </td>			 
          </tr>
		  <tr >
            <td> 查询结果为空时：</td>
            <td><textarea name="cf[notice_3]" id="cf[notice_3]" cols="65" rows="5"><? echo ($cf['notice_3'])?></textarea>		       
         </td>
		 <td > 
		(内容可自由编辑成您要的文字，其中仅用到了“{{bianhao}}系统类字符串")
			</td>
          </tr>
		  <tr >
            <td> 使用说明：</td>
            <td><textarea name="cf[notices]" id="cf[notices]" cols="65" rows="5"><? echo $cf['notices']?></textarea>			
		</td>
		<td > 
		(内容可自由编辑成您要的文字，其中{{bianhao}},{{product}},{{riqi}},{{hits}},{{zd1}},{{zd2}}等“系统类字符串"可自由组合，如保留一定要是完整“系统类字符串”)
			</td>
          </tr>         
          <tr >
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value=" 确 定 " ></td>
			<td></td>
          </tr>
        </table>      
	  </form>	  
	  </td>
  </tr>
</table>
<?
}
//////////////////////////////////////////
if($act == "save_config"){

    $arr = array();
    $sql = "SELECT id, value FROM tgs_config";
    $res = mysql_query($sql);
    while($row = mysql_fetch_array($res))
    {
        $arr[$row['id']] = $row['value'];
    }
	 foreach ($_POST['cf'] AS $key => $val)
    {
        if($arr[$key] != $val)
        { 
		  
		  if($key=='notices' or $key=='notice_1' or $key == 'notice_2' or $key=='notice_3'){
              $val = strreplace($val);
		  }
		  if($key=='site_close_reason'){
              $val = strreplace($val);
		  }

	      $sql="update tgs_config set code_value='".trim($val)."' where code='".$key."' limit 1";
		  mysql_query($sql) or die("err:".$sql);
		}
	}

	
    $file_var_list = array();
    $sql = "SELECT * FROM tgs_config WHERE parentid > 0 AND type = 'file'";
	$res = mysql_query($sql);

	while($row = mysql_fetch_array($res))
    {
        $file_var_list[$row['code']] = $row;
    }
	foreach ($_FILES AS $code => $file)
    {
		
        if ((isset($file['error']) && $file['error'] == 0) || (!isset($file['error']) && $file['tmp_name'] != 'none'))
        {   
			
			$file_size_max    = 307200; 
			$accept_overwrite = true;
			$ext_arr          = array('gif','jpg','png');
			$add              = true;
			$ext              = extend($file['name']);
			
			
			if (in_array($ext,$ext_arr) === false) {
				   $msg .= $_LANG["page"]["_you_upload_pic_type_"]."<br />";
				   
			}else if ($file['size'] > $file_size_max) {
				  $msg .= $_LANG["page"]["_you_upload_pic_larger_than_300k_"]."<br />";
				  
			}else{
				
				if($code == 'site_logo'){
					$date1       =  "logo".date("His");
					$store_dir   = "../upload/logo/";
					$newname     = $date1.".".$ext;

					if (!move_uploaded_file($file['tmp_name'],$store_dir.$newname)) {
					  $msg .= $_LANG['page']['_Copy_file_failed_']."<br />";
					  
					}else{
						
						if (file_exists($store_dir.$file_var_list[$code]['value']))
                        {
                          
						  @unlink($store_dir.$file_var_list[$code]['value']);
                        }

						$sql = "UPDATE tgs_config SET code_value = '$newname' WHERE code = '$code' limit 1";
                        mysql_query($sql);
					}

				}
			}
		}

	}
	   echo "<script>window.location.href='?act=config'</script>";
	   exit; 
}
////
if($act == "superadmin"){
?>
<table align="center" cellpadding="0" cellspacing="0" class="table_98">
  <tr>
    <td valign="top">
      <table cellpadding="3" cellspacing="1" class="table_50">        
		<tr>
          <td width="10%">id</td>
          <td width="20%">管理员帐户</td>
          <td width="20%">操作</td>          
		</tr>
		<?php
		 $sql = "select * from tgs_admin order by id asc";
		 $res = mysql_query($sql);
		 while($arr = mysql_fetch_array($res)){		
		?>
        <tr >
          <td><? echo $arr["id"];?></td>
          <td><a href="?act=edit_superadmin&id=<? echo $arr["id"];?>" title="编辑"><?php echo $arr["username"];?></a></td>
          <td><a href="?act=delete_superadmin&id=<?=$arr['id']?>">删除</a></td>
        </tr>
		<?php
		}
		?>
		</table>
    
	</td>
  </tr>
</table>
<br />
<table align="center" cellpadding="0" cellspacing="0" class="table_98">
  <tr>
    <td valign="top">
	
	<form name="form1" method="post" enctype="multipart/form-data" action="?act=save_add_superadmin">
    
		<table cellpadding="3" cellspacing="1" class="table_50">
          <tr>
            <td colspan="2" align="center">填加管理员帐户</td></tr>
          <tr >
            <td width="20%"> 管理员帐户：</td>
            <td width="80%" ><input name="username" type="text" id="username" size="20" value=""></td>
          </tr>
          <tr >
            <td>管理密码：</td>
            <td><input type="password" name="password" value="" />(如不修改密码则无需添写,密码长度不能少于4位)</td>
          </tr>
		  <tr >
            <td>确认管理密码：</td>
            <td><input type="password" name="repassword" value="" /></td>
          </tr>
          
          <tr >
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value=" 确 定 " ></td>
          </tr>
        </table>
      
	  </form>
	  
	  </td>
  </tr>
</table>
<?
}

//////////////////////////////////////////
if($act == "save_add_superadmin"){

       $username   = trim($_POST["username"]);
	   $password   = trim($_POST["password"]);
	   $repassword = trim($_POST["repassword"]);
	   $a          = 0;

	   if($username==""){
	      echo "<script>alert('管理员帐户不能为空');window.location.href='?act=superadmin'</script>";
		   exit;
	   }	  
		   if(strlen($password)<4){
			   echo "<script>alert('密码长度不能小于4位');window.location.href='?act=superadmin'</script>";
			   exit;
		   }
		   if($password != $repassword)
		   {
			   echo "<script>alert('两次输入的密码不一致');window.location.href='?act=superadmin'</script>";
			   exit;
		   }

	   $sql="insert into tgs_admin set username='".$username."', password='".md5($password)."'";
	   mysql_query($sql) or die("err:".$sql);
	   
       echo "<script>alert('管理帐户添加成功');</script>";
	   echo "<script>window.location.href='?act=superadmin'</script>";
	   exit; 
}


if($act == "edit_superadmin"){ 
 $id  = $_GET['id'];
 $sql = "select * from tgs_admin where id=".$id." limit 1";
 $res = mysql_query($sql);
 $arr = mysql_fetch_array($res);
 $username  = $arr['username'];
?>

<table align="center" cellpadding="0" cellspacing="0" class="table_98">
  <tr>
    <td valign="top">
	
	<form name="form1" method="post" enctype="multipart/form-data" action="?act=save_edit_superadmin">
    <input type="hidden" name="id" id="id" value="<?=$id?>" />
		<table cellpadding="3" cellspacing="1" class="table_50">
          <tr>
            <td colspan="2" align="center">编辑管理员帐户</td></tr>
          <tr >
            <td width="20%"> 管理帐户：</td>
            <td width="80%" ><input name="username" type="text" id="username" size="20" value="<? echo $username?>"></td>
          </tr>
          <tr >
            <td>管理密码：</td>
            <td><input type="password" name="password" value="" />(如不修改密码则无需添写,密码长度不能少于4位)</td>
          </tr>
		  <tr >
            <td>确认管理密码：</td>
            <td><input type="password" name="repassword" value="" /></td>
          </tr>
          
          <tr >
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value=" 确 定 " ></td>
          </tr>
        </table>      
	  </form>	  
	  </td>
  </tr>
</table>
<?
}

//////////////////////////////////////////
if($act == "save_edit_superadmin"){

       $id         = $_POST['id'];
	   $username   = trim($_POST["username"]);
	   $password   = trim($_POST["password"]);
	   $repassword = trim($_POST["repassword"]);
	   $a          = 0;
	   if(!$id){
			   echo "<script>alert('id参数有误');window.location.href='?act=superadmin'</script>";
			   exit;
	  }
	   if($username!=""){
	      $sql="update tgs_admin set username='".$username."' where id=".$id." limit 1";
	      mysql_query($sql) or die("err:".$sql);
		  $a = 1;
	   }
	   if($password != ""){
		   if(strlen($password)<4){
			   echo "<script>alert('密码长度不能小于4位');window.location.href='?act=superadmin'</script>";
			   exit;
		   }
		   if($password != $repassword)
		   {
			   echo "<script>alert('两次输入的密码不一致');window.location.href='?act=superadmin'</script>";
			   exit;
		   }

		   $sql="update tgs_admin set password='".md5($password)."' where id=".$id." limit 1";
	       mysql_query($sql) or die("err:".$sql);
		   $a= 1;
	   }

	   if($a == 1){
         echo "<script>alert('管理帐户更新成功');</script>";
	   }else{
	     echo "<script>alert('管理帐户信息失败!!');</script>";
	   }
	   echo "<script>window.location.href='?act=superadmin'</script>";

	   exit; 

}

//////////////////////////////////////////
if($act == "delete_superadmin"){

      $id         = $_GET['id'];
	   
	  if(!$id){
			   echo "<script>alert('id参数有误');window.location.href='?act=superadmin'</script>";
			   exit;
	  }

	  
	  $sql="delete from tgs_admin where id=".$id." limit 1";
	  mysql_query($sql) or die("err:".$sql);
		 
	   
      echo "<script>alert('管理帐户删除成功');</script>";
	  echo "<script>window.location.href='?act=superadmin'</script>";
	  exit; 

}

////
function __fgetcsv(&$handle, $length = null, $d = ",", $e = '"')
{
      $d = preg_quote($d);
      $e = preg_quote($e);
      $_line = "";
      $eof   = false;
      while ($eof != true)
      {
         $_line .= (empty ($length) ? fgets($handle) : fgets($handle, $length));
         $itemcnt = preg_match_all('/' . $e . '/', $_line, $dummy);
         if ($itemcnt % 2 == 0)
            $eof = true;
      }
      $_csv_line = preg_replace('/(?: |[ ])?$/', $d, trim($_line));      $_csv_pattern = '/(' . $e . '[^' . $e . ']*(?:' . $e . $e . '[^' . $e . ']*)*' . $e . '|[^' . $d . ']*)' . $d . '/';
      preg_match_all($_csv_pattern, $_csv_line, $_csv_matches);
      $_csv_data = $_csv_matches[1];
      for ($_csv_i = 0; $_csv_i < count($_csv_data); $_csv_i++)
      {       $_csv_data[$_csv_i] = preg_replace("/^" . $e . "(.*)" . $e . "$/s", "$1", $_csv_data[$_csv_i]);
         $_csv_data[$_csv_i] = str_replace($e . $e, $e, $_csv_data[$_csv_i]);
      }
      return empty($_line) ? false : $_csv_data;
}
?>
</body>
</html>