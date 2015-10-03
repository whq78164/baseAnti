<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$cf['site_name']?></title>
<meta name="keywords" content="<?=$cf['page_keywords']?>" />
<meta name="description" content="<?=$cf['page_desc']?>" />
<SCRIPT type="text/javascript" src="data/js/ajax.js"></SCRIPT>
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>

</head>
<body style="background-color: #eee;padding-top: 40px; padding-bottom: 40px;>

<div class="row">
    <div class="container">


<p style = "text-align:center;  font-size:20px; font-weight:bold;">
<?=$cf['site_name']?>
</p>


      <br/>
        <label class="pull-left">请输入防伪编码：</label>
        <input onfocus="this.select();" type="text" maxlength="50" size="25" class="form-control" placeholder="请输入防伪密码" name="bianhao" id="bianhao">
        <br>
        <? if($cf['yzm_status']==1){?><b>请输入验证码：</b><br/>
        <input type="text" class="form-control" name="yzm" id="yzm"/><br/>
        <img src="data/code.php" alt="验证码" width="100px" onclick="window.location.reload()"/><? }?><br/>



<button class="btn btn-lg btn-primary btn-block"type="submit" name="ButOK" onClick="return GetQuery();" id="ButOK" >点击查询</button>

<br/>
<INPUT value='' type='hidden' name='search' id='search'>
<INPUT value='<?=$cf['yzm_status']?>' type='hidden' name='yzm_status' id='yzm_status'>

    </div>

<br/>
<div class="container">
<p id="tgs_result_str" style="display:inline-block;color:Blue;"><?php echo $result_str;?></p>

 </div>

</div>
</body>
</html>

