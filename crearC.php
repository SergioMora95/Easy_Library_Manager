<?php 
include ("bd.php"); 
if($_POST){
    print_r($_POST);
    // validacion de existencia de datos en metodo POST
    $nombreCategoria=(isset($_POST["nombreCategoria"])?$_POST["nombreCategoria"]:"");
    // Preparacion de sentencia para insertar datos
    $sentencia=$conexion->prepare("INSERT INTO categoriaspdf(Id,nombreCategoria)
                VALUES(null, :nombreCategoria)");
    //Asignar valores procedentes del metodo POST que vienen desde el formulario
    $sentencia->bindParam(":nombreCategoria",$nombreCategoria);
    $sentencia->execute();
    $mensaje="Registro agregado";
    header("Location:indexC.php?mensaje=".$mensaje);

}
/*$sentencia=$conexion->prepare("SELECT * FROM categoriaspdf");
$sentencia->execute();
$lista_categoriaspdf=$sentencia->fetchAll(PDO::FETCH_ASSOC); */

?>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" />
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="css/dashboard.css" />
<div class="container-fluid" id="main">
  <?php include('top_menus.php'); ?>	
    <div class="row row-offcanvas row-offcanvas-left">
      <?php include('left_menus.php'); ?>
      <div class="col-md-9 col-lg-10 main"> 

<?php include("templates/header.php"); ?>
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<br/>
<div class="card">
    <div class="card-header">
        <h4>Nueva Categoria</h4>
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="nombreCategoria" class="form-label">Agregar categoria</label>
          <input type="text"
            class="form-control" name="nombreCategoria" id="nombreCategoria" aria-describedby="helpId" placeholder="Nombre de Categoria" required>   
        </div>

<button type="submit" class="btn btn-info">Agregar</button>
<a name="" id="" class="btn btn-danger" href="indexC.php" role="button">Cancelar</a>


    </form>    


    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>


<? include("templates/footer.php"); ?>