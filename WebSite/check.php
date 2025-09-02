<?php
// check.php
$password_que_intentas_usar = 'filipyhrm54';
 // <--- ¡AQUÍ PONES LA CONTRASEÑA EXACTA CON LA QUE INTENTAS INICIAR SESIÓN!
$hash_de_la_base_de_datos = '$2y$10$BqJHUBBoZzM4kLWrxv7/3eJkncZqJaraMku4HC.h42phazm.mFt6G'; // <--- ¡AQUÍ PEGAS EL HASH DE LA BD!

echo "Hash generado de la contraseña ingresada: " . password_hash($password_que_intentas_usar, PASSWORD_DEFAULT) . "<br>";
echo "Hash de la base de datos: " . $hash_de_la_base_de_datos . "<br><br>";

if (password_verify($password_que_intentas_usar, $hash_de_la_base_de_datos)) {
    echo "¡Coinciden! La contraseña y el hash son correctos.";
} else {
    echo "¡NO COINCIDEN! Hay un problema con la contraseña o el hash.";
}
?>