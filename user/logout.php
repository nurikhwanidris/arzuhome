 <?php
  //logout.php  
  session_start();
  session_destroy();
  header("location:/arzuhome/user/login.php?msg=Succesfully logged out.&alert=warning");
  //setcookie("user", "", time() - (86400 * 30));
  ?>  