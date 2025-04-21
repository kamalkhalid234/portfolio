<?php 

$localhost = "localhost";
$root = "root";
$modpasse = "";
$base = "portfolieur_kamal";

$con = new mysqli($localhost, $root , $modpasse , $base);

if($con->connect_errno) die ('Erreur de connexion erreur');


?>