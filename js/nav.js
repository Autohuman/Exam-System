$(document).ready(function(){
    $(".haoke").click(function(){
        let status = document.querySelector(".navigation_ul").style.display;
        if (status == "block") {
            document.querySelector(".navigation_ul").style.display = "none";
        } else {
            document.querySelector(".navigation_ul").style.display = "block";
        }
    });
});