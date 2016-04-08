<?php
session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}
include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{ 
	$first_name = mysql_real_escape_string($_POST['first_name']);
	$last_name = mysql_real_escape_string($_POST['last_name']);
	$uname = mysql_real_escape_string($_POST['uname']);
	$email = mysql_real_escape_string($_POST['email']);
	$upass = md5(mysql_real_escape_string($_POST['pass']));
	
	$first_name = trim($firstName);
	$last_name = trim($lastName);
	$uname = trim($uname);
	$email = trim($email);
	$upass = trim($upass);
	
	// email exist or not
	$query = "SELECT user_email FROM users WHERE user_email='$email'";
	$result = mysql_query($query);
	
	$count = mysql_num_rows($result); // if email not found then register
	
	if($count == 0){
		
		if(mysql_query("INSERT INTO users(user_name,first_name,last_name,user_email,user_pass) 
						VALUES('$uname','$first_name','$last_name','$email','$upass')"))
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
<title>Phil's Pills - Login & Registration</title>
<link rel="stylesheet" href="style.css" type="text/css" />

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
						<td><input type="text" name="uname" placeholder="User Name" required /></td>
					</tr> 
                    
					<tr>
						<td><input type="email" name="email" placeholder="Your Email" required /></td>
					</tr> 
                    
					<tr>
						<td><input type="password" name="pass" placeholder="Your Password" required /></td>
					</tr> 
                    
					<tr>
						<td><button type="submit" name="btn-signup">Sign Me Up</button></td>
					</tr> 
                    
					<tr>
						<td><a href="index.php">Sign In Here</a></td>
					</tr>
				</table>
			</form>
		</div>
	</center>
</body>
</html>