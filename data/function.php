<?php
function extend($file_name) 
{ 
	$retval = ""; 
	$pt     = strrpos($file_name, ".");
	if ($pt) $retval=substr($file_name, $pt+1, strlen($file_name) - $pt); 
	return ($retval); 
}

function strreplace($content) 
{ 
	$conntent = str_replace("<","&lt;",$content);
	$conntent = str_replace(">","&gt;",$content);
	$content  = str_replace("\"","&quot;",$content);
	$content  = str_replace("'","‘",$content);
	
	
	return ($content); 
}
function unstrreplace($content) 
{ 
	$conntent = str_replace("&lt;","<",$content);
	$conntent = str_replace("&gt;",">",$content);
	$content  = str_replace("&quot;","\"",$content);
	$content  = str_replace("‘","'",$content);
	
	return ($content); 
}

function boolean($c) 
{ 
	if ($c=="1"){
	   $co = "是";
	}else{
	  $co = "否";
	}
	return ($co); 
} 

function clear($string) {
    $pattern = array("'","\"","","or","&&","!=");
    $replacement = "";
    return preg_replace($pattern,$replacement,$string);
}

function genRandomString($len,$t=0) 
{ 
    $chars = array( 
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",  
        "l", "m", "n", "p", "q", "r", "s", "t", "u", "v",  
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",  
        "H", "I", "J", "K", "L", "M", "N", "P", "Q", "R",  
        "S", "T", "U", "V", "W", "X", "Y", "Z", "2",  
        "3", "4", "5", "6", "7", "8", "9" 
    ); 

	$chars1= array( 
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",  
        "l", "m", "n", "p", "q", "r", "s", "t", "u", "v",  
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",  
        "H", "I", "J", "K", "L", "M", "N", "P", "Q", "R",  
        "S", "T", "U", "V", "W", "X", "Y", "Z"
    ); 

	$chars2 = array( 
        "1", "2", "0", 
        "3", "4", "5", "6", "7", "8", "9" 
    );
	$chars3 = array( 
        "A", "B", "C", "D", "E", "F", "G", "O" ,
        "H", "I", "J", "K", "L", "M", "N", "P", "Q", "R",  
        "S", "T", "U", "V", "W", "X", "Y", "Z"
    );
	
	if($t==1){

        $charsLen = count($chars1) - 1; 
	 
		shuffle($chars1);     
		 
		$output = ""; 
		for ($i=0; $i<$len; $i++) 
		{ 
			$output .= $chars1[mt_rand(0, $charsLen)]; 
		} 




	}elseif($t==2){
       
	   $charsLen = count($chars2) - 1; 
	 
		shuffle($chars2);     
		 
		$output = ""; 
		for ($i=0; $i<$len; $i++) 
		{ 
			$output .= $chars2[mt_rand(0, $charsLen)]; 
		} 

    }elseif($t==3){
       
	   $charsLen = count($chars3) - 1;
	 
		shuffle($chars3);     
		 
		$output = ""; 
		for ($i=0; $i<$len; $i++) 
		{ 
			$output .= $chars3[mt_rand(0, $charsLen)]; 
		} 

	}else{

		$charsLen = count($chars) - 1; 
	 
		shuffle($chars);     
		 
		$output = ""; 
		for ($i=0; $i<$len; $i++) 
		{ 
			$output .= $chars[mt_rand(0, $charsLen)]; 
		} 
	}
	
    return $output; 
 
}


function file_mode_info($file_path)
{
    if (!file_exists($file_path))
    {
        return false;
    }
    $mark = 0;
    if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN')
    {

        $test_file = $file_path . '/cf_test.txt';

        if (is_dir($file_path))
        {

            $dir = @opendir($file_path);
            if ($dir === false)
            {
                return $mark; 
            }
            if (@readdir($dir) !== false)
            {
                $mark ^= 1; 
            }
            @closedir($dir);
            $fp = @fopen($test_file, 'wb');
            if ($fp === false)
            {
                return $mark; 
            }
            if (@fwrite($fp, 'directory access testing.') !== false)
            {
                $mark ^= 2; 
            }
            @fclose($fp);
            @unlink($test_file);
            
            $fp = @fopen($test_file, 'ab+');
            if ($fp === false)
            {
                return $mark;
            }
            if (@fwrite($fp, "modify test.\r\n") !== false)
            {
                $mark ^= 4;
            }
            @fclose($fp);
            
            if (@rename($test_file, $test_file) !== false)
            {
                $mark ^= 8;
            }
            @unlink($test_file);
        }
        
        elseif (is_file($file_path))
        {
            
            $fp = @fopen($file_path, 'rb');
            if ($fp)
            {
                $mark ^= 1; 
            }
            @fclose($fp);
            
            $fp = @fopen($file_path, 'ab+');
            if ($fp && @fwrite($fp, '') !== false)
            {
                $mark ^= 6; 
            }
            @fclose($fp);
            
            if (@rename($test_file, $test_file) !== false)
            {
                $mark ^= 8;
            }
        }
    }
    else
    {
        if (@is_readable($file_path))
        {
            $mark ^= 1;
        }
        if (@is_writable($file_path))
        {
            $mark ^= 14;
        }
    }
    return $mark;
}

function get_site_config($g = ""){
    
	$arr = array();
	$sql5 = "SELECT code,code_value FROM tgs_config where 1";
	if($g === ""){
     $sql5.=" and parentid>0";
	}else{
      $sql5.=" and parentid=".$g."";
	}
	mysql_query("set names 'utf8'");
	$res5 = mysql_query($sql5);    
	while($row5 = mysql_fetch_array($res5))
    {
        $arr[$row5['code']] = $row5['code_value'];
    }
	$arr['yzm_status']              = intval($arr['yzm_status']);

	$arr['notice_1']              = ($arr['notice_1']);
	$arr['notice_2']              = ($arr['notice_2']);
	$arr['notice_3']              = ($arr['notice_3']);
	$arr['notices']               = ($arr['notices']);
	$GLOBALS['cfg']['site_name']      = $arr['site_name'];
	$GLOBALS['cfg']['site_url']       = $arr['site_url'];
	$GLOBALS['cfg']['timezone']       = $arr['cf_timezone'];
	$GLOBALS['cfg']['time_format']    = $arr['time_format'];
	return $arr;
}
?>