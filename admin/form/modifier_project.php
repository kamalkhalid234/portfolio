<?php
session_start();

if (!isset($_SESSION['idLogin_user'])) {
    header("Location: index.php");
    exit();
} else {
    $user_id = $_SESSION['idLogin_user'];
    include "../form/connexion.php";
}

// Ajouter un projet
if (isset($_POST['ajoute'])) {
    $nomProjects = mysqli_real_escape_string($con, $_POST['nomProjects']);
    $typeProjects = mysqli_real_escape_string($con, $_POST['typeProjects']);
    $lienProjects = !empty($_POST['lienProjects']) ? mysqli_real_escape_string($con, $_POST['lienProjects']) : null;

    // Gestion de l'image
    if ($_FILES['imageProjects']['name'] != '') {
        $imageName = $_FILES['imageProjects']['name'];
        $imageTmpName = $_FILES['imageProjects']['tmp_name'];
        $imagePath = "../assets/img/portfolio/" . $imageName;
        move_uploaded_file($imageTmpName, $imagePath);
    } else {
        $imageName = null;  // Pas d'image, on garde null
    }

    // Requête d'ajout
    $sql = "INSERT INTO projects (`nomProjects`, `imageProjects`, `lienProjects`, `typeProjects`) 
            VALUES ('$nomProjects', '$imageName', '$lienProjects', '$typeProjects')";

    if (mysqli_query($con, $sql)) {
        $_SESSION['success'] = "Projet ajouté avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de l'ajout du projet: " . mysqli_error($con);
    }
    header("Location: ../pages/project.php");
    exit();
}

// Modifier un projet
if (isset($_POST['modifie'])) {
    $idProjects = $_POST['idProjects'];
    $nomProjects = mysqli_real_escape_string($con, $_POST['nomProjects']);
    $typeProjects = mysqli_real_escape_string($con, $_POST['typeProjects']);
    $lienProjects = !empty($_POST['lienProjects']) ? mysqli_real_escape_string($con, $_POST['lienProjects']) : null;

    // Si une nouvelle image est téléchargée, utiliser cette image, sinon garder l'ancienne
if (isset($_FILES['imageProjects']) && $_FILES['imageProjects']['error'] == 0) {
    // Gérer l'image téléchargée (nom, chemin, etc.)
    $imageProjects = $_FILES['imageProjects']['name'];  // Exemple de récupération du nom de l'image
    // Déplacer l'image dans le dossier adéquat
    move_uploaded_file($_FILES['imageProjects']['tmp_name'], "../assets/img/portfolio/" . $imageProjects);
} else {
    // Si aucune nouvelle image n'est téléchargée, garder l'ancienne image
    $imageProjects = $_POST['old_image'];
}

    // Requête de mise à jour
    $sql = "UPDATE projects SET 
            nomProjects = '$nomProjects', 
            imageProjects = '$imageProjects', 
            lienProjects = '$lienProjects', 
            typeProjects = '$typeProjects' 
        WHERE idProjects = '$idProjects'";

    if (mysqli_query($con, $sql)) {
        $_SESSION['success'] = "Projet modifié avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de la modification du projet: " . mysqli_error($con);
    }
    header("Location: ../pages/project.php");
    exit();
}

// Supprimer un projet
if (isset($_POST['supprimer'])) {
    $idProjects = $_POST['idProjects'];

    // Supprimer l'image si elle existe
    $sql = "SELECT imageProjects FROM projects WHERE idProjects = '$idProjects'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row['imageProjects']) {
        // Supprimer l'image du dossier si elle existe
        unlink("../assets/img/portfolio/" . $row['imageProjects']);
    }

    // Supprimer le projet
    $sql = "DELETE FROM projects WHERE idProjects = '$idProjects' ";
    
    if (mysqli_query($con, $sql)) {
        $_SESSION['success'] = "Projet supprimé avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de la suppression du projet: " . mysqli_error($con);
    }

    header("Location: ../pages/project.php");
    exit();
}
?>
