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
    <meta charset="UTF-8">
    <title>Mes Projets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../inc/links.php"; ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        .card-project {
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-project:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .project-img {
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
        }
        .card-body h5 {
            font-weight: 600;
        }
        .card-footer {
            background-color: #f9f9f9;
        }
        .badge {
            font-size: 0.875rem;
        }
        .card-text span {
            font-weight: 500;
        }
    </style>
</head>
<body>

<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>
<?php include "../inc/header.php"; ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary"><i class="bx bx-code-block me-2"></i>Mes Projets</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ajouteModal">
            <i class="fas fa-plus me-1"></i>Ajouter un projet
        </button>
    </div>

    <?php
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }

    $sql = "SELECT idProjects, nomProjects, imageProjects, lienProjects, typeProjects FROM projects ";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 0) {
        echo "<div class='alert alert-info text-center w-100'>Vous n'avez encore ajouté aucun projet.</div>";
    }
    ?>

    <div class="row g-4">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-6 col-lg-4" data-aos="fade-up">
                <div class="card card-project shadow-sm h-100">
                    <?php if ($row['imageProjects']) { ?>
                        <img src="../assets/img/portfolio/<?= htmlspecialchars($row['imageProjects']) ?>" class="card-img-top project-img" alt="<?= htmlspecialchars($row['nomProjects']) ?>">
                    <?php } ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['nomProjects']) ?></h5>
                        <?php
                        $type = $row['typeProjects'] == 'app' ? 'Application' : 'Site Web';
                        $badgeClass = $row['typeProjects'] == 'app' ? 'bg-primary' : 'bg-warning text-dark';
                        ?>
                        <p><span class="badge <?= $badgeClass ?>"><?= $type ?></span></p>
                        <?php if ($row['lienProjects']) { ?>
                            <p><a href="<?= htmlspecialchars($row['lienProjects']) ?>" class="text-decoration-none" target="_blank"><i class="fas fa-link me-1"></i><?= htmlspecialchars($row['lienProjects']) ?></a></p>
                        <?php } ?>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['idProjects'] ?>">
                            <i class="fas fa-edit"></i> Modifier
                        </button>
                        <form action="../form/modifier_project.php" method="POST" onsubmit="return confirm('Supprimer ce projet ?');">
                            <input type="hidden" name="idProjects" value="<?= $row['idProjects'] ?>">
                            <button type="submit" name="supprimer" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash-alt"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Modifier -->
            <div class="modal fade" id="editModal<?= $row['idProjects'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['idProjects'] ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="../form/modifier_project.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="idProjects" value="<?= $row['idProjects'] ?>">
                            <div class="modal-header">
                                <h5 class="modal-title">Modifier le projet</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Nom du projet</label>
                                    <input type="text" name="nomProjects" class="form-control" value="<?= htmlspecialchars($row['nomProjects']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label d-block">Type de projet</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="typeProjects" id="typeApp<?= $row['idProjects'] ?>" value="app" <?= ($row['typeProjects'] == 'app') ? 'checked' : '' ?> required>
                                        <label class="form-check-label" for="typeApp<?= $row['idProjects'] ?>">App</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="typeProjects" id="typeWeb<?= $row['idProjects'] ?>" value="web" <?= ($row['typeProjects'] == 'web') ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="typeWeb<?= $row['idProjects'] ?>">Web</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>Lien du projet</label>
                                    <input type="url" name="lienProjects" class="form-control" value="<?= htmlspecialchars($row['lienProjects']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label>Image</label>
                                    <input type="file" name="imageProjects" class="form-control">
                                    <input type="hidden" name="old_image" value="<?= htmlspecialchars($row['imageProjects']) ?>">
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
    </div>
</div>

<!-- Modal Ajouter Projet -->
<div class="modal fade" id="ajouteModal" tabindex="-1" aria-labelledby="ajouteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../form/modifier_project.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un projet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nom du projet</label>
                        <input type="text" name="nomProjects" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block">Type de projet</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="typeProjects" id="typeApp" value="app" required>
                            <label class="form-check-label" for="typeApp">App</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="typeProjects" id="typeWeb" value="web">
                            <label class="form-check-label" for="typeWeb">Web</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Lien du projet</label>
                        <input type="url" name="lienProjects" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="imageProjects" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="ajoute" class="btn btn-success">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("../inc/footer.php")?>

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

<script>
    AOS.init();
</script>

</body>
</html>
