<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{title}</title>
    <!-- Bootstrap core CSS -->
    <link href="<?= base_url(); ?>/theme/gray/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="<?= base_url(); ?>/theme/gray/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?= base_url(); ?>theme/gray/css/grayscale.min.css" rel="stylesheet">


    <style>

      progress{
        width: 100%;
        height: 5px;
      }
    </style>

  </head>

  <body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="<?= base_url(); ?>">PODCAST</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?= base_url(); ?>login">Sobre</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#programacao">Programação</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?= base_url(); ?>account/#projects">Assinar</a>
            </li>

            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?= base_url(); ?>podcast">Podcast</a>
            </li>

            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?= base_url(); ?>login/#projects">Logar</a>
            </li>

          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
          <h1 class="mx-auto my-0 text-uppercase" id="nome_musica"></h1>
          <progress id="barra_progresso" max="0" value="0"></progress>
          <p>
            <span id="tempo_atual">00:00:00</span> /
            <span id="tempo_total">00:00:00</span>
            <audio id="audio">
                Seu navegador não possui suporte ao elemento audio
            </audio>

          </p>
          <a href="#" id="play"  class="btn btn-primary js-scroll-trigger"> <i class="fa fa-play" aria-hidden="true"></i> </a>
          <a href="#" id="pause" class="btn btn-primary js-scroll-trigger"> <i class="fa fa-pause" aria-hidden="true"></i> </a>
          <a href="#" id="stop"  class="btn btn-primary js-scroll-trigger"> <i class="fa fa-stop" aria-hidden="true"></i> </a>
        </div>
      </div>
    </header>


    <!-- Contact Section -->

    <!-- Footer -->
    <footer class="bg-black small text-center text-white-50">
      <div class="container">
        Copyright &copy; Beit Miklat 2018
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="<?= base_url(); ?>/theme/gray/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/theme/gray/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?= base_url(); ?>/theme/gray/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?= base_url(); ?>/theme/gray/js/grayscale.min.js"></script>





    <script>

    $(document).ready(function(){

       var i = 0;

       var musicas = {musicas};

       audio = document.getElementById('audio');

       audio.addEventListener('canplay', play_evento , false);
       audio.addEventListener('timeupdate', atualizar , false);
       audio.addEventListener('ended', proxima , false);

       function play(){
           proxima();
       }

       function pause(){
           audio.pause();
       }

       function stop(){
           audio.pause();
           audio.currentTime = 0;
       }

       function play_evento(){
           document.getElementById('tempo_atual').innerHTML = secToStr( audio.currentTime) ;
           document.getElementById('tempo_total').innerHTML = secToStr( audio.duration );
           document.getElementById('barra_progresso').max = audio.duration;
           document.getElementById('barra_progresso').value = audio.currentTime;
       }

       function atualizar(){
           document.getElementById('tempo_atual').innerHTML = secToStr( audio.currentTime);
           document.getElementById('barra_progresso').value = audio.currentTime;
       }

       function proxima(){
           if(audio.canPlayType("audio/mp3") != ''){
               audio.src = musicas[i].mp3;
           }else{
               audio.src = musicas[i].ogg;
           }
           document.getElementById('nome_musica').innerHTML = musicas[i].titulo;
           audio.play();

           i++;
           if( i >= musicas.length ) i = 0;
       }

       function secToStr( sec_num ) {
           sec_num = Math.floor( sec_num );
           var horas   = Math.floor(sec_num / 3600);
           var minutos = Math.floor((sec_num - (horas * 3600)) / 60);
           var segundos = sec_num - (horas * 3600) - (minutos * 60);

           if (horas   < 10) {horas   = "0"+horas;}
           if (minutos < 10) {minutos = "0"+minutos;}
           if (segundos < 10) {segundos = "0"+segundos;}
           var tempo    = horas+':'+minutos+':'+segundos;
           return tempo;
       }


       $("#play").click(function(){
         play();
       });

       $("#pause").click(function(){
         pause();
       });

       $("#stop").click(function(){
         stop();
       });


       play();



    });

    </script>


  </body>

</html>
