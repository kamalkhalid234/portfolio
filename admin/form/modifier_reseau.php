<?php
session_start();
if (!isset($_SESSION['idLogin_user'])) {
    header("Location: index.php");
    exit();
} else {
    $user_id = $_SESSION['idLogin_user'];
    include "../form/connexion.php";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['modifie'])) {
        // Récupération des données du formulaire
        $idReseau = $_POST['idReseau'];
        $githubReseau = mysqli_real_escape_string($con, $_POST['githubReseau']);
        $linkdinReseau = mysqli_real_escape_string($con, $_POST['linkdinReseau']);
        $twiterReseau = mysqli_real_escape_string($con, $_POST['twiterReseau']);

        // Vérification de la validité des URL
        if (!filter_var($githubReseau, FILTER_VALIDATE_URL)) {
            $_SESSION['error'] = "L'URL GitHub est invalide.";
            header("Location: ../pages/reseau_sociaux.php");
            exit();
        }
        if (!filter_var($linkdinReseau, FILTER_VALIDATE_URL)) {
            $_SESSION['error'] = "L'URL LinkedIn est invalide.";
            header("Location: ../pages/reseau_sociaux.php");
            exit();
        }
        if (!filter_var($twiterReseau, FILTER_VALIDATE_URL)) {
            $_SESSION['error'] = "L'URL Twitter est invalide.";
            header("Location: ../pages/reseau_sociaux.php");
            exit();
        }

        // Mise à jour dans la base de données
        $sql = "UPDATE reseau_sociau 
                SET githubReseau = '$githubReseau', linkdinReseau = '$linkdinReseau', twiterReseau = '$twiterReseau' 
                WHERE idReseau = '$idReseau'";

        if (mysqli_query($con, $sql)) {
            $_SESSION['success'] = "Les informations des réseaux sociaux ont été mises à jour avec succès.";
            header("Location: ../pages/reseau_sociaux.php");

        } else {
            $_SESSION['error'] = "Une erreur est survenue lors de la mise à jour.";
            header("Location: ../pages/reseau_sociaux.php");

        }

        // Redirection vers la page des réseaux sociaux
        header("Location: ../pages/reseau_sociaux.php");
        exit();
    }

}
?>
