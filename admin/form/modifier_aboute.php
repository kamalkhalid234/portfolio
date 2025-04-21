<?php
session_start();
include("connexion.php");

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateNaissance = $_POST['dateNaissance'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $degree = $_POST['degree'];
    $Freelance = $_POST['Freelance'];
    $Website = $_POST['Website'];
    $city = $_POST['city'];
    $titre = $_POST['titre'];
    $texteAboute = $_POST['texteAboute'];
    $texetContact = $_POST['texetContact'];

    $image = $_FILES['image']['name'];
    $upload = false;


    if (!empty($image)) {
        $target_dir = "../assets/img/";
        $target_file = $target_dir . basename($image);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $upload = true;
        }
    }

    // Requête SQL avec ou sans image
    $sql = "UPDATE about SET nom=?, prenom=?, dateNaissance=?, Age=?, email=?, degree=?, Freelance=?, Website=?, city=?,titre=?, texteAboute=?, texetContact=?";
    if ($upload) {
        $sql .= ", image=?";
    }

    $stmt = $con->prepare($sql);

    // Lier les paramètres
    if ($upload) {
        $stmt->bind_param("sssssssssssss", $nom, $prenom, $dateNaissance, $age, $email, $degree, $Freelance, $Website, $city,$titre, $texteAboute, $texetContact, $image);
    } else {
        $stmt->bind_param("ssssssssssss", $nom, $prenom, $dateNaissance, $age, $email, $degree, $Freelance, $Website, $city,$titre, $texteAboute, $texetContact);
    }

    // Exécuter et rediriger
    if ($stmt->execute()) {
        $_SESSION['success'] = "Données mises à jour avec succès.";
        header("Location: ../pages/aboute.php");
    } else {
        $_SESSION['error'] = "Erreur de mise à jour : " . $stmt->error;
        header("Location: ../pages/aboute.php");
    }

    header("Location: ../pages/aboute.php");
    exit();
}
?>
