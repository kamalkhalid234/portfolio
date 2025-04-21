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
      <h4 class="mb-0"><i class="fas fa-book me-2"></i>Parcours Éducatif</h4>
      <a href="ajouter_education.php" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#ajouteModal">
        <i class="fas fa-plus me-1"></i>Ajouter
      </a>
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

      $sql = "SELECT * FROM `education`";
      $result = mysqli_query($con, $sql);

      if (mysqli_num_rows($result) == 0) {
          echo "<p class='text-danger'>Aucun parcours éducatif trouvé.</p>";
      }

      while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="education-card mb-4 p-3 border rounded">
          <div class="education-card-header">
            <h5><?= htmlspecialchars($row['nomEducation']) ?> (<?= $row['datedebu'] ?> → <?= $row['datetermine'] ?>)</h5>
          </div>
          <div class="education-card-body">
            <strong><?= htmlspecialchars($row['titreEducation']) ?></strong>
            <p><?= htmlspecialchars($row['texteEducation']) ?></p>
          </div>
          <div class="d-flex justify-content-end">
            <!-- Bouton Modifier -->
            <button class="btn btn-sm btn-outline-primary me-2" name="modifie" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['idEducation'] ?>">
              <i class="fas fa-edit"></i> Modifier
            </button>

            <!-- Formulaire Supprimer -->
            <form action="../form/modifie_education.php" method="POST" onsubmit="return confirm('Supprimer ce parcours ?');">
              <input type="hidden" name="idEducation" value="<?= $row['idEducation'] ?>">
              <button type="submit" name="supprimer" class="btn btn-sm btn-outline-danger">
                <i class="fas fa-trash-alt"></i> Supprimer
              </button>
            </form>
          </div>
        </div>
      

    
        <!-- Modal spécifique à cette entrée -->
        <div class="modal fade" id="editModal<?= $row['idEducation'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['idEducation'] ?>" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="../form/modifie_education.php" method="POST">
                <input type="hidden" name="idEducation" value="<?= $row['idEducation'] ?>">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel<?= $row['idEducation'] ?>">Modifier le parcours éducatif</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label>Nom</label>
                    <input type="text" name="nomEducation" class="form-control" value="<?= htmlspecialchars($row['nomEducation']) ?>" required>
                  </div>
                  <div class="mb-3">
                    <label>Date début</label>
                    <input type="date" name="datedebu" class="form-control" value="<?= $row['datedebu'] ?>" required>
                  </div>
                  <div class="mb-3">
                    <label>Date fin</label>
                    <input type="date" name="datetermine" class="form-control" value="<?= $row['datetermine'] ?>" required>
                  </div>
                  <div class="mb-3">
                    <label>Titre</label>
                    <textarea name="titreEducation" class="form-control" required><?= htmlspecialchars($row['titreEducation']) ?></textarea>
                  </div>
                  <div class="mb-3">
                    <label>Description</label>
                    <textarea name="texteEducation" class="form-control" required><?= htmlspecialchars($row['texteEducation']) ?></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" name="modifie" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php } ?>
      






   <!-- Modal  AJOUTE -->
 <div class="modal fade " id="ajouteModal" tabindex="-1" aria-labelledby="ajouteModalLabel" aria-hidden="true"> -->
     <div class="modal-dialog ">
      <div class="modal-content">
        <form action="../form/modifie_education.php " method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="ajouteModal">Ajoute les informations</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body ">
            <div class="mb-3"><label>nomEducation</label><input type="text" name="nomEducation" class="form-control"  required></div>
            <div class="mb-3"><label>datedebu</label><input type="date" name="datedebu" class="form-control" value="" required></div>
            <div class="mb-3"><label>datetermine</label><input type="date" name="datetermine" class="form-control" ></input></div>
            <div class="mb-3"><label>titreEducation</label><textarea name="titreEducation" class="form-control" required></textarea></div>
            <div class="mb-3"><label>texteEducation</label><textarea name="texteEducation" class="form-control"></textarea>
          </div>
          <div class="modal-footer">
            <button type="submit" name="ajoute" class="btn btn-primary">Ajoute</button>
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
