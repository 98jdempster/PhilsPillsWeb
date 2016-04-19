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

$result = mysql_query("SELECT * FROM prescriptions WHERE user_id=".$_SESSION['user']);

if(mysql_num_rows($result) > 0) 
{ 
	while($row = mysql_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>" . $row['mName'] . "</td>";
		echo "<td>" . $row['mDose'] . "</td>";
		echo "<td>" . $row['mHour'] . ":" . $row['mMinute'] . " " . $row['mPeriod'];
		echo "</td>";
		echo "</tr>";
	} 
} 
else 
{ 
	echo ""; 
}
?> 
<!doctype html>
<html ng-app>
<head>
<meta charset="utf-8">
<title>Phil's Pills Home</title> 
<link rel="stylesheet" href="../css/homestyle.css" type="text/css" /> 
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>  
<script src="../js/ClockBox.js"></script> 
<script src="../js/Tabs.js"></script>  
<script src="../js/ClockAlarm.js"></script>  
</head>

<body>  
	<header class="title-block">
		<h1>Phil's Pills</h1>  
        <div id="clockbox"></div>
    </header> 
    
	<div class="tabs" id="tabs">    
    	<ul class="tab-links"> 
    		<li class="active" style="border-left:thin solid #FFFFFF; margin-left:1.5%"><a href="#tab1">Home</a></li>
    		<li><a href="#tab2">Contacts</a></li>
    		<li style="margin-right:1.5%"><a href="#tab3">Settings</a></li>
    	</ul>   
        <div class="content"> 
     		<div id="tab1" class="tab active">  
            	<p><a href="inputmed.php" class="btn-addmed">Add Medication</a></p>
            	<table id="medTable" class="medTable">  
                    <?php
                    $result = mysql_query("SELECT * FROM prescriptions WHERE user_id=".$_SESSION['user']);

					if(mysql_num_rows($result) > 0) 
					{  
						echo "<th>Name:</th>"; 
						echo "<th>Dose:</th>";  
						echo "<th>Time:</th>"; 
						
						while($row = mysql_fetch_array($result))
						{
							echo "<tr>";
							echo "<td>" . $row['mName'] . "</td>";
							echo "<td>" . $row['mDose'] . "</td>";
							echo "<td>" . $row['mHour'] . ":" . $row['mMinute'] . " " . $row['mPeriod'];
							echo "</td>";
							echo "</tr>";
						} 
					} 
					else 
					{ 
						echo "<tr>No medications in database.</tr>"; 
					}
					?> 
                </table>
        	</div>
 
        	<div id="tab2" class="tab"> 
            	<p><a href="inputcontact.php" class="btn-add">Add New Contact</a></p>
            	<table align="center" border="0">
                	<tr> 
                    	<th>Name:</th>
                        <th>Phone Number:</th>
                        <th>Email:</th>
                    </tr>
                     
                    <?php 
						$conRow=mysql_query("SELECT * FROM contacts WHERE user_id=".$_SESSION['user']);
						$conRow=mysql_fetch_array($presRes); 
						$cName = $conRow['first_name'] + " " + $conRow['last_name'];
					?> 
                    <tr> 
                    	<td><?php echo $cName; ?></td> 
                        <td><?php echo $conRow['phone_number']; ?></td>
                        <td><?php echo $conRow['email']; ?></td>
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