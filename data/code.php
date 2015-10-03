<?php
Header("Content-type:image/png");
session_start();
$authnum_session = ''; 
$str = '1234567890'; 
$l = strlen($str);  
for($i=1;$i<=4;$i++){ 
$num=rand(0,$l-1); 
$authnum_session.= $str[$num]; 
}
$_SESSION["authnum_session"] = $authnum_session;
srand((double)microtime()*1000000);
$im = imagecreatetruecolor(50,20); 
$black = imagecolorallocate($im, 0,0,10);
$white = imagecolorallocate($im, 255,255,255);
$gray  = imagecolorallocate($im, 200,200,200);
imagefill($im,0,0,$white);
$li = ImageColorAllocate($im, 220,220,220);
for($i=0;$i<3;$i++) { 
 imageline($im,rand(0,30),rand(0,21),rand(20,40),rand(0,21),$li);
} 
Imagestring($im, 5, 8, 2, $authnum_session, $blank);
for($i=0;$i<90;$i++){
 Imagesetpixel($im, rand()%70 , rand()%30 , $gray);
}
ImagePNG($im);
ImageDestroy($im);
?>