<?php
include("Includes/db_connect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email_suscripcion'] ?? '');
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $db->prepare("INSERT INTO suscripciones (email) VALUES (:email)");
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        if (!$stmt->execute()) {
            die("Error al insertar: " . $db->lastErrorMsg());
        }
        header("Location: index.php?sub=ok");
        exit;
    } else {
        header("Location: index.php?sub=invalid");
        exit;
    }
}
?>