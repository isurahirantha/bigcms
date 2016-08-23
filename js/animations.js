
	$(document).ready(function(){
		$("#anim").css({"background-color":"rgb(146, 108, 243)","width":"840px","border-radius":"5px","margin-left":"0px","padding":"10px 10px 10px 10px"});
		if($("#anim").animate({letterSpacing:"+=20px",lineHeight:"=2em"})){
		$("#anim").animate({letterSpacing:"-=10px",lineHeight:"=2em"})
		}

	});