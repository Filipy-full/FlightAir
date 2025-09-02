<?php
session_start();

$db_path = '../DataBase/usuarios.db';

try {
    $db = new PDO('sqlite:' . $db_path);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error de conexión a la base de datos: " . $e->getMessage());
    $_SESSION['login_error_message'] = "Problema con el servidor. Intenta de nuevo más tarde.";
    $_SESSION['active_tab'] = 'login';
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {
    $nombre_o_email = trim($_POST['nombre_o_email']);
    $password = $_POST['password'];

    if (empty($nombre_o_email) || empty($password)) {
        $_SESSION['login_error_message'] = "Por favor, introduce tu usuario/email y contraseña.";
        $_SESSION['active_tab'] = 'login';
        header("Location: login.php");
        exit();
    }

    try {
        $stmt = $db->prepare("SELECT id, nombre, email, password, rol FROM usuarios WHERE nombre = :input OR email = :input");
        $stmt->bindParam(':input', $nombre_o_email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_username'] = $user['nombre'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['rol'];

            if ($_SESSION['user_role'] === 'admin') {
                header("Location: index_admin.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $_SESSION['login_error_message'] = "Usuario/Email o contraseña incorrectos.";
            $_SESSION['active_tab'] = 'login';
            header("Location: login.php");
            exit();
        }
    } catch (PDOException $e) {
        error_log("Error en la consulta de login: " . $e->getMessage());
        $_SESSION['login_error_message'] = "Error al intentar iniciar sesión. Por favor, intenta de nuevo.";
        $_SESSION['active_tab'] = 'login';
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}