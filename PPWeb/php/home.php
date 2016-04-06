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
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Phil's Pills Home</title> 
<link rel="stylesheet" href="../css/homestyle.css" type="text/css" /> 
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script> 
<script src="../js/ClockBox.js"></script> 
<script src="../js/Tabs.js"></script>    
</head>

<body>  
	<header class="title-block">
		<h1>Phil's Pills</h1>  
        <div id="clockbox"></div>
    </header> 
    
	<div class="tabs" id="tabs">    
    	<ul class="tab-links"> 
    		<li class="active" style="border-left:thin solid #FFFFFF; margin-left:1.5%"><a href="#tab1" onclick="checkTable();">Home</a></li>
    		<li><a href="#tab2">Contacts</a></li>
    		<li style="margin-right:1.5%"><a href="#tab3">Settings</a></li>
    	</ul>   
        <div class="content">
     		<div id="tab1" class="tab active">  
            	<p><a href="inputmed.php" class="btn-addmed">Add Medication</a></p>
            	<table id="medTable" class="medTable"> 
                	<tr> 
                    	<td>Name:</td> 
                        <td>Dose:</td>
                        <td>Time:</td> 
                        <td>Frequency (Hours):</td>
                    </tr>
                    <?php 
						$presRes=mysql_query("SELECT * FROM prescriptions WHERE user_id=".$_SESSION['user']);
						$presRow=mysql_fetch_array($presRes); 
					?> 
                    <tr>  
						<td><?php echo $presRow['mName']; ?></td>
                        <td><?php echo $presRow['mName']; ?></td> 
                        <td> 
							<?php  
							$medTime=$presRow['mHour']+":"+$presRow['mMinute']+$presRow['mPeriod'];
							echo $medTime;
						 	?>
                        </td>
                        <td><?php echo $presRow['mFreq']; ?></td> 
                    </tr>
                </table>
        	</div>
 
        	<div id="tab2" class="tab"> 
            	<p><a href="inputcontact.php" class="btn-add">Add New Contact</a></p>
            	<table align="center" border="0">
                	<tr> 
                    	<td>Name:</td>
                        <td>Phone Number:</td>
                        <td>Email:</td>
                    </tr> 
                    
                    <tr> 
                    	<td></td> 
                        <td></td>
                        <td></td>
                    </tr>
                </table>
        	</div>
 
        	<div id="tab3" class="tab">
            	<p><a href="logout.php?logout">Logout</a></p>
        	</div> 
        </div>
     </div>  
</body>
</html>