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

$maSql = "SELECT mName, mDose, mHour, mMinute, mPeriod FROM prescriptions WHERE user_id =".$_SESSION['user']; 
$maRes = mysql_query($maSql);
  
$medArray = array(); 

while($maRow = mysql_fetch_assoc($maRes))
{ 
	$medArray[] = $maRow; 
}
/* 
Every 5 minutes {
  $now = current_time;
  Foreach $user currently logged in {
    Foreach $medication that user takes {
      If $now > $calculated_next dose {
        Add $medication to $overdue_list
      }
    }
    If there are any entries in $overdue_list {
      Alert $user of $overdue_list
    }
  }
} 
*/ 
$overdue_list = array(); 

//Medication alarm
if(mysql_num_rows($result) > 0 && mysql_num_rows($result) != null) 
{    
	while(true) 
	{			
		$now = time();
		for($x = 0; $x < count($medArray); $x++)  
		{ 
			if($now > mktime($medArray[$x]['mHour'],$medArray[$x]['mMinute'],date("n"),date("j"),date("Y"))) 
			{  
				$overdue_list[] = $cMed;
			} 
			
			if($now == mktime($medArray[$x]['mHour'],$medArray[$x]['mMinute'],date("n"),date("j"),date("Y"))) 
			{  
				?>
        		<script>alert('Take your medication! ');</script>
				<?php	
			}
		} 
		if((time() - mktime($overdue_list[0]['mHour'],$medArray[0]['mMinute'],date("n"),date("j"),date("Y"))) >= 300 
		&& count($overdue_list) > 0) 
		{  
			?>
        	<script>alert('Take your medication! ');</script>
			<?php	
		}
		/*
		while($alRow = mysql_fetch_array($result))
		{  
			if(date('g:i space? meridian') == date('g:i space? meridian',strtotime($alRow['mHour'] . ":" . $alRow['mMinute'] . $alRow['mPeriod'])))
			{  
				?>
        		<script>alert('Take your medication! ');</script>
				<?php
			}
		}
		*/
	}
} 
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
     		<div id="tab1" class="tab active" style="overflow-x:auto;">  
            	<p><a href="inputmed.php" class="btn-addmed">Add Medication</a></p>
            	<table id="medTable" class="medTable">  
                    <?php
                    $result = mysql_query("SELECT * FROM prescriptions WHERE user_id=".$_SESSION['user']);

					if(mysql_num_rows($result) > 0 && mysql_num_rows($result) != null) 
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
 
        	<div id="tab2" class="tab" style="overflow-x:auto;"> 
            	<p><a href="inputcontact.php" class="btn-add">Add New Contact</a></p>
            	<table align="center" border="0"> 
                	<?php
                    $cResult = mysql_query("SELECT * FROM contacts WHERE user_id=".$_SESSION['user']);

					if(mysql_num_rows($cResult) > 0 && mysql_num_rows($cResult) != null) 
					{  
						echo "<th>Name:</th>"; 
						echo "<th>Phone Number:</th>";  
						echo "<th>Email:</th>"; 
						
						while($cRow = mysql_fetch_array($cResult))
						{
							echo "<tr>";
							echo "<td>" . $cRow['first_name'] . " " . $cRow['last_name'] . "</td>";
							echo "<td>" . $cRow['phone_number'] . "</td>";
							echo "<td>" . $cRow['email'] . "</td>";
						} 
					} 
					else 
					{ 
						echo "<tr>No contacts in database.</tr>"; 
					}
					?> 
                </table>
        	</div>
 
        	<div id="tab3" class="tab">
            	<p><a href="logout.php?logout">Logout</a></p>
        	</div> 
        </div>
     </div>  
</body>
</html>