<?php
session_start();
session_destroy();
setcookie("id","",time()-3600);
setcookie("token","",time()-3600);
setcookie("PHPSESSID","",time()-3600);
header("location: login.php");
//echo"you are logged out successfully";
exit()
?>
