<!--   
	checks to see if the credentials were received
    connects to the database
    checks for the user in the database
    checks to see if the user has logged in previously
    [optional] records log ins to the audit table
    sets up authorization to use the administrative side of Pizza Parlor Deluxe
    redirects the user to different locations within the administrative side or the original login page 
    -->
<?php
session_start();
//echo $_SERVER['HTTP_REFERER']; //check for the referring page using a built-in PHP server variable

?>

<?php

// create variables from accepted refering pages
$refer1 = "hhttp://localhost/pizzaParlorDeluxe/"; //assigns a default URL to a variable
$refer2 = "http://localhost/pizzaParlorDeluxe/index.php"; //assigns the full URL to a variable

// check to see if the referring page is correct, if not, send the user back to the log in page
if (($_SERVER['HTTP_REFERER'] != $refer1) && ($_SERVER['HTTP_REFERER'] != $refer2)){
    header('Location: '."index.php"); //sends the user who has arrived from an unacceptable URL back to the log in page
}
elseif ((!isset($_POST['txtUser'])) && (!isset($_POST['pswWord']))) {
    header('Location: '."index.php");
}
else {
    // requiring the db connection file, this file must exist and included only once
    require_once("../includes/connect.php");
        // assign variable names
    $adminLogin = $_POST['txtUser'];
    $adminPass = $_POST['pswWord'];
        // used for encrypting the user's password, clear hash if exists
    $hash = "";

    // set default number of records found in DB
    $recCount = 0;

    // start SQL statement
    $sql = "SELECT adminID, firstName, lastName, adminLevel, COUNT(*) AS numRecs FROM admins WHERE login = '$adminLogin' AND password = ";

    // check to see if default password is being used. End the SQL statement.
    if ($adminPass == "'Noth1ng!'"){
        // User is signing for the first time
        $sql .= "'$adminPass';";
    }
    else {
        // User has signed in before, encrypt the password
        $hash = hash('sha256', $adminPass);
        $sql .= "'$hash';";
    }
   
    // run the query using mysqli_query
    $result = mysqli_query($dbc, $sql) or die(mysqli_error);

    // Get data as an associative array
    // assign the count of records to a variable
    if ($result){
        while ($row = mysqli_fetch_array ($result, MYSQLI_ASSOC)){
            $recCount = $row['numRecs'];
        }
    }
   
    // test number of records returned.  a value of 0 means no record found in DB
   // Set error message for log in page. Therefore, Session must be started
    // get the user out if no records are returned from query.
    if ($recCount == 0){
        $_SESSION["loginWarn"] = "Log in failed; Invalid userID or password";
        $_SESSION["logOnAttempt"] += 1;
        $_SESSION["loggedIn"] = false;
        header('Location: '."index.php");        
    }
    // a user record was found
    // remaining code belogs in else clause
    // set session variables for admin side of application
    else {
        if ($result) {
            while ($row = mysqli_fetch_array ($result, MYSQLI_ASSOC)) {
                // create Session variables to hold administrator's information
                $_SESSION['adminID'] = $row['adminID'];
                $_SESSION['adminFName'] = $row['firstName'];
                $_SESSION['adminLName'] = $row['lastName'];
                $_SESSION['adminAuthLevel'] = $row['adminLevel'];
                $_SESSION['loggedIn'] = true;
            }
            
            // Information has been captured, redirect the user to the correct page
            header('Location: '. $redirectURL);
        }
   
    }
}
?><!--   
	checks to see if the credentials were received
    connects to the database
    checks for the user in the database
    checks to see if the user has logged in previously
    [optional] records log ins to the audit table
    sets up authorization to use the administrative side of Pizza Parlor Deluxe
    redirects the user to different locations within the administrative side or the original login page 
    -->
<?php

echo $_SERVER['HTTP_REFERER']; //check for the referring page using a built-in PHP server variable

?>