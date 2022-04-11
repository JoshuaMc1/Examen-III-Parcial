<?php
header('Content-Type: application/json');

require_once('../../database/connection.php');

$sqlQuery = "SELECT SUM(totalHombres)as total, c.Ciudad FROM registro_poblacional rp INNER JOIN ciudad c ON rp.idCiudad=c.idCiudad GROUP BY c.Ciudad";

$result = mysqli_query($conection, $sqlQuery);

$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

require("../../database/close_connection.php");
echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>