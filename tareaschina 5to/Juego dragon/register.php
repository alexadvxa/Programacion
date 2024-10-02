<?php
include 'db.php'; //Importar información de un archivo externo
if (isset($_POST['register'])) { //Si doy clic a un boton llamado register+
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $avatar = $_POST['avatar']; // Avatar asignado aleatoriamente

    // Comprobamos si el email ya existe
    $checkEmail = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $checkEmail->execute(['email' => $email]);
    if ($checkEmail->rowCount() > 0) {
        $error = "El correo ya está registrado.";
    } else {
        // Insertamos el nuevo usuario
        $query = $pdo->prepare("INSERT INTO users (name, email, password, avatar) VALUES (:name, :email, :password, :avatar)");
        $query->execute(['name' => $name, 'email' => $email, 'password' => $password, 'avatar' => $avatar]);
        //echo $password."---".$_POST['password'];
        header('Location: index.php');
        exit();
    }
}
?>