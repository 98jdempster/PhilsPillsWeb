<?php  
include_once 'dbconnect.php';  
 
error_reporting(E_ALL);
ini_set('display_errors', '1');

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}

$mrSql = "SELECT * FROM prescriptions WHERE user_id =".$_SESSION['user']; 
$mrRes = mysql_query($maSql);
  
$medminute_array = array(); 

while($aMedRow = mysql_fetch_array($mrRes))
{ 
	$medminute_array[] = $maRow['mMinute'];
} 

print json_encode($medminute_array);
?>