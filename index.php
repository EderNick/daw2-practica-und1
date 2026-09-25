<?php

require_once "config/Autoload.php";

// TODO:
// importar el BO correspondiente
// instanciar el objeto BO correspondiente

use bo\Prestamo as PrestamoBO;
$bo = new PrestamoBO();

$registros = [];


/*
/*
|--------------------------------------------------------------------------
| REGISTRAR
|--------------------------------------------------------------------------
*/

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && ($_POST["accion"] ?? "") === "registrar"
) {

    $estudiante = trim($_POST["estudiante"] ?? "");
    $equipo = trim($_POST["equipo"] ?? "");
    $fecha = trim($_POST["fecha"] ?? "");

    if ($estudiante !== "" && $equipo !== "" && $fecha !== "") {
        $bo->registrar($estudiante, $equipo, $fecha);
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

        $id = (int) ($_POST["id"] ?? 0);

    if ($id > 0) {
        $bo->cambiarEstado($id);
    }
}


/*
|--------------------------------------------------------------------------
| BUSCAR / LISTAR
|--------------------------------------------------------------------------
*/

if (!empty($_GET["buscar"])) {
    

    $registros = $bo->buscar($_GET["buscar"]);

} else {

    $registros = $bo->listar();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Práctica Unidad I</title>
</head>

<body>

    <h1>Gestión de préstamos de equipos</h1>

    <!-- FORMULARIO DE REGISTRO -->

    <form method="POST">

        <input type="hidden" name="accion" value="registrar">

        <input
            type="text"
            name="estudiante"
            placeholder="Estudiante"
            required>

        <input
            type="text"
            name="equipo"
            placeholder="Equipo"
            required>

        <input
            type="date"
            name="fecha"
            required>

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
            value="<?= htmlspecialchars($_GET["buscar"] ?? "") ?>">
        <button type="submit">
            Buscar
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
                <th>Acción</th>
            
            </tr>
        </thead>

        <tbody>

            <?php foreach ($registros as $item): ?>

                <tr>
                    <!-- datos -->
                    <td><?= htmlspecialchars($item["id"]) ?></td>
                    <td><?= htmlspecialchars($item["estudiante"]) ?></td>
                    <td><?= htmlspecialchars($item["equipo"]) ?></td>
                    <td><?= htmlspecialchars($item["fecha"]) ?></td>
                    <td><?= htmlspecialchars($item["estado"]) ?></td>

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