<?php
session_start();

$error_message = $_SESSION['login_error_message'] ?? '';
unset($_SESSION['login_error_message']);

$register_message = $_SESSION['register_message'] ?? '';
unset($_SESSION['register_message']);

$active_tab = $_SESSION['active_tab'] ?? 'login';
unset($_SESSION['active_tab']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso - FlightAir</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Includes/Style/login.css">

</head>
<body>
    <?php include("Includes/header.html"); ?>
     <div class="center-container">
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="welcome-bar">
            ¡Bienvenido, <strong><?= htmlspecialchars($_SESSION['user_username']) ?></strong>!
            Eres un <span><?= htmlspecialchars($_SESSION['user_role']) ?></span>.
            | <a href="logout.php">Cerrar Sesión</a>
        </div>
    <?php endif; ?>

   
        <div class="login-box">
            <div class="tab-bar">
                <button class="tab-btn <?php echo ($active_tab == 'login') ? 'active' : ''; ?>" id="tab-login-btn" type="button">Iniciar Sesión</button>
                <button class="tab-btn <?php echo ($active_tab == 'register') ? 'active' : ''; ?>" id="tab-register-btn" type="button">Registrarse</button>
            </div>
            <div class="tab-content <?php echo ($active_tab == 'login') ? 'active' : ''; ?>" id="tab-login-content">
                <?php if ($error_message): ?>
                    <div class="msg-error"><?= htmlspecialchars($error_message) ?></div>
                <?php endif; ?>
                <form id="form-login" method="POST" action="login.proc.php">
                    <input type="hidden" name="login" value="1">
                    <label for="nombre_o_email">Usuario o Email:</label>
                    <input type="text" id="nombre_o_email" name="nombre_o_email" required>
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                    <button type="submit">Entrar</button>
                </form>
            </div>
            <div class="tab-content <?php echo ($active_tab == 'register') ? 'active' : ''; ?>" id="tab-register-content">
                <?php if ($register_message): ?>
                    <div class="<?= strpos($register_message, 'exitoso') !== false ? 'msg-ok' : 'msg-error' ?>">
                        <?= htmlspecialchars($register_message) ?>
                    </div>
                <?php endif; ?>
                <form id="form-register" method="POST" action="registrar.php">
                    <input type="hidden" name="register" value="1">
                    <label for="reg_nombre">Usuario:</label>
                    <input type="text" id="reg_nombre" name="reg_nombre" required>
                    <label for="reg_email">Email:</label>
                    <input type="email" id="reg_email" name="reg_email" required>
                    <label for="reg_password">Contraseña:</label>
                    <input type="password" id="reg_password" name="reg_password" required>
                    <button type="submit">Registrarse</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Tabs
        const tabLoginBtn = document.getElementById('tab-login-btn');
        const tabRegisterBtn = document.getElementById('tab-register-btn');
        const tabLoginContent = document.getElementById('tab-login-content');
        const tabRegisterContent = document.getElementById('tab-register-content');

        tabLoginBtn.addEventListener('click', function() {
            tabLoginBtn.classList.add('active');
            tabRegisterBtn.classList.remove('active');
            tabLoginContent.classList.add('active');
            tabRegisterContent.classList.remove('active');
        });
        tabRegisterBtn.addEventListener('click', function() {
            tabRegisterBtn.classList.add('active');
            tabLoginBtn.classList.remove('active');
            tabRegisterContent.classList.add('active');
            tabLoginContent.classList.remove('active');
        });

        // Si hay error o mensaje, mostrar la pestaña correspondiente
        <?php if ($error_message || $register_message): ?>
            document.addEventListener('DOMContentLoaded', function() {
                <?php if ($active_tab == 'register'): ?>
                    tabRegisterBtn.click();
                <?php else: ?>
                    tabLoginBtn.click();
                <?php endif; ?>
            });
        <?php endif; ?>
    </script>
</body>
</html>