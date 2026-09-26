<?php

require_once "config/Autoload.php";

use bo\Incidencia;

$bo = new Incidencia();

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

    $resultado = $bo->registrar(
        $_POST["usuario"] ?? "",
        $_POST["asunto"] ?? "",
        $_POST["prioridad"] ?? ""
    );

    $mensaje = $resultado
        ? "Incidencia registrada correctamente."
        : "No se pudo registrar la incidencia. Revisa los datos enviados.";
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
        $mensaje = $bo->cambiarEstado($id)
        ? "Estado actualizado correctamente."
        : "No se pudo actualizar el estado.";
}
    



/*
|--------------------------------------------------------------------------
| BUSCAR / LISTAR
|--------------------------------------------------------------------------
*/

if (!empty($_GET["buscar"])) {

     $registros = $bo->buscar((string) $_GET["buscar"]);

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

    <h1>Gestión de registros</h1>

    <!-- FORMULARIO DE REGISTRO -->

    <form method="POST">

        <input type="hidden" name="accion" value="registrar">

         <label>
            Usuario
            <input type="text" name="usuario" required>
        </label>

        <label>
            Asunto
            <input type="text" name="asunto" required>
        </label>

        <label>
            Prioridad
            <select name="prioridad" required>
                <option value="ALTA">Alta</option>
                <option value="MEDIA" selected>Media</option>
                <option value="BAJA">Baja</option>
            </select>
        </label>

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

    </form>


    <hr>


    <!-- LISTADO -->

    <table border="1" cellpadding="5">

        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Asunto</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($registros as $item): ?>

                <tr>
                    <td><?= (int) $item["id"] ?></td>
                    <td><?= htmlspecialchars($item["usuario"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars($item["asunto"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars($item["prioridad"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars($item["estado"], ENT_QUOTES, "UTF-8") ?></td>
                  
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