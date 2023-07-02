<?php 
include ("bd.php"); 

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM librospdf WHERE Id=:Id");
    $sentencia->bindParam(":Id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $nombreLibro=$registro["nombreLibro"];
    $autorLibro=$registro["autorLibro"];

    $imagenLibro=$registro["imagenLibro"];
    $pdfLibro=$registro["pdfLibro"];

    $idCategoria=$registro["idCategoria"];
    $nPaginas=$registro["nPaginas"];

    $sentencia=$conexion->prepare("SELECT * FROM categoriaspdf");
    $sentencia->execute();
    $lista_categoriaspdf=$sentencia->fetchAll(PDO::FETCH_ASSOC);

   /* $sentencia->bindParam(":nombreLibro",$nombreLibro);
    $sentencia->bindParam(":autorLibro",$autorLibro);
    $sentencia->bindParam(":imagenLibro",$nombreArchivoImagen);
    $sentencia->bindParam(":pdfLibro",$nombreArchivoPdf);
    $sentencia->bindParam(":idCategoria",$idCategoria);
    $sentencia->bindParam(":nPaginas",$nPaginas); */
    
}
if($_POST){
   
    print_r($_POST);
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $nombreLibro=(isset($_POST["nombreLibro"])?$_POST["nombreLibro"]:"");
    $autorLibro=(isset($_POST["autorLibro"])?$_POST["autorLibro"]:"");
    $idCategoria=(isset($_POST["idCategoria"])?$_POST["idCategoria"]:"");
    $nPaginas=(isset($_POST["nPaginas"])?$_POST["nPaginas"]:"");

  
    $sentencia=$conexion->prepare("UPDATE librospdf SET 
    nombreLibro=:nombreLibro,
    autorLibro=:autorLibro,
    idCategoria=:idCategoria,
    nPaginas=:nPaginas WHERE Id=:Id");
     
  
  $sentencia->bindParam(":nombreLibro",$nombreLibro);
  $sentencia->bindParam(":autorLibro",$autorLibro);
  $sentencia->bindParam(":idCategoria",$idCategoria);
  $sentencia->bindParam(":nPaginas",$nPaginas);
  $sentencia->bindParam(":Id",$txtID);
  $sentencia->execute();

  $imagenLibro=(isset($_FILES["imagenLibro"]['name'])?$_FILES["imagenLibro"]['name']:"");
  $fecha_=new DateTime();
  $nombreArchivoImagen=($imagenLibro!='')?$fecha_->getTimestamp()."_".$_FILES["imagenLibro"]['name']:"";
  $tmp_imagenLibro=$_FILES["imagenLibro"]['tmp_name'];
  
  if($tmp_imagenLibro!=''){
  move_uploaded_file($tmp_imagenLibro,"archivos/".$nombreArchivoImagen);

    $sentencia=$conexion->prepare("SELECT imagenLibro FROM librospdf WHERE Id=:Id");
    $sentencia->bindParam(":Id",$txtID);
    $sentencia->execute();
    $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);
    
 
    if(isset($registro_recuperado["imagenLibro"])&& $registro_recuperado["imagenLibro"]!=""){
        if(file_exists("archivos/".$registro_recuperado["imagenLibro"])){
            unlink("archivos/".$registro_recuperado["imagenLibro"]);
        }
    }

  $sentencia=$conexion->prepare("UPDATE librospdf SET imagenLibro=:imagenLibro WHERE Id=:Id");
  $sentencia->bindParam(":imagenLibro",$nombreArchivoImagen);
  $sentencia->bindParam(":Id",$txtID);
  $sentencia->execute();
  }
  

  $pdfLibro=(isset($_FILES["pdfLibro"]['name'])?$_FILES["pdfLibro"]['name']:"");

  $nombreArchivoPdf=($pdfLibro!='')?$fecha_->getTimestamp()."_".$_FILES["pdfLibro"]['name']:"";
  $tmp_pdfLibro=$_FILES["pdfLibro"]['tmp_name'];
  if($tmp_pdfLibro!=''){
    move_uploaded_file($tmp_pdfLibro,"archivos/".$nombreArchivoPdf);

    $sentencia=$conexion->prepare("SELECT pdfLibro FROM librospdf WHERE Id=:Id");
    $sentencia->bindParam(":Id",$txtID);
    $sentencia->execute();
    $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_recuperado["pdfLibro"])&& $registro_recuperado["pdfLibro"]!=""){
        if(file_exists("archivos/".$registro_recuperado["pdfLibro"])){
            unlink("archivos/".$registro_recuperado["pdfLibro"]);
        }
    }

    $sentencia=$conexion->prepare("UPDATE librospdf SET pdfLibro=:pdfLibro WHERE Id=:Id");
    $sentencia->bindParam(":pdfLibro",$nombreArchivoPdf);
    $sentencia->bindParam(":Id",$txtID);
    $sentencia->execute();
}


$mensaje="Registro modificado";
header("Location:indexRED.php?mensaje=".$mensaje);
  
  
  
  }
?>

<?php include("templates/header.php"); ?>
<link rel="stylesheet" href="../../css/bootstrap.min.css"/>
<div class="card">
    <div class="card-header">
        Datos de Recurso
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
      <label for="nombreLibro" class="form-label">Nombre</label>
      <input type="text"
      value="<?php echo $nombreLibro; ?>"
        class="form-control" name="nombreLibro" id="nombreLibro" aria-describedby="helpId" placeholder="Nombre del recurso">
    </div>

    <div class="mb-3">
      <label for="autorLibro" class="form-label">Autor</label>
      <input type="text"
      value="<?php echo $autorLibro; ?>"
        class="form-control" name="autorLibro" id="autorLibro" aria-describedby="helpId" placeholder="Nombre del autor">
    </div>

    <div class="mb-3">
      <label for="imagenLibro" class="form-label">Imagen</label>
      <br/>
      <img width="100"
       src="archivos/<?php echo $imagenLibro; ?>" 
       class="rounded" alt="">
       <br/>
       <br/>
      <input type="file"
    
        class="form-control" name="imagenLibro" id="imagenLibro" aria-describedby="helpId" placeholder="Imagen">
    </div>

    <div class="mb-3">
      <label for="pdfLibro" class="form-label">Archivo </label>
      <br/>
      <a href="<?php echo $pdfLibro; ?>"><?php echo $pdfLibro; ?></a>
      <input type="file"
      value="<?php echo $txtID; ?>"
        class="form-control" name="pdfLibro" id="pdfLibro" aria-describedby="helpId" placeholder="Archivo de Recurso">
    </div>

    <div class="mb-3">
      <label for="idCategoria" class="form-label">Categoria</label>
      
      <select class="form-select form-select-sm" name="idCategoria" id="idCategoria">
         <?php foreach($lista_categoriaspdf as $registro){ ?>
           <option <?php echo ($idCategoria==$registro['Id'])?"selected":""; ?> value="<?php echo $registro['Id']?>">
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

   
    <button type="submit" class="btn btn-info">Actualizar registro</button>
    <a name="" id="" class="btn btn-danger" href="indexRED.php" role="button">Cancelar</a>
    

    </form>


    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>



<?php include("templates/footer.php"); ?>