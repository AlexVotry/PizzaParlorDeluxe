<?php 
	$finalPizza = $_SESSION['finalPizza'];
    $totalWithTax = $_SESSION['totalWithTax'];
	$custInfo = $_SESSION['custInfo'];
	$contactInfo = $_SESSION['contactInfo'];
	$instructions = $_SESSION['instructions'];
 ?>

</head>
<body onload="startTime();">
	<div id="header"> 
		<h1>Pizza Perfection </h1>
		<a href="<?php echo base_url();?>">Home</a>
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