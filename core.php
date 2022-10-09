<?php
//Original code by Nilson Cain, October, 2003
//Add smiles support - Nilson Cain - 11-06-2003
//Merge into single file by Nilson Cain, November 12 2003
//Varius cleanup/editing by Nilson Cain, November 16, 2003
//Serveral mods -  Nilson Cain, November 16, 2003
//Bug fixes - November 18, 2003 Nilson Cain
//Comment and Post function work

  require("./config.php");
  $postcounter = fread(fopen($config_postcounterfile, "r"), filesize($config_postcounterfile));
  putenv('TZ='.$timezone);

//POSTS
function getposts(){
  require("./config.php");
  global $postcounter;
  if(isset($_GET['startingat']))
    $startingat = $_GET['startingat'];
  if(isset($_GET['permalink']))
    $permalink = $_GET['permalink'];
  if(!isset($startingat))
    $startingat = $postcounter;
  if(!isset($permalink))
    for ($loop = $startingat; ($loop >= 0) && ($loop > $startingat - $config_postsperpage); $loop--)
    {
       $postfile = $config_postdir."post_".$loop;
       include $postfile;
    }
  else { 
	if($permalink == "first")
	  $permalink = 1;
	if($permalink == "last")
	  $permalink = $postcounter;
	$postfile = $config_postdir."post_".$permalink;
	include $postfile;
  }
  if($config_legacy){ include("posts.txt"); }
}

function newpost(){
  require("./config.php");
  require("./smilies.php");
  global $poster, $title, $message, $postcounter;
  //$comments_count = substr_count(fopen("./posts/post_$postcount_comments", "r"), "<h2>");
  $postcounter++;
  fwrite(fopen($config_postcounterfile, "w+"), $postcounter);
  if($config_use_comments)
	  $content = "\n<h1 id=\"$postcounter\">$title</h1>\n<p>$message</p>\n<span id=\"postinfo\">Posted by <strong>$poster</strong> on $config_fulldate @ $config_fulltime - <a href=\"./?permalink=$postcounter\">permalink</a> [<a href=\"./edit.php?thispost=$postcounter\" id=\"commentLink\">Edit</a>] [<a href=\"./comments.php?thispost=$postcounter\" id=\"commentLink\">Comments ($comments_count)</a>]</span>\n\n";
  else
      $content = "\n<h1 id=\"$postcounter\">$title</h1>\n<p>$message</p>\n<span id=\"postinfo\">Posted by <strong>$poster</strong> on $config_fulldate @ $config_fulltime - <a href=\"./?permalink=$postcounter\">permalink</a> [<a href=\"./edit.php?thispost=$postcounter\" id=\"commentLink\">Edit</a>]</span>\n\n";
       
  $content = preg_replace("/\r\n/", "<br />\r\n", $content);
  $content = stripslashes($content);
  $message = wordwrap($message, 80, "\n");
  if($config_use_smilies)
    $content = insertsmilies($content);
  fwrite(fopen($config_postdir."post_".$postcounter, "wb"), $content);
}



//COMMENTS
function getcomments(){
  require("./config.php");
  global $thispost;
  $postfile = $config_postdir."post_".$thispost."comments";
  if(file_exists($postfile))
    include $postfile;
  else
    echo "<p>No comments have been made on this blog entry yet.</p>";
}

function newcomment(){
  require("./config.php");
  require("./smilies.php");
  global $thispost, $name, $comment, $title;
  $comment = strip_tags($comment, "<a>");
  $comment = stripslashes($comment);
  $comment = preg_replace("/\r\n/", "<br />\r\n", $comment);
  $content="<h2 id=\"$config_dateid\">$title</h2>\n<p>$comment</p><span id=\"postinfo\">Posted by <strong>$name</strong> on $config_fulldate @ $config_fulltime</span>\n\n";
  $content = wordwrap($content, 80, "\n");
  if(stristr($comment, "<a") && !stristr($comment, "</a>"))
    $comment = $comment."</a>";
  if($config_use_smilies)
    $content = insertsmilies($content);
  fwrite(fopen($config_postdir."post_".$thispost."comments", "a"), $content);
}
?>