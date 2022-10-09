<?php

  include('./pagetemplates/pagerendered.txt');
  require('config.php');
  
  if($config_use_comments){

  require('core.php');

  if(isset($_GET['startingat'])){
    $startingat = $_GET['startingat'];
    global $startingat; 
  }
  else if(!isset($startingat)){ $startingat = $postcounter; }

  if(isset($_GET['thispost'])){ $thispost = $_GET['thispost']; }
  if(isset($_POST['name'])){ $name = $_POST['name']; }
  if(isset($_POST['title'])){ $title = $_POST['title']; }
  if(isset($_POST['comment'])){ $comment = $_POST['comment']; }
  
  if($config_use_comments && isset($title) && $title !="" && isset($name) && $name !="" && isset($comment) && $comment !="" && isset($thispost) && $thispost !="")
  {
  newcomment();
  header("Location: ".$config_installurl.$config_installdir."/comments.php?thispost=".$thispost);
  }
  
print <<<END
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="templates/$config_template" />
<title>Comments for blog entry $thispost</title>
</head>
<body>
<div id="header"><a href="$config_installurl$config_installdir/?$_SERVER[QUERY_STRING]">$config_blogname</a> - Comments for blog entry $thispost</div>
<div id="content">
END;
$postfile = $config_postdir."post_".$thispost;
include $postfile;
print <<<END
<hr><h2>Comments:</h2>
<p style="padding:3px; margin:0px; font-size:12px;">(<a href="#addComment">Add Comment</a>)</p><br/><br/>
END;
getcomments();
print <<<END
<hr />
<h3 id="addComment">Add a comment</h3>
<form action="comments.php?thispost=$thispost" method="post">
<label>Your Name:</label><br />
<input type="text" size="30" name="name" /><br /><br />
<label>Comment Title:</label><br />
<input type="text" size="30" name="title" /><br /><br />
<label>Comment:</label><br />
<textarea name="comment" rows="10" cols="100"></textarea><br /><br />
<input type="submit" value="Add comment" />
</form>
</div>
END;
include ('./pagetemplates/menu.txt');
print <<<END
<!-- Powered by Nilson's Blogger version $config_setversion. See http://nilson-blogger.sourceforge.net/ for info -->
</body>
</html>
END;

}
else {
	echo "The comment system has been disabled by the administrator of this site.";
}
?>