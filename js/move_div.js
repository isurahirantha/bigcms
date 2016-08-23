$(document).ready(function(){
	function move_div(){
	window_width = $(window).width();
	window_height = $(window).height();

	object_width =$("#search_reult").width();
	object_height =$("#search_reult").height();

	$("#search_reult").css('top',(window_height/2)-(object_height/2)).css('left',(window_width/2)-(object_width/2));
	}
	move_div();

	$(window).resize(function(){
		move_div();
	});
});