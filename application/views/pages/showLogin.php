       <!-- author: Marti Baker CIS 243 -->

<?php

// Start decision Check Number of Attempts 

$blnShowForm = true;

// check to see if this is the first time the user has attempted to log into the administrative site, if so, the session variable will not exist
// use the isset() method to determine if the variable exists
if (!isset($_SESSION["logOnAttempt"])) {
    // create a session variable to determine the number of log in attempts
    $_SESSION["logOnAttempt"] = 0;
    $blnShowForm = true;
}
// check to see if the there have been 10 or more log in attempts
// 'logOnAttempt' will increment on login.php
elseif ($_SESSION["logOnAttempt"] >= 10){
    $_SESSION["loginWarn"] = "There is a problem with the log in capabilities.  Contact the administrator of this site for access.";
    // to help secure your site, you would acquire the IP addresses and write it to a table in your database to block this IP Address
    $blnShowForm = false;
}
// check to see if there have been 3 or more log in attempts
elseif ($_SESSION["logOnAttempt"] >= 3) {
    $_SESSION["loginWarn"] = "There is a problem with your credentials. Contact the administrator of this site for access.";
    // to help secure your site, you would remove the log in form and have the user call the administrator of the site
    $blnShowForm = false;
}

?>
</head>
<body>
<div id="wrapper">
        <div id="header">
            <h1> Pizza Perfection </h1>
            <div id="nav">
                <a href="<?php echo base_url(); ?>index.php/home" class="orderSum">Home</a><br>
                <a href="<?php echo base_url(); ?>index.php/home/contact" class="orderSum">Contact Us</a><br>
                <a href="<?php echo base_url(); ?>index.php/home" class="orderSum">Order Now</a>
            </div>
        </div> 
<?php
    if ($blnShowForm == true){
?>
    <form method="post" action="login.php" onsubmit="return chkForm(0)">
    
    <div id="main">
        <p>
        Please enter your administrator log in:<br><br>
        User name: <input type="text" name="txtUser" class="input" value=""><br>
        Password: &nbsp;&nbsp;<input type="password" name="pswWord" class="input"><br><br>
        <input type="submit" value="Log in">
        </p>
<?php
    }
?>
        <span id="loginWarn">
            <?php
            // Session variable to display login in warning
            if (isset($_SESSION["loginWarn"])){
                echo $_SESSION["loginWarn"];
            }
            ?>
        </span>
    </div>
    
    </form>
    
</div>
</body>

</html>