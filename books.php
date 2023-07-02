<?php
include_once 'config/Database.php';
include_once 'class/User.php';
include_once 'class/Books.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if(!$user->loggedIn()) {
	header("Location: index.php");
}
$book = new Books($db);
include('inc/header4.php');
?>
<title>Catalogo De Libros | Easy Library Manager</title>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" />
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="css/dashboard.css" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
<script src="js/books.js"></script>
</head>
<body>
	
	<div class="container-fluid">
	<?php include('top_menus.php'); ?>
		<div class="row row-offcanvas row-offcanvas-left">
			<?php include('left_menus.php'); ?>
			<div class="col-md-9 col-lg-10 main"> 
			<h2>Administración de libros</h2> 
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-10">
						<h3 class="panel-title"></h3>
					</div>
					<div class="col-md-8" align="left">
						<a href="ReportesBD/exel_libros.php" class="btn btn-outline-success">Reporte Exel</a>
						<button type="button" id="addBook" class="btn btn-info" title="Add book"><span class="glyphicon glyphicon-plus">Agregar Libro</span></button>
					</div>
				</div>
			</div>
			<table id="bookListing" class="table-responsive-sm table-bordered">
				<thead>
					<tr>						
						<td></td>
						<th>Libro</th>
						<th>ISBN</th>
						<th>Autor</th>	
						<th>Editorial</th>	
						<th>Categoria</th>	
						<th>Sección</th>
						<th>No de copia</th>						
						<th>Estado</th>	
						<th>Fecha de carga</th>							
						<th></th>
						<th></th>					
					</tr>
				</thead>
			</table>				
			</div>
		</div>		
		<div id="bookModal" class="modal fade">
			<div class="modal-dialog">
				<form method="post" id="bookForm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"></button>
							<h4 class="modal-title"><i class="fa fa-plus"></i> Editar libro</h4>
						</div>
						<div class="modal-body">						
							
							<div class="form-group">							
								<label for="book" class="control-label">Libro</label>							
								<input type="text" name="name" id="name" autocomplete="off" class="form-control" placeholder="nombre"/>
												
							</div>
							
							<div class="form-group">							
								<label for="book" class="control-label">ISBN No</label>							
								<input type="text" name="isbn" id="isbn" autocomplete="off" class="form-control" placeholder="isbn"/>
												
							</div>
							
							<div class="form-group">							
								<label for="book" class="control-label">No de copias</label>			
								<input type="number" name="no_of_copy" id="no_of_copy" autocomplete="off" class="form-control" placeholder="Numero de copias"/>
							</div>
							
							<div class="form-group">							
								<label for="author"  class="control-label">Autor</label>
								<select name="author" id="author" class="form-control" size="1" >
									<option  value="">Seleccionar</option>
									<?php 
									$authorResult = $book->getAuthorList();
									while ($author = $authorResult->fetch_assoc()) { 	
									?>
									<option value="<?php echo $author['authorid']; ?>"><?php echo $author['name']; ?></option>			
									<?php } ?>	
																
								</select>
							</div>
							
							
							<div class="form-group">							
								<label for="publisher" class="control-label">Editorial</label>
								<select name="publisher" id="publisher" class="form-control" size="1">
									<option value="">Seleccionar</option>
									<?php 
									$publisherResult = $book->getPublisherList();
									while ($publisher = $publisherResult->fetch_assoc()) { 	
									?>
									<option value="<?php echo $publisher['publisherid']; ?>"><?php echo $publisher['name']; ?></option>			
									<?php } ?>									
								</select>
							</div>

							<div class="form-group">							
								<label for="category" class="control-label">Categoria</label>
								<select name="category" id="category" class="form-control" size="1">
									<option value="">Seleccionar</option>
									<?php 
									$categoryResult = $book->getCategoryList();
									while ($category = $categoryResult->fetch_assoc()) { 	
									?>
									<option value="<?php echo $category['categoryid']; ?>"><?php echo $category['name']; ?></option>			
									<?php } ?>									
								</select>
							</div>								
						
							<div class="form-group">							
								<label for="rack" class="control-label">Sección</label>
								<select name="rack" id="rack" class="form-control" size="1">
									<option value="">Seleccionar</option>
									<?php 
									$rackResult = $book->getRackList();
									while ($rack = $rackResult->fetch_assoc()) { 	
									?>
									<option value="<?php echo $rack['rackid']; ?>"><?php echo $rack['name']; ?></option>			
									<?php } ?>									
								</select>
							</div>	
							
							
							<div class="form-group">
								<label for="status" class="control-label">Estado</label>							
								<select class="form-control" size="1" id="status" name="status"/>
									<option value="">Seleccionar</option>							
									<option value="Enable">Disponible</option>
									<option value="Disable">No Disponible</option>								
								</select>							
							</div>				
							
											
						</div>
						<div class="modal-footer">
							<input type="hidden" name="bookid" id="bookid" />					
							<input type="hidden" name="action" id="action" value="" />
							<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</form>
			</div>
		</div>	
	</div>

</body>
</html>

