<?php

//Basic Setup

$config_blogname = "My New Blog";                           //Your blog's name
$config_installurl = "http://".$_SERVER['SERVER_NAME'];     //Install URL.  Unless you encounter problems, leave this alone.
$config_installdir = "";                                    //Which directory is Nilson's Blogger being installed in?  No trailing slash.
$config_postdir = './posts/';                               //subdirectory of $config_installdir that your posts/comments will be stored in.
$config_postcounterfile = $config_postdir.'postcount.txt';         //Where your postcounter will go
$comfig_commentcounterfile = $config_postdir.'commentcount.txt';   //Where your comment counter will go


//Configuration Options

$config_legacy = false;                                     //If you are upgrading from a pre-0.4 version of Nilson's Blogger
$config_postsperpage = 8;                                   //How many posts will be shown per page
$config_template = "default.css";                           //The css stylesheet to apply to your pages
$config_use_smilies = true;                                 //Enable automatic smiley (a.k.a emoticon) insertion
$config_use_comments = true;                                //Whether or not to enable the comment subsystem
$config_autofill_name = true;                               //Whether or not to fill in your name automatically on the 'To' field.
$config_showpostlink = true;                                //Whether or not to show a link to make a new post on the front page/


//Locale and User Options

$config_timezone = "US/Central";                            //Your timezone
$config_yourname = "" ;                                     //Your real name
$config_dateid=date("Fd");                                  //format of date to be stored in the id="" of the post
$config_fulldate=date("l, F d, Y");                         //format of the long-date
$config_fulltime=date("g:i:s A");                           //format of the time


//Internal Configuration

$config_setversion = "0.11";
$config_showcredits = true;
?>
