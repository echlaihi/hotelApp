$(document).ready(function(){

	var toggler = $(".icon-toggler");
	var nav  = $("nav");
	
	toggler.click(function (){
		$(nav).toggleClass("active");
	});

});