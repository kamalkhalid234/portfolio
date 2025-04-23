<?php 
session_start();
include("connexion.php");

// AJOUTER
if (isset($_POST['ajoute'])) {
    $nomEducation = $_POST['nomEducation'];
    $datedebu = $_POST['datedebu'];
    $datetermine = $_POST['datetermine'];
    $titreEducation = $_POST['titreEducation'];
    $texteEducation = $_POST['texteEducation'];

    $stmt = $con->prepare("INSERT INTO education(nomEducation, datedebu, datetermine, titreEducation, texteEducation) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $nomEducation, $datedebu, $datetermine, $titreEducation, $texteEducation);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Ajout effectué avec succès.";
    } else {
        $_SESSION['error'] = "Error adding " . $stmt->error;
    }

    header("Location: ../pages/education.php");
    exit();
}

// SUPPRIMER
if (isset($_POST['supprimer'])) {
    $id = intval($_POST['idEducation']);
    $stmt = $con->prepare("DELETE FROM education WHERE idEducation = ?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Parcours supprimé avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de la suppression.";
    }

    header("Location: ../pages/education.php");
    exit();
}

// MODIFIER
if (isset($_POST['modifie'])) {
    $id = intval($_POST['idEducation']);
    $nom = $_POST['nomEducation'];
    $date_debut = $_POST['datedebu'];
    $date_fin = $_POST['datetermine'];
    $titre = $_POST['titreEducation'];
    $texte = $_POST['texteEducation'];

    $stmt = $con->prepare("UPDATE education SET nomEducation = ?, datedebu = ?, datetermine = ?, titreEducation = ?, texteEducation = ? WHERE idEducation = ?");
    $stmt->bind_param('sssssi', $nom, $date_debut, $date_fin, $titre, $texte, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Parcours modifié avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de la modification.";
    }

    header("Location: ../pages/education.php");
    exit();
}
?>
