<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <title>PHP Array and String Assignment</title>
     <!--
     Alex Votry
     CIS 243 Web Dev III
     -->
     <meta charset="utf-8">
     <meta name="author" content="Alex Votry">
     <meta name="robots" content="NOINDEX, NOFOLLOW">
<style type="text/css">
body {
    margin: 10px;
    padding: 25px;
}

   
.wrapper {
    background-color: #8fbc8f;
    border: thin black solid;
    padding: 25px;
}
table {
    border: 2px solid black;
    border-collapse: collapse;
    padding: 10px;
    width: 90%;
    margin: center;
} 

td, th {
    border: 1px solid black;
    padding: 10px;
}
td.num, th.num {
    width: 25px;
    padding: 2px;
    background-color: #a9a9a9;
    text-align: center;
}

#pizzaD {
    width: 250px;
    margin-left: 40%;
}
</style>
</head>
<body>
<h2>PHP Array And String Assignment</h2>
<div class="wrapper">

<?php
date_default_timezone_set("America/Los_Angeles");
$t= date("h:i a");
$pizzaOrders = $_SESSION['pizzaOrders'];

if (isset($_POST['delivered'])) {
    $delivered = $_POST['delivered'];
    $numDelivered = count($delivered);

echo<<<HERE
    <form action='receipt.php' method='post'>
    <input type='hidden' name='dTime' value='$t' />
    <h3>Delivered Pizzas</h3>
    <table>
        <tr>
        <th class='num'>Item Number</th><th>Date</th><th>Time of Delivery</th><th>Pizza<th>Price</th><th>Tax</th><th>Total</th>
        <th>Customer Name</th><th class='address'>Address</th><th>City</th><th>Receipts</th>
        </tr>
HERE;
    foreach ($delivered as $key=>$value) {
        if ($value !="") {
            echo "<tr>";
        $itemNum = $value[10] + 1;  //this is the number imported with delivery[$i].  0=d, 1=e, etc..
        echo "<td class='num'>$itemNum</td>";
            for ($j = 0; $j < 9; $j++) {
                $pizzaOrders[$value[10]][1] = $t;
                echo "<td>";
                echo $pizzaOrders[$value[10]][$j];  // can't be in parenthesis.
                echo "</td>";
            }
        }
         echo "<td><input type='checkbox' name='receipt[]' value='receipt[$value[10]]'>receipt</td>";
    echo "</tr>";
    }
    echo "<tr><td colspan='11'><button id='pizzaD' type='submit'>Print Receipt</button></td></tr>";
    echo "<tr><td colspan='11' align='right'>Total Number of Delivered Pizzas: ".$numDelivered;
    echo "</form>";
}
else
echo<<<HERE
    Please click the "Go Back" button and check which pizza(s) have been ordered.
    <br>
    <a  href="phpArrayAndStringAssignment.php"><button>Go Back</button></a>
HERE;

?>

</div>
</body>
</html>