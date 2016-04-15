<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}

$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);   

$uID=$userRow[0]; 

if(isset($_POST['btn-cancel'])) 
{  
	header("Location: home.php");
}  

if(isset($_POST['btn-addmed']))
{  
	$days1 = $_POST['dys1']; 
	$mDays = ""; 
	 
	for($i=0;$i<sizeof($days1);$i++){ 
		$mDays .= $days1[$i]; 
		if($i < (sizeof($days1)-1)){ 
			$mDays .= ", ";	 
		}
	} 
	
	$mName = mysql_real_escape_string($_POST['mName']);
	$mDose = mysql_real_escape_string($_POST['mDose']);
	$mHour = $_POST['mHour'];
	$mMinute = $_POST['mPeriod']; 
	$mPeriod = $_POST['mPeriod'];
	
	$mName = trim($mName);
	$mDose = trim($mDose);
	
	// prescription exist or not
	$count= mysql_query("SELECT count(*) FROM prescriptions WHERE mName='$mName' AND user_id=".$_SESSION['user']);
	
	if($count == 0){  
		 
		if(mysql_query("INSERT INTO prescriptions(user_id,mName,mDose,mHour,mMinute,mPeriod,mTime,mDays) 
						VALUES('$uID','$mName','$mDose','$mHour','$mMinute','$mPeriod','$mTime','$mDays'")) 
		{
			?>
			<script>alert('successfully added ');</script>
			<?php 
			header("Location: home.php");
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
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Phil's Pills - Add Medication</title>
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
    		<p class="tab-links">Add New Medication</p>
        </div>
     
     	<center>
			<div id="content">
				<form method="post">
					<table class="addInput" align="center" width="30%" border="0">                   
						<tr>
							<td class="inputTitle">Medication Name:</td>
                    		<td><input type="text" name="mName" placeholder="Medication Name" required /></td>
						</tr> 
                    
                    	<tr>  
                    		<td class="inputTitle">Dose:</td>
							<td><input type="number" name="mDose" placeholder="Dosage" min="0" required /></td>
                    	</tr>   
                    
                    	<tr>  
                    		<td class="inputTitle">Time:</td> 
                        	<td><input type="time" name="mTime" required /></td>
                    	</tr>
                    
                    	<tr> 
                    		<td class="inputTitle">Days of the week:</td> 
                        	<td><input type="checkbox" name="dys1[]" value="Sunday" />Sunday</td>
                        	<td><input type="checkbox" name="dys1[]" value="Monday" />Monday</td> 
                        	<td><input type="checkbox" name="dys1[]" value="Tuesday" />Tuesday</td>
                        	<td><input type="checkbox" name="dys1[]" value="Wednesday" />Wednesday</td>
                        	<td><input type="checkbox" name="dys1[]" value="Thursday" />Thursday</td>
                        	<td><input type="checkbox" name="dys1[]" value="Friday" />Friday</td>
                        	<td><input type="checkbox" name="dys1[]" value="Saturday" />Saturday</td>
                    	</tr>
                    
						<tr>
							<td><button type="submit" name="btn-addmed">Add Medication</button></td>
						</tr>
                    
						<tr>
							<td><a href="home.php">Cancel</a></td>
						</tr>
					</table>
				</form>
			</div>
		</center>
	</div>
</body>
</html>