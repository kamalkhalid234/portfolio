<?php 

session_start();
include("connexion.php");

// AJOUTER
if (isset($_POST['ajoute'])) {
    $nomExperience = $_POST['nomExperience'];
    $dateDepart = $_POST['dateDepart'];
    $dateTermine = $_POST['dateTermine'];
    $titreExperience = $_POST['titreExperience'];
    $texteExperience = $_POST['texteExperience'];

    $stmt = $con->prepare("INSERT INTO experience(nomExperience, dateDepart, dateTermine, titreExperience, texteExperience) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $nomExperience, $dateDepart, $dateTermine, $titreExperience, $texteExperience);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Ajout effectué avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de l'ajout : " . $stmt->error;
    }

    header("Location: ../pages/experience.php");
    exit();
}

// SUPPRIMER
if (isset($_POST['supprimer'])) {
    $id = intval($_POST['idExperience']);
    $stmt = $con->prepare("DELETE FROM experience WHERE idExperience = ?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Parcours supprimé avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de la suppression.";
    }

    header("Location: ../pages/experience.php");
    exit();
}

// MODIFIER
if (isset($_POST['modifie'])) {
    $id = intval($_POST['idExperience']);
    $nom = $_POST['nomExperience'];
    $date_debut = $_POST['dateDepart'];
    $date_fin = $_POST['dateTermine'];
    $titre = $_POST['titreExperience'];
    $texte = $_POST['texteExperience'];

    $stmt = $con->prepare("UPDATE experience SET nomExperience = ?, dateDepart = ?, dateTermine = ?, titreExperience = ?, texteExperience = ? WHERE idExperience = ?");
    $stmt->bind_param('sssssi', $nom, $date_debut, $date_fin, $titre, $texte, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Parcours modifié avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de la modification.";
    }

    header("Location: ../pages/experience.php");
    exit();
}

?>