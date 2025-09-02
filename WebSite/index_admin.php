<?php
session_start();

// Solo permitir acceso a administradores
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
    header("Location: login.php");
    exit();
}

// Conexión a las bases de datos
try {
    $dbAviones = new PDO('sqlite:../DataBase/aviones.db');
    $dbAviones->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbUsuarios = new PDO('sqlite:../DataBase/usuarios.db');
    $dbUsuarios->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbAerolineas = new PDO('sqlite:../DataBase/aerolineas.db');
    $dbAerolineas->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

$message = '';
$error = '';

// ------------------- FABRICANTES (aviones.db) -------------------
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_fabricante'])) {
    $fab_nom = trim($_POST['fab_nom'] ?? '');
    $fab_imagen = trim($_POST['fab_imagen'] ?? '');

    if ($fab_nom === '' || $fab_imagen === '') {
        $error = "Nombre y URL de imagen son obligatorios.";
    } else {
        try {
            $stmt = $dbAviones->prepare("INSERT INTO fabricantes (fab_nom, fab_imagen) VALUES (:fab_nom, :fab_imagen)");
            $stmt->bindParam(':fab_nom', $fab_nom, PDO::PARAM_STR);
            $stmt->bindParam(':fab_imagen', $fab_imagen, PDO::PARAM_STR);
            $stmt->execute();
            $message = "Fabricante '{$fab_nom}' añadido exitosamente.";
        } catch (PDOException $e) {
            $error = "Error al añadir fabricante: " . $e->getMessage();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_fabricante'])) {
    $fab_id = (int)($_POST['fab_id'] ?? 0);
    $fab_nom = trim($_POST['fab_nom'] ?? '');
    $fab_imagen = trim($_POST['fab_imagen'] ?? '');

    if ($fab_id <= 0 || $fab_nom === '' || $fab_imagen === '') {
        $error = "ID, nombre y URL de imagen son obligatorios para actualizar.";
    } else {
        try {
            $stmt = $dbAviones->prepare("UPDATE fabricantes SET fab_nom = :fab_nom, fab_imagen = :fab_imagen WHERE fab_id = :fab_id");
            $stmt->bindParam(':fab_nom', $fab_nom, PDO::PARAM_STR);
            $stmt->bindParam(':fab_imagen', $fab_imagen, PDO::PARAM_STR);
            $stmt->bindParam(':fab_id', $fab_id, PDO::PARAM_INT);
            $stmt->execute();
            $message = "Fabricante '{$fab_nom}' actualizado exitosamente.";
        } catch (PDOException $e) {
            $error = "Error al actualizar fabricante: " . $e->getMessage();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && ($_GET['action'] ?? '') === 'delete_fabricante' && isset($_GET['id'])) {
    $fab_id = (int)$_GET['id'];
    if ($fab_id > 0) {
        try {
            $stmt = $dbAviones->prepare("DELETE FROM fabricantes WHERE fab_id = :fab_id");
            $stmt->bindParam(':fab_id', $fab_id, PDO::PARAM_INT);
            $stmt->execute();
            $message = "Fabricante eliminado exitosamente.";
        } catch (PDOException $e) {
            $error = "Error al eliminar fabricante: " . $e->getMessage();
        }
    } else {
        $error = "ID de fabricante inválido para eliminar.";
    }
}

// Obtener fabricantes
$fabricantes = [];
try {
    $result = $dbAviones->query("SELECT fab_id, fab_nom, fab_imagen FROM fabricantes ORDER BY fab_nom");
    while ($fab = $result->fetch(PDO::FETCH_ASSOC)) {
        $fabricantes[] = $fab;
    }
} catch (PDOException $e) {
    $error = "Error al cargar fabricantes: " . $e->getMessage();
}

// ------------------- MODELOS DE AVIONES (aviones.db) -------------------
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_modelo'])) {
    $mod_nom = trim($_POST['modelo_nom'] ?? '');
    $mod_imagen = trim($_POST['modelo_img'] ?? '');
    $fab_id = (int)($_POST['fabricante_id'] ?? 0);

    $mod_descripcio = trim($_POST['modelo_descripcio'] ?? '');
    $fecha_lanzamiento = trim($_POST['fecha_lanzamiento'] ?? '');
    $velocidad_maxima = $_POST['velocidad_maxima'] !== '' ? (int)$_POST['velocidad_maxima'] : null;

    if ($mod_nom === '' || $mod_imagen === '' || $fab_id <= 0) {
        $error = "Todos los campos son obligatorios para el modelo.";
    } else {
        try {
            $stmt = $dbAviones->prepare("INSERT INTO modelos_aviones (mod_nom, mod_imagen, fab_id, mod_descripcio, fecha_lanzamiento, velocidad_maxima) VALUES (:mod_nom, :mod_imagen, :fab_id, :mod_descripcio, :fecha_lanzamiento, :velocidad_maxima)");
            $stmt->bindParam(':mod_nom', $mod_nom, PDO::PARAM_STR);
            $stmt->bindParam(':mod_imagen', $mod_imagen, PDO::PARAM_STR);
            $stmt->bindParam(':fab_id', $fab_id, PDO::PARAM_INT);
            $stmt->bindParam(':mod_descripcio', $mod_descripcio, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_lanzamiento', $fecha_lanzamiento, PDO::PARAM_STR);
            $stmt->bindParam(':velocidad_maxima', $velocidad_maxima, PDO::PARAM_INT);
            $stmt->execute();
            $message = "Modelo '{$mod_nom}' añadido exitosamente.";
        } catch (PDOException $e) {
            $error = "Error al añadir modelo: " . $e->getMessage();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_modelo'])) {
    $mod_id = (int)($_POST['modelo_id'] ?? 0);
    $mod_nom = trim($_POST['modelo_nom'] ?? '');
    $mod_imagen = trim($_POST['modelo_img'] ?? '');
    $fab_id = (int)($_POST['fabricante_id'] ?? 0);

    $mod_descripcio = trim($_POST['modelo_descripcio'] ?? '');
    $fecha_lanzamiento = trim($_POST['fecha_lanzamiento'] ?? '');
    $velocidad_maxima = $_POST['velocidad_maxima'] !== '' ? (int)$_POST['velocidad_maxima'] : null;

    if ($mod_id <= 0 || $mod_nom === '' || $mod_imagen === '' || $fab_id <= 0) {
        $error = "Todos los campos son obligatorios para actualizar el modelo.";
    } else {
        try {
            $stmt = $dbAviones->prepare("UPDATE modelos_aviones SET mod_nom = :mod_nom, mod_imagen = :mod_imagen, fab_id = :fab_id, mod_descripcio = :mod_descripcio, fecha_lanzamiento = :fecha_lanzamiento, velocidad_maxima = :velocidad_maxima WHERE mod_id = :mod_id");
            $stmt->bindParam(':mod_nom', $mod_nom, PDO::PARAM_STR);
            $stmt->bindParam(':mod_imagen', $mod_imagen, PDO::PARAM_STR);
            $stmt->bindParam(':fab_id', $fab_id, PDO::PARAM_INT);
            $stmt->bindParam(':mod_descripcio', $mod_descripcio, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_lanzamiento', $fecha_lanzamiento, PDO::PARAM_STR);
            $stmt->bindParam(':velocidad_maxima', $velocidad_maxima, PDO::PARAM_INT);
            $stmt->bindParam(':mod_id', $mod_id, PDO::PARAM_INT);
            $stmt->execute();
            $message = "Modelo '{$mod_nom}' actualizado exitosamente.";
        } catch (PDOException $e) {
            $error = "Error al actualizar modelo: " . $e->getMessage();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && ($_GET['action'] ?? '') === 'delete_modelo' && isset($_GET['id'])) {
    $mod_id = (int)$_GET['id'];
    if ($mod_id > 0) {
        try {
            $stmt = $dbAviones->prepare("DELETE FROM modelos_aviones WHERE mod_id = :mod_id");
            $stmt->bindParam(':mod_id', $mod_id, PDO::PARAM_INT);
            $stmt->execute();
            $message = "Modelo eliminado exitosamente.";
        } catch (PDOException $e) {
            $error = "Error al eliminar modelo: " . $e->getMessage();
        }
    } else {
        $error = "ID de modelo inválido para eliminar.";
    }
}

// Obtener modelos de aviones
$modelos = [];
try {
    $result = $dbAviones->query("SELECT m.mod_id, m.mod_nom, m.mod_descripcio, m.mod_imagen, m.fecha_lanzamiento, m.velocidad_maxima, f.fab_nom, m.fab_id 
                          FROM modelos_aviones m 
                          JOIN fabricantes f ON m.fab_id = f.fab_id 
                          ORDER BY m.mod_nom");
    while ($mod = $result->fetch(PDO::FETCH_ASSOC)) {
        $modelos[] = $mod;
    }
} catch (PDOException $e) {
    $error = "Error al cargar modelos: " . $e->getMessage();
}

// ------------------- USUARIOS (usuarios.db) -------------------
$usuarios = [];
try {
    $result = $dbUsuarios->query("SELECT id, nombre, email, rol FROM usuarios ORDER BY nombre");
    while ($user = $result->fetch(PDO::FETCH_ASSOC)) {
        $usuarios[] = $user;
    }
} catch (PDOException $e) {
    $error = "Error al cargar usuarios: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['change_role'])) {
    $user_id = (int)($_POST['user_id'] ?? 0);
    $new_role = $_POST['new_role'] ?? 'usuario';
    if ($user_id > 0 && in_array($new_role, ['usuario', 'admin', 'administrador'])) {
        try {
            $stmt = $dbUsuarios->prepare("UPDATE usuarios SET rol = :rol WHERE id = :id");
            $stmt->bindParam(':rol', $new_role, PDO::PARAM_STR);
            $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $message = "Rol actualizado correctamente.";
        } catch (PDOException $e) {
            $error = "Error al actualizar rol: " . $e->getMessage();
        }
    } else {
        $error = "Datos inválidos para cambiar rol.";
    }
}
  if ($_SERVER["REQUEST_METHOD"] === "GET" && ($_GET['action'] ?? '') === 'delete_user' && isset($_GET['id'])) {
    $user_id = (int)$_GET['id'];
    if ($user_id > 0 && $user_id != $_SESSION['user_id']) {
        try {
            $stmt = $dbUsuarios->prepare("DELETE FROM usuarios WHERE id = :id");
            $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $message = "Usuario eliminado exitosamente.";
        } catch (PDOException $e) {
            $error = "Error al eliminar usuario: " . $e->getMessage();
        }
    } else {
        $error = "No puedes eliminar tu propio usuario o ID inválido.";
    }
}
// ------------------- AEROLÍNEAS (aerolineas.db) -------------------
// Ejemplo: obtener lista de aerolíneas
$aerolineas = [];
try {
    $result = $dbAerolineas->query("SELECT * FROM aerolineas ORDER BY nombre");
    while ($aero = $result->fetch(PDO::FETCH_ASSOC)) {
        $aerolineas[] = $aero;
    }
} catch (PDOException $e) {
    $error = "Error al cargar aerolíneas: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración - FlightAir</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Includes/Style/style.css">
    <style>
        body {
            background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
        }
        .admin-container {
            max-width: 1200px;
            margin: 40px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(44,62,80,0.18);
            padding: 36px 28px;
            overflow-x: auto;
        }
        h1 { color: #1a4e7a; letter-spacing: 1px; }
        .section-title { color: #14507a; margin-top: 32px; font-size: 1.4em; }
        .messages { margin: 18px 0; padding: 12px; border-radius: 8px; font-size: 1.1em; }
        .message-success { background: #eafaf1; color: #27ae60; border-left: 5px solid #27ae60; }
        .message-error { background: #fdeaea; color: #c82333; border-left: 5px solid #c82333; }
        .data-table { width: 100%; border-collapse: collapse; margin-top: 18px; background: #f9fbfd; }
        .data-table th, .data-table td { border: 1px solid #bfc9d1; padding: 12px; text-align: left; }
        .data-table th { background: #e4ebf5; font-weight: 600; }
        .data-table tr:nth-child(even) { background: #f4f8fb; }
        .btn { padding: 8px 20px; border-radius: 6px; border: none; font-weight: 600; cursor: pointer; transition: background 0.2s; }
        .btn-primary { background: #2980b9; color: #fff; }
        .btn-primary:hover { background: #1a4e7a; }
        .btn-edit { background: #f1c40f; color: #fff; }
        .btn-edit:hover { background: #b7950b; }
        .btn-danger { background: #c82333; color: #fff; }
        .btn-danger:hover { background: #922b21; }
        .actions { display: flex; gap: 8px; }
        .form-group { margin-bottom: 16px; }
        input[type="text"], input[type="url"], input[type="number"], select {
            width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #bfc9d1; font-size: 1em;
        }
        input[type="text"]:focus, input[type="url"]:focus, input[type="number"]:focus, select:focus {
            outline: none; border-color: #2980b9;
        }
        /* MODALES */
        .modal-bg, .modal-edit-bg, .modal-edit-bg-modelo {
            display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
            background: rgba(44,62,80,0.18); z-index: 3000; align-items: center; justify-content: center;
        }
        .modal-content, .modal-edit-content {
            background: #fff; padding: 36px 30px 30px 30px; border-radius: 18px;
            box-shadow: 0 8px 32px rgba(44,62,80,0.18); min-width: 340px; max-width: 95vw;
            position: relative; display: flex; flex-direction: column; align-items: center;
        }
        .modal-close, .modal-edit-close { position: absolute; top: 10px; right: 15px; background: none; border: none; font-size: 28px; color: #2980b9; cursor: pointer; }
        .modal-title { margin-bottom: 18px; color: #14507a; }
        .modal-form { width: 100%; }
        @media (max-width: 700px) {
            .admin-container { padding: 10px 2px; }
            .data-table th, .data-table td { font-size: 0.95em; }
            .modal-content, .modal-edit-content { min-width: 90vw; }
        }
    </style>
</head>
<body>
<?php include("Includes/header.html"); ?>
<div class="admin-container">
    <h1>Panel de Administración</h1>
    <p>
        Bienvenido, <strong><?= htmlspecialchars($_SESSION['user_username'] ?? 'Usuario') ?></strong>
        (Rol: <?= htmlspecialchars($_SESSION['user_role'] ?? '-') ?>)
        | <a href="logout.php">Cerrar Sesión</a>
    </p>
    <?php if ($message): ?>
        <div class="messages message-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="messages message-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div style="display:flex; gap:30px; flex-wrap:wrap; justify-content:center;">
        <button class="btn btn-primary" onclick="showModal('modalAddFabricanteBg')">+ Nuevo Fabricante</button>
        <button class="btn btn-primary" onclick="showModal('modalAddModeloBg')">+ Nuevo Modelo</button>
    </div>

    <h3>Fabricantes Existentes</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen (URL)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($fabricantes)): ?>
                <tr><td colspan="4">No hay fabricantes registrados.</td></tr>
            <?php else: ?>
                <?php foreach ($fabricantes as $fab): ?>
                    <tr>
                        <td><?= htmlspecialchars($fab['fab_id']) ?></td>
                        <td><?= htmlspecialchars($fab['fab_nom']) ?></td>
                        <td><a href="<?= htmlspecialchars($fab['fab_imagen']) ?>" target="_blank"><?= htmlspecialchars($fab['fab_imagen']) ?></a></td>
                        <td class="actions">
                            <button type="button" class="btn btn-edit"
                                onclick="openEditFabricanteModal(
                                    <?= $fab['fab_id'] ?>,
                                    <?= json_encode($fab['fab_nom']) ?>,
                                    <?= json_encode($fab['fab_imagen']) ?>
                                )">Editar</button>
                            <a href="?action=delete_fabricante&id=<?= $fab['fab_id'] ?>"
                            onclick="return confirm('¿Estás seguro de que quieres eliminar este fabricante? Esta acción es irreversible.');"
                            class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <h3>Modelos Existentes</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Fecha lanzamiento</th>
                <th>Velocidad máxima</th>
                <th>Fabricante</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($modelos)): ?>
                <tr><td colspan="8">No hay modelos registrados.</td></tr>
            <?php else: ?>
                <?php foreach ($modelos as $mod): ?>
                    <tr>
                        <td><?= htmlspecialchars($mod['mod_id']) ?></td>
                        <td><?= htmlspecialchars($mod['mod_nom']) ?></td>
                        <td><?= htmlspecialchars($mod['mod_descripcio']) ?></td>
                        <td><a href="<?= htmlspecialchars($mod['mod_imagen']) ?>" target="_blank"><?= htmlspecialchars($mod['mod_imagen']) ?></a></td>
                        <td><?= htmlspecialchars($mod['fecha_lanzamiento']) ?></td>
                        <td><?= htmlspecialchars($mod['velocidad_maxima']) ?></td>
                        <td><?= htmlspecialchars($mod['fab_nom']) ?></td>
                        <td class="actions">
                            <button type="button" class="btn btn-edit"
                                onclick="openEditModeloModal(
                                    <?= $mod['mod_id'] ?>,
                                    <?= json_encode($mod['mod_nom']) ?>,
                                    <?= json_encode($mod['mod_descripcio']) ?>,
                                    <?= json_encode($mod['mod_imagen']) ?>,
                                    <?= json_encode($mod['fecha_lanzamiento']) ?>,
                                    <?= json_encode($mod['velocidad_maxima']) ?>,
                                    <?= $mod['fab_id'] ?>
                                )">Editar</button>
                            <a href="?action=delete_modelo&id=<?= $mod['mod_id'] ?>"
                            onclick="return confirm('¿Estás seguro de que quieres eliminar este modelo? Esta acción es irreversible.');"
                            class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php include("Includes/footer.html"); ?>

<!-- MODAL ALTA FABRICANTE -->
<div id="modalAddFabricanteBg" class="modal-bg" style="display:none;">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('modalAddFabricanteBg')">&times;</button>
        <h2 class="modal-title">Añadir Nuevo Fabricante</h2>
        <form class="modal-form" method="POST" action="">
            <div class="form-group">
                <label for="fab_nom_add">Nombre del Fabricante:</label>
                <input type="text" id="fab_nom_add" name="fab_nom" required>
            </div>
            <div class="form-group">
                <label for="fab_imagen_add">URL de la Imagen:</label>
                <input type="url" id="fab_imagen_add" name="fab_imagen" required>
            </div>
            <button type="submit" name="add_fabricante" class="btn btn-primary">Añadir Fabricante</button>
        </form>
    </div>
</div>

<!-- MODAL ALTA MODELO -->
<div id="modalAddModeloBg" class="modal-bg" style="display:none;">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('modalAddModeloBg')">&times;</button>
        <h2 class="modal-title">Añadir Nuevo Modelo</h2>
        <form class="modal-form" method="POST" action="">
            <div class="form-group">
                <label for="modelo_nom_add">Nombre del Modelo:</label>
                <input type="text" id="modelo_nom_add" name="modelo_nom" required>
            </div>
            <div class="form-group">
                <label for="modelo_descripcio_add">Descripción:</label>
                <input type="text" id="modelo_descripcio_add" name="modelo_descripcio">
            </div>
            <div class="form-group">
                <label for="modelo_img_add">URL de la Imagen:</label>
                <input type="url" id="modelo_img_add" name="modelo_img" required>
            </div>
            <div class="form-group">
                <label for="fecha_lanzamiento_add">Fecha de Lanzamiento:</label>
                <input type="text" id="fecha_lanzamiento_add" name="fecha_lanzamiento">
            </div>
            <div class="form-group">
                <label for="velocidad_maxima_add">Velocidad Máxima:</label>
                <input type="number" id="velocidad_maxima_add" name="velocidad_maxima">
            </div>
            <div class="form-group">
                <label for="fabricante_id_add">Fabricante:</label>
                <select id="fabricante_id_add" name="fabricante_id" required>
                    <option value="">Seleccione...</option>
                    <?php foreach ($fabricantes as $fab): ?>
                        <option value="<?= $fab['fab_id'] ?>"><?= htmlspecialchars($fab['fab_nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="add_modelo" class="btn btn-primary">Añadir Modelo</button>
        </form>
    </div>
</div>

<!-- MODAL EDITAR FABRICANTE -->
<div id="editFabricanteModalBg" class="modal-edit-bg">
    <div class="modal-edit-content">
        <button id="editFabricanteModalClose" class="modal-edit-close">&times;</button>
        <h2>Editar Fabricante</h2>
        <form id="editFabricanteForm" method="POST" action="">
            <input type="hidden" id="edit_fab_id" name="fab_id">
            <div class="form-group">
                <label for="edit_fab_nom">Nombre del Fabricante:</label>
                <input type="text" id="edit_fab_nom" name="fab_nom" required>
            </div>
            <div class="form-group">
                <label for="edit_fab_imagen">URL de la Imagen:</label>
                <input type="url" id="edit_fab_imagen" name="fab_imagen" required>
            </div>
            <button type="submit" name="update_fabricante" class="btn btn-primary" id="btnUpdateFabricante">Guardar Cambios</button>
        </form>
    </div>
</div>

<!-- MODAL EDITAR MODELO -->
<div id="editModeloModalBg" class="modal-edit-bg-modelo">
    <div class="modal-edit-content">
        <button id="editModeloModalClose" class="modal-edit-close">&times;</button>
        <h2>Editar Modelo</h2>
        <form id="editModeloForm" method="POST" action="">
            <input type="hidden" id="edit_modelo_id" name="modelo_id">
            <div class="form-group">
                <label for="edit_modelo_nom">Nombre del Modelo:</label>
                <input type="text" id="edit_modelo_nom" name="modelo_nom" required>
            </div>
            <div class="form-group">
                <label for="edit_modelo_descripcio">Descripción:</label>
                <input type="text" id="edit_modelo_descripcio" name="modelo_descripcio">
            </div>
            <div class="form-group">
                <label for="edit_modelo_img">URL de la Imagen:</label>
                <input type="url" id="edit_modelo_img" name="modelo_img" required>
            </div>
            <div class="form-group">
                <label for="edit_fecha_lanzamiento">Fecha de Lanzamiento:</label>
                <input type="text" id="edit_fecha_lanzamiento" name="fecha_lanzamiento">
            </div>
            <div class="form-group">
                <label for="edit_velocidad_maxima">Velocidad Máxima:</label>
                <input type="number" id="edit_velocidad_maxima" name="velocidad_maxima">
            </div>
            <div class="form-group">
                <label for="edit_fabricante_id">Fabricante:</label>
                <select id="edit_fabricante_id" name="fabricante_id" required>
                    <option value="">Seleccione...</option>
                    <?php foreach ($fabricantes as $fab): ?>
                        <option value="<?= $fab['fab_id'] ?>"><?= htmlspecialchars($fab['fab_nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="update_modelo" class="btn btn-primary" id="btnUpdateModelo">Guardar Cambios</button>
        </form>
    </div>
</div>

<script>
    // Mostrar y cerrar modales de alta
    function showModal(id) {
        document.getElementById(id).style.display = 'flex';
    }
    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
    // Modal edición fabricante
    function openEditFabricanteModal(id, nombre, imagen) {
        document.getElementById('edit_fab_id').value = id;
        document.getElementById('edit_fab_nom').value = nombre;
        document.getElementById('edit_fab_imagen').value = imagen;
        document.getElementById('editFabricanteModalBg').style.display = 'flex';
        document.getElementById('btnUpdateFabricante').disabled = false;
    }
    document.getElementById('editFabricanteModalClose').onclick = function() {
        document.getElementById('editFabricanteModalBg').style.display = 'none';
    };
    document.getElementById('editFabricanteModalBg').onclick = function(e) {
        if (e.target === this) this.style.display = 'none';
    };
    // Modal edición modelo
    function openEditModeloModal(id, nombre, descripcio, img, fecha, velocidad, fabricante_id) {
        document.getElementById('edit_modelo_id').value = id;
        document.getElementById('edit_modelo_nom').value = nombre;
        document.getElementById('edit_modelo_descripcio').value = descripcio;
        document.getElementById('edit_modelo_img').value = img;
        document.getElementById('edit_fecha_lanzamiento').value = fecha;
        document.getElementById('edit_velocidad_maxima').value = velocidad;
        document.getElementById('edit_fabricante_id').value = fabricante_id;
        document.getElementById('editModeloModalBg').style.display = 'flex';
        document.getElementById('btnUpdateModelo').disabled = false;
    }
    document.getElementById('editModeloModalClose').onclick = function() {
        document.getElementById('editModeloModalBg').style.display = 'none';
    };
    document.getElementById('editModeloModalBg').onclick = function(e) {
        if (e.target === this) this.style.display = 'none';
    };
    // Cerrar modales de alta al hacer click fuera
    document.getElementById('modalAddFabricanteBg').onclick = function(e) {
        if (e.target === this) this.style.display = 'none';
    };
    document.getElementById('modalAddModeloBg').onclick = function(e) {
        if (e.target === this) this.style.display = 'none';
    };
</script>
</body>
</html>