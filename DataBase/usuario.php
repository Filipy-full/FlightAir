<?php

// Crear o abrir la base de datos SQLite
$db = new SQLite3('usuarios.db');

$db->exec("DROP TABLE IF EXISTS usuarios");

$db->exec("CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    rol VARCHAR(50) NOT NULL DEFAULT 'usuario' -- 'usuario' o 'administrador'
);");
// Insertar un usuario administrador por defecto
$hasjeada = password_hash('filipyhrm54', PASSWORD_DEFAULT);
$hash = '$2y$10$BqJHUBBoZzM4kLWrxv7/3eJkncZqJaraMku4HC.h42phazm.mFt6G'; // Hash de ejemplo
$db->exec("INSERT INTO usuarios (nombre, email, password, rol)
VALUES ('Filipy', 'filipyhenrique54@gmail.com', '$hash', 'admin');");

$password_plano = 'filipyhrm54';
$password_hasheada = password_hash($password_plano, PASSWORD_DEFAULT);

echo "Contraseña en texto plano: " . $password_plano . "\n";
echo "Su hash (ejemplo): " . $password_hasheada . "\n";
?>