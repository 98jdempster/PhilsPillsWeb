<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}

$uID = mysql_fetch_array(mysql_query("SELECT user_id FROM users WHERE user_id=".$_SESSION['user']))[0];
error_log("Session User : ". $_SESSION['user'] ." User ID : $uID\n", 0);

if(isset($_POST['btn-cancel'])) 
{  
	header("Location: home.php");
}

if (isset($_POST['btn-addmed']))
{ 

    error_log("Add Med Button Pressed\n", 0);

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
	
    // prescription exist or not
    $query = "SELECT count(*) FROM prescriptions WHERE mName = '$mName' AND user_id =".$_SESSION['user'];
    $count = mysql_fetch_array(mysql_query($query))[0];

    error_log("Duplicate Med Count : $count\n", 0);

    if($count == 0){  
        
        if(mysql_query("INSERT INTO prescriptions (user_id,mName,mDose,mHour,mMinute,mPeriod,mFreq) ".
                       "VALUES ('$uID','$mName','$mDose','$mHour','$mMinute','$mPeriod','$mFreq')")) 
        {
            ?>
            <script>alert('successfully added ');</script>
            <?php 
			header("Location: home.php");
        }
        else
        {
            error_log("MYSQL ERROR : ". mysql_error() ."\n", 0);
            ?>
            <script>alert('error while adding med ');</script>
            <?php
        }		
    }
    else
    {
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
    <script src="../js/InputAlert.js"></script>
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
      <div id="content" class="content">
      	<form method="post">
    		<table class="addInput" align="center" width="30%" border="0"> 
	    		<tr>
	      			<td class="inputTitle">Medication Name:</td>
        			<td><input type="text" name="mName" placeholder="Medication Name" /></td>
	    		</tr> 
            
	    		<tr> 
            		<td class="inputTitle">Dose:</td>
	    			<td><input type="number" name="mDose" placeholder="Dosage" min="0" /></td>
	    		</tr>
            
	    		<tr>  
            		<td class="inputTitle">Time:</td>
	    			<td class="timeIn"><input type="number" name="mHour" placeholder="Hour" min="1" max="12" /></td> 
            		<td class="timeColon">:</td>
            		<td class="timeIn"><input type="number" name="mMinute" placeholder="Minute" min="0" max="59" /></td>
            		<td class="timePeriod"><input type="radio" name="mPeriod" value="A.M." />A.M.</td>
            		<td class="timePeriod"><input type="radio" name="mPeriod" value="P.M." />P.M.</td>   
	    		</tr> 
                
               	<tr> 
                	<td class="inputTitle">Days Of The Week:</td> 
                    <td class="timePeriod"><input type="radio" name="mFreq" value="Every other day" />Every other day</td>
                    <td class="timePeriod"><input type="radio" name="mFreq" value="Daily" />Daily</td>
                    <td class="timePeriod"><input type="radio" name="mFreq" value="Weekly" />Weekly</td>
                </tr>
            
	    		<tr>
	    			<td><button type="submit" name="btn-addmed">Add Medication</button></td>
	    		</tr>  
            
        		<tr>
        			<td><a href="home.php" class="btn-cancel">Cancel</button></td>
	    		</tr>
	  		</table>
        </form>
      </div> 
    </div>
  </body>
</html>