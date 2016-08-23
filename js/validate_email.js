function validate_email(email){
	$.post("js/validate_input.php",{email:email},function(data){
		$("#emailtxt").text(data);
	});
}
$("#email").focusin(function(){
	if($("#email").val()===""){
		$("#emailtxt").text("Go on, Write a valid email address");
	}else{
validate_email($("#email").val());
	}
}).blur(function(){
	$("#emailtxt").text("");
}).keyup(function(){
	validate_email($("#email").val());
});

$("#regbutton").click(function(){
	if( $("#name").val()===""){
    	$("#nametxt").text("Name Field shoud be filled ,thanks");
    	return false;
    	}	
    })
$("#regbutton").click(function(){
	if( $("#lname").val()===""){
    	$("#lnametxt").text("Last Name Field shoud be filled ,thanks");
    	return false;
    	}
});
$("#regbutton").click(function(){
	if( $("#goodat").val()===""){
    	$("#goodattxt").text("Tell people What do you specialized in..,thanks");
    	return false;
    	}
});
$("#regbutton").click(function(){
	if( $("#email").val()===""){
    	$("#emailtxt").text("Email Field shoud be filled..,thanks");
    	return false;
    	}
});
$("#regbutton").click(function(){
	if( $("#password").val()===""){
    	$("#passwordtxt").text("Password Field shoud be filled..,thanks");
    	return false;
    	}
});
$("#Retype_password").keyup(function(){
	var password = $("#password").val();
	var re_password= $("#Retype_password").val();
	if(password!==""){
	if(password!=re_password){
		$("#confirm_pass").text("Password not matched!");
		return false
	}else{
		if(password==re_password){
			$("#confirm_pass").text("Password matched!");
		}
	}
}
});
$(document).ready(function(){
	$("#agreed").change(function(){
	state = $(this).attr("value");
	if(state=="agree"){
		$("#regbutton").removeAttr("disabled");
	}else if(state == null){
		$("#regbutton").attr("disabled","disabled");
	}
	});
});


