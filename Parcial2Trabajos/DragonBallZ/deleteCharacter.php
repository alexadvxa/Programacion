<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

include 'db.php';

// Verificar si se ha recibido el ID del personaje a eliminar
if (isset($_POST['character_id'])) {
    $character_id = $_POST['character_id'];

    // Preparar la consulta para eliminar el personaje
    $query = $pdo->prepare("DELETE FROM characters WHERE id = :character_id AND user_id = :user_id");
    $query->execute(['character_id' => $character_id, 'user_id' => $_SESSION['user_id']]);

    // Redirigir de nuevo a la lista de personajes
    header('Location: dashboardCharacters.php');
    exit();
} else {
    // Si no se recibe ningún ID, redirigir de nuevo a la lista de personajes
    header('Location: dashboardCharacters.php');
    exit();
}
