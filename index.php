<?php

require_once "config/Autoload.php";

$equipoBO = new \bo\Equipo();
$registros = [];

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && ($_POST["accion"] ?? "") === "registrar"
) {
    $equipoBO->registrar(
        trim($_POST["codigo"] ?? ""),
        trim($_POST["nombre"] ?? ""),
        trim($_POST["categoria"] ?? "")
    );

    header("Location: index.php");
    exit;
}

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && ($_POST["accion"] ?? "") === "cambiarEstado"
) {
    $equipoBO->cambiarEstado((int) ($_POST["id"] ?? 0));

    header("Location: index.php");
    exit;
}

if (isset($_GET["buscar"]) && trim($_GET["buscar"]) !== "") {
    $registros = $equipoBO->buscar(trim($_GET["buscar"]));
} else {
    $registros = $equipoBO->listar();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario de equipos</title>
</head>
<body>
    <h1>Inventario de equipos</h1>

    <h2>Registrar equipo</h2>
    <form method="POST">
        <input type="hidden" name="accion" value="registrar">
        <label>Código <input type="text" name="codigo" required></label>
        <label>Nombre <input type="text" name="nombre" required></label>
        <label>Categoría <input type="text" name="categoria" required></label>
        <button type="submit">Registrar</button>
    </form>

    <h2>Buscar por categoría</h2>
    <form method="GET">
        <input type="text" name="buscar" placeholder="Categoría" value="<?= htmlspecialchars($_GET["buscar"] ?? "", ENT_QUOTES, "UTF-8") ?>">
        <button type="submit">Buscar</button>
        <a href="index.php">Listar todos</a>
    </form>

    <h2>Equipos registrados</h2>
    <table border="1" cellpadding="5">
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
            <?php foreach ($registros as $item): ?>
                <tr>
                    <td><?= htmlspecialchars((string) ($item["id"] ?? ""), ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars((string) ($item["codigo"] ?? ""), ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars((string) ($item["nombre"] ?? ""), ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars((string) ($item["categoria"] ?? ""), ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars((string) ($item["estado"] ?? ""), ENT_QUOTES, "UTF-8") ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="accion" value="cambiarEstado">
                            <input type="hidden" name="id" value="<?= htmlspecialchars((string) ($item["id"] ?? ""), ENT_QUOTES, "UTF-8") ?>">
                            <button type="submit">Cambiar estado</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
