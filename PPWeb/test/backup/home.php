<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"> 

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['user_email']; ?></title>
<link rel="stylesheet" href="../css/homestyle.css" type="text/css" />  
<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
<script>var __adobewebfontsappname__="dreamweaver"</script>
<script src="http://use.edgefonts.net/source-sans-pro:n2:default.js" type="text/javascript"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
</head>  
<body>
<!-- Main Container -->
<div class="container"> 
  <!-- Navigation -->
  <header>
    <h4 class="logo">Phil's Pills</h4>
  
    <nav>
      <ul> 
      	<li>Welcome <?php echo $userRow['user_name']; ?></li> 
        <li><a href="logout.php?logout">Sign Out</a></li>
        <li><a href="PhilsPillsWebsite.html">HOME</a></li>
        <li><a href="#about">ABOUT</a></li>
        <li> <a href="ContactPage.html">CONTACT</a></li>
      </ul>
    </nav>
  </header> 
  <header>
    <nav>
      <ul> 
      	<li>Welcome <?php echo $userRow['user_name']; ?></li> 
        <li><a href="logout.php?logout">Sign Out</a></li>
        <li><a href="PhilsPillsWebsite.html">HOME</a></li>
        <li><a href="#about">ABOUT</a></li>
        <li> <a href="ContactPage.html">CONTACT</a></li>
      </ul>
    </nav>
  </header> 
  <div class="tab-content">
 	   <div id="tab1" class="tab active">
    	    <p>Tab #1 content goes here!</p>
	   </div>
 
       <div id="tab2" class="tab">
            <p>Tab #2 content goes here!</p>
       </div>
 
       <div id="tab3" class="tab">
         	<p>Tab #3 content goes here!</p>
       </div>
 
       <div id="tab4" class="tab">
            <p>Tab #4 content goes here!</p>
       </div>
  </div> 
  
  <a type="activate" class="activate" href="register.php">Activate Planner</a> 
  <a type="activate" class="activate" href="index.php">Log in</a> 
  
  <!-- About Section --> 
  <section class="about" id="about"> 
    <h2 class="hidden">About</h2>
    <p class="text_column">The goal of the Phil's Pills with the Phil's Pills Planner is to prevent harm caused by forgetting to take medications.</p>
  
  </section>
  <!-- Stats Gallery Section -->
  <div class="gallery">
    <div class="thumbnail">
      <h1 class="stats">1500</h1>
      <h4>TITLE</h4>
      <p>One line description</p>
    </div>
    <div class="thumbnail">
      <h1 class="stats">2300</h1>
      <h4>TITLE</h4>
      <p>One line description</p>
    </div>
    <div class="thumbnail">
      <h1 class="stats">7500</h1>
      <h4>TITLE</h4>
      <p>One line description</p>
    </div>
    <div class="thumbnail">
      <h1 class="stats">9870</h1>
      <h4>TITLE</h4>
      <p>One line description</p>
    </div>
  </div>
  <!-- Parallax Section -->
  <section class="banner">
    <h2 class="parallax">PARALLAX HERO</h2>
    <p class="parallax_description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
  </section>
  <!-- More Info Section -->
  <footer>
    <article class="footer_column">
      <h3>ABOUT</h3>
      <img src="images/placeholder.jpg" alt="" width="400" height="200" class="cards"/>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla </p>
    </article>
    <article class="footer_column">
      <h3>LOCATION</h3>
      <img src="images/placeholder.jpg" alt="" width="400" height="200" class="cards"/>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla </p>
    </article>
  </footer>
  <div class="copyright"><strong>Phil's Pills</strong></div>
</div>
<!-- Main Container Ends -->
</body>

<!--
<body> 

<div class="container"> 
  
  <header>
    <h4 class="logo">Phil's Pills</h4>
    <nav>
      <ul class="navul"> 
      	<li class="navulli"><?php echo $userRow['user_name']; ?></li>
        <li class="navulli"><a href="PhilsPillsWebsite.html">HOME</a></li> 
        <li class="navulli"><a href="#about">ABOUT</a></li>
        <li class="navulli"> <a href="ContactPage.html">CONTACT</a></li> 
        <li class="navulli"><a href="logout.php?logout">SIGN OUT</a></li>
      </ul>
    </nav>
  </header>
  
  <section class="hero" id="hero">
    <h2 class="hero_header">PHIL'S PILLS</h2>
    <p class="tagline">ENGINEERING DESIGN AND DEVELOPMENT GROUP 5</p>
  </section>   
  -->
  
<!--  

<div id="header">
	<div id="left">
    <label>Coding Cage</label>
    </div>
    <div id="right">
    	<div id="content">
        	hi &nbsp;<a href="logout.php?logout">Sign Out</a>
        </div>
    </div>
</div>

<div id="body">
    <p>Focuses on PHP, MySQL, Ajax, jQuery, Web Design and more...</p>
</div>  

-->
<!--
</body> 
-->
</html>