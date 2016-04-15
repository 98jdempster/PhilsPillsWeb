/*Tabs

   Description: Javascript used to switch between
   				tabs on the home page (home.php).
 
    Programmer: Jack Dempster
 
          Date: April 13, 2016
          
 Date Modified: April 15, 2016
*/
jQuery(document).ready(function() {
	jQuery('.tabs .tab-links a').on('click', function(e)  {
    	var currentAttrValue = jQuery(this).attr('href');
 			
        	// Show/Hide Tabs 
			jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
        	//jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
 
        	// Change/remove current tab to active
        	jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        	e.preventDefault();
		});
});