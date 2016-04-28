<?php
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );

if(!mysql_connect("fdb14.agilityhoster.com","2110121_ppw","98jdempster10010666"))
{
	die('oops connection problem ! --> '.mysql_error());
}

if(!mysql_select_db("2110121_ppw"))
{
	die('oops database selection problem ! --> '.mysql_error());
}
?>