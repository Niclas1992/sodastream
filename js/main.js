
//MENU   

function burgerAnimation() {
    var burger = $('.toggle-menu');
    burger.toggleClass('active');
}

function toggleMenu() {
    var menu = $('#menu-box-mobile');
    var classExpanded = "is-expanded";

    if (menu.hasClass(classExpanded)) {
        menu.removeClass(classExpanded);             
    } else {
        menu.addClass(classExpanded);
    }
}


function menuOffcanvas() {
    var menu = $('#menu-box-mobile');
    var windowHeight = window.outerHeight;
    var classFromRight = "is-from-right";
    var documentHeight = document.body.scrollHeight;
    var currPosition = window.pageYOffset;

  menu.removeClass("is-from-right");
  
    if (window.pageYOffset <= (windowHeight * 0.85)) {
        menu.addClass(classFromRight);
    } 
}

window.addEventListener("scroll", menuOffcanvas);
document.getElementById("toggle-menu").addEventListener("click", toggleMenu);
