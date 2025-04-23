<?php 
session_start();
include("connexion.php");


if(isset($_POST['supprime'])){
    $id = intval($_POST['idContact']);
    $stmt = $con->prepare("DELETE FROM contact WHERE  idContact = ?");
    $stmt->bind_param('i',$id);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Message sent successfully";
    } else {
        $_SESSION['error'] = "Erreur";
    }

    header("Location: ../pages/contacte.php");
    exit();



}

?>
