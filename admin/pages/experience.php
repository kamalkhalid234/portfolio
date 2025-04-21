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
  <title>Parcours Éducatif</title>
  <?php include "../inc/links.php"; ?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>
<?php include "../inc/header.php"; ?>

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0"><i class="fas fa-briefcase me-2"></i>Parcours Expérience</h4>
      <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#ajouteModal">
        <i class="fas fa-plus me-1"></i>Ajouter
      </button>
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

      $sql = "SELECT * FROM `experience`";
      $result = mysqli_query($con, $sql);

      if (mysqli_num_rows($result) == 0) {
          echo "<p class='text-danger'>Aucune expérience trouvée.</p>";
      }

      while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="experience-card mb-4 p-3 border rounded">
          <div class="experience-card-header">
            <h5><?= htmlspecialchars($row['nomExperience']) ?> (<?= $row['dateDepart'] ?> → <?= $row['dateTermine'] ?>)</h5>
          </div>
          <div class="experience-card-body">
            <strong><?= htmlspecialchars($row['titreExperience']) ?></strong>
            <p><?= htmlspecialchars($row['texteExperience']) ?></p>
          </div>
          <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['idExperience'] ?>">
              <i class="fas fa-edit"></i> Modifier
            </button>
            <form action="../form/modifie_experience.php" method="POST" onsubmit="return confirm('Supprimer ce parcours ?');">
              <input type="hidden" name="idExperience" value="<?= $row['idExperience'] ?>">
              <button type="submit" name="supprimer" class="btn btn-sm btn-outline-danger">
                <i class="fas fa-trash-alt"></i> Supprimer
              </button>
            </form>
          </div>
        </div>

        <!-- MODAL DE MODIFICATION -->
        <div class="modal fade" id="editModal<?= $row['idExperience'] ?>" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="../form/modifie_experience.php" method="POST">
                <input type="hidden" name="idExperience" value="<?= $row['idExperience'] ?>">
                <div class="modal-header">
                  <h5 class="modal-title">Modifier le parcours</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3"><label>Nom</label><input type="text" name="nomExperience" class="form-control" value="<?= htmlspecialchars($row['nomExperience']) ?>" required></div>
                  <div class="mb-3"><label>Date début</label><input type="date" name="dateDepart" class="form-control" value="<?= $row['dateDepart'] ?>" required></div>
                  <div class="mb-3"><label>Date fin</label><input type="date" name="dateTermine" class="form-control" value="<?= $row['dateTermine'] ?>" required></div>
                  <div class="mb-3"><label>Titre</label><textarea name="titreExperience" class="form-control" required><?= htmlspecialchars($row['titreExperience']) ?></textarea></div>
                  <div class="mb-3"><label>Description</label><textarea name="texteExperience" class="form-control" required><?= htmlspecialchars($row['texteExperience']) ?></textarea></div>
                </div>
                <div class="modal-footer">
                  <button type="submit" name="modifie" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

<!-- MODAL D’AJOUT -->
<div class="modal fade" id="ajouteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../form/modifie_experience.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter une expérience</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3"><label>Nom</label><input type="text" name="nomExperience" class="form-control" required></div>
          <div class="mb-3"><label>Date début</label><input type="date" name="dateDepart" class="form-control" required></div>
          <div class="mb-3"><label>Date fin</label><input type="date" name="dateTermine" class="form-control"></div>
          <div class="mb-3"><label>Titre</label><textarea name="titreExperience" class="form-control" required></textarea></div>
          <div class="mb-3"><label>Description</label><textarea name="texteExperience" class="form-control"></textarea></div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="ajoute" class="btn btn-success">Ajouter</button>
        </div>
      </form>
    </div>
  </div>
</div>

  <!-- Vendor JS Files -->
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

