<?php
error_reporting(0);
require("../data/session.php");
require("../data/head.php");
$act = $_GET["act"];
if($act=="export_code")
{
	$chk = $_REQUEST["chk"];
	$chk = explode(",",$chk);
	$file_encoding = $_POST["file_encoding"];	
	$a   = 0;
	if(count($chk) > 0){		
		if($_POST['field_bianhao']=="1"){
		 $content  = "商品防伪码";
		 $a        = 1;
		}
		if($_POST['field_riqi']=="1"){
		 $content .= ",有效日期";
		 $a        = 1;
		}
		if($_POST['field_product']==1){
		 $content .= ",产品类型";
		 $a        = 1;
		}
		if($_POST['field_zd1']==1){
		 $content .= ",保留字段1";
		 $a        = 1;
		}
		if($_POST['field_zd2']==1){
		 $content .= ",保留字段2";
		 $a        = 1;
		}
		$content  .= "\n";
		if($a == 0){
		    header("content-Type: text/html; charset=utf-8");
	        echo "<script>alert('请选择要导出的防伪码字段');history.back();</script>";
	        exit;
		}
		$countchk = count($chk);
		for($i=0;$i<$countchk;$i++)  
		{ 
		  $sql="select * from tgs_code where id='$chk[$i]' limit 1";
		  $res=mysql_query($sql);
		  while($arr=mysql_fetch_array($res)){
			  if($_POST['field_bianhao']=="1"){
			  $content .= $arr["bianhao"];
			  }
			  if($_POST['field_riqi']=="1"){
			  $content .= ",".$arr["riqi"];
			  }
			  if($_POST['field_product']=="1"){
			  $content .= ",".$arr["product"];
			  }
			  if($_POST['field_zd1']=="1"){
			  $content .= ",".$arr["zd1"];
			  }
			  if($_POST['field_zd2']=="1"){
			  $content .= ",".$arr["zd2"];
			  }
			  $content .= "\n";
		  }		}

		if($file_encoding == "gbk"){
		 $content = iconv("utf-8", "gb2312"."//IGNORE", $content);
		}
		$filename = "../upload/temp_csv_".date("Ymd").".csv";		
		$fp = fopen($filename,'w+');
		if(fwrite($fp,$content)){		
		  header("content-Type: text/html; charset=utf-8");
		  echo "生成csv文件成功，<a href='".$filename."' target='_blank'>右击'目标另存为'文档</a>，下载后<a href='?act=delete_file&file=".$filename."'>删除此CSV文档</a>";
		}else{
		  header("content-Type: text/html; charset=utf-8");
		  echo "无法写入导出内容，./upload文件夹应该为可读写权限。";
		}
		fclose($fp);
     }else{
	   header("content-Type: text/html; charset=utf-8");
	   echo "<script>alert('请选择要导出的防伪码');window.location.href='admin.php'</script>";
	   exit;
     }
}
elseif($act == "delete_file")
{
  $filename = $_GET['filename'];
  unlink($filename);
  header("content-Type: text/html; charset=utf-8");
  echo "<script>alert('CSV文档删除成功');window.close()</script>";
  exit;
}
?>