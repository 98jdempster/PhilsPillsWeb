<?php
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
if(!mysql_connect("sql104.byethost17.com","b17_17618486","10010666"))
{
	die('oops connection problem ! --> '.mysql_error());
}
if(!mysql_select_db("b17_17618486_philspills"))
{
	die('oops database selection problem ! --> '.mysql_error());
}
?>