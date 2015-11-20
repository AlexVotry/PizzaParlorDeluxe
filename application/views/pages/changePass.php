<?php
// start a session in order to work with session variables
session_start();

if (!$_SESSION['loggedIn']){
   $_SESSION["loginWarn"] = "You must be logged into the system to access the page.";
   header('Location: '."index.php");
}
else {
?>
  <!DOCTYPE html>
<html lang="en">

<head>
<title>Password Change</title>
       <!-- author: Marti Baker
       CIS 243 -->
       <meta name="author" content="Marti Baker">
       <meta name="keywords" content="final project 'Pizza Parlor'">
       <meta name="description" content="Log in page for Pizza Parlor Deluxe Admin site">
       <meta http-equiv="content-type" content="text/html; charset=UTF-8">
       <meta name="robots" content="none">
       <link rel="stylesheet" href="adminStyle.css" type="text/css">
       <script type="text/javascript" src="admin.js"></script>
       <script type="text/javascript" src="cookies.js"></script>
</head>
<body>
<div id="container">
    <div id="head">
        <img src="../images/pepperoni_1.jpg" width="238" height="120" alt="" id="logo">
        <span class="header">PizzaParlorDeluxe.com</span>
        <span class="contact">
            20000 68th Ave. W<br>
            Lynnwood, WA 98036<br>
            425.222.1234
        </span>
    </div>
    
    <div id="break">    
        <hr style="clear:both;margin-top:15px;">
    </div>
    
    <div id="nav">
        <a href="../home.html" class="orderSum">Home</a><br>
        <a href="../contact.html" class="orderSum">Contact Us</a><br>
        <a href="../order.html" class="orderSum">Order Now</a>
    </div>
    <form method="post" action="processPasswordChange.php" onsubmit="return chkForm(0)">
    
    <div id="main">
        <p>
        <h3>Please enter your old password and your new password</h3>
        <p>Passwords must include all of the four types of characters below:</p>
        <ul>
            <li>Upper case letters</li>
            <li>Lower case letters</li>
            <li>Numbers</li>
            <li>Non-alpha characters</li>
            <li>A minimum length of eight characters</li>
        </ul>
        Current password: <input type="password" name="pswOld" class="input" value="" onchange="return clrErr('loginWarn')"> <br>
        New Password: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="pswWord" class="input" value="" onchange="return clrErr('loginWarn')"><br>
        Confirm Password: <input type="password" name="pswConf" class="input" value="" onchange="return clrErr('loginWarn')"><br><br>
        <input type="submit" value="Log in">
        </p>
        <span id="loginWarn">
            
        </span>
    </div>
    
    </form>
    
</div>
</body>

</html>

<?php
}  // end else
?>