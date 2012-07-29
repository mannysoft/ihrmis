var xmlHttp


function GetXmlHttpObject()
{
	var xmlHttp=null;
	
	try
 	{
 		// Firefox, Opera 8.0+, Safari
		 xmlHttp=new XMLHttpRequest();
 	}
	
	catch (e)
 	{
 		//Internet Explorer
 		try
  		{
  			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  		}
 		catch (e)
  		{
 			 xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  		}
 	}

	return xmlHttp;
}


function openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function formValidator()
{
	
	// Make quick references to our fields
	var employee_id		= document.getElementById('employee_id');
	var got_data		= document.getElementById('got_data');
	//alert(got_data);
	
	if (got_data != null)
	{
		return true;
	}
	
	
	// Check each input in the order that it appears in the form!
	if(isEmpty(employee_id, "Please enter Employee ID!"))
	{
	
		document.getElementById("view_dtr").value='View DTR'
		return false;
		//return true;
	}
	var no_record	= document.getElementById('no_record').value;

	if(no_record==0)
	{
		alert("Invalid Employee ID!");
		document.getElementById("view_dtr").value='View DTR'
		employee_id.focus();
		return false;	
	}
	
	var dtr_record	= document.getElementById('dtr_record').value;

	if(dtr_record==0)
	{
		alert("NO Record found!");
		//document.getElementById("view_dtr").value='View DTR'
		return false;	
	}
	
	
	return true;
}


function validate_ob_employee_id()
{
	// Make quick references to our fields
	var employee_id		= document.getElementById('employee_id');
	
	// Check each input in the order that it appears in the form!
	if(isEmpty(employee_id, "Please enter Employee ID!"))
	{
	
		return false;
		//return true;
	}
	var no_record	= document.getElementById('no_record').value;

	if(no_record==0)
	{
		alert("Invalid Employee ID!");
		employee_id.focus();
		return false;	
	}
	
	return true;
}


function isEmpty(elem, helperMsg)
{
	if(elem.value.length == 0)
	{ 
		alert(helperMsg);
		elem.focus(); // set the focus to this input
		return true;
	}
	return false;
	//return true;
}


//this function is for check all checkboxes

var formblock;
var forminputs;

function prepare() {
	formblock= document.getElementById('myform');
	forminputs = formblock.getElementsByTagName('input');
}

function select_all(name, value) 
{
	
	var checkall;
	checkall=document.getElementById('checkall').value;
	
	//if the checkox is checked(the top checkbox)
	if(checkall==1)
	{
		value=1;
		document.getElementById('checkall').value=0;
	}
	//if not
	else{
		value=0;
		document.getElementById('checkall').value=1;
	}
	
	for (i = 0; i < forminputs.length; i++) {
		// regex here to check name attribute
		var regex = new RegExp(name, "i");
		if (regex.test(forminputs[i].getAttribute('name'))) 
		{
			if (value == '1') {
				forminputs[i].checked = true;
			} else {
				forminputs[i].checked = false;
			}
		}
	}
}

if (window.addEventListener) 
{
	window.addEventListener("load", prepare, false);
	} else if (window.attachEvent) 
	{
		window.attachEvent("onload", prepare)
	} else if (document.getElementById) 
	{
		window.onload = prepare;
}



function confirm_msg(msg)
{
	var answer = confirm(msg)
	if (!answer)
	{
		return false;
	}

	document.myform.action = "w.php"
	document.myform.submit();
    //return true;
	
}



function checkform()
{
	var taken	= document.getElementById('taken').value;
	
	if(taken==0)
	{
		alert("The Employee no. is not available");
		document.getElementById('employee_id').focus()
		return false;	
	}
	
	// Make quick references to our fields
	var employee_id	= document.getElementById('employee_id');
	var last		= document.getElementById('last');
	var first		= document.getElementById('first');
	var middle		= document.getElementById('middle');
	var position	= document.getElementById('position');
	var password	= document.getElementById('password').value;
	var repassword	= document.getElementById('repassword').value;
	
	// Check each input in the order that it appears in the form!
	if(isEmpty(employee_id, "Please enter Employee ID!"))
	{
	
		return false;
	}
	
	if(isEmpty(last, "Please enter Last Name!"))
	{
	
		return false;
	}
	
	if(isEmpty(first, "Please enter First Name!"))
	{
	
		return false;
	}
	
	if(isEmpty(middle, "Please enter Middle Name!"))
	{
	
		return false;
	}
	
	if(isEmpty(position, "Please enter position!"))
	{
	
		return false;
		//return true;
	}
	
	
	return true;
	
}


function check_equal_password()
{
	
	var password2	= document.getElementById('password2').value;
	var hidden_pass	= document.getElementById('hidden_password').value;
	
	if(hidden_pass!=password2)
	{
		alert("Invalid password. Please type your current password correctly.")
		
		return false
		//document.getElementById('password2').focus();
	}
	
}

//function for add employee add-employee.php
function disable_add_employee(form)
{
	//alert("");
	var shift_new_check = form.shift_new_check.value;
	
	
	if(shift_new_check==1)
	{	
		form.hour.disabled = false
		form.minute.disabled = false
		form.am_pm.disabled = false
		form.hour2.disabled = false
		form.minute2.disabled = false
		form.am_pm2.disabled = false
		
		
		form.shift_check.disabled = false
		form.shift2.disabled = true
		form.shift_check.checked = false
		form.shift_new_check.checked = true
		form.shift_new_check.disabled = true

	}
	
	
}

//function for add employee add-employee.php
function enable_add_employee(form)
{
	var shift_check = form.shift_check.value;
	
	if(shift_check==1)
	{	
		form.hour.disabled = true
		form.minute.disabled = true
		form.am_pm.disabled = true
		form.hour2.disabled = true
		form.minute2.disabled = true
		form.am_pm2.disabled = true
		
		
		form.shift_check.disabled = true
		form.shift2.disabled = false
		form.shift_check.checked = true
		form.shift_new_check.checked = false
		form.shift_new_check.disabled = false
		
		document.getElementById("show_shift_time").innerHTML=""
	}

}

//this shows that text box for adding new office
function show_add_office(form)
{
	document.getElementById("add_office").innerHTML="Office Name: <input type='text' name='office_name' id='office_name' onkeyup='check_office_exist(this.form)' size='45' class=\"ilaw\" onfocus=\"this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';\" onblur=\"this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';\"><input type='submit' name='add_office' value='Add Office' class='button'><input type='button' value='Cancel' onclick='cancel()' class='button'>"
	document.getElementById("office_name").focus()
	document.getElementById('add_office_button').style.visibility='hidden';
	
}

//this shows that text box for editing office
function show_edit_office(form, office_name, office_id)
{
	document.getElementById("add_office").innerHTML="Office Name: <input type='text' value ='"+office_name+"' name='office_name' id='office_name' onkeyup='check_office_exist(this.form)' size='45' class=\"ilaw\" onfocus=\"this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';\" onblur=\"this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';\"><input type='submit' name='add_office' value='Save' class='button'><input type='button' value='Cancel' onclick='cancel()' class='button'><input name='edit_office' type='hidden' value='"+office_id+"' />"
	document.getElementById("office_name").focus()
	document.getElementById('add_office_button').style.visibility='hidden';
	
}

//hide the textbox for adding office
function cancel()
{
	document.getElementById("add_office").innerHTML=""
	document.getElementById('add_office_button').style.visibility='visible';
	document.getElementById("office_check").innerHTML=""
	
}

//check if the form will be submit if hidden field is not 0
function isSubmit(form)
{
	
	//var hidden_add_check = document.getElementById("hidden_add_check").value
	
	//if(hidden_add_check==0)
	//{
		//alert("This office already exists. Please enter another one.")
		//return false
	//}
	var office_name = document.getElementById("office_name").value
	
	if(office_name=="")
	{
		alert("Office Name cannot be blank!")
		document.getElementById("office_name").focus()
		return false
		
	}
}

//this for the menu on admin home page
function changeDivValue(message)
{
	document.getElementById("menu_div").innerHTML=message

}

function backDivValue()
{
	document.getElementById("menu_div").innerHTML=""

}

//this is for ob and leave page

function disable_ob_leave(form)
{
	//alert("");
	var half = form.half.value;
	
	if(half==1)
	{	
		//enable elements
		form.month3.disabled = false
		form.day3.disabled = false
		form.year3.disabled = false
		form.hour.disabled = false
		form.minute.disabled = false
		form.am_or_pm.disabled = false
		
		//disable the elements
		form.month.disabled = true
		form.day.disabled = true
		form.year.disabled = true
		form.month2.disabled = true
		form.day2.disabled = true
		form.year2.disabled = true
		
		form.whole.checked = false
		
		//disable the checkbox
		form.half.disabled = true
		
		//enable
		form.whole.disabled = false
		form.execute_half.value = 1
	}
	
}



function enable_ob_leave(form)
{
	//alert("");
	var whole = form.whole.value;
	
	
	if(whole==1)
	{	
		//enable elements
		form.month3.disabled = true
		form.day3.disabled = true
		form.year3.disabled = true
		form.hour.disabled = true
		form.minute.disabled = true
		form.am_or_pm.disabled = true
		
		//disable the elements
		form.month.disabled = false
		form.day.disabled = false
		form.year.disabled = false
		form.month2.disabled = false
		form.day2.disabled = false
		form.year2.disabled = false
		
		//disable the checkbox
		form.whole.disabled = true
		
		//enable
		form.half.checked = false
		form.half.disabled = false
		form.execute_half.value = 0
	}
	
	
}

//include-ob.php
function show_half_date(form)
{
	//document.getElementById("half_date").innerHTML="hello"
}

//show or hide the div box
function showMe (it, box) 
{ 
	 
	 document.getElementById("permanent_only").disabled = true;
	 
	 if(box.checked == true)
	 {
		document.getElementById("employee_id").value = "" 
		document.getElementById("permanent_only").disabled = false;
		document.getElementById("office_id").disabled = false;
	 }
	 
	 var vis = (box.checked) ? "block" : "none"; 
	 document.getElementById(it).style.display = vis;
	 
	 var dis = (box.checked) ? true : false; 
	 document.getElementById("employee_id").disabled = dis;
	 
	  var dis = (box.checked) ? false : true; 
	 document.getElementById("office_id").disabled = dis;
	 
	 document.getElementById("employee_id").focus()
	 
	 var dis = (box.checked) ? "check from list" : ""; 
	 document.getElementById("employee_id").value = dis;
	 
	 //List box
	 var disa = (box.checked) ? true : false; 
	// document.getElementById("permanent_only").disabled = disa;
	 
} 

//show or hide the div box
function showMe2 (it, box) 
{ 
	 
	 var vis = (box.checked) ? "block" : "none"; 
	 document.getElementById(it).style.display = vis;
	 
	 var dis = (box.checked) ? true : false; 
	 document.getElementById("employee_id").disabled = dis;
	 
	 document.getElementById("employee_id").focus()
	 
	 var dis = (box.checked) ? "check from list" : ""; 
	 document.getElementById("employee_id").value = dis;
	 
}

//show or hide the div box
function show_div (it, box) 
{ 
	 
	 var vis = (box.checked) ? "block" : "none"; 
	 document.getElementById(it).style.display = vis;
	 
}

//show or hide the div box
function show_hide_office (it, box) 
{ 
	 
	 
	 
	 var vis = (box.checked) ? "block" : "none"; 
	 document.getElementById(it).style.display = vis;
	 
	 
	 
} 


/**Confirm and delete an office
  *
  *
  *
  */
 
function delete_office(office_id, msg)
{
	var answer = confirm(msg)
	
	if (!answer)
	{
		return false;
	}
	
	window.location = "index.php?q=21&delete_id="+ office_id
}


function delete_employee(delete_id, msg, page, office_id)
{
	var answer = confirm(msg)
	
	if (!answer)
	{
		return false;
	}
	//alert("index.php?q=9&delete_id="+ delete_id +"&page="+page+"&office_id="+office_id)
	window.location = "index.php?q=9&delete_id="+ delete_id +"&page="+page+"&office_id="+office_id
}

function delete_user(delete_id, msg)
{
	var answer = confirm(msg)
	
	if (!answer)
	{
		return false;
	}
	
	window.location = "delete_user/"+ delete_id
}

//redirect to edit employee page
function go_to_url(url)
{	
	//alert(employee_id)
	//window.location = "index.php?q=25&edit_id="+ employee_id
	window.location = url
}
//check if employee we try is permanent (enable the start of service check box
function ispermanent(form)
{
	
	var permanent = document.getElementById("permanent").value
	//alert(permanent);
	
	if(permanent != 1 && permanent != 2)
	{
		document.getElementById("ifpermanent").value = "";
		document.getElementById("ifpermanent").disabled = true;
		document.getElementById('f_trigger_a').style.display = "none";
		document.getElementById("sg").disabled = true;
		document.getElementById("step").disabled = true;
		document.getElementById("dont_compute_leave").disabled = true;
		
	}
	
	else
	{
		document.getElementById("ifpermanent").disabled = false;
		document.getElementById('f_trigger_a').style.display = "block";
		document.getElementById("sg").disabled = false;
		document.getElementById("step").disabled = false;
		document.getElementById("ifpermanent").focus()
		document.getElementById("dont_compute_leave").disabled = false;
	}
}

function direct_print(employee_id)
{
	window.location = "print-leave.php?employee_id="+ employee_id
}


//this is for file upload with no reload
function upload(form)
{
	document.getElementById('iframefile').style.display = "block";
	document.getElementById('session_pic').style.display = "none";
	form.target = "iframefile";
	form.action = "upload.php";
	form.enctype = "multipart/form-data"
	form.submit();
	
	document.getElementById('uploadedfile').value = ""	
	//document.getElementById('pic').src = "../pics/not_available.jpg"
	//document.getElementById('msg_upload').innerHTML = "<img src='../pic/ "+image+">"
}

function include_add_employee_change_form(form)
{
	//alert("");
	form.target = "";
	form.action = "index.php?q=24";
	//form.enctype = "multipart/form-data"
	//form.submit();
	return true
}


//check if the time chosen in adding new employee was not on the listbox
function isother_shift()
{
	var other_shift = document.getElementById("shift2").value
	//alert(permanent);
	//alert("");
	if(other_shift == 0)
	{
		document.getElementById("hour1").disabled = false;
		document.getElementById("minute1").disabled = false;
		document.getElementById("am_pm1").disabled = false;
		document.getElementById("hour2").disabled = false;
		document.getElementById("minute2").disabled = false;
		document.getElementById("am_pm2").disabled = false;
		//document.getElementById('f_trigger_a').style.display = "none";
	}
	
	else
	{
		document.getElementById("hour1").disabled = true;
		document.getElementById("minute1").disabled = true;
		document.getElementById("am_pm1").disabled = true;
		document.getElementById("hour2").disabled = true;
		document.getElementById("minute2").disabled = true;
		document.getElementById("am_pm2").disabled = true;
		//document.getElementById("hour2").disabled = true;
		//document.getElementById("minute2").disabled = true;
		//document.getElementById("am_pm2").disabled = true;
		//document.getElementById('f_trigger_a').style.display = "block";
	}
}

function please_wait()

{
		document.getElementById("view_dtr").value='Please Wait....'
		
		document.all.pleasewaitScreen.style.pixelTop = (document.body.scrollTop + 50);

		document.all.pleasewaitScreen.style.visibility="visible";

		//window.setTimeout('do_totals2()',1);

}

//function change_button_value(it, box)
//{
	//var caption = (box.checked) ? "Download" : "Upload data to main server"; 
	//document.getElementById(it).value = caption;
//}

function change_value(new_value, name, div)
{
	//alert(new_value)
	document.getElementById("employee_id").value=new_value
	document.getElementById(div).innerHTML=name
}

function bash()
{
	alert("bash");	
}

function is_monetization(form)
{
	
	var leave_type_id = document.getElementById("type_leave").value
	//alert(permanent);
	
	if(leave_type_id != 9)
	{
		document.getElementById("days").value = "";
		document.getElementById("days").disabled = true;
	}
	
	else
	{
		document.getElementById("days").value = "";
		document.getElementById("days").disabled = false;
		document.getElementById("days").focus();
	}
}
function is_mc(form)
{
	
	var leave_type_id = document.getElementById("type_leave").value
	//alert(permanent);
	
	if(leave_type_id != 3)
	{
		//document.getElementById("special_priv_id").value = "";
		document.getElementById("special_priv_id").disabled = true;
	}
	
	else
	{
		//document.getElementById("special_priv_id").value = "";
		document.getElementById("special_priv_id").disabled = false;
		//document.getElementById("days").focus();
	}
}