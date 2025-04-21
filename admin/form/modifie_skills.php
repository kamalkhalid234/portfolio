<?php
session_start();
include("connexion.php");

// Modifier une compétence simple
if (isset($_POST['modifie'])) {
    $id = intval($_POST['idSkills']);
    $texteSkills = $_POST['texteSkills'];

    $stmt = $con->prepare("UPDATE skills SET texteSkills = ? WHERE idSkills = ?");
    $stmt->bind_param('si', $texteSkills, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Compétence modifiée avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de la modification.";
    }

    header("Location: ../pages/skills.php");
    exit();
}

// Ajouter une compétence avec degré
if (isset($_POST['ajouter'])) {
    $nomSkillsDegre = $_POST['nomSkillsDegre'];
    $degreSkillsDegre = $_POST['degreSkillsDegre'];

    $stmt = $con->prepare("INSERT INTO skills_degre (nomSkillsDegre, degreSkillsDegre) VALUES (?, ?)");
    $stmt->bind_param('si', $nomSkillsDegre, $degreSkillsDegre);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Ajout effectué avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de l'ajout : " . $stmt->error;
    }

    header("Location: ../pages/skills.php");
    exit();
}

// Modifier une compétence avec degré
if (isset($_POST['modifie_degre'])) {
    $id = intval($_POST['idSkillsDegre']);
    $nomSkillsDegre = $_POST['nomSkillsDegre'];
    $degreSkillsDegre = $_POST['degreSkillsDegre'];

    $stmt = $con->prepare("UPDATE skills_degre SET nomSkillsDegre = ?, degreSkillsDegre = ? WHERE idSkillsDegre = ?");
    $stmt->bind_param('sii', $nomSkillsDegre, $degreSkillsDegre, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Compétence modifiée avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de la modification.";
    }

    header("Location: ../pages/skills.php");
    exit();
}

// Supprimer une compétence avec degré
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $con->prepare("DELETE FROM skills_degre WHERE idSkillsDegre = ?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Compétence supprimée avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de la suppression.";
    }

    header("Location: ../pages/skills.php");
    exit();
}
?>
