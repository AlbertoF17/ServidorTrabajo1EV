function toggleNav() {
    var sidenavWidth = document.getElementById("mySidenav").style.width;
    if (sidenavWidth > "0px") {
        closeNav();
    } else {
        openNav();
    }
}

let hamburger = document.getElementById("hamburger");

hamburger.addEventListener("click", function(){
    toggleNav();
})

function openNav() {
    document.getElementById("mySidenav").style.width = "20vw";
    document.getElementById("mySidenav").style.paddingRight = "2rem";
    document.getElementById("main").style.marginLeft = "20vw";
    document.getElementById("hamburger").innerHTML = "&#10006;";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    document.getElementById("mySidenav").style.paddingRight = "0";
    document.getElementById("hamburger").innerHTML = "&#9776;";
}