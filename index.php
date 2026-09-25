<?php

require_once "config/Autoload.php";

// TODO:
// importar el BO correspondiente
// instanciar el objeto BO correspondiente
use \bo\Prestamo as PrestamoBO;
$prestamoBO = new PrestamoBO();

$registros = [];
$mensaje = "";

/*
|--------------------------------------------------------------------------
| REGISTRAR
|--------------------------------------------------------------------------
*/

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && ($_POST["accion"] ?? "") === "registrar"
) {

    // TODO:
    // llamar al método registrar()
    $estudiante = trim($_POST["estudiante"] ?? "");
    $equipo = trim($_POST["equipo"] ?? "");
    $fecha = $_POST["fecha"] ?? "";

    if ($estudiante !== "" && $equipo !== "" && $fecha !== "") {
        $resultado = $prestamoBO->registrar($estudiante, $equipo, $fecha);

        if ($resultado) {
            $mensaje = "Préstamo registrado correctamente.";
        } else {
            $mensaje = "No se pudo registrar el préstamo.";
        }
    } else {
        $mensaje = "Complete todos los campos.";
    }
}


/*
|--------------------------------------------------------------------------
| CAMBIAR ESTADO
|--------------------------------------------------------------------------
*/

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && ($_POST["accion"] ?? "") === "cambiarEstado"
) {

    // TODO:
    // llamar al método cambiarEstado()
    $id = $_POST["id"] ?? "";

    if ($id !== "") {
        $resultado = $prestamoBO->cambiarEstado($id);

        if ($resultado) {
            $mensaje = "El préstamo fue marcado como DEVUELTO.";
        } else {
            $mensaje = "No se pudo cambiar el estado.";
        }
    }
}


/*
|--------------------------------------------------------------------------
| BUSCAR / LISTAR
|--------------------------------------------------------------------------
*/

if (!empty($_GET["buscar"])) {

    // TODO:
    // llamar al método buscar()
    $texto = trim($_GET["buscar"]);
    $registros = $prestamoBO->buscar($texto);
} else {

    // TODO:
    // llamar al método listar()
    $registros = $prestamoBO->listar();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Práctica Unidad I</title>
</head>

<body>

    <h1>Gestión de registros</h1>

    <!-- FORMULARIO DE REGISTRO -->

    <form method="POST">

        <input type="hidden" name="accion" value="registrar">

        <!--
            Aquí van los campos
            correspondientes a la variante
        -->
        <label for="estudiante">Estudiante:</label>
        <input type="text" id="estudiante" name="estudiante" required>

        <br><br>

        <label for="equipo">Equipo:</label>
        <input
            type="text"
            id="equipo"
            name="equipo"
            required>

        <br><br>

        <label for="fecha">Fecha:</label>
        <input
            type="date"
            id="fecha"
            name="fecha"
            required>

        <br><br>

        <button type="submit">
            Registrar
        </button>

    </form>


    <hr>


    <!-- FORMULARIO DE BÚSQUEDA -->

    <form method="GET">

        <input
            type="text"
            name="buscar"
            placeholder="Buscar">

        <button type="submit">
            Buscar
        </button>

        <button type="submit">
            Listar todos
        </button>

    </form>


    <hr>


    <!-- LISTADO -->

    <table border="1" cellpadding="5">

        <thead>
            <tr>
                <!-- columnas -->
                <th>ID</th>
                <th>Estudiante</th>
                <th>Equipo</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Operación</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($registros as $item): ?>

                <tr>

                    <!-- datos -->
                    <td><?= $item["id"]; ?></td>
                    <td><?= $item["estudiante"]; ?></td>
                    <td><?= $item["equipo"]; ?></td>
                    <td><?= $item["fecha"]; ?></td>
                    <td><?= $item["estado"]; ?></td>

                    <td>

                        <form method="POST">

                            <input
                                type="hidden"
                                name="accion"
                                value="cambiarEstado">

                            <input
                                type="hidden"
                                name="id"
                                value="<?= $item["id"] ?>">

                            <button type="submit">
                                Cambiar estado
                            </button>

                        </form>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</body>

</html>