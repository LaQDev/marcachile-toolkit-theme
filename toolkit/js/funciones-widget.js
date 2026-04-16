const cSlide = document.getElementsByClassName('c-home');
if(cSlide){
[].forEach.call(document.querySelectorAll('.c-home'), function (el) {
  var slider = tns({
    container: el,
    items: 1,
    controls: true,
    autoplay: true,
    autoplayTimeou: 7000,
    nav: true,
    navPosition: 'bottom',
    preventScrollOnTouch: "force"
    });
    slider.events.on('transitionEnd', function(){
    });
    slider.events.on('transitionEnd', function(){
    });
  });
}

const carrusel3 = document.getElementsByClassName('c-3');
if(carrusel3){
[].forEach.call(document.querySelectorAll('.c-3'), function (el) {
  var slider2 = tns({
      container: el,
      items: 3,
      controls: true,
      nav: true,
      navPosition: 'bottom',
      gutter: 60,
      preventScrollOnTouch: "force",
      responsive: {
          0: {
              items: 1
          },
          768: {
              items: 2
          },
          991: {
            items: 3
          }
      }
    });
  });
}

const carrusel1 = document.getElementsByClassName('c-1');
if(carrusel1){
[].forEach.call(document.querySelectorAll('.c-1'), function (el) {
  var slider = tns({
      container: el,
      items: 1,
      controls: true,
      nav: true,
      navPosition: 'bottom',
      gutter: 60,
      preventScrollOnTouch: "force",
      responsive: {
          0: {
              items: 1
          },
          768: {
              items: 1
          },
          991: {
            items: 1
          }
      }
    });
  });
}
const carrusel1b = document.getElementsByClassName('c-this');
if(carrusel1b){
[].forEach.call(document.querySelectorAll('.c-this'), function (el) {
  var slider = tns({
      container: el,
      items: 1,
      controls: true,
      nav: false,
      navPosition: 'bottom',
      gutter: 20,
      preventScrollOnTouch: "force",
      responsive: {
          0: {
              items: 1,
              gutter: 10
          },
          768: {
              items: 1
          },
          991: {
            items: 1
          }
      }
    });
  });
}

const carrusel2 = document.getElementsByClassName('c-2');
if(carrusel2){
[].forEach.call(document.querySelectorAll('.c-2'), function (el) {
  var slider = tns({
      container: el,
      items: 2,
      controls: true,
      nav: true,
      controlsPosition: 'top',
      navPosition: 'top',
      gutter: 65,
      preventScrollOnTouch: "force",
      responsive: {
          0: {
              items: 1,
              gutter: 20
          },
          550: {
              gutter: 20,
              items: 1
              
          },
          991: {
            items: 2
          }
      }
    });
  });
}

const cToolkit = document.getElementsByClassName('c-toolkit');
if(cToolkit){
[].forEach.call(document.querySelectorAll('.c-toolkit'), function (el) {
  var slider = tns({
    container: el,
    items: 1,
    controls: true,
    autoplay: true,
    autoplayTimeout: 4500,
    nav: true,
    navPosition: 'bottom',
    preventScrollOnTouch: "force"
    });
    slider.events.on('transitionEnd', function(){
    });
    slider.events.on('transitionEnd', function(){
    });
  });
}

$(document).ready(function(){
  $('.olvidaste').click(function(e){
    e.preventDefault();
    $('.recuperacion').addClass('visible');
  });
});

//Acordeon
const acc = document.getElementsByClassName('accordion');
if(acc){
  for (let i = 0; i < acc.length; i++) {
      let item = acc[i];
      var accordion = new Accordion({
          element: item,
          oneOpen: true
      });
  }
}
/*--LAZY--*/

/*--WOW--*/
    wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        mobile: false,
        callback: function(box) {
          if(box.classList.contains("cifras")){
            iniciarCount();
          }
        }
      }
    );
    wow.init();
/*--FIN WOW--*/

$(function(){
  
  $('.menu-lateral a[href*=\\#]').click(function() {

  if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
      && location.hostname == this.hostname) {

          var $target = $(this.hash);

          $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');

          if ($target.length) {

              var targetOffset = $target.offset().top;

              $('html,body').animate({scrollTop: targetOffset}, 1000);

              return false;

         }

    }

});

});

$(document).ready(function(){
  $('.menu-mobile .menu-body nav ul').on('click','li.menu-item-has-children.activo > a',function(e){
    e.preventDefault();
    $(this).parent().removeClass('activo');
  });
  $('.menu-mobile .menu-body nav ul ').on('click','li.menu-item-has-children:not(.activo) > a',function(e){
    e.preventDefault();
    $('.menu-mobile .menu-body nav ul > li.menu-item-has-children').removeClass('activo');
    $(this).parent().addClass('activo');
  });

});