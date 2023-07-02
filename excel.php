<?php 
header("Content-Type: aplication/xls");
header("Content-Disposition: attachment; filename= reporte.xls");

?>
<?php 
include ("bd.php"); 
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT imagenLibro,pdfLibro FROM librospdf WHERE Id=:Id");
    $sentencia->bindParam(":Id",$txtID);
    $sentencia->execute();
    $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);
    
 
    if(isset($registro_recuperado["imagenLibro"])&& $registro_recuperado["imagenLibro"]!=""){
        if(file_exists("./".$registro_recuperado["imagenLibro"])){
            unlink("./".$registro_recuperado["imagenLibro"]);
        }
    }

    if(isset($registro_recuperado["pdfLibro"])&& $registro_recuperado["pdfLibro"]!=""){
        if(file_exists("./".$registro_recuperado["pdfLibro"])){
            unlink("./".$registro_recuperado["pdfLibro"]);
        }
    }
    
    $sentencia=$conexion->prepare("DELETE FROM librospdf WHERE  Id=:Id");
    $sentencia->bindParam(":Id",$txtID);
    $sentencia->execute();
    $mensaje="Registro eliminado";
    header("Location:indexRED.php?mensaje=".$mensaje);
    
}

$sentencia=$conexion->prepare("SELECT *, 
(SELECT nombreCategoria 
FROM categoriaspdf 
WHERE categoriaspdf.Id=librospdf.idCategoria limit 1) as nombreCategoria
FROM librospdf");

$sentencia->execute();
$librospdf=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>



<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<br/>

<div class="card">
    <div class="card-header">
        <h4>Gestion de Recursos Educativos Digitales </h4>
         
    </div>

    <div class="card-body">
       <div class="table-responsive-sm">
        <table class="table table" id="tabla_id">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Autor</th>
                    
                    <th scope="col">Categoria</th>
                    <th scope="col">Formato</th>
                    
                    
                </tr>
            </thead>
            <tbody>

            <?php foreach($librospdf as $registro){ ?>
                <tr class="">
                    <td><?php echo $registro['Id']; ?></td>
                    <td scope="row"><?php echo $registro['nombreLibro']; ?></td>
                    <td><?php echo $registro['autorLibro']; ?></td>
                    <td><?php echo $registro['nombreCategoria']; ?></td>
                    <td><?php echo $registro['nPaginas']; ?></td>
                    <td>
                    
                   
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
       </div>
       
    </div>
</div>
