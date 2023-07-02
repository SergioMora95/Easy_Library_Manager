

<link rel="stylesheet" href="/css/bootstrap.min.css"/>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" />
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="css/dashboard.css" />
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<div class="container-fluid" id="main">
  <?php include('top_menus.php'); ?>	
    <div class="row row-offcanvas row-offcanvas-left">
      <?php include('left_menus.php'); ?>
      <div class="col-md-9 col-lg-10 main"> 
      <?php include("templates/header.php"); ?>
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">EASY LIBRARY MANAGER</h1>
          <h2>Bienvenido al modulo de gestion de Recursos Educativos Digitales</h2>
          <p class="col-md-8 fs-4">A continuacion usted podra administrar archivos en el sistema.</p>
          
          <a name="" id="" class="btn btn-info btn-lg" href="indexRED.php" role="button">Iniciar Gestion</a>
        </div>
      </div>
      

<?php include("templates/footer.php"); ?>