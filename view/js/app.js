function toggleSubmenu(item) {
    var submenu = item.querySelector('.submenu');
    if (submenu.classList.contains('active')) {
        submenu.classList.remove('active');
    } else {
        submenu.classList.add('active');
    }
}

function toggleNav() {
    var sidenavWidth = document.getElementById("mySidenav").style.width;
    if (sidenavWidth > "0px") {
        closeNav();
    } else {
        openNav();
    }
}

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