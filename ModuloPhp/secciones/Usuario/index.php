<?php 
include ("../../bd.php"); 


$sentencia=$conexion->prepare("SELECT * FROM librospdf");
$sentencia->execute();
$librospdf=$sentencia->fetchAll(PDO::FETCH_ASSOC);


$sentencia=$conexion->prepare("SELECT *, 
(SELECT nombreCategoria 
FROM categoriaspdf 
WHERE categoriaspdf.Id=librospdf.idCategoria limit 1) as nombreCategoria
FROM librospdf");

$sentencia->execute();
$librospdf=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>


<?php include("../../templates/header.php"); ?>
<link rel="stylesheet" href="../../css/bootstrap.min.css"/>
<br/>

<div class="card">
    <div class="card-header">
        <h4>Recursos Educativos Digitales</h4>
        
    </div>

    <div class="card-body">
       <div class="table-responsive-sm">
        <table class="table table" id="tabla_id">
            <thead>
                <tr> 
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Archivo</th>
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
                    <td>
                    <img width="50"
                     src="../../archivos/<?php echo $registro['imagenLibro'];?>">
                        </td>                    
                    </td>
                    <td>
                        <a href="../../archivos/<?php echo $registro['pdfLibro'];?>"target="_blank">
                        <?php echo $registro['pdfLibro']; ?></td>
                        </a>
                    <td><?php echo $registro['nombreCategoria']; ?></td>
                    <td><?php echo $registro['nPaginas']; ?></td>
                    
                </tr>
                <?php }?>
            </tbody>
        </table>
       </div>
       
    </div>
</div>



<?php include("../../templates/footer.php"); ?>