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
    border: 1px solid black;
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
$date = date("m/d");
$t= date("h:i a");
$dt = new DateTime($t);
$dt->sub(new DateInterval('PT20M')); 

$subprice = array(14.40, 20.55, 12.75, 23.65, 16.35);
$priceNum = count($subprice);
for ($p = 0; $p < $priceNum; $p++) {
    $subtax[$p] = $subprice[$p] * .095;
    $subtotal[$p] = $subprice[$p] *1.095;
    $total[$p] = '$'.number_format($subtotal[$p], 2);
    $tax[$p] = '$'.number_format($subtax[$p], 2);
    $price[$p] = '$'.number_format($subprice[$p], 2);
    $dt->add(new DateInterval('PT4M')); //add 8 minutes to original time.
    $time[$p] = $dt->format('h:i a');
}

$pizzaOrders = array (
    array($date, $time[0],'Medium Aloha pizza', $price[0], $tax[0], $total[0], 'Frank Hill', '2203 Fir Ave', 'Edmonds'),
    array($date, $time[1], 'Large pepperoni pizza', $price[1], $tax[1], $total[1], 'Sharon Hanson', '123 Main St', 'Edmonds'),
    array($date, $time[2], 'Small Meat-lovers pizza', $price[2], $tax[2], $total[2], 'Brett Humdinger', '1425 Perkins Ln', 'Lynnwood'),
    array($date, $time[3], 'Large BBQ Chicken pizza', $price[3], $tax[3], $total[3], 'John Stacy', '5236 110th Ave W', 'Edmonds'),
    array($date, $time[4], 'Medium pepperoni pizza', $price[4], $tax[4], $total[4], 'Hugh Millan', '22510 9th Ave W', 'Lynnwood')

);
$custNum = count($pizzaOrders);
echo<<<HERE
   <form action='completeOrder.php' method='post'>
    <h3>Undelivered Pizzas</h3>
    <table>
        <tr>
        <th class='num'>Item Number</th><th>Date</th><th>Time of Order</th><th>Pizza<th>Price</th><th>Tax</th><th>Total</th>
        <th>Customer Name</th><th class='address'>Address</th><th>City</th><th>Delivered</th>
        </tr>
HERE;
    for ($i = 0; $i < $custNum; $i++) {
        echo "<tr>";
        $itemNum = $i + 1;
        echo "<td class='num'>$itemNum</td>";
        for ($j = 0; $j < 9; $j++) {
            echo "<td>";
            echo $pizzaOrders[$i][$j];  // can't be in parenthesis.
            echo "</td>";
        }
         echo "<td><input type='checkbox' name='delivered[]' value='delivered[$i]'>delivered</td>";
    echo "</tr>";
    }
    echo "<tr><td colspan='11'><button id='pizzaD' type='submit'>Selected Pizzas Delivered</button></td></tr>";
    echo "<tr><td colspan='11' align='right'>Total Number of Invoices: ".$itemNum;
    echo "</form>";

    $_SESSION['pizzaOrders'] = $pizzaOrders;
?>

</div>
</body>
</html>