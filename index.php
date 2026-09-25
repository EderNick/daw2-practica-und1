<?php

require_once "config/Autoload.php";

use bo\Prestamo as PrestamoBO;

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

    try {
        $prestamoBO->registrar(
            $_POST["estudiante"] ?? "",
            $_POST["equipo"] ?? "",
            $_POST["fecha"] ?? ""
        );
        header("Location: index.php");
        exit;
    } catch (Exception $e) {
        $mensaje = $e->getMessage();
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

    try {
        $prestamoBO->cambiarEstado((int) ($_POST["id"] ?? 0));
        header("Location: index.php");
        exit;
    } catch (Exception $e) {
        $mensaje = $e->getMessage();
    }
}


/*
|--------------------------------------------------------------------------
| BUSCAR / LISTAR
|--------------------------------------------------------------------------
*/

if (!empty($_GET["buscar"])) {

    $registros = $prestamoBO->buscar($_GET["buscar"]);

} else {

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

    <?php if ($mensaje !== ""): ?>
        <p><b><?= htmlspecialchars($mensaje) ?></b></p>
    <?php endif; ?>

    <!-- FORMULARIO DE REGISTRO -->

    <form method="POST">

        <input type="hidden" name="accion" value="registrar">

        <input type="text" name="estudiante" placeholder="Estudiante" required>

        <input type="text" name="equipo" placeholder="Equipo" required>

        <input type="date" name="fecha" value="<?= date("Y-m-d") ?>" required>

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
            value="<?= htmlspecialchars($_GET["buscar"] ?? "") ?>"
            placeholder="Buscar por estudiante">

        <button type="submit">
            Buscar
        </button>

    </form>


    <hr>


    <!-- LISTADO -->

    <table border="1" cellpadding="5">

        <thead>
            <tr>
                <th>ID</th>
                <th>Estudiante</th>
                <th>Equipo</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Operacion</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($registros as $item): ?>

                <tr>

                    <td><?= $item["id"] ?></td>
                    <td><?= htmlspecialchars($item["estudiante"]) ?></td>
                    <td><?= htmlspecialchars($item["equipo"]) ?></td>
                    <td><?= $item["fecha"] ?></td>
                    <td><?= $item["estado"] ?></td>

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
                                Marcar como DEVUELTO
                            </button>

                        </form>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</body>

</html>