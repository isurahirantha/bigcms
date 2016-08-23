//open_images
$(document).ready(function(){
$("#images").click(function(){
$("#up_image").slideDown(100);
});
});
//close
$(document).ready(function(){
$(".wbutton").click(function(){
$("#up_image").fadeOut(200);
});
});

//open_characters
$(document).ready(function(){
$("#math").click(function(){
$("#chars").slideDown(100);
});
});
//close
$(document).ready(function(){
$(".wbutton").click(function(){
$("#chars").fadeOut(200);
});
});
//close error message
$(document).ready(function(){
$("#errcls").click(function(){
$(".errmsg").slideUp(200);
});
});
//add list
$(document).ready(function(){
$("#lists").click(function(){
 var textarea_val = $("textarea").val();
 var add_val ="<li>replace this</li>";
 jQuery.trim(add_val);
 $("textarea").focus().val(textarea_val+''+add_val+'');
});
});
//bold text
$(document).ready(function(){
$("#bold").click(function(){
 var textarea_val = $("textarea").val();
 var add_val ="<b>replace text</b>";
 jQuery.trim(add_val);
 $("textarea").focus().val(textarea_val+''+add_val+'');
});
});
//underline text
$(document).ready(function(){
$("#underline").click(function(){
 var textarea_val = $("textarea").val();
 var add_val ="<u>replace text</u>";
 jQuery.trim(add_val);
 $("textarea").focus().val(textarea_val+''+add_val+'');
});
});
//italic text
$(document).ready(function(){
$("#italic").click(function(){
 var textarea_val = $("textarea").val();
 var add_val ="<i>replace text</i>";
 jQuery.trim(add_val);
 $("textarea").focus().val(textarea_val+''+add_val+'');
});
});
//italic text
$(document).ready(function(){
$("#quote").click(function(){
 var textarea_val = $("textarea").val();
 var add_val ="<blockquote>replace text</blockquote>";
 jQuery.trim(add_val);
 $("textarea").focus().val(textarea_val+''+add_val+'');
});
});
//Entity
$(document).ready(function(){
$("#entity").click(function(){
 var textarea_val = $("textarea").val();
 var add_val ="♀ WRITE DOWN YOUR CODES INSIDE THIS MALE FEMALE SYMBOLS  ♂";
 jQuery.trim(add_val);
 $("textarea").focus().val(textarea_val+''+add_val+'');
});
});

//<p style="color:sienna;"></p>
