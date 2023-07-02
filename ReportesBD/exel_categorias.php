<?php
// Paso 1: Conexión a la base de datos MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library-system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM category";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //Generar el archivo Excel

    $filename = tempnam(sys_get_temp_dir(), 'reporte_');
    $file = fopen($filename, 'w');

    // Cabecera del reporte
    $header = "ID\tNombre\tEstado\n";
    fwrite($file, $header);

    // Llenar el reporte con los datos de la tabla 'book'
    while ($row_data = $result->fetch_assoc()) {
        $row = $row_data['categoryid'] . "\t" . $row_data['name'] ."\t" .$row_data['status'] . "\t" . "\n";
        fwrite($file, $row);
    }

    fclose($file);

    // Paso 4: Descargar el archivo Excel
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="reporte_categorias.xls"');
    header('Cache-Control: max-age=0');

    readfile($filename);

    // Eliminar el archivo temporal
    unlink($filename);

    exit;
} else {
    echo "No hay datos en la tabla 'book'";
}

$conn->close();
?>
