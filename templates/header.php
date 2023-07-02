<?php
$url_base="http://localhost/ModuloPhp/";
?>
<!doctype html>
<html lang="es">

<head>
  <title>Recursos Educativos Digitales</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  

  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
   
    <script
  src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
  crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script> src="libs/button/cdn.datatables.net_1.13.4_js_jquery.dataTables.min.js"</script>
  <script>src="libs/button/cdn.datatables.net_buttons_2.3.6_js_buttons.html5.min.js"</script>
  <script>src="libs/button/cdn.datatables.net_buttons_2.3.6_js_dataTables.buttons.min.js"</script>
  <script>src="libs/button/cdnjs.cloudflare.com_ajax_libs_jszip_3.1.3_jszip.min"</script>
  <script>src="libs/button/cdnjs.cloudflare.com_ajax_libs_pdfmake_0.1.53_pdfmake.min.js"</script>
  <script>src="libs/button/cdnjs.cloudflare.com_ajax_libs_pdfmake_0.1.53_vfs_fonts.js"</script>
  <script>src="libs/button/code.jquery.com_jquery-3.5.1.js"</script>

  

</head>

<body>
  <header>
    
  </header>

    <nav class="navbar navbar-expand navbar-light bg-light">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="indexM.php" aria-current="page">Recursos Educativos Digitales<span class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="dashboard.php">Regresar al Dashboard</a>
            </li>
            
        </ul>
    </nav>


  <main class="container">
  <?php if(isset($_GET['mensaje'])) {?>
<script>
    Swal.fire({icon:"succes", title:"<?php echo $_GET['mensaje']; ?>"});
</script>
<?php } ?>
<link rel="stylesheet" href="./css/bootstrap.min.css"/>

