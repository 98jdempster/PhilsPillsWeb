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

$aHour = mysql_query("SELECT mHour FROM prescriptions WHERE user_id=".$_SESSION['user']);
$aMinute = mysql_query("SELECT mHour FROM prescriptions WHERE user_id=".$_SESSION['user']); 
$aPeriod = mysql_query("SELECT mHour FROM prescriptions WHERE user_id=".$_SESSION['user']); 
$aName = mysql_query("SELECT mName FROM prescriptions WHERE user_id=".$_SESSION['user']);

$query = "SELECT count(*) FROM prescriptions WHERE user_id =".$_SESSION['user'];
$count = mysql_fetch_array(mysql_query($query))[0];
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Phil's Pills Home</title> 
<link rel="stylesheet" href="../css/homestyle.css" type="text/css" /> 
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
<script src="../js/ClockBox.js"></script> 
<script src="../js/Tabs.js"></script>  
<script src="../js/ClockAlarm.js"></script>  
<script>
var medTable = angular.module("medTable", []);
medTable.controller("MedCtrl", function($scope) {
$scope.meds = [];
$scope.addRow = function(){		
	<?php  
		for($i = 1; $i <= $count; $i++) 
			{
				$presRes=mysql_query("SELECT * FROM prescriptions WHERE prescriptionID = AND user_id=".$_SESSION['user']);
				$presRow=mysql_fetch_array($presRes);   
				if($presRow['mMinute'] < 10) 
				{  
					$medTime = ($presRow['mHour']+":"+"0"+$presRow['mMinute']+$presRow['mPeriod']);
				} 
				else 
				{ 
					$medTime = ($presRow['mHour']+":"+$presRow['mMinute']+$presRow['mPeriod']); 
				}
				?> 
				$scope.name=<?php echo $presRow['mName']; ?>
				$scope.dose=<?php echo $presRow['mDose']; ?>
				$scope.time=<?php echo $medTime; ?>
				$scope.meds.push({ 'name':$scope.name, 'dose':$scope.dose, 'time':$scope.time });
				<?php
			}
	?>
}
};
)};
</script>
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
     		<div id="tab1" class="tab active" ng-app="medTable" ng-controller="MedCtrl">  
            	<p><a href="inputmed.php" class="btn-addmed">Add Medication</a></p>
            	<table id="medTable" class="medTable" onload="addRow()"> 
                	<tr> 
                    	<th>Name:</th> 
                        <th>Dose:</th>
                        <th>Time:</th> 
                    </tr> 
                    
                    <tr class="med-display" ng-show="meds.length == 0">No medications in database.</tr>
                    
                    <tr ng-repeat="med in meds" ng-show="meds.length != 0">  
						<td>{{med.name}}</td>
                        <td>{{med.dose}}</td> 
                        <td>{{med.time}}</td> 
                    </tr>
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