<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    require("../database/connection.php");
    $ciudad = mysqli_real_escape_string($conection, $_POST['ciudad']);
    $hombres = mysqli_real_escape_string($conection, $_POST['hombres']);
    $mujeres = mysqli_real_escape_string($conection, $_POST['mujeres']);
    if($sentencia = mysqli_query($conection, "INSERT INTO registro_poblacional(idCiudad, totalMujeres, totalHombres) VALUES('$ciudad','$mujeres','$hombres')")){
        echo '
            <script>
                window.location = "../../../index.php?status=success";
            </script>
        ';
    }else {
        echo '
            <script>
                window.location = "../../../index.php?status=unexpected";
            </script>
        ';
    }
}