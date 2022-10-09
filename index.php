<?php

include('./pagetemplates/pagerendered.txt');
require('config.php');
require('core.php');

if(($_COOKIE['nilsonsbloggerlogin'] == $_SESSION['user_sid']) || ($_GET['sid'] == $_SESSION['user_sid']))
  session_start();
  
print <<<END
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>
<title>$config_blogname</title>
<link rel="stylesheet" type="text/css" href="templates/template.php" />
</head>

<body>
<div id="header"><a href="$config_installurl$config_installdir/">$config_blogname</a></div>\n
<div id="content">\n
END;

echo "<!-- Posts Start -->\n\n";
getposts();
echo "<!-- Posts End -->\n\n";

if(isset($_GET['startingat'])){
  $startingat = $_GET['startingat'];
  global $startingat; 
}
else if(!isset($startingat)){ $startingat = $postcounter; }

echo "</div>\n\n";

include ('./pagetemplates/menu.txt');

if($config_showcredits) { echo "\n\n<span id=\"credits\">[Powered by <a href=\"http://nilson-blogger.sourceforge.net\">Nilson's Blogger</a> $config_setversion]</span>\n\n"; }
?>
<span class="subtext"><?php
if($showname && $namelink){echo "<i>--<a href=\"$namelocation\">$config_yourname</i>"; }
else if($showname){echo "<i>--",$config_yourname,"</i>";}
?></span>
</div>

<!-- Powered by Nilson's Blogger version <?php echo $config_setversion; ?>. See http://nilson-blogger.sourceforge.net/ for info -->

</body>
</html>