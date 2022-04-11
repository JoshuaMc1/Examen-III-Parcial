<?php
require("./src/php/database/connection.php");
$sql = "SELECT p.Pais, r.*, c.Ciudad FROM ciudad c INNER JOIN registro_poblacional r ON r.idCiudad=c.idCiudad INNER JOIN pais p ON c.Pais=p.idPais";
$sentencia = mysqli_query($conection, $sql);
$sentenciaCiudad = mysqli_query($conection, "SELECT * FROM ciudad");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
    <link rel="stylesheet" href="src/style/style.css?v=<?php echo rand(); ?>">
    <title>Examen III-PARCIAL</title>
</head>

<body>
    <main>
        <section class="contenedor">
            <div class="container-fluid p-1 p-xl-5 p-lg-3">
                <div class="row">
                    <div class="col-xl-6 col-lg-12 mb-3">
                        <div class="card border-morado bg-dark">
                            <div class="card-header bg-morado text-center">
                                <h5 class="fw-bold">Registro poblacional</h5>
                            </div>
                            <div class="card-body">
                                <form action="./src/php/funciones/guardar.php" method="POST" id="formRegistro">
                                    <div class="row">
                                        <div class="col-lg-12 mb-2" id="msg"></div>
                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label text-white">Seleccione la ciudad</label>
                                            <select name="ciudad" id="ciudad" class="form-select">
                                                <option value="">Seleccione una opción</option>
                                                <?php
                                                while ($dataCiudad = mysqli_fetch_assoc($sentenciaCiudad)) {
                                                ?>
                                                    <option value="<?php echo $dataCiudad['idCiudad']; ?>"><?php echo $dataCiudad['Ciudad']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label text-white">Ingrese la cantidad de hombres</label>
                                            <input type="text" name="hombres" id="hombres" class="form-control">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label text-white">Ingrese la cantidad de mujeres</label>
                                            <input type="text" name="mujeres" id="mujeres" class="form-control">
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-morado">Guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 mb-3">
                        <div class="card border-morado bg-dark scrol-tabla">
                            <div class="card-header bg-morado text-center">
                                <h5 class="fw-bold">Tabla de registros</h5>
                            </div>
                            <div class="card-body">
                                <div id="msgTabla"></div>
                                <table class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Pais</th>
                                            <th scope="col">Ciudad</th>
                                            <th scope="col">Total hombres</th>
                                            <th scope="col">Total mujeres</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (mysqli_num_rows($sentencia) <= 0) {
                                            echo '
                                                    <tr class="text-center">
                                                        <td colspan="6" class="text-morado fw-bold">NO DATA</td>
                                                    </tr>
                                                ';
                                        } else {
                                            while ($data = mysqli_fetch_assoc($sentencia)) {
                                                echo '
                                                        <tr>
                                                            <th scope="row">' . $data["idRegistro"] . '</th>
                                                            <td>' . $data["Pais"] . '</td>
                                                            <td>' . $data["Ciudad"] . '</td>
                                                            <td>' . $data["totalHombres"] . '</td>
                                                            <td>' . $data["totalMujeres"] . '</td>
                                                            <td>
                                                                <a class="btn btn-sm btn-warning" href="./src/php/controller/controller.php?acs=1&idReg=' . $data["idRegistro"] . '" role="button"><i class="fas fa-edit"></i></a>
                                                                <a class="btn btn-sm btn-danger" href="./src/php/controller/controller.php?acs=2&idReg=' . $data["idRegistro"] . '" role="button"><i class="fas fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    ';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_GET['status'])) {
                        if ($_GET['status'] == 'success') {
                            echo '
                                        <script>
                                            let alertPlaceholder = document.getElementById("msg");
                                            var wrapper = document.createElement("div");
                                            wrapper.innerHTML = \'<div class="alert alert-success fs-6 alert-dismissible" role="alert">El registro se guardo exitosamente<button type="button" id="close" class="btn-close btnClose" data-bs-dismiss="alert" aria-label="Close"></button></div>\';
                                            alertPlaceholder.append(wrapper);
                                        </script>
                                    ';
                        } else if ($_GET['status'] == 'unexpected') {
                            echo '
                                        <script>
                                            let alertPlaceholder = document.getElementById("msg");
                                            var wrapper = document.createElement("div");
                                            wrapper.innerHTML = \'<div class="alert alert-danger fs-6 alert-dismissible" role="alert">El registro no se a guardado<button type="button" id="close" class="btn-close btnClose" data-bs-dismiss="alert" aria-label="Close"></button></div>\';
                                            alertPlaceholder.append(wrapper);
                                        </script>
                                    ';
                        } else if ($_GET['status'] == 'ERROR320') {
                            echo '
                                        <script>
                                            let alertPlaceholder = document.getElementById("msg");
                                            var wrapper = document.createElement("div");
                                            wrapper.innerHTML = \'<div class="alert alert-danger fs-6 alert-dismissible" role="alert">Vaya, a ocurrido un error<button type="button" id="close" class="btn-close btnClose" data-bs-dismiss="alert" aria-label="Close"></button></div>\';
                                            alertPlaceholder.append(wrapper);
                                        </script>
                                    ';
                        } else if ($_GET['status'] == 'reg_delete') {
                            echo '
                                        <script>
                                            let alertPlaceholder = document.getElementById("msgTabla");
                                            var wrapper = document.createElement("div");
                                            wrapper.innerHTML = \'<div class="alert alert-success fs-6 alert-dismissible" role="alert">Registro eliminado exitosamente<button type="button" id="close" class="btn-close btnClose" data-bs-dismiss="alert" aria-label="Close"></button></div>\';
                                            alertPlaceholder.append(wrapper);
                                        </script>
                                    ';
                        } else if ($_GET['status'] == 'reg_no_delete') {
                            echo '
                                        <script>
                                            let alertPlaceholder = document.getElementById("msgTabla");
                                            var wrapper = document.createElement("div");
                                            wrapper.innerHTML = \'<div class="alert alert-danger fs-6 alert-dismissible" role="alert">A ocurrido un error al eliminar el registro<button type="button" id="close" class="btn-close btnClose" data-bs-dismiss="alert" aria-label="Close"></button></div>\';
                                            alertPlaceholder.append(wrapper);
                                        </script>
                                    ';
                        } else if ($_GET['status'] == 'reg_edit') {
                            echo '
                                        <script>
                                            let alertPlaceholder = document.getElementById("msgTabla");
                                            var wrapper = document.createElement("div");
                                            wrapper.innerHTML = \'<div class="alert alert-success fs-6 alert-dismissible" role="alert">Registro editado exitosamente<button type="button" id="close" class="btn-close btnClose" data-bs-dismiss="alert" aria-label="Close"></button></div>\';
                                            alertPlaceholder.append(wrapper);
                                        </script>
                                    ';
                        } else if ($_GET['status'] == 'reg_no_edit') {
                            echo '
                                        <script>
                                            let alertPlaceholder = document.getElementById("msgTabla");
                                            var wrapper = document.createElement("div");
                                            wrapper.innerHTML = \'<div class="alert alert-danger fs-6 alert-dismissible" role="alert">A ocurrido un error al editar el registro<button type="button" id="close" class="btn-close btnClose" data-bs-dismiss="alert" aria-label="Close"></button></div>\';
                                            alertPlaceholder.append(wrapper);
                                        </script>
                                    ';
                        }
                    }
                    ?>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <div class="d-grid">
                            <button class="btn btn-morado" id="graficas">Estadisticas</button>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2 d-none" id="mostrarGraficas">
                        <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="card border-morado bg-dark">
                                <div class="card-header bg-morado text-center">
                                    <h5 class="fw-bold">Numero de personas por pais</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="grafico1"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="card border-morado bg-dark">
                                <div class="card-header bg-morado text-center">
                                    <h5 class="fw-bold">Numero de perosnas por ciudad</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="grafico2"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="card border-morado bg-dark">
                                <div class="card-header bg-morado text-center">
                                    <h5 class="fw-bold">Mujeres por pais</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="grafico3"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="card border-morado bg-dark">
                                <div class="card-header bg-morado text-center">
                                    <h5 class="fw-bold">Hombres por pais</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="grafico4"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="card border-morado bg-dark">
                                <div class="card-header bg-morado text-center">
                                    <h5 class="fw-bold">Mujeres por ciudad</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="grafico5"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="card border-morado bg-dark">
                                <div class="card-header bg-morado text-center">
                                    <h5 class="fw-bold">hombres por ciudad</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="grafico6"></canvas>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="src/js/app.js?v=<?php echo rand() ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>