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
    <link href="<?= base_url(); ?>theme/gray/css/grayscale.css" rel="stylesheet">
  </head>
  <body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="<?= base_url(); ?>">{NAME}</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?= base_url(); ?>login">Sobre</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?= base_url(); ?>#programacao">Programação</a>
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
    <header class="masthead2">
      <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
          <h1 class="mx-auto my-0 text-uppercase">Em Breve</h1>
          <h2 class="text-white-50 mx-auto mt-2 mb-5">Acesso a parashiot onde estiver,no momento que desejar.</h2>
        </div>
      </div>
    </header>

    <!-- About Section -->

    <!-- Projects Section -->
    <section id="projects" class="projects-section bg-light">
      <div class="container">
        {conteudo}
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
