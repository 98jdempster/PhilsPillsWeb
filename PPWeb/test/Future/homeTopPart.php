<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);   

$uID = $userRow['user_id'];

$sql = "SELECT GROUP_CONCAT(medicationName SEPARATOR ', '), GROUP_CONCAT(mDose SEPARATOR ', '), GROUP_CONCAT(mDose SEPARATOR ', '), 
		GROUP_CONCAT(mHour SEPARATOR ', '), GROUP_CONCAT(mMinute SEPARATOR ', '), GROUP_CONCAT(mPeriod SEPARATOR ', '),  
		GROUP_CONCAT(mFreq SEPARATOR ', ') FROM prescriptions GROUP BY user_id WHERE user_id = '$uID'";  
$result = mysql_query($sql) or die('A error occured: ' . mysql_error());

$query = "SELECT medicationName FROM medications WHERE medicationName ='$mName'";  
$result = mysql_query($query);
$count = mysql_num_rows($result); // if medication not found then add  


if(isset($_POST['btn-addmed']))
{ 
	$mName = mysql_real_escape_string($_POST['mName']);
	$mDose = mysql_real_escape_string($_POST['mDose']);
	$mHour = mysql_real_escape_string($_POST['mHour']); 
	$mMinute = mysql_real_escape_string($_POST['mMinute']);
	$mPeriod = mysql_real_escape_string($_POST['mPeriod']);
	$mFreq = mysql_real_escape_string($_POST['mFreq']);
	
	$mName = trim($mName);
	$mDose = trim($mDose);
	$mHour = trim($mHour);
	$mMinute = trim($mMinute); 
	$mPeriod = trim($mPeriod);
	$mFreq = trim($mFreq);
	
	// medication exist or not 
	$query = "SELECT medicationName FROM medications WHERE medicationName ='$mName'";  
	$result = mysql_query($query);
	$count = mysql_num_rows($result); // if medication not found then add  
	
	if($count == 0){  
	
		if(mysql_query("INSERT INTO medications(medicationName) VALUES('$mName')"))
		{
			echo "successfully added"; 	
		}
		else
		{
			?>
			<script>alert('error while adding med ');</script>
			<?php
		}		
	}
	
	// prescription exist or not
	$query = "SELECT medicationID FROM prescriptions WHERE user_id =".$_SESSION['user'];
	$result = mysql_query($query);
	
	$count = mysql_num_rows($result); // if prescription not found then add
	
	if($count == 0){ 
	
		$userID = $_SESSION['user']; 
		$medication_id = "SELECT medicationID FROM medications WHERE medicationName ='$mName'";  
		 
		if(mysql_query("INSERT INTO prescriptions(user_id,medicationID,mDose,mHour,mMinute,mPeriod,mFreq) VALUES('$userID','$medication_id','$mDose','$mHour','$mMinute','$mPeriod','$mFreq')"))
		{
			?>
			<script>alert('successfully added ');</script>
			<?php
		}
		else
		{
			?>
			<script>alert('error while adding med ');</script>
			<?php
		}		
	}
	else{
			?>
			<script>alert('Sorry medication already added ');</script>
			<?php
	} 
}
?> 