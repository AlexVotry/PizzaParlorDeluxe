
<script type="text/javascript">
$(document).ready(function() {
    $("#sDrop").click(function(){
        $("#special").slideDown("slow");
		$("#build").slideUp("slow");
    });
    $("#bDrop").click(function(){
        $("#build").slideDown("slow");
		$("#special").slideUp("slow");
    });

	$('#menu').validate({
    rules: {
      size: {
        required: true, 
        minlength: 1
      },
      crust: { 
        required: true,
        minlength: 1
      },
      sizeB: {
        required: true, 
        minlength: 1
      },
      crustB: { 
        required: true,
        minlength: 1
      },
      specialty: {
      	required: true,
      	minlength: 1
      },
      topping: {
      	required: true,
      	minlength: 1
      },
    },
    messages: { // uses the "name in the input"
      size: "Pick a size",
      crust: "Pick a crust",
      sizeB: "Pick a size",
      crustB: "Pick a crust",
      specialty: "What kind of pizza would you like?",
      topping: "What would you like on it?"
    },
    // this is how to change the look of the error message
    errorPlacement: function(label, element) {
      label.insertBefore(element);
    },
  });
});

</script>
</head>

<body>
	<div id="wrapper">
		<div id="header">
			<span id="pp"><h1> Pizza Perfection </h1></span>
			<span id="adminLogin"><a href="<?php echo base_url(); ?>index.php/admin">login</a></span>
			<div id="nav">
				<p> Your order for tonight:</p>
				<p id="order"></p>	
				<p id="total"></p>
			</div>
		</div> 
		<div id="sDrop"><img class="pizzaPic" src="<?php echo base_url(); ?>public/images/hawaiianPizza.png" alt="specialty">Choose one of our Specialty Pizzas!</div>
		<div id="bDrop" ><img class="pizzaPic" src="<?php echo base_url(); ?>public/images/buildItPizza.jpg" alt="build a pizza"> Build your own masterpiece! </div>
			<form id="menu" action="<?php echo base_url();?>index.php/orders" method="post">
				<div id="special">
					<h4> Your choices are:</h4>
						
						<input type="radio" name="specialty" value="Aloha" onclick="order();">Aloha:  Pineapple and Canadian Bacon<br>
						<input type="radio" name="specialty" value="Meat Lover" onclick="order();">Meat Lover's Pizza:  Pepperoni, Canadian Bacon, sausage<br>
						<input type="radio" name="specialty" value="BBQ Chicken" onclick="order();">BBQ chicken:  Tender chicken with BBQ sauce on you type of crust.<br>
					<h4> What size would you like?</h4>
						<input type="hidden" name="sizeChoice" value="$size" />
						<input type="radio" name="size" value="Large" onclick="order();">Large
						<input type="radio" name="size" value="Medium" onclick="order();">Medium
						<input type="radio" name="size" value="Small" onclick="order();">Small
					<h4> What type of crust?</h4>
						<input type="hidden" name = "crustChoice" value="$crust">
						<input type="radio" name="crust" value="regular" onclick="order();">Regular
						<input type="radio" name="crust" value="gluten free" onclick="order();">Gluten free<br><br>
					<div class="buttons">
						<!--<button type="reset" class="negative" onclick="clearPizza();">let me change that...</button><br/><br/>-->
						<button type="submit" class="positive" onclick="orderCheck();">
						<img src="<?php echo base_url(); ?>public/images/tick.png" alt="" /> perfect!</button>   
						<button type="reset" class="negative" onclick="clearPizza();"><img src="<?php echo base_url(); ?>public/images/cancel.png" alt=""/>Start Over!</button>	
					</div>					
				</div>
				<div id="build">
					<h4> Your topping choices are:</h4>
						<div id="checkBuild">
						<div id="warning"></div>
						<input type="checkbox" name="topping[]" value="Pepperoni" onclick="order();">Pepperoni<br>
						<input type="checkbox" name="topping[]" value="Sausage" onclick="order();">Sausage<br>
						<input type="checkbox" name="topping[]" value="Pineapple" onclick="order();">Pineapple<br>
						<input type="checkbox" name="topping[]" value="Canadian Bacon" onclick="order();">Canadian Bacon<br>
						<input type="checkbox" name="topping[]" value="Olives" onclick="order();">Olives<br>
						<input type="checkbox" name="topping[]" value="Mushrooms" onclick="order();">Mushrooms<br>
						</div>
					<h4> What size would you like?</h4>
						<input type="radio" name="sizeB" value="Large" onclick="order();">Large
						<input type="radio" name="sizeB" value="Medium" onclick="order();">Medium
						<input type="radio" name="sizeB" value="Small" onclick="order();">Small
					<h4> What type of crust?</h4>
						<input type="radio" name="crustB" value="regular" onclick="order();">Regular
						<input type="radio" name="crustB" value="gluten free" onclick="order();">Gluten free<br><br>
						 <input id="twt" type="hidden" name="twt" />
					<div class="buttons">
						<button type="submit" class="positive" >
						<img src="<?php echo base_url(); ?>public/images/tick.png" alt="" /> perfect!</button>   
						<button type="reset" class="negative" onclick="clearPizza();"><img src="<?php echo base_url(); ?>public/images/cancel.png" alt=""/>Start Over!</button>	
					</div>
				</div>
			</form>
	
	</div>
		<div id="mobileLogin"><a href="<?php echo base_url(); ?>index.php/admin">login</a></div>
</body>
</html> 