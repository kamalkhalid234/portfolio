<?php
session_start();

if (!isset($_SESSION['idLogin_user'])) {
    header("Location: index.php");
    exit();
}

include "../form/connexion.php";

// Charger les données de l'utilisateur
$sql = "SELECT * FROM about LIMIT 1";
$result = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KAMAL - Tableau de bord</title>
  <?php include "../inc/links.php"; ?>
</head>
<body>
<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>
  <?php include "../inc/header.php"; ?>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow-lg border-0">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-user-circle me-2"></i>Informations personnelles</h4>
          </div>
          <div class="card-body p-4">
            <?php
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            ?>

            <div class="text-center mb-4">
              <img src="../assets/img/<?= htmlspecialchars($data['image']) ?>" class="rounded-circle border" width="120">
              <h5 class="mt-3"><?= htmlspecialchars($data['nom']) . " " . htmlspecialchars($data['prenom']) ?></h5>
              <p class="text-muted"><?= htmlspecialchars($data['titre']) ?></p>
            </div>
            <table class="table table-hover">
              <tbody>
                <tr><th>Date de naissance</th><td><?= htmlspecialchars($data['dateNaissance']) ?></td></tr>
                <tr><th>Âge</th><td><?= htmlspecialchars($data['Age']) ?></td></tr>
                <tr><th>Email</th><td><?= htmlspecialchars($data['email']) ?></td></tr>
                <tr><th>Diplôme</th><td><?= htmlspecialchars($data['degree']) ?></td></tr>
                <tr><th>Freelance</th><td><?= htmlspecialchars($data['Freelance']) ?></td></tr>
                <tr><th>Site web</th><td><a href="<?= htmlspecialchars($data['Website']) ?>" target="_blank"><?= htmlspecialchars($data['Website']) ?></a></td></tr>
                <tr><th>Ville</th><td><?= htmlspecialchars($data['city']) ?></td></tr>
                <tr><th>À propos</th><td><?= nl2br(htmlspecialchars($data['texteAboute'])) ?></td></tr>
                <tr><th>Contact</th><td><?= nl2br(htmlspecialchars($data['texetContact'])) ?></td></tr>
              </tbody>
            </table>

            <div class="text-center mt-4">
              <button class="btn btn-outline-primary px-4" data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fas fa-edit me-2"></i>Modifier
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <form action="../form/modifier_aboute.php" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Modifier les informations</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body ">
            <!-- Champs -->
            <div class="mb-3"><label>Nom</label><input type="text" name="nom" class="form-control" value="<?= $data['nom'] ?>" required></div>
            <div class="mb-3"><label>Prénom</label><input type="text" name="prenom" class="form-control" value="<?= $data['prenom'] ?>" required></div>
            <div class="mb-3"><label>Date de naissance</label><input type="date" name="dateNaissance" class="form-control" value="<?= $data['dateNaissance'] ?>" required></div>
            <div class="mb-3"><label>Âge</label><input type="number" name="age" class="form-control" value="<?= $data['Age'] ?>" required></div>
            <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" value="<?= $data['email'] ?>" required></div>
            <div class="mb-3"><label>Diplôme</label><input type="text" name="degree" class="form-control" value="<?= $data['degree'] ?>" required></div>
            <div class="mb-3"><label>Freelance</label><input type="text" name="Freelance" class="form-control" value="<?= $data['Freelance'] ?>" required></div>
            <div class="mb-3"><label>Titre</label><input type="text" name="titre" class="form-control" value="<?= $data['titre'] ?>" required></div>


            <div class="mb-3"><label>Site web</label><input type="url" name="Website" class="form-control" value="<?= $data['Website'] ?>" required></div>
            <div class="mb-3"><label>Ville</label><input type="text" name="city" class="form-control" value="<?= $data['city'] ?>" required></div>
            <div class="mb-3"><label>À propos</label><textarea name="texteAboute" class="form-control" required><?= $data['texteAboute'] ?></textarea></div>
            <div class="mb-3"><label>Contact</label><textarea name="texetContact" class="form-control" required><?= $data['texetContact'] ?></textarea></div>
            <div class="mb-3"><label>Image</label><input type="file" name="image" class="form-control"></div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-primary">Enregistrer</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- JS -->
   <!-- JS Files -->
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/aos/aos.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../assets/vendor/typed.js/typed.min.js"></script>
<script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>
<script src="../assets/js/main.js"></script>
    
</body>
</html>
