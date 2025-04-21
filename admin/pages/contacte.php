<?php
session_start();
if (!isset($_SESSION['idLogin_user'])) {
    header("Location: index.php");
    exit();
} else {
    $user_id = $_SESSION['idLogin_user'];
    include "../form/connexion.php";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Page de Contact</title>
  <?php include "../inc/links.php"; ?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>
<?php include "../inc/header.php"; ?>

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0"><i class="fas fa-phone me-2"></i>Messages Reçus</h4>
    </div>
    <div class="card-body">
      <?php
      if (isset($_SESSION['success'])) {
          echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
          unset($_SESSION['success']);
      }
      if (isset($_SESSION['error'])) {
          echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
          unset($_SESSION['error']);
      }

      $sql = "SELECT * FROM `contact` ORDER BY idContact DESC";
      $result = mysqli_query($con, $sql);

      if (mysqli_num_rows($result) == 0) {
          echo "<p class='text-muted'>Aucun message reçu pour le moment.</p>";
      }

      while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="card mb-4 border shadow-sm">
          <div class="card-header bg-light">
            <strong><?= htmlspecialchars($row['nameContact']) ?></strong> - 
            <span class="text-muted"><?= htmlspecialchars($row['emailContact']) ?></span>
          </div>
          <div class="card-body">
            <h6 class="text-primary"><?= htmlspecialchars($row['subjectContact']) ?></h6>
            <p><?= nl2br(htmlspecialchars($row['messageContact'])) ?></p>
            <div class="text-end">
              <form action="../form/modifie_contacte.php" method="POST" onsubmit="return confirm('Supprimer ce message ?');">
                <input type="hidden" name="idContact" value="<?= $row['idContact'] ?>">
                <button type="submit" name="supprime" class="btn btn-sm btn-danger">
                  <i class="fas fa-trash-alt"></i> Supprimer
                </button>
              </form>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

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
