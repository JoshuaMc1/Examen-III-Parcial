<?php
if (isset($_GET["acs"], $_GET["idReg"])) {
    if ($_GET['acs'] == '1') {
        $id = $_GET['idReg'];
        echo '
            <script>
                window.location = "../view/viewEdit.php?idReg='.$id.'";
            </script>
        ';
    } else if ($_GET['acs'] == '2') {
        require("../database/connection.php");
        $idRegistro = $_GET["idReg"];
        if($sentencia = mysqli_query($conection, "DELETE FROM registro_poblacional WHERE idRegistro='$idRegistro'")) {
            mysqli_query($conection, "ALTER TABLE registro_poblacional AUTO_INCREMENT = 1");
            require("../database/close_connection.php");
            echo '
                <script>
                    window.location = "../../../index.php?status=reg_delete";
                </script>
            ';
        }else {
            require("../database/close_connection.php");
            echo '
                <script>
                    window.location = "../../../index.php?status=reg_no_delete";
                </script>
            ';
        }
    } else {
        echo '
            <script>
                window.location = "../../../index.php?status=ERROR320";
            </script>
        ';
    }
} else {
    echo '
        <script>
            window.location = "../../../index.php?status=ERROR320";
        </script>
    ';
}
