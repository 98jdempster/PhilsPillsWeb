<?php
session_start();
include_once 'dbconnect.php';  
 
error_reporting(E_ALL);
ini_set('display_errors', '1');

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

$mrSql = "SELECT * FROM prescriptions WHERE user_id =".$_SESSION['user']; 
$mrRes = mysql_query($mrSql);
  
$medArray = array(); 
$medname_array = array(); 
$meddose_array = array();
$medhour_array = array();
$medminute_array = array(); 
$medperiod_array = array(); 

while($maRow = mysql_fetch_assoc($maRes))
{ 
	$medArray[] = $maRow;  
}
while($aMedRow = mysql_fetch_array($mrRes))
{ 
	$medname_array[] = $aMedRow['mName'];
	$meddose_array[] = $aMedRow['mDose']; 
	$medhour_array[] = $aMedRow['mHour'];
	$medminute_array[] = $aMedRow['mMinute'];
	$medperiod_array[] = $aMedRow['mPeriod']; 
}

//Medication alarm  
/*
$overdue_list = array();  

if(count($medArray) > 0) 
{ 
	$now = time(); 
	
	for($x = 0; $x < count($medArray); $x++)
	{  
		$hr = $medArray[$x]['mHour']; 
		$min = $medArray[$x]['mMinute'];
		 
		if($medArray[$x]['mPeriod'] == "P.M." && $medArray[$x]['mHour'] < 12) 
		{ 
			$hr = $medArray[$x]['mHour'] + 12; 
		}
	
		if($medArray[$x]['mPeriod'] == "A.M." && $medArray[$x]['mHour'] == 12) 
		{ 
			$hr = $medArray[$x]['mHour'] - 12; 
		}
		 
		if($medArray[$x]['mMinute'] < 10) 
		{  
			$min = "0" . $medArray[$x]['mMinute'];
		}
		
		$mTimeString = $hr . ":" . $min; 
		
		if($mTimeString == date("G:i")) 
		{ 
			$overdue_list[] = $medArray[$x];
		}
	}
}
*/
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
<script type="text/javascript">

//var amint = setInterval(alert_med, 10000);
//var ovint = setInterval(over_med, 300000); 

function alert_med()
{ 
	var now = new Date(); 
	var medNameArr = <?php echo json_encode($medname_array);?>; 
	var medDoseArr = <?php echo json_encode($meddose_array);?>;
	var medHourArr = <?php echo json_encode($medhour_array);?>;
	var medMinuteArr = <?php echo json_encode($medminute_array);?>;
	var medPeriodArr = <?php echo json_encode($medperiod_array);?>;  
	
	var medName; //= php echo json_encode($medArray[0]['mName']);?>;	
	var medDose; //= php echo json_encode($medArray[0]['mDose']);?>;	
	var medHour; //= php echo json_encode($medArray[0]['mHour']);?>;	
	var medMinute; //= php echo json_encode($medArray[0]['mMinute']);?>;	
	var medPeriod; //= php echo json_encode($medArray[0]['mPeriod']);?>;	
	
	var message = "Take your "; 
	
	var now = new Date();
	
	for(var index = 0; index < medNameArr.length; index++) 
	{ 
		medName = medNameArr[index];  
		medDose = medDoseArr[index]; 
		medHour = medHourArr[index];
		medMinute = medMinuteArr[index];
		medPeriod = medPeriodArr[index];
		
		if(medMinute < 10) 
		{ 
			medMinute = "0" + medMinute;
		}
	
		if(medPeriod == "P.M." && medHour < 12) 
		{ 
			medHour = parseInt(medHour) + 12; 
		}
	
		if(medPeriod == "A.M." && medHour == 12) 
		{ 
			medHour = parseInt(medHour) - 12; 
		} 
	
		if(medHour == now.getHours() && medMinute == now.getMinutes()) 
		{ 
			message = message.concat(medName);
		} 
		
	} 
	
	if(message.length > 10) 
	{ 
		alert(message);
	}
	
	//var nextmin = new Date(now.getFullYear(), now.getMonth(), now.getDate(), now.getHours(), (now.getMinutes()+1), 0, 0) - now;
	//setTimeout(function(){}, nextmin);
}

window.onload = function () {
	var now = new Date(); 
	var nextmin = new Date(now.getFullYear(), now.getMonth(), now.getDate(), now.getHours(), (now.getMinutes()+1), 0, 0);
	nextmin = nextmin - now;

	setTimeout(alert_med, nextmin); //Make sure the function runs as soon as time changes by a minute
    setTimeout(alert_med, 60000); //Then set it to run again every minute
}
/*
function over_med() 
{ 
	var oNow = new Date();
	var oName = php echo json_encode($overdue_list[0]['mName']);?>;	
	var oDose = php echo json_encode($overdue_list[0]['mDose']);?>;	
	var oHour = php echo json_encode($overdue_list[0]['mHour']);?>;	
	var oMinute = php echo json_encode($overdue_list[0]['mMinute']);?>;	
	var oPeriod = php echo json_encode($overdue_list[0]['mPeriod']);?>;	
	
	if(oMinute < 10) 
	{ 
		oMinute = "0" + oMinute;
	}
	
	if(medPeriod == "P.M." && oHour < 12) 
	{ 
		oHour = oHour + 12; 
	}
	
	if(oPeriod == "A.M." && oHour == 12) 
	{ 
		oHour = oHour - 12; 
	}  
	
	var message = "Take your " + oName;
	alert(message);
}

function start_alarm() 
{
	var ivar = setInterval(alert_med, 60000); 
	var ovar = setInterval(over_med, 300000);   
}
*/
</script>
</head>

<body onload="alert_med()">  
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
						echo "<th>Frequency:</th>";
						
						while($row = mysql_fetch_array($result))
						{  
							$min = $row['mMinute']; 
							
							if($row['mMinute'] < 10) 
							{ 
								$min = "0" . $row['mMinute']; 
							}
							
							echo "<tr>";
							echo "<td>" . $row['mName'] . "</td>";
							echo "<td>" . $row['mDose'] . "</td>";
							echo "<td>" . $row['mHour'] . ":" . $min . " " . $row['mPeriod'] . "</td>";
							echo "<td>" . $row['mFreq'] . "</td>";
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