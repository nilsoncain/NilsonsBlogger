<?php

include('./pagetemplates/pagerendered.txt');
require('config.php');
require('core.php');

session_start();

if(!isset($_GET['sid']) && isset($_COOKIE['nilsonsbloggerlogin']))
  $test_sid = $_COOKIE['nilsonsbloggerlogin'];

else if(isset($_GET['sid']))
  $test_sid = $_GET['sid'];

if(session_id() != $test_sid)
  header("Location: ".$config_installurl.$config_installdir."/login.php?reqpage=post.php");

if(isset($_POST['poster'])){ $poster = $_POST['poster']; }
if(isset($_POST['pass'])){ $pass = $_POST['pass']; }
if(isset($_POST['title'])){ $title = $_POST['title']; }
if(isset($_POST['message'])){ $message = $_POST['message']; }

if(isset($poster) && $poster != "" && isset($title) && $title != "" && isset($message) && $message !="")
{
newpost();
header("Location: ".$config_installurl.$config_installdir);
}

print <<<END
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<link rel="stylesheet" type="text/css" href="templates/template.php" />
<title>Posting to blog: $blogname</title>
</head>
<body>
<div id="header">Posting to blog: <a href="$config_installurl$config_installdir">$blogname</a></div>
<div id="content">
<form action="post.php" method="post">
<input type="hidden" name="pass" value="$pass" />
<label>Your Name:</label><br/>
END;
if($config_autofill_name && isset($config_yourname)){ echo "<input type=\"text\" size=\"30\" name=\"poster\" value=\"$config_yourname\" /><br /><br />"; }
else { echo "<input type=\"text\" size=\"30\" name=\"poster\" /><br /><br />"; }
print <<<END
<label>Title:</label><br />
<input type="text" size="40" name="title" /><br /><br />
<label>Blog:</label><br />
<textarea name="message" rows="10" cols="100"></textarea><br /><br />
<input type="submit" value="Blog It!" />
</form>
<hr><h2>Past few blog entries:</h2><br/><br/>
END;
getposts();
print <<<END
</div>
END;
include('./pagetemplates/menu.txt');
print <<<END

<!-- Powered by Nilson's Blogger version $config_setversion. See http://nilson-blogger.sourceforge.net/ for info -->
</body>
</html>
END;

?>
