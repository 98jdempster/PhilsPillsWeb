<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);   

$uID=mysql_query("SELECT user_id FROM users WHERE user_id=".$_SESSION['user']); 

$query = "SELECT medicationName FROM prescriptions WHERE userID ='$uID'";  
$result = mysql_query($query);
$count = mysql_num_rows($result); // if medication not found then add  

if(isset($_POST['btn-addcon']))
{ 
	$first_name = mysql_real_escape_string($_POST['first_name']);
	$last_name = mysql_real_escape_string($_POST['last_name']);
	$phone_number = mysql_real_escape_string($_POST['phone_number']);
	$email = mysql_real_escape_string($_POST['email']);
	
	$first_name = trim($first_name);
	$last_name = trim($last_name);
	$phone_number = trim($phone_number);
	$email = trim($email);
	
	// email exist or not
	$query = "SELECT phone_number FROM contacts WHERE user_id='$uID'";
	$result = mysql_query($query);
	
	$count = mysql_num_rows($result); // if email not found then register
	
	if($count == 0){
		
		if(mysql_query("INSERT INTO contacts(user_id,first_name,last_name,phone_number,email) 
						VALUES('$uID','$first_name','$last_name','$phone_number','$email')"))
		{
			?>
			<script>alert('successfully registered ');</script>
			<?php
		}
		else
		{
			?>
			<script>alert('error while registering you...');</script>
			<?php
		}		
	}
	else{
			?>
			<script>alert('Sorry Email ID already taken ...');</script>
			<?php
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Phil's Pills - New Contact</title>
<link rel="stylesheet" href="../css/addmed.css" type="text/css" />

</head>
<body>
	<center>
		<div id="login-form">
			<form method="post">
				<table align="center" width="30%" border="0">
					<tr>
						<td><input type="text" name="first_name" placeholder="First Name" required /></td>
					</tr>  
					<tr>
						<td><input type="text" name="last_name" placeholder="Last Name" required /></td>
					</tr> 
                    <tr>  
                    	<td><input type="text" name="phone_number" placeholder="Phone Number" required /></td>
                    </tr>
					<tr>
						<td><input type="email" name="email" placeholder="Contact Email" /></td>
					</tr>
					<tr>
						<td><button type="submit" name="btn-addcon">Register Contact</button></td>
					</tr>
					<tr>
						<td><a href="home.php">Cancel</a></td>
					</tr>
				</table>
			</form>
		</div>
	</center>
</body>
</html>