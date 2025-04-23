<?php
session_start();
include("connexion.php");

if (isset($_POST['submit'])) {
    // Filtrer et valider les données POST
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
    $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_STRING);
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $degree = filter_input(INPUT_POST, 'degree', FILTER_SANITIZE_STRING);
    $Freelance = filter_input(INPUT_POST, 'Freelance', FILTER_SANITIZE_STRING);
    $Website = filter_input(INPUT_POST, 'Website', FILTER_SANITIZE_URL);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_STRING);
    $texteAboute = filter_input(INPUT_POST, 'texteAboute', FILTER_SANITIZE_STRING);

    // Gestion des fichiers (image et CV)
    $image = $_FILES['image']['name'];
    $cv = $_FILES['cv']['name'];
    $upload_image = false;
    $upload_cv = false;

    // Fonction pour uploader un fichier
    function uploadFile($file, $targetDir) {
        $fileName = $file['name'];
        if (!empty($fileName)) {
            $targetFile = $targetDir . basename($fileName);
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                return $fileName;
            }
        }
        return false;
    }

    // Upload de l'image
    $image = uploadFile($_FILES['image'], "../assets/img/");
    if ($image) {
        $upload_image = true;
    }

    // Upload du CV
    $cv = uploadFile($_FILES['cv'], "../assets/pdf/");
    if ($cv) {
        $upload_cv = true;
    }

    // Construction de la requête SQL
    $sql = "UPDATE about SET nom=?, prenom=?, dateNaissance=?, Age=?, email=?, degree=?, Freelance=?, Website=?, city=?, titre=?, texteAboute=?";

    // Ajout des champs image et cv seulement s'ils sont uploadés
    if ($upload_cv) {
        $sql .= ", cv=?";
    }

    if ($upload_image) {
        $sql .= ", image=?";
    }


    $stmt = $con->prepare($sql);

    // Vérification de la préparation de la requête
    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $con->error);
    }

    // Définition des types de paramètres
    $types = "sssssssssss";
    $params = [$nom, $prenom, $dateNaissance, $age, $email, $degree, $Freelance, $Website, $city, $titre, $texteAboute];

    // Ajout des paramètres cv et image
    if ($upload_cv) {
        $types .= "s";
        $params[] = $cv;
    }

    if ($upload_image) {
        $types .= "s";
        $params[] = $image;
    }

    // Binding des paramètres
    $stmt->bind_param($types, ...$params);

    // Exécution de la requête
    if ($stmt->execute()) {
        $_SESSION['success'] = "Données mises à jour avec succès.";
    } else {
        $_SESSION['error'] = "Erreur de mise à jour : " . $stmt->error;
    }

    // Fermeture du statement
    $stmt->close();

    // Redirection
    header("Location: ../pages/aboute.php");
    exit();
}

// Fermeture de la connexion
$con->close();
?>
