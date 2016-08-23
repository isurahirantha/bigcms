$("#keyword").keyup(function(){
var string = $("#keyword").val();
$.ajax({
	type:"post",
	url:"search.php",
	data:"string="+string,
	success:function(callback){
		$("#search_reult").html(callback);
	}
});
});

$("#keyword").focus(function(){
	$("#search_reult").show();
});

