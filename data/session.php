<?php
session_start();
if(!$_SESSION["Adminname"]){
 echo "<script>location.href='index.php';</script>";
 exit;
}
?>
