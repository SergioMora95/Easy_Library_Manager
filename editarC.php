<?php  
include ("bd.php");

if(isset($_GET['txtID'])){
  $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

  $sentencia=$conexion->prepare("SELECT * FROM categoriaspdf WHERE  Id=:Id");
  $sentencia->bindParam(":Id",$txtID);
  $sentencia->execute();
  $registro=$sentencia->fetch(PDO::FETCH_LAZY);
  $nombreCategoria=$registro["nombreCategoria"];
  
}

if($_POST){
  
  // validacion de existencia de datos en metodo POST
  $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
  $nombreCategoria=(isset($_POST["nombreCategoria"])?$_POST["nombreCategoria"]:"");
  // Preparacion de sentencia para actualizar datos
  $sentencia=$conexion->prepare("UPDATE categoriaspdf SET nombreCategoria=:nombreCategoria
  WHERE Id=:Id");
  //Asignar valores procedentes del metodo POST que vienen desde el formulario
  $sentencia->bindParam(":nombreCategoria",$nombreCategoria);
  $sentencia->bindParam(":Id",$txtID);
  $sentencia->execute();
  $mensaje="Registro modificado";
    header("Location:indexC.php?mensaje=".$mensaje);
}

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
        Categorias
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">
 <div class="mb-3">
  
 <label for="txtID" class="form-label">ID</label>
   <input type="text"
    value="<?php echo $txtID; ?>"
     class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
  
 </div>

        <div class="mb-3">
          <label for="nombreCategoria" class="form-label">Nombre de Categoria</label>
          <input type="text"
          value="<?php echo $nombreCategoria; ?>"
            class="form-control" name="nombreCategoria" id="nombreCategoria" aria-describedby="helpId" placeholder="Nombre de Categoria" required>   
        </div>

<button type="submit" class="btn btn-info">Editar</button>
<a name="" id="" class="btn btn-danger" href="indexC.php" role="button">Cancelar</a>


    </form>    


    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>

<? include("templates/footer.php"); ?>