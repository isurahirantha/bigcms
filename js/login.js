$("#button").click(function(){

var name =$("#username").val();
var age  =$("#age").val();

$.post('process.php',{name:name,age:age},function(callback){

$("#result").html(callback);

});

});