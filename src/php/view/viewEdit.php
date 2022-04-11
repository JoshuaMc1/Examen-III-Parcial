<?php
require("../database/connection.php");
if (isset($_GET['idReg'])) {
    $id = $_GET['idReg'];
    $sentenciaCiudad = mysqli_query($conection, "SELECT * FROM ciudad");
    $sentenciaReg = mysqli_query($conection, "SELECT * FROM registro_poblacional WHERE idRegistro='$id'");
    $dataRegistro = mysqli_fetch_assoc($sentenciaReg);
} else $id = "";

if (($_SERVER['REQUEST_METHOD'] === 'POST')) {
    $idReg = mysqli_real_escape_string($conection, $_POST['idReg']);
    $ciudad = mysqli_real_escape_string($conection, $_POST['ciudad']);
    $hombres = mysqli_real_escape_string($conection, $_POST['hombres']);
    $mujeres = mysqli_real_escape_string($conection, $_POST['mujeres']);

    if (mysqli_query($conection, "UPDATE registro_poblacional SET idCiudad='$ciudad', totalMujeres='$mujeres', totalHombres='$hombres' WHERE idRegistro='$idReg'")) {
        require("../database/close_connection.php");
        echo '
                <script>
                    window.location = "../../../index.php?status=reg_edit";
                </script>
            ';
    } else {
        require("../database/close_connection.php");
        echo '
                <script>
                    window.location = "../../../index.php?status=reg_no_edit";
                </script>
            ';
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
    <link rel="stylesheet" href="../../style/style.css?v=<?php echo rand(); ?>">
    <title>Examen III-PARCIAL</title>
</head>

<body>
    <main class="main-view">
        <section class="contenedor-view">
            <div class="container-fluid p-1 p-xl-5 p-lg-3">
                <div class="card border-morado bg-dark">
                    <div class="card-header bg-morado text-center">
                        <h5 class="fw-bold">Editar registro poblacional</h5>
                    </div>
                    <div class="card-body">
                        <form action="viewEdit.php" method="POST" id="formEdit">
                            <div id="msg"></div>
                            <div class="row">
                                <div class="col-lg-2 mb-3">
                                    <label class="form-label text-white">ID</label>
                                    <input type="text" name="idReg" id="id" value="<?php echo $id ?>" class="form-control" readonly>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label class="form-label text-white">Ciudad</label>
                                    <select name="ciudad" id="ciudad" class="form-select">
                                        <option value="">Seleccione una opción</option>
                                        <?php
                                        while ($dataCiudad = mysqli_fetch_assoc($sentenciaCiudad)) {
                                            if ($dataCiudad['idCiudad'] == $dataRegistro['idCiudad']) {
                                        ?>
                                                <option value="<?php echo $dataCiudad['idCiudad']; ?>" selected><?php echo $dataCiudad['Ciudad']; ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?php echo $dataCiudad['idCiudad']; ?>"><?php echo $dataCiudad['Ciudad']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <label class="form-label text-white">Cantidad hombres</label>
                                    <input type="text" name="hombres" id="hombres" value="<?php echo $dataRegistro['totalHombres']; ?>" class="form-control">
                                </div>
                                <div class="col-lg-3 mb-4">
                                    <label class="form-label text-white">Cantidad mujeres</label>
                                    <input type="text" name="mujeres" id="mujeres" value="<?php echo $dataRegistro['totalMujeres']; ?>" class="form-control">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="d-grid">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-morado">Editar registro</button>
                                            <button type="button" class="btn btn-morado" id="btnCancelar">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="../../js/view-app.js?v=<?php echo rand()?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>