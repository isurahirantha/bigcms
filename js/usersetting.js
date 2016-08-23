$(document).ready(function(){
	$("#pic_save").hide();

	$("#savefnme").hide();
	$("#fnme").css({"background-color":"#555","color":"white","border":"1px solid #626262"});//input

	$("#savelnme").hide();
	$("#lnme").css({"background-color":"#555","color":"white","border":"1px solid #626262"});//input

	$("#savehbd").hide();
	$("#hbd").css({"background-color":"#555","color":"white","border":"1px solid #626262"});//input

	$("#savewebsite").hide();
	$("#website").css({"background-color":"#555","color":"white","border":"1px solid #626262"});//input

	$("#saveuniversity").hide();
	$("#uni").css({"background-color":"#555","color":"white","border":"1px solid #626262"});//input

	$("#saveschool").hide();
	$("#sch").css({"background-color":"#555","color":"white","border":"1px solid #626262"});//input

	$("#savebelief").hide();
	$("#belief").css({"background-color":"#555","color":"white","border":"1px solid #626262"});//input

	$("#saveaboutme").hide();
	$("#aboutme").css({"background-color":"#555","color":"white","border":"1px solid #626262"});//input

	$("#belief").css({"height":"100px"});//input 
	$("#aboutme").css({"height":"100px"});//input
	$(".usersettingbutton").css({"background-color":"#555","border":"1px solid white","color":"#fff","border-radius":"5px"});//input
	$(".input").css({"color":"rgb(235, 250, 5)"});//input 
});

$("#picture").change(function(){
	$("#pic_save").show();
});

//firstname 
$("#fnme ,#savefnme").focus(function(){
	$("#savefnme").show();
	$("#fnme").css({"background-color":"#DFDFDF","color":"#525252","border":"0px"});//input
});
$("#fnme").blur(function(){
	
	$("#fnme").css({"background-color":"#555","color":"rgb(235, 250, 5)","border":"1px solid #626262"});//input
});
//lastname
$("#lnme ,#savelnme").focus(function(){
	$("#savelnme").show();
	$("#lnme").css({"background-color":"#DFDFDF","color":"#525252","border":"0px"});//input
});
$("#lnme").blur(function(){
	
	$("#lnme").css({"background-color":"#555","color":"rgb(235, 250, 5)","border":"1px solid #626262"});//input
});
//birthday
$("#hbd ,#savehbd").focus(function(){
	$("#savehbd").show();
	$("#hbd").css({"background-color":"#DFDFDF","color":"#525252","border":"0px"});//input
});
$("#hbd").blur(function(){
	
	$("#hbd").css({"background-color":"#555","color":"rgb(235, 250, 5)","border":"1px solid #626262"});//input
});

//website
$("#website ,#savewebsite").focus(function(){
	$("#savewebsite").show();
	$("#website").css({"background-color":"#DFDFDF","color":"#525252","border":"0px"});//input
});
$("#website").blur(function(){
	
	$("#website").css({"background-color":"#555","color":"rgb(235, 250, 5)","border":"1px solid #626262"});//input
});

//university
$("#uni ,#saveuniversity").focus(function(){
	$("#saveuniversity").show();
	$("#uni").css({"background-color":"#DFDFDF","color":"#525252","border":"0px"});//input
});
$("#uni").blur(function(){
	
	$("#uni").css({"background-color":"#555","color":"rgb(235, 250, 5)","border":"1px solid #626262"});//input
});

//school
$("#sch ,#saveschool").focus(function(){
	$("#saveschool").show();
	$("#sch").css({"background-color":"#DFDFDF","color":"#525252","border":"0px"});//input
});
$("#sch").blur(function(){
	
	$("#sch").css({"background-color":"#555","color":"rgb(235, 250, 5)","border":"1px solid #626262"});//input
});

//belief
$("#belief, #savebelief").focus(function(){
	$("#savebelief").show();
	$("#belief").css({"background-color":"#DFDFDF","color":"#525252","border":"0px"});//input
});
$("#belief").blur(function(){
	
	$("#belief").css({"background-color":"#555","color":"rgb(235, 250, 5)","border":"1px solid #626262"});//input
});

//about
$("#aboutme, #saveaboutme").focus(function(){
	$("#saveaboutme").show();
	$("#aboutme").css({"background-color":"#DFDFDF","color":"#525252","border":"0px"});//input
});
$("#aboutme").blur(function(){
	
	$("#aboutme").css({"background-color":"#555","color":"rgb(235, 250, 5)","border":"1px solid #626262"});//input
});
//
//User setting update
