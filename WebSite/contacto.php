<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new PDO('sqlite:../DataBase/aviones.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $mensaje = trim($_POST['mensaje']);

    $stmt = $db->prepare("INSERT INTO contactos (nombre, email, mensaje) VALUES (:nombre, :email, :mensaje)");
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $log = "[" . date('Y-m-d H:i:s') . "] Nombre: $nombre | Email: $email\nMensaje: $mensaje\n--------------------------\n";
        file_put_contents(__DIR__ . '/mensajes_contacto.txt', $log, FILE_APPEND | LOCK_EX);

        $msg = "Mensaje enviado correctamente.";
    } else {
        $msg = "Error al enviar mensaje.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto | FlightAir</title>
    <link rel="stylesheet" href="Includes/Style/contacto.css">
</head>
<body>
    <?php include("Includes/header.html"); ?>
    <main>
        <?php if($msg): ?>
            <div class="msg-contacto"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>
        <form id="form-contacto" action="contacto.php" method="POST">
            <h2 id="titulo-contacto">Contacto</h2>
            <label for="nombre-contacto">Nombre:</label>
            <input type="text" id="nombre-contacto" name="nombre" required>
            <label for="email-contacto">Correo electrónico:</label>
            <input type="email" id="email-contacto" name="email" required>
            <label for="mensaje-contacto">Mensaje:</label>
            <textarea id="mensaje-contacto" name="mensaje" required></textarea>
            <button type="submit" id="btn-enviar-contacto">Enviar</button>
        </form>
    </main>
    <?php include("Includes/footer.html"); ?>
</body>
</html>