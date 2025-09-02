<?php
session_start();

$db_path = '../DataBase/usuarios.db';

try {
    $db = new PDO('sqlite:' . $db_path);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['register_message'] = "Error de conexión. Intenta más tarde.";
    $_SESSION['active_tab'] = 'register';
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['register'])) {
    $nombre = trim($_POST['reg_nombre'] ?? '');
    $email = trim($_POST['reg_email'] ?? '');
    $password = $_POST['reg_password'] ?? '';

    if ($nombre === '' || $email === '' || $password === '') {
        $_SESSION['register_message'] = "Todos los campos son obligatorios.";
        $_SESSION['active_tab'] = 'register';
        header("Location: login.php");
        exit();
    }

    // Verifica si el usuario o email ya existen
    $stmt = $db->prepare("SELECT id FROM usuarios WHERE nombre = :nombre OR email = :email");
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->fetch()) {
        $_SESSION['register_message'] = "El usuario o email ya está registrado.";
        $_SESSION['active_tab'] = 'register';
        header("Location: login.php");
        exit();
    }

    // Hashea la contraseña
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Inserta el usuario
    $stmt = $db->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nombre, :email, :password, 'usuario')");
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password_hash, PDO::PARAM_STR);

    try {
        $stmt->execute();
        $_SESSION['register_message'] = "Registro exitoso. Ahora puedes iniciar sesión.";
        $_SESSION['active_tab'] = 'login';
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['register_message'] = "Error al registrar. Intenta de nuevo.";
        $_SESSION['active_tab'] = 'register';
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}