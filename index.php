<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "config/Autoload.php";

use Bo\Equipo;

$equipoBO = new Equipo();

$mensaje = '';

$registros = [];


/*
|--------------------------------------------------------------------------
| REGISTRAR
|--------------------------------------------------------------------------
*/

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && ($_POST["accion"] ?? "") === "registrar"
) {

    $codigo = trim(
        $_POST['codigo'] ?? ''
    );

    $nombre = trim(
        $_POST['nombre'] ?? ''
    );

    $categoria = trim(
        $_POST['categoria'] ?? ''
    );

    if (
        $codigo !== ''
        && $nombre !== ''
        && $categoria !== ''
    ) {

        $equipoBO->registrar(
            $codigo,
            $nombre,
            $categoria
        );

        header('Location: index.php');
        exit;

    } else {

        $mensaje =
            'Complete todos los campos.';
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

    $equipoBO->cambiarEstado(
        (int) ($_POST['id'] ?? 0)
    );

    header('Location: index.php');
    exit;
}


/*
|--------------------------------------------------------------------------
| BUSCAR / LISTAR
|--------------------------------------------------------------------------
*/

$textoBuscar = '';

if (!empty($_GET['buscar'])) {
    $textoBuscar = trim($_GET['buscar']);
}

if ($textoBuscar !== '') {
    $registros = $equipoBO->buscar($textoBuscar);
} else {
    $registros = $equipoBO->listar();
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

        <input
            type="hidden"
            name="accion"
            value="registrar">

        <label>Código:</label>

        <input
            type="text"
            name="codigo"
            required>


        <label>Nombre del equipo:</label>

        <input
            type="text"
            name="nombre"
            required>


        <label>Categoría:</label>

        <input
            type="text"
            name="categoria"
            required>


        <button type="submit">
            Registrar
        </button>

    </form>


    <?php if ($mensaje !== ''): ?>

        <p>
            <?= htmlspecialchars($mensaje) ?>
        </p>

    <?php endif; ?>


    <hr>


    <!-- FORMULARIO DE BÚSQUEDA -->

    <form method="GET">

        <input
            type="text"
            name="buscar"
            placeholder="Buscar"
            value="<?= htmlspecialchars($textoBuscar) ?>">

        <button type="submit">
            Buscar
        </button>

    </form>


    <hr>


    <!-- LISTADO -->

    <table
        border="1"
        cellpadding="5"
        cellspacing="0">

        <thead>

            <tr>

                <th>ID</th>

                <th>Código</th>

                <th>Nombre</th>

                <th>Categoría</th>

                <th>Estado</th>

                <th>Acción</th>

            </tr>

        </thead>


        <tbody>

            <?php if (!empty($registros)): ?>

                <?php foreach ($registros as $item): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars($item["id"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($item["codigo"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($item["nombre"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($item["categoria"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($item["estado"]) ?>
                        </td>

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

            <?php else: ?>

                <tr>

                    <td colspan="6">
                        No hay registros para mostrar.
                    </td>

                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</body>

</html>