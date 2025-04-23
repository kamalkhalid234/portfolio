<?php
session_start();
include 'connexion.php';

if (isset($_POST['conecte'])) {
    $login = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $con->prepare("SELECT * FROM `login` WHERE `username` = ? AND `password` = ?");
    $stmt->bind_param("ss", $login, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username_user'] = $user['username']; 
        $_SESSION['idLogin_user'] = $user['idLogin'];
        header("Location: ../pages/aboute.php?msg=connecte");
        exit();
    } else {
        header("Location: ../index.php?msg=" . urlencode("Nom d'utilisateur ou mot de passe incorrect"));
        exit();
    }
}

// $stmt = $con->prepare("SELECT * FROM `login` WHERE `username` = ? AND `password` = ?");
// $stmt->bind_param("ss", $login, $password);
// SELECT * FROM `login` WHERE `username` = '$login' AND `password` =' OR '1'='1'
?>
