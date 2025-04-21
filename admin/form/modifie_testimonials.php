<?php
session_start();

if (!isset($_SESSION['idLogin_user'])) {
    header("Location: index.php");
    exit();
} else {
    $user_id = $_SESSION['idLogin_user'];
    include "connexion.php";
}

// Ajouter un témoignage
if (isset($_POST['ajouter'])) {
    $nom = mysqli_real_escape_string($con, $_POST['nomTestimonials']);
    $titre = mysqli_real_escape_string($con, $_POST['titreTestimonials']);
    $texte = mysqli_real_escape_string($con, $_POST['texteTestimonials']);

    // Traitement de l'image
    if (!empty($_FILES['imageTestimonials']['name'])) {
        $image = $_FILES['imageTestimonials']['name'];
        $tmp = $_FILES['imageTestimonials']['tmp_name'];
        $imagePath = "../assets/img/testimonials/" . $image;
        move_uploaded_file($tmp, $imagePath);
    } else {
        $image = null;
    }

    // Insertion en base
    $sql = "INSERT INTO testimonials (nomTestimonials, titreTestimonials, texteTestimonials, imageTestimonials)
            VALUES ('$nom', '$titre', '$texte', '$image')";
    if (mysqli_query($con, $sql)) {
        $_SESSION['success'] = "Témoignage ajouté avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de l'ajout: " . mysqli_error($con);
    }

    header("Location: ../pages/testimonials.php");
    exit();
}

// Modifier un témoignage
if (isset($_POST['modifie'])) {
    $id = $_POST['idTestimonials'];
    $nom = mysqli_real_escape_string($con, $_POST['nomTestimonials']);
    $titre = mysqli_real_escape_string($con, $_POST['titreTestimonials']);
    $texte = mysqli_real_escape_string($con, $_POST['texteTestimonials']);

    // Image : nouvelle ou ancienne ?
    if (isset($_FILES['imageTestimonials']) && $_FILES['imageTestimonials']['error'] == 0) {
        $image = $_FILES['imageTestimonials']['name'];
        move_uploaded_file($_FILES['imageTestimonials']['tmp_name'], "../assets/img/testimonials/" . $image);
    } else {
        $image = $_POST['old_image']; // on conserve l'ancienne
    }

    // Mise à jour
    $sql = "UPDATE testimonials 
            SET nomTestimonials = '$nom', titreTestimonials = '$titre', texteTestimonials = '$texte', imageTestimonials = '$image'
            WHERE idTestimonials = '$id'";
    
    if (mysqli_query($con, $sql)) {
        $_SESSION['success'] = "Témoignage modifié avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de la modification: " . mysqli_error($con);
    }

    header("Location: ../pages/testimonials.php");
    exit();
}

// Suppression d'un témoignage
if (isset($_POST['supprimer'])) {
    $id = $_POST['idTestimonials'];

    // Récupérer l'image du témoignage à supprimer
    $sql = "SELECT imageTestimonials FROM testimonials WHERE idTestimonials = '$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $imagePath = "../assets/img/testimonials/" . $row['imageTestimonials'];

    // Supprimer l'image du dossier
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    // Supprimer le témoignage de la base de données
    $sql = "DELETE FROM testimonials WHERE idTestimonials = '$id'";
    if (mysqli_query($con, $sql)) {
        header("Location: ../pages/testimonials.php");
        $_SESSION['error'] = "Témoignage supprime avec succès.";

    } else {
        echo "Erreur lors de la suppression du témoignage : " . mysqli_error($con);
    }
}
?>
