function openNav() {
    if (x.matches) {
        document.getElementById("mySidenav").style.width = "100%";
    } else {
        document.getElementById("mySidenav").style.width = "250px";
    }
}

var x = window.matchMedia("(max-width: 700px)");

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
