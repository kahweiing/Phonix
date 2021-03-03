$(document).ready(function () //Make function after DOM initialize JavaScript
{

});
/* When the user scrolls down, hide the navbar. When the user scrolls up, show the navbar */
var prevScrollpos = window.pageYOffset;
window.onscroll = function () {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("navbar").style.top = "0";
    } else {
        document.getElementById("navbar").style.top = "-100px";
    }
    prevScrollpos = currentScrollPos;
}

$(".hBack").on("click", function (e) {
    e.preventDefault();
    window.history.back();
});


function valid() {
    if (document.chngpwd.opwd.value == "") {
        alert("Old Password Filed is Empty !!");
        document.chngpwd.opwd.focus();
        return false;
    } else if (document.chngpwd.npwd.value == "") {
        alert("New Password Filed is Empty !!");
        document.chngpwd.npwd.focus();
        return false;
    } else if (document.chngpwd.cpwd.value == "") {
        alert("Confirm Password Filed is Empty !!");
        document.chngpwd.cpwd.focus();
        return false;
    } else if (document.chngpwd.npwd.value != document.chngpwd.cpwd.value) {
        alert("Password and Confirm Password Field do not match  !!");
        document.chngpwd.cpwd.focus();
        return false;
    }
    return true;
}
