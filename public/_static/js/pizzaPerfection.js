var chosen = "";
var size = "";
var crust = "";
var subTotal = [0];
var len = 0;
var total = 0;
var totalWithTax = 0;
var price = 0;
	
function order() {
	// reset global variables to 0 each time an option is checked.
	chosen = "";
	size = "";
	crust = "";
	subTotal = [0];
	tops = 0;
	total = 0;
	totalWithTax = 0;
	price = 0;
	var picked = document.forms[0];
	var elem = picked.elements;
	// determine which specialty is chosen
	for (var i = 0; i < picked.specialty.length; i++){
		if (picked.specialty[i].checked) {
			chosen = picked.specialty[i].value;
		}
	}
	// determine which toppings
	for (var i = 12; i < 19; i++){
		if (elem[i].checked) {
			chosen += elem[i].value + ", ";
			tops += .85;
		}
	}
	for (var i = 0; i < picked.size.length; i++) {
		if (picked.size[i].checked) {
			size = picked.size[i].value;
		} else {
				if (picked.sizeB[i].checked) {
					size = picked.sizeB[i].value;
				}
		}
	}
	// adjust price for size of pie
	switch (size) {
		case "Large":
		price = 20.00;
		break;
		case "Medium":
		price = 17.5;
		break;
		case "Small":
		price = 14;
		break;
		default:
		price = 0;
		break;
	}

	// determine price for specialty.
	if(chosen == "Aloha")
		cost = Number(price) + 1;
	if(chosen == "Meat Lover")
		cost = price + 4;
	if(chosen == "BBQ Chicken")
		cost = price + 3;
	if(tops > 0) cost = Number(price) + Number(tops);
	// determine if it is gluten free and add $3.00 if it is
	if (picked.crust[1].checked == true || picked.crustB[1].checked) {
		crust = "gluten free";
		cost += 3;
	}
	else {
		crust = "regular";
	}
	// write the pizza order in the <div=order> on showHome.php
	subTotal = cost.toFixed(2);	
	document.getElementById("order").innerHTML = size + " " + chosen + " pizza on a " + crust + " crust:  $" + subTotal;	
	totalWithTax = Number(subTotal) * 1.095;
	document.getElementById("total").innerHTML = "Your total order with tax is: $" + totalWithTax.toFixed(2);	
}

	// install a set time of 1/2 hr after time of order.
function startTime() {
    var today=new Date();
    var h=today.getHours();
    var m=today.getMinutes();
	var am = "AM";
	m = m + 30;
	if (m > 60) {
		m = m - 60;
		h = h + 1;
	}
	if (h > 12) {
		h = h - 12;
		am = "PM";
	}
    m = checkTime(m);
    document.getElementById("clock").innerHTML = "You should receive your pizza around: " + h + ":" + m + " " + am;
}

function checkTime(i) {
    if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
