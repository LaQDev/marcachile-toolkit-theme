/* Header home */
let headerHome = document.getElementById("headerHome");
let headerHomeNav = document.querySelector(".marca-chile-header__home .navbar");

let headerMobile = document.getElementById("headerMobile");
let headerMobileNav = document.querySelector('.marca-chile-header__mobile .navbar');

let sideMenu = document.getElementById("offcanvasNavbar");

window.onscroll = function () {
  headerFunction()
};

function headerFunction() {

  //home scroll
  if (document.body.scrollTop > 250 || document.documentElement.scrollTop > 250) {
    headerHome.classList.add('marca-chile-header__scroll');
    headerHomeNav.classList.add('fixed-top');

    headerMobile.classList.add('marca-chile-header__scroll');
    headerMobileNav.classList.add('fixed-top');
  }

  else {
    headerHome.classList.remove('marca-chile-header__scroll');
    headerHomeNav.classList.remove('fixed-top');

    headerMobile.classList.remove('marca-chile-header__scroll');
    headerMobileNav.classList.remove('fixed-top');
  }

  //home scroll fixed
  if (document.body.scrollTop > 350 || document.documentElement.scrollTop > 350) {
    headerHome.classList.add('fixed--show');

    headerMobile.classList.add('fixed--show');
  }

  else {
    headerHome.classList.remove('fixed--show');

    headerMobile.classList.remove('fixed--show');
  }

  //offcanvas
  /*
  if(sideMenu.classList.contains('show')) {
    headerHome.classList.add('fixed--show');
  }

  else {
    headerHome.classList.remove('fixed--show');
  }
  */

}