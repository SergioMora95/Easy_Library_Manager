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
<title>Administración de Prestamos</title>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" />
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="css/dashboard.css" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
<script src="js/issue_books.js"></script>
</head>
<body>
	
	<div class="container-fluid">
	<?php include('top_menus.php'); ?>
		<div class="row row-offcanvas row-offcanvas-left">
			<?php include('left_menus.php'); ?>
			<div class="col-md-9 col-lg-10 main"> 
			<h2>Administracion de Prestamos</h2> 
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-10">
						<h3 class="panel-title"></h3>
					</div>
					<div class="col-md-8" align="left">
						<a href="ReportesBD/exel_prestamos.php" class="btn btn-outline-success">Reporte Exel</a>
						<button type="button" id="issueBook" class="btn btn-info" title="issue book"><span class="glyphicon glyphicon-plus">Prestar libro</span></button>
					</div>
				</div>
			</div>
			<table id="issuedBookListing" class="table-responsive-sm table-bordered">
				<thead>
					<tr>
						<th>Id</th>				
						<th>Libro</th>
						<th>ISBN</th>
						<th>Usuario</th>	
						<th>Fecha de Prestamo</th>	
						<th>Devolucion prevista</th>	
						<th>Fecha de Devolucion</th>											
						<th>Estado</th>													
						<th></th>
						<th></th>					
					</tr>
				</thead>
			</table>				
			</div>
		</div>		
		<div id="issuedBookModal" class="modal fade">
			<div class="modal-dialog">
				<form method="post" id="issuedBookForm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"></button>
							<h4 class="modal-title"><i class="fa fa-plus"></i>Modificar Prestamo</h4>
						</div>
						<div class="modal-body">								
							<div class="form-group">							
								<label for="rack" class="control-label">Libros disponibles</label>
								<select name="book" size="1" id="book" class="form-control">
									<option value="">Seleccionar</option>
									<?php 
									$bookResult = $book->getBookList();
									while ($book = $bookResult->fetch_assoc()) { 					
									?>
									<option value="<?php echo $book['bookid']; ?>"><?php echo $book['name']; ?></option>			
									<?php } ?>									
								</select>
							</div>	
							
							<div class="form-group">							
								<label for="rack" class="control-label">Usuario</label>
								<select name="users" size="1" id="users" class="form-control">
									<option value="">Seleccionar</option>
									<?php 
									$usersResult = $user->getUsersList();
									while ($user = $usersResult->fetch_assoc()) { 	
									?>
									<option value="<?php echo $user['id']; ?>"><?php echo ucfirst($user['first_name'])." ".ucfirst($user['last_name']); ?></option>			
									<?php } ?>									
								</select>
							</div>	
							
							
							<div class="form-group">							
								<label for="expected date" class="control-label">Devolucion prevista</label>
								<input type="datetime-local" step="1" name="expected_return_date" id="expected_return_date" autocomplete="off" class="form-control"/>								
							</div>
							
							
							<div class="form-group">							
								<label for="expected date" class="control-label">Fecha de Devolucion</label>
								<input type="datetime-local" step="1" name="return_date" id="return_date" autocomplete="off" class="form-control"/>								
							</div>
							
							
							<div class="form-group">
								<label for="status" class="control-label">Estado</label>			
								<select class="form-control" size="1" id="status" name="status"/>
									<option value="">Seleccionar</option>							
									<option value="Issued">Prestado</option>
									<option value="Returned">Devuelto</option>
									<option value="Not Return">No Devuelto</option>										
								</select>							
							</div>				
							
											
						</div>
						<div class="modal-footer">
							<input type="hidden" name="issuebookid" id="issuebookid" />					
							<input type="hidden" name="action" id="action" value="" />
							<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</form>
			</div>
		</div>	
	</div>

</body>
</html>

