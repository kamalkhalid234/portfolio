<?php
session_start();

// Vérification de la session
function checkUserLogin() {
    if (!isset($_SESSION['idLogin_user'])) {
        header("Location: index.php");
        exit();
    }
}
checkUserLogin();

$user_id = $_SESSION['idLogin_user'];
include "../form/connexion.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Compétences</title>

  <?php include "../inc/links.php"; ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <!-- Menu mobile -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- Header -->
  <?php include "../inc/header.php"; ?>

  <!-- Contenu principal -->
  <div class="container mt-5">

    <!-- 🔔 Alertes Bootstrap -->
    <?php if (isset($_SESSION['success'])): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
      </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
      </div>
    <?php endif; ?>

    <div class="row">

      <!-- Carte : Compétences simples -->
      <div class="col-md-6 mb-4">
        <div class="card shadow">
          <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-brain me-2"></i>Compétences (Skills)</h5>
          </div>
          <div class="card-body">
            <?php
            function displaySkills($con) {
                $sqlSkills = "SELECT idSkills, texteSkills FROM skills";
                if ($stmt = mysqli_prepare($con, $sqlSkills)) {
                    mysqli_stmt_execute($stmt);
                    $resultSkills = mysqli_stmt_get_result($stmt);
                    
                    if (mysqli_num_rows($resultSkills) === 0) {
                        echo "<p class='text-muted'>Aucune compétence trouvée.</p>";
                    } else {
                        echo "<ul class='list-group'>";
                        while ($skill = mysqli_fetch_assoc($resultSkills)) {
                            echo "
                            <li class='list-group-item d-flex justify-content-between align-items-center'>
                              <span><i class='fas fa-check-circle text-success me-2'></i>" . htmlspecialchars($skill['texteSkills']) . "</span>
                              <a href='#editskills{$skill['idSkills']}' data-bs-toggle='modal' class='btn btn-sm btn-outline-primary'>
                                <i class='fas fa-edit'></i>
                              </a>
                            </li>";

                            echo "
                            <div class='modal fade' id='editskills{$skill['idSkills']}' tabindex='-1' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <form action='../form/modifie_skills.php' method='POST'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title'>Modifier la compétence</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <div class='mb-3'>
                                                    <textarea name='texteSkills' class='form-control' required>" . htmlspecialchars($skill['texteSkills']) . "</textarea>
                                                </div>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='submit' name='modifie' class='btn btn-primary'>Enregistrer</button>
                                                <input type='hidden' name='idSkills' value='{$skill['idSkills']}'>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>";
                        }
                        echo "</ul>";
                    }
                    mysqli_stmt_close($stmt);
                }
            }
            displaySkills($con);
            ?>
          </div>
        </div>
      </div>

      <!-- Carte : Compétences avec degré -->
      <div class="col-md-6 mb-4">
        <div class="card shadow">
          <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Compétences avec Degré</h5>
            <a href="#addSkillModal" data-bs-toggle="modal" class="btn btn-light btn-sm">
              <i class="fas fa-plus me-1"></i>Ajouter
            </a>
          </div>
          <div class="card-body">
            <?php
            function displaySkillsWithLevel($con) {
                $sqlDegres = "SELECT idSkillsDegre, nomSkillsDegre, degreSkillsDegre FROM skills_degre";
                if ($stmt = mysqli_prepare($con, $sqlDegres)) {
                    mysqli_stmt_execute($stmt);
                    $resultDegres = mysqli_stmt_get_result($stmt);
                    
                    if (mysqli_num_rows($resultDegres) === 0) {
                        echo "<p class='text-muted'>Aucune compétence avec degré trouvée.</p>";
                    } else {
                        while ($degre = mysqli_fetch_assoc($resultDegres)) {
                            echo "
                            <p class='fw-bold mb-1'>" . htmlspecialchars($degre['nomSkillsDegre']) . "</p>
                            <div class='progress mb-2' style='height: 20px;'>
                              <div class='progress-bar' role='progressbar' 
                                   style='width: {$degre['degreSkillsDegre']}%;' 
                                   aria-valuenow='{$degre['degreSkillsDegre']}' aria-valuemin='0' aria-valuemax='100'>
                                {$degre['degreSkillsDegre']}%
                              </div>
                            </div>
                            <div class='d-flex justify-content-end mb-4'>
                              <a href='#editSkillModal{$degre['idSkillsDegre']}' data-bs-toggle='modal' class='btn btn-sm btn-outline-primary me-2'>
                                <i class='fas fa-edit'></i>
                              </a>
                              <a href='../form/modifie_skills.php?id={$degre['idSkillsDegre']}' name='supprime'
                                 class='btn btn-sm btn-outline-danger' 
                                 onclick='return confirm(\"Voulez-vous vraiment supprimer cette compétence ?\")'>
                                <i class='fas fa-trash-alt'></i>
                              </a>
                            </div>";

                            echo "
                            <div class='modal fade' id='editSkillModal{$degre['idSkillsDegre']}' tabindex='-1' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <form action='../form/modifie_skills.php' method='POST'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title'>Modifier le degré de compétence</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <div class='mb-3'>
                                                    <label for='nomSkillsDegre'>Nom de la compétence</label>
                                                    <input type='text' name='nomSkillsDegre' class='form-control' value='" . htmlspecialchars($degre['nomSkillsDegre']) . "' required>
                                                </div>
                                                <div class='mb-3'>
                                                    <label for='degreSkillsDegre'>Degré (0-100%)</label>
                                                    <input type='number' name='degreSkillsDegre' class='form-control' value='" . htmlspecialchars($degre['degreSkillsDegre']) . "' min='0' max='100' required>
                                                </div>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='submit' name='modifie_degre' class='btn btn-primary'>Enregistrer</button>
                                                <input type='hidden' name='idSkillsDegre' value='{$degre['idSkillsDegre']}'>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>";
                        }
                    }
                    mysqli_stmt_close($stmt);
                }
            }
            displaySkillsWithLevel($con);
            ?>
          </div>
        </div>
      </div>

      <!-- Modal : Ajouter une nouvelle compétence avec degré -->
      <div class="modal fade" id="addSkillModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="../form/modifie_skills.php" method="POST">
              <div class="modal-header">
                <h5 class="modal-title">Ajouter une nouvelle compétence avec degré</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="nomSkillsDegre">Nom de la compétence</label>
                  <input type="text" name="nomSkillsDegre" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label for="degreSkillsDegre">Degré (0-100%)</label>
                  <input type="number" name="degreSkillsDegre" class="form-control" min="0" max="100" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button>
              </div>
            </form>
          </div>
        </div>
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
