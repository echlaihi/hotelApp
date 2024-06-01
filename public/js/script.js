$(document).ready(function() {

    var main = $("main");
    var aside = $("aside");
    var toggler = $("#toggler");

    toggler.click(function() {

        $(aside).toggleClass("active");
        $(main).toggleClass("disactive");


    });


    // Handling adding image
    var btn = $("#addImage");
    var imageInput = $("input[type='file']:last");
    console.log(imageInput);
    $(btn).click(function(e) {
        e.preventDefault();
        console.log("btn clicked");
    });


});