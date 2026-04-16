$(document).ready(function(){
  $(window).on('scroll', function() {
    if($(window).scrollTop() > 100) {  
      $('header').addClass('scroll');
    } else {
      $('header').removeClass('scroll');
    }
  });
  $('.btn-menu').click(function(){
    $('.menu-mobile').toggleClass('visible');
  }); 
  $('.menu-mobile .cerrar').click(function(){
    $('.menu-mobile').toggleClass('visible');
  }); 
  $('.lupa').click(function(){
    $('.buscador').addClass('visible');
  });

  $('.scroll-up').click(function(){
    var targetOffset = $('body').offset().top;
    $('html,body').animate({scrollTop: targetOffset}, 1000);
  });
  $(document).on("click",function(e) {
    var container = $(".buscador");
    var container2 = $(".lupa");
    if (!container.is(e.target) && container.has(e.target).length === 0) { 
      if (!container2.is(e.target) && container2.has(e.target).length === 0) { 
        $('.buscador').removeClass('visible');
      }
    }
  });

  $('.menu-tabs.tabs a').click(function(e){
    e.preventDefault();
    var r = $(this).data('rel');
    $('.menu-tabs a').removeClass('activo');
    $(this).addClass('activo');
    $('.panel-item').removeClass('activo');
    $('.panel-item#panel-' + r).addClass('activo');
    $('.box-colaboracion').addClass('fadeIn');
  });

  $('.v-mas').click(function(e){
    e.preventDefault();
    $('.oculto').show();
    $(this).hide();
    $('.v-menos').show();
  });
  $('.v-menos').click(function(e){
    e.preventDefault();
    $('.oculto').hide();
    $(this).hide();
    $('.v-mas').show();
  });
  //$('.c-uso').slick();
});
