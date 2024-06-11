$(document).ready(function() {

    var main = $("main");
    var aside = $("aside");
    var toggler = $("#toggler");

    toggler.click(function() {

        $(aside).toggleClass("active");
        $(main).toggleClass("disactive");


    });


    // handling the display of the contract area
    var contract_area = $(".contract_area");
    var show_btn = $(".marriageBtn");
    var mainContainer = $("main .container");
    

    Array.from(show_btn).forEach(function(btn) {
        $(btn).click(function(e) {

            // var src = "http://127.0.0.1:8000/storage/contracts/" + $(e.target).attr("data");
            $(contract_area).addClass("open");
            ;
            
            
        });
    });

    // closing the contract area
    var btn = $(".contract_area .btn");
    console.log(btn);
    $(btn).click(function(){
        $(contract_area).removeClass("open")
    });



})