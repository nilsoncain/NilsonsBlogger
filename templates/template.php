<?php

//Original code by Nilson Cain, January 2004

function parseTemplate(){
	require("../config.php");
	$template_orig = fread(fopen($config_template, "r"), filesize($config_template));
	$template_new = preg_replace("/_SITEURL_/", $config_installurl.$config_installdir, $template_orig);
	header("Content-type: text/css");
	print $template_new;
}

parseTemplate();

?>