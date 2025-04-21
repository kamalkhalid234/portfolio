<?php
session_start();

if (!isset($_SESSION['idLogin_user'])) {
    header("Location: index.php");
    exit();
} else {
    $user_id = $_SESSION['idLogin_user'];
    include "../form/connexion.php"; // Inclure la connexion à la base de données
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Témoignages</title>
  <?php include "../inc/links.php"; ?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    .testimonial-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .testimonial-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }
    .testimonial-img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .testimonial-content {
      padding: 15px;
    }
    .testimonial-name {
      font-size: 1.2rem;
      font-weight: bold;
    }
    .testimonial-title {
      font-size: 1rem;
      color: #777;
    }
    .testimonial-text {
      font-size: 1rem;
      color: #333;
    }
    .btn-custom {
      transition: background-color 0.3s ease, color 0.3s ease;
    }
    .btn-custom:hover {
      background-color: #007bff;
      color: #fff;
    }
  </style>
</head>
<body>

<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>
<?php include "../inc/header.php"; ?>

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0"><i class="bx bx-comment-detail me-3"></i>Témoignages</h4>
      <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addTestimonialModal">
        <i class="fas fa-plus me-1"></i> Ajouter
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
      // Requête SQL pour récupérer les témoignages
      $sql = "SELECT idTestimonials, nomTestimonials, titreTestimonials, texteTestimonials, imageTestimonials FROM testimonials";
      $result = mysqli_query($con, $sql);

      if (mysqli_num_rows($result) == 0) {
          echo "<p class='text-muted'>Aucun témoignage trouvé.</p>";
      } else {
          while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="testimonial-card mb-4 p-3">
              <div class="row align-items-center">
                <!-- Colonne image -->
                <div class="col-md-3 text-center">
                  <?php if (!empty($row['imageTestimonials'])) { ?>
                    <img src="../assets/img/testimonials/<?= $row['imageTestimonials']?>" alt="Témoignage" class="testimonial-img">
                  <?php } ?>
                </div>

                <!-- Colonne contenu -->
                <div class="col-md-9 testimonial-content">
                  <div class="d-flex justify-content-between">
                    <div>
                      <h5 class="testimonial-name"><?= htmlspecialchars($row['nomTestimonials']) ?> <span class="badge bg-secondary"><?= $row['titreTestimonials'] ?></span></h5>
                      <p class="testimonial-text"><?= nl2br(htmlspecialchars($row['texteTestimonials'])) ?></p>
                    </div>
                    <div>
                      <button class="btn btn-sm btn-outline-primary me-1 btn-custom" data-bs-toggle="modal" data-bs-target="#editTestimonialModal<?= $row['idTestimonials'] ?>">
                        <i class="fas fa-edit"></i> Modifier
                      </button>
                      <form action="../form/modifie_testimonials.php" method="POST" onsubmit="return confirm('Supprimer ce parcours ?');">
                           <input type="hidden" name="idTestimonials" value="<?= $row['idTestimonials'] ?>">
                           <button type="submit" name="supprimer" class="btn btn-sm btn-outline-danger">
                              <i class="fas fa-trash-alt"></i> Supprimer
                          </button>
                      </form>

                      <!-- <a href="../form/modifie_testimonials.php?idTestimonials=<?= $row['idTestimonials'] ?>" class="btn btn-sm btn-outline-danger btn-custom" onclick="return confirm('Voulez-vous vraiment supprimer ce témoignage ?')">
                        <i class="fas fa-trash-alt"></i> Supprimer
                      </a> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal Modifier -->
            <div class="modal fade" id="editTestimonialModal<?= $row['idTestimonials'] ?>" tabindex="-1" aria-labelledby="editTestimonialModalLabel<?= $row['idTestimonials'] ?>" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="../form/modifie_testimonials.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="idTestimonials" value="<?= $row['idTestimonials'] ?>">
                    <div class="modal-header">
                      <h5 class="modal-title">Modifier le témoignage</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label>Nom</label>
                        <input type="text" name="nomTestimonials" class="form-control" value="<?= htmlspecialchars($row['nomTestimonials']) ?>" required>
                      </div>
                      <div class="mb-3">
                        <label>Titre</label>
                        <input type="text" name="titreTestimonials" class="form-control" value="<?= htmlspecialchars($row['titreTestimonials']) ?>" required>
                      </div>
                      <div class="mb-3">
                        <label>Texte</label>
                        <textarea name="texteTestimonials" class="form-control" rows="4" required><?= htmlspecialchars($row['texteTestimonials']) ?></textarea>
                      </div>
                      <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="imageTestimonials" class="form-control">
                        <input type="hidden" name="old_image" value="<?= htmlspecialchars($row['imageTestimonials']) ?>">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="modifie" class="btn btn-primary">Enregistrer</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php }
      }
      ?>
    </div>
  </div>
</div>

<!-- Modal Ajouter Testimonial -->
<div class="modal fade" id="addTestimonialModal" tabindex="-1" aria-labelledby="addTestimonialModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../form/modifie_testimonials.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter un témoignage</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nomTestimonials" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Titre</label>
            <input type="text" name="titreTestimonials" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Texte</label>
            <textarea name="texteTestimonials" class="form-control" rows="4" required></textarea>
          </div>
          <div class="mb-3">
            <label>Image</label>
            <input type="file" name="imageTestimonials" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="ajouter" class="btn btn-success">Ajouter</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- JS Files -->
  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- Vendor JS Files -->
   <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/typed.js/typed.min.js"></script>
    <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/js/main.js"></script>

</body>
</html>
