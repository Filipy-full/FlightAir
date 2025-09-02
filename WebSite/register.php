<?php
include("Includes/db_connect.php");
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)");
    $stmt->bindValue(':nombre', $nombre, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);

    if ($stmt->execute()) {
        $msg = "Usuario registrado correctamente.";
    } else {
        $msg = "Error al registrar usuario.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro | FlightAir</title>
    <link rel="stylesheet" href="Style/style.css">
</head>
<body>
    <?php include("Includes/header.html"); ?>
    <main>
        <h2 id="titulo-registro">Registro de Usuario</h2>
        <?php if($msg) echo "<p>$msg</p>"; ?>
        <form id="form-registro-usuario" action="registro.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" id="btn-registrar-usuario">Registrarse</button>
        </form>
        <a href="index.php" id="link-inicio">Volver al inicio</a>
    </main>
    <?php include("Includes/footer.html"); ?>
</body>
</html>