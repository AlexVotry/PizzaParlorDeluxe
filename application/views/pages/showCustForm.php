<?php 

if (filter_has_var(INPUT_POST, "size")) {
       $size = $_POST['size'];
} else {
    $size = $_POST['sizeB'];
}

if (filter_has_var(INPUT_POST, "crust")) {
    $crust = $_POST['crust'];
} else {
    $crust = $_POST['crustB'];
}

if (isset($_POST['specialty'])) {
    $specialty = $_POST['specialty'];
}   else {
     $specialty = "";
    }

if (isset($_POST['topping'])) {
    $topping = $_POST['topping'];
    $pTopping = "";
    $numToppings = count($topping);
    foreach ($topping as  $value) {
        if ($value !="") {
            $pTopping = $pTopping . " $value, ";
        }
    }
}  else {
        $pTopping = "";
        $numToppings = 0;
    }

    switch ($size) {
        case "Large":
        $price = 20.00;
        break;
        case "Medium":
        $price = 17.5;
        break;
        case "Small":
        $price = 14;
        break;
        default:
        $price = 0;
        break;
    }
    // determine price for specialty.
    switch ($specialty) {
        case "Aloha":
            $cost = $price + 1;
            break;
        case "Meat Lover":
            $cost = $price + 4;
            break;
        case "BBQ Chicken":
            $cost = $price + 3;
            break;
        default:
            $cost = 0;
            break;
    }
    if($numToppings > 0) $cost = $price + ($numToppings * .85);
    if ($crust == "gluten free") {
        $cost += 3;
    }
    $rawTotal = $cost * 1.095;
    $totalWithTax = round($rawTotal, 2);
$finalPizza = "$size $specialty $pTopping with $crust crust";
$_SESSION['finalPizza'] = $finalPizza;
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
   
<form class="cmxform" id="commentForm" name="commentForm" method="post" action="<?php echo base_url();?>index.php/home/summary" onsubmit="return deliveryAddress();" >

 <fieldset>
    <input type="hidden" name="finalPizza" value="<?=$finalPizza?>" />
    <input type="hidden" name="totalWithTax" value="<?=$totalWithTax?>" />
   <legend><b>Please fill out our customer information form</b></legend>
        <table>
            <tr>
                <td class="ten"><label for="cfname">First Name</label></td>
                <td class="thirty"><input id="cfname" name="fname" size="25" class="required" minlength="2" required/></td>
            
                <td class="ten"><label for="clname">Last Name</label></td>
                <td class="thirty"><input id="clname" name="lname" size="25" class="required" minlength="2" required/></td>
                
            </tr>
            <tr>
                <td class="ten"><label for="cemail">E-Mail</label></td>
                <td class="thirty"><input id="cemail" name="email" size="25"  class="required email" required /></td>
            
                <td class="ten"><label for="cphone">Phone #</label></td>
                <td class="thirty"><input id="cphone" name="phone" size="20" class="required" minlength="7" required/></td>
                
            </tr>
            <tr>    
               <td class="ten"><label for="caddress">Your delivery address:</label></td>
               <td class="thirty"><input id="caddress" name="address" size="25"  class="required" required/></td>
               
               <td class="ten"><label for="aptnum">Apartment number</label></td>
               <td class="thirty"><input id="aptnum" name="aptnum" size= "20"/></td>
               
            </tr>
            <tr>
                <td class="ten"><label for="czip"> Zip codes in our delivery area: </label></td>
                <td class="thirty"><select id="czip" name="zip" class="required">
                    <option>98020</option>
                    <option>98026</option>
                    <option>98037</option>
                    <option>98036</option>
                    </select></td>
                    <td></td>
                    <td>
                        <div class="buttons">
                            <button type="reset" class="negative"><img src="<?php echo base_url(); ?>public/images/cancel.png" alt=""/>start over</button>
                        </div>
                    </td>
            </tr>
            <tr>
                <td class="ten"><label for="ccomment">Any special requests?</label></td>
                <td class="thirty"><textarea id="ccomment" name="comment" cols="32"></textarea></td>
                <td></td>
                <td> 
                    <div class="buttons">
                        <button type="submit" class="positive"><img src="<?php echo base_url(); ?>public/images/tick.png" alt="" /> Give me my Pizza!</button> 
                        
                    </div>
                </td>
            </tr>
        </table>
                
 </fieldset>
</form>
</body>
</html>