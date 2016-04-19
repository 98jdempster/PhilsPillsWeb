<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
/*
  $res = mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
  $userRow=mysql_fetch_array($res);   
*/

$uID = mysql_fetch_array(mysql_query("SELECT user_id FROM users WHERE user_id=".$_SESSION['user']))[0];
error_log("Session User : ". $_SESSION['user'] ." User ID : $uID\n", 0);

/*
  $query = "SELECT medicationName FROM prescriptions WHERE userID ='$uID'";  
  $result = mysql_query($query);
  $count = mysql_num_rows($result); // if medication not found then add  
*/

if (isset($_POST['btn-addcon']))
{ 

    error_log("Add Con Button Pressed\n", 0);

    $first_name = mysql_real_escape_string($_POST['first_name']);
	$last_name = mysql_real_escape_string($_POST['last_name']);
	$phone_number = mysql_real_escape_string($_POST['phone_number']);
	$email = mysql_real_escape_string($_POST['email']);
	
	$first_name = trim($first_name);
	$last_name = trim($last_name);
	$phone_number = trim($phone_number);
	$email = trim($email);
	
    // prescription exist or not
    $query = "SELECT count(*) FROM contacts WHERE phone_number = '$phone_number' AND user_id =".$_SESSION['user'];
    $count = mysql_fetch_array(mysql_query($query))[0];
	
    error_log("Duplicate Con Count : $count\n", 0);

    if($count == 0){  
        
        if(mysql_query("INSERT INTO contacts (user_id,first_name,last_name,phone_number,email) ".
                       "VALUES ('$uID','$first_name','$last_name','$phone_number','$email')")) 
        {
            ?>
            <script>alert('successfully added ');</script>
            <?php
        }
        else
        {
            error_log("MYSQL ERROR : ". mysql_error() ."\n", 0);
            ?>
            <script>alert('error while adding contact ');</script>
            <?php
        }		
    }
    else
    {
        ?>
        <script>alert('Sorry contact already added ');</script>
	<?php
    }  
}

?> 
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Phil's Pills - New Contact</title>
<link rel="stylesheet" href="../css/addmed.css" type="text/css" />
<script src="../js/ClockBox.js"></script> 
</head>
<body>
	<header class="title-block">
		<h1>Phil's Pills</h1>  
        <div id="clockbox"></div>
    </header> 
	<div id="main" class="main"> 
    	<div id="botHeader" class="botHeader"> 
    		<p class="tab-links">Add New Contact</p>
        </div>
		<center>
			<div id="content">
				<form method="post">
					<table class="addInput" align="center" width="30%" border="0">
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
              				<td><a href="home.php" class="btn-cancel">Cancel</button></td>
	    				</tr>
					</table>
				</form>
			</div>
		</center> 
	</div>     
</body>
</html>