<?php

//page is accessed with /login.php?reqpage=xxxxxx.php[&submit[&badlogin]][&/?logoutuser]

include('./pagetemplates/pagerendered.txt');
require('config.php');
require('core.php');
require('users.php');

if(isset($_POST[submit])) {
  $userkey = array_search($_POST['user'], $user_name);
  $checkpass = $user_pass[$userkey];

  if($_POST['pass'] == $checkpass){
    session_start();
    $_SESSION['user_name'] = $_POST['user'];
    setcookie("nilsonsbloggerlogin", session_id(), (time()+60*60*24*1));
    header("Location: ".$config_installurl.$config_installdir."/".$_GET['reqpage']."?sid=".session_id());
  }
 }

if(isset($_GET['logoutuser'])){
    session_start();
	session_destroy();
	setcookie("nilsonsbloggerlogin","", time() - 3600);
    unset($_COOKIE["nilsonsbloggerlogin"]); 
	header("Location: ".$config_installurl.$config_installdir."/");
}

print <<<END

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<link rel="stylesheet" type="text/css" href="templates/template.php" />
<title>Please login to perform the requested action</title>
</head>

<body>
<div id="header">Please log in to perform the requested action</h1></div>
<div id="content">
<form action="login.php?reqpage=$_GET[reqpage]" method="post">
<label>Username: </label><input type="textbox" name="user" /><br />
<label>Password: </label><input type="password" name="pass" /><br />
<input type="hidden" name="submit" value="" />
<label>Stay Logged In: </label><input type="checkbox" name="keeplogin" /><br />
<input type="submit" value="OK" /><br />
</form>
</div>
END;

include('./pagetemplates/menu.txt');

?>

<!-- Powered by Nilson's Blogger version <?php echo $config_setversion; ?>. See http://nilson-blogger.sourceforge.net/ for info -->
</body>

</html>
