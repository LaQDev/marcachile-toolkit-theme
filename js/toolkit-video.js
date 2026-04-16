document.addEventListener('DOMContentLoaded', function () {
  // Obtener la cantidad de bloques con la clase "marca-chile-card-toolkit-video"
  var numBlocks = document.querySelectorAll('.marca-chile-card-toolkit-video').length;

  for (var i = 1; i <= numBlocks; i++) {
    var videoId = 'myVideo' + i;
    var videoIconId = 'videoIcon' + i;

    var video = document.getElementById(videoId);
    var videoIcon = document.getElementById(videoIconId);

    // Agregar evento al hacer hover sobre el video
    video.addEventListener('mouseenter', function () {
      var index = this.id.split('myVideo')[1];
      document.getElementById('videoIcon' + index).style.display = 'none';
      this.setAttribute('controls', 'controls');

      if (this.paused) {
        this.play();
      }
    });

    // Agregar evento al salir del hover sobre el video
    video.addEventListener('mouseleave', function () {
      var index = this.id.split('myVideo')[1];
      document.getElementById('videoIcon' + index).style.display = 'block';
      this.removeAttribute('controls');
      this.pause();
    });

    // Agregar evento al hacer clic en el icono
    videoIcon.addEventListener('click', function () {
      var index = this.id.split('videoIcon')[1];
      this.style.display = 'none';
      document.getElementById('myVideo' + index).setAttribute('controls', 'controls');

      if (document.getElementById('myVideo' + index).paused) {
        document.getElementById('myVideo' + index).play();
      } else {
        document.getElementById('myVideo' + index).pause();
      }
    });

    // Agregar evento al finalizar el video
    video.addEventListener('ended', function () {
      var index = this.id.split('myVideo')[1];
      document.getElementById('videoIcon' + index).style.display = 'block';
      this.removeAttribute('controls');
      this.pause();
    });
  }
});