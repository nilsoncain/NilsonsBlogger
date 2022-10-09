<?php
//Original code by Nilson Cain, November 04, 2003
//Stupid bug fixed by Shaun Hill (chocoba65), 2003-11-05
//Strange rewrite by Shaun Hill (chocoba65), 2003-11-05
//update for new smilies by Nilson Cain, 2004-01-05

function createSmileyHTML($filename, $altname)
{

  $temp = "<img src=\"./gfx/blogger/smilies/" . $filename . "\" alt=\"" . $altname . "\" />";
  return $temp;
}

function insertsmilies($contentIn){

  $smilies = array(
  ":)",
  ":(",
  ":|",
  "8)",
  ":shocked:",
  ":?",
  ":lol:",
  ":x",
  ":P",
  ":cry:",
  ":evil:",
  ":roll:",
  ":rolleyes:",
  ":wink:",
  ":!:",
  ":idea:",
  ":mrgreen:",
  ":arrow:",
  ":surprised:",
  ":D",
  ":-D",
  ":?:",
  ":oops:",
  ";)");

  $filenames = array(
  "smile.gif",
  "sad.gif",
  "normal.gif",
  "cool.gif",
  "eek.gif",
  "confused.gif",
  "lol.gif",
  "angry.gif",
  "razz.gif",
  "cry.gif",
  "evil.gif",
  "rolleyes.gif",
  "rolleyes.gif",
  "wink.gif",
  "exclaim.gif",
  "idea.gif",
  "mrgreen.gif",
  "surprised.gif",
  "biggrin.gif",
  "biggrin.gif",
  "question.gif",
  "redface.gif",
  "wink.gif");

  $altnames = array(
  "Smile",
  "Sad",
  "Normal",
  "Cool",
  "Shocked",
  "Confused",
  "Laugh out Loud",
  "Mad",
  "Razz",
  "Cry",
  "Evil",
  "Roll Eyes",
  "Roll Eyes",
  "Wink",
  "Exclamatory",
  "Idea",
  "Mr. Green",
  "Surprised",
  "Big Grin",
  "Big Grin",
  "Question",
  "Redface",
  "Wink");

  for ($i = 0; $i < sizeof($smilies); $i++)
  {
    $smileyHTML = createSmileyHTML($filenames[$i], $altnames[$i]);
    $contentIn = str_replace($smilies[$i], $smileyHTML, $contentIn);
  }

return $contentIn;

}

?>
