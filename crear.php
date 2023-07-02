<?php 
include ("bd.php"); 
if($_POST){
   
  print_r($_POST);

  $nombreLibro=(isset($_POST["nombreLibro"])?$_POST["nombreLibro"]:"");
  $autorLibro=(isset($_POST["autorLibro"])?$_POST["autorLibro"]:"");
  $idCategoria=(isset($_POST["idCategoria"])?$_POST["idCategoria"]:"");
  $nPaginas=(isset($_POST["nPaginas"])?$_POST["nPaginas"]:"");

  
  $imagenLibro=(isset($_FILES["imagenLibro"]['name'])?$_FILES["imagenLibro"]['name']:"");
  $pdfLibro=(isset($_FILES["pdfLibro"]['name'])?$_FILES["pdfLibro"]['name']:"");

  $sentencia=$conexion->prepare("INSERT INTO librospdf(Id,nombreLibro,autorLibro,
  imagenLibro,pdfLibro,idCategoria,nPaginas)
   VALUES (null,:nombreLibro,:autorLibro,:imagenLibro,:pdfLibro,:idCategoria,:nPaginas);");

$sentencia->bindParam(":nombreLibro",$nombreLibro);
$sentencia->bindParam(":autorLibro",$autorLibro);

//En el adjunto de la imagen primero se optiene el tiemkpo para no reescribir otro archivo
//Se utiliza un archivo temporal, para moverlo a otro destino
//Al final se actualiza la base de  datos con el nuevo nombre
$fecha_=new DateTime();
$nombreArchivoImagen=($imagenLibro!='')?$fecha_->getTimestamp()."_".$_FILES["imagenLibro"]['name']:"";
$tmp_imagenLibro=$_FILES["imagenLibro"]['tmp_name'];
if($tmp_imagenLibro!=''){
  move_uploaded_file($tmp_imagenLibro,"archivos/".$nombreArchivoImagen);
}
$sentencia->bindParam(":imagenLibro",$nombreArchivoImagen);

$nombreArchivoPdf=($pdfLibro!='')?$fecha_->getTimestamp()."_".$_FILES["pdfLibro"]['name']:"";
$tmp_pdfLibro=$_FILES["pdfLibro"]['tmp_name'];
if($tmp_pdfLibro!=''){
  move_uploaded_file($tmp_pdfLibro,"archivos/".$nombreArchivoPdf);
}
$sentencia->bindParam(":pdfLibro",$nombreArchivoPdf);


$sentencia->bindParam(":idCategoria",$idCategoria);
$sentencia->bindParam(":nPaginas",$nPaginas);

$sentencia->execute();
$mensaje="Registro agregado";
header("Location:indexRED.php?mensaje=".$mensaje);



}

$sentencia=$conexion->prepare("SELECT * FROM categoriaspdf");
$sentencia->execute();
$lista_categoriaspdf=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("templates/header.php"); ?>

<link rel="stylesheet" href="../../css/bootstrap.min.css"/>
<br/>

<div class="card">
    <div class="card-header">
        Datos de Recurso
    </div>
    <div class="card-body">
    
    <form action="" method="post" enctype="multipart/form-data">
    
    <div class="mb-3">
      <label for="nombreLibro" class="form-label">Nombre</label>
      <input type="text"
        class="form-control" name="nombreLibro" id="nombreLibro" aria-describedby="helpId" placeholder="Nombre del recurso"required>
    </div>

    <div class="mb-3">
      <label for="autorLibro" class="form-label">Autor</label>
      <input type="text"
        class="form-control" name="autorLibro" id="autorLibro" aria-describedby="helpId" placeholder="Nombre del autor"required>
    </div>

    <div class="mb-3">
      <label for="imagenLibro" class="form-label">Imagen</label>
      <input type="file"
        class="form-control" name="imagenLibro" id="imagenLibro" aria-describedby="helpId" placeholder="Imagen "required>
    </div>

    <div class="mb-3">
      <label for="pdfLibro" class="form-label">Archivo</label>
      <input type="file"
        class="form-control" name="pdfLibro" id="pdfLibro" aria-describedby="helpId" placeholder="Archivo de Recurso" required>
    </div>

    <div class="mb-3">
      <label for="idCategoria" class="form-label">Categoria</label>
      
      <select class="form-select form-select-sm" name="idCategoria" id="idCategoria">
         <?php foreach($lista_categoriaspdf as $registro){ ?>
           <option value="<?php echo $registro['Id']?>">
           <?php echo $registro ['nombreCategoria'] ?>
           </option>
         <?php } ?>
      </select>

    </div>

    <div class="mb-3">
      <label for="nPaginas" class="form-label">Formato</label>
      <select class="form-select form-select-sm" name="nPaginas" id="nPaginas">
           <option>PDF</option> 
           <option>AUDIO</option>
           <option>VIDEO</option>
         
      </select>
    </div>

   
    <button type="submit" class="btn btn-info">Agregar registro</button>
    <a name="" id="" class="btn btn-danger" href="indexRED.php" role="button">Cancelar</a>
    

    </form>


    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>


<? include("templates/footer.php"); ?>