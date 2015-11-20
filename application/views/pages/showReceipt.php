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

   
#receipt {
    background-color: #fff;
    border: thin black dotted;
    width: 250px;
    padding: 25px;
}

</style>
</head>
<body>


<h2>Receipt</h2>
<div class="wrapper">

<?php 
$pizzaOrders = $_SESSION['pizzaOrders'];
$dTime = $_POST['dTime'];

if (isset($_POST['receipt'])) {
    $receipt = $_POST['receipt'];
    $numReceipt = count($receipt);

 foreach ($receipt as $key=>$value) {
        if ($value !="") {
        $itemNum = $value[8] + 1;  //the number in value[number] is imported from the string 'receipt[$i]'.  0=d, 1=e, etc..
        $final = $pizzaOrders[$value[8]];
        $sum = $final[5];
        echo '<div id="receipt">';
            echo '<h3>Receipt for Pizza #'.$itemNum.'</h3>';
            echo 'Date: <span style="color:red">'.$final[0].'</span><br>';
            echo 'Order time: <span style="color:red">'.$final[1].'</span><br>';  
            echo 'Delivery Time: <span style="color:red">'.$dTime."</span><br>"; 
            echo 'Pizza Description: <span style="color:red">'.$final[2].'</span><br><br>';
            echo "<table>";
            echo '<tr><td>Subtotal: </td><td align="right"> <span style="color:red">'.$final[3].'</span></td></tr>';
            echo '<tr><td>Tax: </td><td align="right"><span style="color:red">'.$final[4].'</span></td></tr>';
            echo '<tr><td>Total: </td><td align="right">   <span style="color:red">'.$final[5].'</span><br></td></tr>';
            echo '</table>';
            echo '<br>Purchace / Delivery to:<br>';
            echo '<span style="color:red">'.$final[6].'</span><br>';
            echo '<span style="color:red">'.$final[7].", ".$final[8].'</span><br>';
        echo '</div>';
        }
    }
} 
else
echo<<<HERE
    Please click the "go back" button and start again.
    <br>
    <a  href="phpArrayAndStringAssignment.php"><button>Go Back</button></a>
HERE;




?>
</div>
</body>
</html>