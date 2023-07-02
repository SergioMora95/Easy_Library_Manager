<?php 
include ("bd.php");

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("DELETE FROM categoriaspdf WHERE  Id=:Id");
    $sentencia->bindParam(":Id",$txtID);
    $sentencia->execute();
    $mensaje="Registro eliminado";
    header("Location:indexC.php?mensaje=".$mensaje);
}

$sentencia=$conexion->prepare("SELECT * FROM categoriaspdf");
$sentencia->execute();
$lista_categoriaspdf=$sentencia->fetchAll(PDO::FETCH_ASSOC);



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
<link rel="stylesheet" href="../../css/bootstrap.min.css"/>
<br/>


<div class="card">
    <div class="card-header">
    <h4>Categorias</h4>
    <a name="" id="" class="btn btn-info" href="crearC.php" role="button">Agregar registro</a>
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
    <table class="table" id="tabla_id">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre de Categoria</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($lista_categoriaspdf as $registro){ ?>
            <tr class="">
                <td scope="row"><?php echo $registro['Id']; ?></td>
                <td><?php echo $registro['nombreCategoria']; ?></td>
                <td>
                    

                    <a class="btn btn-warning" href="editarC.php?txtID=<?php echo $registro['Id']; ?>" role="button">Modificar</a>

                    <a class="btn btn-danger" href="javascript:borrar2 (<?php echo $registro['Id']; ?>);" role="button">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
           
        </tbody>
    </table>
</div>
    </div>
    
</div>








<?php include("templates/footer.php"); ?>