<?php 
// Connexion à la base de données
include "../form/connexion.php";

// Requête de la base de données pour récupérer les informations d'about
$sql = "SELECT * FROM about";
$result = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($result);

// Requête de la base de données pour récupérer les informations des réseaux sociaux
$sql_Reseau = "SELECT * FROM reseau_sociau";
$result_Reseau = mysqli_query($con, $sql_Reseau);
$data_Reseau = mysqli_fetch_assoc($result_Reseau);

?>

<!-- ======= Header ======= -->
<header id="header">
  <div class="d-flex flex-column">
    <div class="profile">
      <!-- ======= Image de profil ======= -->
      <img
        src="../assets/img/<?= htmlspecialchars($data['image'] ?: 'default-profile.jpg') ?>" 
        alt="Profile Image" 
        class="img-fluid rounded-circle"
      />
      <h1 class="text-light">
        <a href="../index.html"><?= htmlspecialchars($data['nom'] . " " . $data['prenom']) ?></a>
      </h1>
    </div>

    <nav id="navbar" class="nav-menu navbar">
  <ul>
    <li>
      <a href="aboute.php" class="nav-link scrollto">
        <i class="bx bx-user"></i> <span>About</span>
      </a>
    </li>
    <li>
      <a href="education.php">
        <i class="bx bx-book"></i> <span>Education</span>
      </a>
    </li>
    <li>
      <a href="Experience.php" class="nav-link scrollto">
        <i class="bx bx-briefcase"></i> <span>Experience</span>
      </a>
    </li>
    <li>
      <a href="project.php" class="nav-link scrollto">
        <i class="bx bx-code-block"></i> <span>Project</span>
      </a>
    </li>
    <li>
      <a href="skills.php" class="nav-link scrollto">
        <i class="bx bx-brain"></i> <span>Skills</span>
      </a>
    </li>
    <li>
      <a href="testimonials.php" class="nav-link scrollto">
        <i class="bx bx-comment-detail"></i> <span>Testimonials</span>
      </a>
    </li>
    <li>
      <a href="reseau_sociaux.php" class="nav-link scrollto">
        <i class="bx bx-world"></i> <span>Reseau Sociau</span>
      </a>
    </li>
    <li>
      <a href="contacte.php" class="nav-link scrollto">
        <i class="bx bx-phone"></i> <span>Contacte</span>
      </a>
    </li>
  </ul>
</nav>

    <!-- End Navbar -->
  </div>
</header>
<!-- End Header -->
