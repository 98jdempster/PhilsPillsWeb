<?php
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );

if(!mysql_connect("f13-preview.awardspace.net","2110123_ppw","98jdempster10010666"))
{
	die('oops connection problem ! --> '.mysql_error());
}

if(!mysql_select_db("2110123_ppw"))
{
	die('oops database selection problem ! --> '.mysql_error());
}
?>