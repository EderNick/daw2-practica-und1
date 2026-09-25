<?php

require_once "config/Autoload.php";

// TODO:
// importar el BO correspondiente
// instanciar el objeto BO correspondiente
use \bo\Incidencia as IncidenciaBO;
$incidenciaBO = new IncidenciaBO();
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

    // TODO:
    // llamar al método registrar()
        $incidenciaBO->registrar(
        $_POST["usuario"] ?? "",
        $_POST["asunto"] ?? "",
        $_POST["prioridad"] ?? ""
    );
    header("Location: index.php");
    exit;
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
    $incidenciaBO->cambiarEstado($_POST["id"] ?? "");
    header("Location: index.php");
    exit;
}


/*
|--------------------------------------------------------------------------
| BUSCAR / LISTAR
|--------------------------------------------------------------------------
*/

if (!empty($_GET["buscar"])) {

    // TODO:
    // llamar al método buscar()
    $registros = $incidenciaBO->buscar($_GET["buscar"]);

} else {

    // TODO:
    // llamar al método listar()
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

    <!-- FORMULARIO DE REGISTRO -->

    <form method="POST">

        <input type="hidden" name="accion" value="registrar">

        <!--
            Aquí van los campos
            correspondientes a la variante
        -->
          <p>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" maxlength="120" required>
        </p>
        <p>
            <label for="asunto">Asunto:</label>
            <input type="text" id="asunto" name="asunto" maxlength="255" required>
        </p>
        <p>
            <label for="prioridad">Prioridad:</label>
            <select id="prioridad" name="prioridad" required>
                <option value="BAJA">Baja</option>
                <option value="MEDIA" selected>Media</option>
                <option value="ALTA">Alta</option>
            </select>
        </p>   

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
                <!-- columnas -->
            <th>ID</th>
                <th>Usuario</th>
                <th>Asunto</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Operaciones</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($registros as $item): ?>

                <tr>
                    <!-- datos -->
                    <td><?= htmlspecialchars((string) $item["id"], ENT_QUOTES, "UTF-8"); ?></td>
                    <td><?= htmlspecialchars((string) $item["usuario"], ENT_QUOTES, "UTF-8"); ?></td>
                    <td><?= htmlspecialchars((string) $item["asunto"], ENT_QUOTES, "UTF-8"); ?></td>
                    <td><?= htmlspecialchars((string) $item["prioridad"], ENT_QUOTES, "UTF-8"); ?></td>
                    <td><?= htmlspecialchars((string) $item["estado"], ENT_QUOTES, "UTF-8"); ?></td>
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