<?php
require_once "config/Autoload.php";

use bo\Incidencia as IncidenciaBO;

$incidenciaBO = new IncidenciaBO();

$registros = [];

// registros

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && ($_POST["accion"] ?? "") === "registrar"
) {

    $incidenciaBO->registrar($_POST["usuario"], $_POST["asunto"], $_POST["prioridad"]);
}


//cambio de estados

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && ($_POST["accion"] ?? "") === "cambiarEstado"
) {

    $incidenciaBO->cambiarEstado($_POST["id"]);
}

//buscar y listar

if (!empty($_GET["buscar"])) {

    $registros = $incidenciaBO->buscar($_GET["buscar"]);

} else {

    $registros = $incidenciaBO->listar();
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

    Formulario de registro

    <form method="POST">

        <input type="hidden" name="accion" value="registrar">

        <input type="text" name="usuario" placeholder="Usuario" required>

        <input type="text" name="asunto" placeholder="Asunto" required>

        <select name="prioridad">
            <option value="BAJA">BAJA</option>
            <option value="MEDIA">MEDIA</option>
            <option value="ALTA">ALTA</option>
        </select>

        <button type="submit">
            Registrar
        </button>

    </form>


    <hr>


  Formulario Búsqueda

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


 Listado 

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

                    <td><?= $item["id"] ?></td>
                    <td><?= $item["usuario"] ?></td>
                    <td><?= $item["asunto"] ?></td>
                    <td><?= $item["prioridad"] ?></td>
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