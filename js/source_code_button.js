$(document).ready(function(){
	$("#source_code").hide();
});
$("#source_code_button").click(function(){
	$("#source_code").slideUp(400);
	$("#msg_source_code").show();
$("#source_code_button").css({"color":"yellow"});
});
$("#msg_source_code").click(function(){
	$("#source_code").slideDown(400);
	$("#msg_source_code").hide();	
	$("#source_code_button").css({"color":"red"});
});

