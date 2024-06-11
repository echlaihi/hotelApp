$(document).ready(function(){

	var toggler = $(".icon-toggler");
	var nav  = $("nav");
	
	toggler.on('click', function (){
		$(nav).toggleClass("active");
	});


	// Handling reservation Form
	var reserveBtn = $("#reserveBtn");
	var reservationForm = $("#reservation-form");
	// console.log(reservationForm);
	$(reservationForm).hide();
	// con/

	$(reserveBtn).on("click", function(){
		$(reservationForm).show();
		$(reserveBtn).hide();
	});

	// Handling reservation display in user dashboard

	var reservationBtn = $('.reservationBtn');

	Array.from(reservationBtn).forEach(btn => {
		$(btn).on("click", function (e) {
			var reservation = $(e.target).parent()[0];
			$(reservation).toggleClass("open");

			var classes = $(reservation).attr("class").split(" ");
			classes = Array.from(classes);

			if (classes.indexOf("open") >= 0) {

				$(e.target).html("voir moin");
			} else {
				$(e.target).html("voir plus");
			}

		})
	})
	

});