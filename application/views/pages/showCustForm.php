<?php 

        // get time and date;
        date_default_timezone_set("America/Los_Angeles");
        $date = date("m/d");
        $t= date("h:i a");
        $dt = new DateTime($t);
        $time = $dt->format('h:i a');
        $finalPizza = $_SESSION['finalPizza'];
        $tax = $_SESSION['tax'];
        $totalWithTax = $_SESSION['totalWithTax'];
        $subTotal = $_SESSION['subTotal'];
?>
</head>

<body>
    <div id="header"> 
        <h1>Pizza Perfection </h1>
        <div id="nav">
            <p>The pizza you ordered is:</p>
            <p id="order">  <?=$finalPizza?></p> 
            <p id="total">Your total with tax is: $<?=$totalWithTax?> </p>
           
        </div>   
    </div>
   
<form id="commentForm" name="commentForm" method="post" action="<?php echo base_url();?>index.php/orders/insertNewPizza" >
    <fieldset class="cform">

    <input type="hidden" name="date" value="<?=$date?>" />
    <input type="hidden" name="time" value="<?=$time?>" />
    <input type="hidden" name="finalPizza" value="<?=$finalPizza?>" />
    <input type="hidden" name="totalWithTax" value="<?=$totalWithTax?>" />
    <input type="hidden" name="subTotal" value="<?=$subTotal?>" />
    <input type="hidden" name="tax" value="<?=$tax?>" />
    <input type="hidden" name="state" value="WA" />
    <input type="hidden" name="completed" value="no" />

        <legend><b>Please fill out our customer information form</b></legend>
            
                <p><label for="cfname">First Name:</label>
                <span class="ten"><input id="cfname" name="fname" size="25" class="required" minlength="2" required/></span>
            
                <label for="clname">Last Name:</label>
                <span class="lap"><input id="clname" name="lname" size="25" class="required" minlength="2" required/></span></p>
                
                <p><label for="caddress">Your delivery address:</label>
                 <span class="five"><input id="caddress" name="address" size="25"  class="required" required/></span>
               
                <label for="aptnum">Apartment number:</label>
                 <span class="lap"><input id="aptnum" name="aptnum" size= "20"/></span></p>
            
                <p><span class="five"><label for="cemail">email address:</label></span>
                <span class="six"><input id="cemail" name="email" size="25"  class="required email" required /></span>
            
                <span ><label for="cphone">Phone #:</label></span>
                <span class="lap"><input id="cphone" name="phone" size="20" class="required" minlength="7" required/></span></p>

                <p><label for="czip"> Zip codes in our delivery area: </label>
               <select id="czip" name="zip" class="required">
                    <option>98020</option>
                    <option>98026</option>
                    <option>98037</option>
                    <option>98036</option>
                    </select></p>
            
                    <div class="buttons">
                        <button type="submit" class="positive"><img src="<?php echo base_url(); ?>public/images/tick.png" alt="" /> Give me my Pizza!</button>  
                    </div>
                    <div class="buttons">
                        <button type="reset" class="negative"><img src="<?php echo base_url(); ?>public/images/cancel.png" alt=""/>start over</button>
                    </div>
    </fieldset>
</form>

<form id="mobileForm" name="mobileForm" method="post" action="<?php echo base_url();?>index.php/orders/insertNewPizza" >
    <fieldset class="mform">

        <input type="hidden" name="date" value="<?=$date?>" />
        <input type="hidden" name="time" value="<?=$time?>" />
        <input type="hidden" name="finalPizza" value="<?=$finalPizza?>" />
        <input type="hidden" name="totalWithTax" value="<?=$totalWithTax?>" />
        <input type="hidden" name="subTotal" value="<?=$subTotal?>" />
        <input type="hidden" name="tax" value="<?=$tax?>" />
        <input type="hidden" name="state" value="WA" />
        <input type="hidden" name="completed" value="no" />

        <legend><b>Please fill out our customer information form</b></legend>
            
                <p><label for="cfname">First Name:</label>
                <input id="cfname" name="fname" size="25" class="required" minlength="2" required/></p>
            
                <p><label for="clname">Last Name:</label>
                <span class="lap"><input id="clname" name="lname" size="25" class="required" minlength="2" required/></span></p>
                
                <p><label for="caddress">Your delivery address:</label>
                <input id="caddress" name="address" size="25"  class="required" required/></p>
               
                <p><label for="aptnum">Apartment number:</label>
                <input id="aptnum" name="aptnum" size= "20"/></p>
            
                <p><label for="cemail">email address:</label>
                <input id="cemail" name="email" size="25"  class="required email" required /></p>
            
                <p><label for="cphone">Phone #:</label>
                <input id="cphone" name="phone" size="20" class="required" minlength="7" required/></p>

                <p><label for="czip"> Zip codes in our delivery area: </label>
               <select id="czip" name="zip" class="required">
                    <option>98020</option>
                    <option>98026</option>
                    <option>98037</option>
                    <option>98036</option>
                    </select></p>
            
                    <div class="buttons">
                        <button type="submit" class="positive"><img src="<?php echo base_url(); ?>public/images/tick.png" alt="" /> Give me my Pizza!</button>  
                    </div>
                    <div class="buttons">
                        <button type="reset" class="negative"><img src="<?php echo base_url(); ?>public/images/cancel.png" alt=""/>start over</button>
                    </div>
    </fieldset>
</form>
