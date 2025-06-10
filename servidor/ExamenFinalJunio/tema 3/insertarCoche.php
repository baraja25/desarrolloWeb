<?php
require_once("DaoCoche.php");

$dao = new CochesDao();
$fotosPC = array();
$fotosSC = array();
$fotosTC = array();


if (isset($_POST['guardar'])) {


    //datos del primer coche
    $nombrePC = $_POST["nombrePrimerCoche"];
    $marcaPC = $_POST["marcaPrimerCoche"];
    $modeloPC = $_POST["modeloPrimerCoche"];
    $precioPC = $_POST["precioPrimerCoche"] ?? 0;
    $matriculaPC = $_POST["matriculaPrimerCoche"];
    $anioPC = $_POST["anioPrimerCoche"] ?? 1900;

    $dao->insertarCoche($nombrePC, $marcaPC, $modeloPC, $precioPC, $matriculaPC, $anioPC);

    foreach ($_FILES["fotosPrimerCoche"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name1 = $_FILES["fotosPrimerCoche"]["tmp_name"][$key];
            base64_encode($tmp_name1);
            $dao->insertarFoto($tmp_name1);
        }
    }

    // //datos del segundo coche
    $nombreSC = $_POST["nombreSegundoCoche"] ?? "";
    $marcaSC = $_POST["marcaSegundoCoche"] ?? "";
    $modeloSC = $_POST["modeloSegundoCoche"] ?? "";
    $precioSC = $_POST["precioSegundoCoche"] ?? 0;
    $matriculaSC = $_POST["matriculaSegundoCoche"] ?? "";
    $anioSC = $_POST["anioSegundoCoche"] ?? 1900;

    // //insertar sus datos
    $dao->insertarCoche($nombreSC, $marcaSC, $modeloSC, $precioSC, $matriculaSC, $anioSC);

    foreach ($_FILES["fotosSegundoCoche"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name2 = $_FILES["fotosSegundoCoche"]["tmp_name"][$key];
            base64_encode($tmp_name2);
            $dao->insertarFoto($tmp_name2);
        }
    }

    // //datos del tercer coche
    $nombreTC = $_POST["nombreTercerCoche"];
    $marcaTC = $_POST["marcaTercerCoche"];
    $modeloTC = $_POST["modeloTercerCoche"];
    $precioTC = $_POST["precioTercerCoche"] ?? 0;
    $matriculaTC = $_POST["matriculaTercerCoche"];
    $anioTC = $_POST["anioTercerCoche"] ?? 1900;


    // //insertar sus datos
    $dao->insertarCoche($nombreTC, $marcaTC, $modeloTC, $precioTC, $matriculaTC, $anioTC);

    foreach ($_FILES["fotosTercerCoche"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name3 = $_FILES["fotosTercerCoche"]["tmp_name"][$key];
            base64_encode($tmp_name3);
            $dao->insertarFoto($tmp_name3);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio final junio</title>
</head>

<body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
        <table border="1" style="width: 50%;">
            <tr>
                <th colspan="6">Datos del coche</th>
            </tr>
            <tr>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Precio</th>
                <th>matricula</th>
                <th>Año</th>
            </tr>
            <tr>
                <td><input type="text" name="nombrePrimerCoche"></td>
                <td><input type="text" name="marcaPrimerCoche"></td>
                <td><input type="text" name="modeloPrimerCoche"></td>
                <td><input type="number" name="precioPrimerCoche"></td>
                <td><input type="text" name="matriculaPrimerCoche"></td>
                <td><input type="number" name="anioPrimerCoche"></td>
            </tr>
            <tr>
                <td colspan="6">Fotos del coche: <br><input type="file" name="fotosPrimerCoche[]"><input type="file" name="fotosPrimerCoche[]"><input type="file" name="fotosPrimerCoche[]">
                </td>
            </tr>
            <tr>
                <td><input type="text" name="nombreSegundoCoche" required></td>
                <td><input type="text" name="marcaSegundoCoche" required></td>
                <td><input type="text" name="modeloSegundoCoche" required></td>
                <td><input type="number" name="precioPrimerCoche" required></td>
                <td><input type="text" name="matriculaSegundoCoche" required></td>
                <td><input type="number" name="anioSegundoCoche" required></td>
            </tr>
            <tr>
                <td colspan="6">Fotos del coche: <br><input type="file" name="fotosSegundoCoche[]" required><input type="file" name="fotosSegundoCoche[]"><input type="file" name="fotosSegundoCoche[]">
                </td>
            </tr>
            <tr>
                <td><input type="text" name="nombreTercerCoche" required></td>
                <td><input type="text" name="marcaTercerCoche" required></td>
                <td><input type="text" name="modeloTercerCoche" required></td>
                <td><input type="number" name="precioTercerCoche" required></td>
                <td><input type="text" name="matriculaTercerCoche" required></td>
                <td><input type="number" name="fotosTercerCoche" required></td>
            </tr>
            <tr>
                <td colspan="6">Fotos del coche: <br><input type="file" name="fotosTercerCoche[]" required><input type="file" name="fotosTercerCoche[]"><input type="file" name="fotosTercerCoche[]">
                </td>
            </tr>
        </table>
        <input type="submit" value="Guardar" name="guardar">
    </form>
</body>

</html>