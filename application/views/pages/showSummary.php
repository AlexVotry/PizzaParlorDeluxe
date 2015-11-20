<?php 
session_start();
$zip = 0;
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$aptnum = $_POST['aptnum'];
$zip = $_POST['zip'];
$comment = $_POST['comment'];
if ($zip > 98026) {
	$city = "Lynnwood";
} else {
	$city = "Edmonds";
}
$totalWithTax = $_POST['totalWithTax'];
$finalPizza = $_POST['finalPizza'];
$custInfo = "$fname $lname <br>$address  $aptnum <br>$city, $zip WA <br>";
$contactInfo = "contact info: $phone<br> $email";
if ($comment !="") {
	$instructions = "Your special instructions are: <br> $comment";
} else {
	$instructions = "";
}
?>

</head>
<body onload="startTime();">
	<div id="header"> 
		<h1>Pizza Perfection </h1>
		<div id="nav">
		<p>Your final order is: </p>
		<p id="order"><?=$finalPizza?></p>	
		<p id="total">Your total cost is: $<?=$totalWithTax?></p>
	</div>
	</div>
	
	<div id="address">
		<p>We will deliver a <?=$finalPizza?> to:</p>
		<p id="dAddress"><?=$custInfo?></p>
		<p><?=$contactInfo?></p>
		<p><?=$instructions?></p>
	</div>
<div id="clock">should be a clock</div>

</body>
</html>