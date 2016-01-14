
function pizzaOrderSubmit(document){
	var name=orderForm.name_text.value;
	var address=orderForm.address_text.value;
	var city=orderForm.city_text.value;
	var phone_num=orderForm.phone_text.value;
	var size;
	var toppings="";
	var order="";

	for(i=0;i<=3;i++){
		if(orderForm.size_select[i].checked==true){
			size=orderForm.size_select[i].value;
		}
	}

	if(orderForm.chk_pepperoni.checked==true){
		toppings+=orderForm.chk_pepperoni.value;
		toppings+=", ";
	}
	if(orderForm.chk_sausage.checked==true){
		toppings+=orderForm.chk_sausage.value;
		toppings+=", ";
	}
	if(orderForm.chk_green_peps.checked==true){
		toppings+=orderForm.chk_green_peps.value;
		toppings+=", ";
	}
	if(orderForm.chk_onions.checked==true){
		toppings+=orderForm.chk_onions.value;
		toppings+=", ";
	}
	if(orderForm.chk_mushrooms.checked==true){
		toppings+=orderForm.chk_mushrooms.value;
		toppings+=", ";
	}
	if(orderForm.chk_hot_peps.checked==true){
		toppings+=orderForm.chk_hot_peps.value;
	}

	order+="Name: " + name;
	order+="\n";
	order+="Address: " + address;
	order+="\n";
	order+="City: " + city;
	order+="\n";
	order+="Phone Number: " + phone_num;
	order+="\n";
	order+="Size: " + size;
	order+="\n";
	order+="Toppings: " + toppings;

	orderConfirm.order_text.value=order;

}

function goHome(){
	window.location.href="http://sabre.southhills.edu/~ntorretti";
}

function addNums(form2){
	var num1=eval(form2.txtFirstNum.value);
	var num2=eval(form2.txtSecNum.value);
	alert(num1+num2);
}


function makeML(myForm){
	
	//create variables
	var sound;
	var person;
	var part;
	var descrip;
	var vehicle;
	var animal;
	var story="";

	//get text box variables
	person=myForm.txtPerson.value;
	vehicle=myForm.txtVehicle.value;
	animal=myForm.txtAnimal.value;

	//get description
	descrip="";

	if(myForm.chkEvil.checked==true){
		descrip+=myForm.chkEvil.value;
		descrip+=", ";
	} //end if

	if(myForm.chkGoofy.checked==true){
		descrip+=myForm.chkGoofy.value;
		descrip+=", ";
	} //end if

	if(myForm.chkDysfunc.checked==true){
		descrip+=myForm.chkDysfunc.value;
		descrip+=", ";
	} //end if

	if(myForm.chkWacky.checked==true){
		descrip+=myForm.chkWacky.value;
		descrip+=", ";
	}//end if

	//story +="descrip: \t" + descrip + "\n";

	//get sound
	for(i=0;i<=3;i++){
		if(myForm.optSound[i].checked==true){
			sound=myForm.optSound[i].value;
		} //end if
	} //end for loop

	//story += "sound: \t" + sound + "\n";

	//get body part

	var theSelect=myForm.selBody;

	var theOption=theSelect[theSelect.selectedIndex];

	part=theOption.value;

	//story += "part: \t" + part + "\n";

	story="One day, a person named " + person + " was walking down";
	story+=" the street. Suddenly, " + person + " heard an awful, ";
	story+=descrip + "mysterious " + sound + " sound. " + person;
	story+=" looked around and saw that the " + sound + " sound was";
	story+=" coming from a " + vehicle + " careening madly down the";
	story+=" street. " + person + "'s fear turned to terror as ";
	story+=person + " realized that the " + vehicle + " was driven by";
	story+=" none other than the evil Super-" + animal + ". Once an";
	story+=" ordinary " + animal + ", it had befallen a strange";
	story+=" transformation after being dropped in a vat of nuclear";
	story+=" waste. Super-" + animal + " continued to taunt " + person;
	story+=" with the horrible " + sound + " noise, but " + person;
	story+=" was unconcerned. \"You can't bother me, Super-" + animal;
	story+="! I know how to turn the other " + part + "!\" \nThe End."

	myForm.txtStory.value=story;
	//return story;
} //end makeML

function vehicleOrder(document){
var name=vehicle_form.name_txt.value;
	var street=vehicle_form.street_txt.value;
	var city=vehicle_form.city_txt.value;
	var state=vehicle_form.state_txt.value;
	var zip=vehicle_form.zip_txt.value;
	var price=0;
	var make=vehicle_form.make_select.value;
	var model;
	var upgrades="";
	var order="";

	

	for(i=0;i<=3; ++i){
		if(vehicle_form.model_sel[i].checked==true){
			model=vehicle_form.model_sel[i].value;
		}
	}
	
		
	
	if(model=="Coupe"){
		price=eval(15000);
	}
	if(model=="Sedan"){
		price=eval(18000);
	}
	if(model=="Convertable"){
		price=eval(20000);
	}
	if(model=="SUV"){
		price=eval(25000);
	}

	if(vehicle_form.ac_chk.checked==true){
		upgrades+=vehicle_form.ac_chk.value;
		upgrades+=", ";
		price+=1000;
	}
	if(vehicle_form.man_tran_chk.checked==true){
		upgrades+=vehicle_form.man_tran_chk.value;
		upgrades+=", ";
		price-=2000;
	}
	if(vehicle_form.sound_sys_chk.checked==true){
		upgrades+=vehicle_form.sound_sys_chk.value;
		upgrades+=", ";
		price+=5000;
	}
	if(vehicle_form.rally_chk.checked==true){
		upgrades+=vehicle_form.rally_chk.value;
		upgrades+=", ";
		price+=7000;
	}
	if(vehicle_form.highpf_tires_chk.checked==true){
		upgrades+=vehicle_form.highpf_tires_chk.value;
		upgrades+=", ";
		price+=3000;
	}
	if(vehicle_form.extnd_war_chk.checked==true){
		upgrades+=vehicle_form.extnd_war_chk.value;
		price+=10000;
		
	}
	order="Name: " + name;
	order+="\n";
	order+="Address: ";
	order+="\n";
	order+=street;
	order+="\n";
	order+=city;
	order+=", ";
	order+=state + " " +zip;
	order+="\n";
	order+="Make: " + make;
	order+="\n";
	order+="Model: " + model;
	order+="\n";
	order+="Special Upgrades: " + upgrades;
	order+="\n";
	order+="Price: $" + price;


	vehicle_form.conf_order.value=order;
}
