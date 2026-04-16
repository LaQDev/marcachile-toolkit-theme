/* set max-height by code */
function resize() {
    if (window.innerWidth > 960) {
      var colHeight = document.getElementById("child_1").getBoundingClientRect().height;
      console.log("window width" + window.innerWidth +"px");
      document.getElementById("child_2").style.maxHeight = colHeight+"px";
    }
  }
  
  resize();
  window.onresize = resize;
  
  
  
  
  