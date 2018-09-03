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
              <a class="nav-link js-scroll-trigger" href="<?= base_url(); ?>account">Assinar</a>
            </li>

            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?= base_url(); ?>login">Logar</a>
            </li>

          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
          <h1 class="mx-auto my-0 text-uppercase">Em Breve</h1>
          <h2 class="text-white-50 mx-auto mt-2 mb-5">Por essa razão, desde o dia em que o ouvimos, não deixamos de orar por vocês e de pedir que sejam cheios do pleno conhecimento da vontade de Deus, com toda a sabedoria e entendimento espiritual." (Colossenses 1:9)</h2>
          <a href="<?= base_url(); ?>account" class="btn btn-primary js-scroll-trigger">Cadsatre-se</a>
        </div>
      </div>
    </header>

    <!-- Projects Section -->
    <section id="programacao" class="projects-section bg-light">
      <div class="container">

        <!-- Featured Project Row -->

        <div class="row align-items-center no-gutters mb-4 mb-lg-5">
          <div class="col-xl-8 col-lg-7">
            <img class="img-fluid mb-3 mb-lg-0" src="<?= base_url(); ?>/theme/gray/img/bg-masthead.jpg" alt="">
          </div>
          <div class="col-xl-4 col-lg-5">
            <div class="featured-text text-center text-lg-left">
              <h4>Parashat Ki Tavô</h4>
              <p class="text-black-50 mb-0">A Parashá inicia - se com a mitsvá de bicurim (primícias). Após Êrets Yisrael ter sido conquistada e dividida, o agricultor  levava  as  primeiras  frutas  maduras  para  o  Templo.  As  frutas  eram  entregues  ao cohen numa cerimônia que incluía uma declaração tocante de gratidão a Hashem pelo Seu papel eterno como o Mentor da nossa história. A oferenda das primícias ao
                  cohen simboliza que o judeu dedica tudo que possui ao serviço de Hashem.  Para  um  judeu  enunciar  que  toda  e  qualquer  realização  sua – não importa o quanto ele tenha se esforçado para tanto – é uma dádiva Divina, este é um dos objetivos da Criaçã
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Contact Section -->
    <section class="contact-section bg-black">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Endereço</h4>
                <hr class="my-4">
                <div class="small text-black-50">4923 Market Street, Orlando FL</div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-envelope text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Email</h4>
                <hr class="my-4">
                <div class="small text-black-50">
                  <a href="#">ibraim.caiofabio@gmail.com</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Telefone</h4>
                <hr class="my-4">
                <div class="small text-black-50">+55 (21) 99863-9055</div>
              </div>
            </div>
          </div>
        </div>

        <div class="social d-flex justify-content-center">
          <a href="#" class="mx-2">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="mx-2">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="mx-2">
            <i class="fab fa-github"></i>
          </a>
        </div>

      </div>
    </section>

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

  </body>

</html>
