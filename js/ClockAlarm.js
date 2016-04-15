/*ClockAlarm

   Description: Javascript used as alarm clock 
   				to alert user they need to take 
				medications.
 
    Programmer: Jack Dempster
 
          Date: April 13, 2016
          
 Date Modified: April 15, 2016
*/
function alarm(){  
	var d = new Date();
	var dHour = "<?php echo $aHour; ?>"; //Target hour
	var dMinute = "<?php echo $aMinute; ?>"; //Target minute
	var dPeriod = "<?php echo $aPeriod; ?>"; //Target period 
	var dName = "<?php echo $aName; ?>"; //Target name
	
	if(dPeriod == "P.M."){  
		var tHr = parseInt(dHour); 
		tHr += 12;
		dHour = tHr;
	} 
	
	if(dHour == getHours() && dMinute == getMinutes()){ 
		var message = ("It is" + (dHour-12) + ":" + dMinute + " " + dPeriod); 
		message += ("\nPlease take your " + dName);
		alert(message);
	}
}
