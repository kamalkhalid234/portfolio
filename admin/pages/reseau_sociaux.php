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
    <title>Mes Réseaux Sociaux</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../inc/links.php"; ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        .social-card {
            transition: transform 0.2s ease;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .social-card:hover {
            transform: scale(1.05);
        }
        .social-card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 10px;
        }
        .social-card-body {
            padding: 15px;
        }
        .social-card-footer {
            background-color: #f8f9fa;
            text-align: right;
            padding: 10px;
            border-radius: 0 0 10px 10px;
        }
        .btn-outline-danger {
            color: #e63946;
            border-color: #e63946;
        }
        .btn-outline-danger:hover {
            background-color: #e63946;
            color: #fff;
        }
        .btn-outline-primary {
            color: #1d3557;
            border-color: #1d3557;
        }
        .btn-outline-primary:hover {
            background-color: #1d3557;
            color: #fff;
        }
    </style>
</head>
<body>

<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>
<?php include "../inc/header.php"; ?>

<div class="container mt-5">
    <h2 class="text-primary mb-4"><i class="fas fa-world me-2"></i>Mes Réseaux Sociaux</h2>

    <?php
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }

    $sql = "SELECT idReseau, githubReseau, linkdinReseau, twiterReseau FROM reseau_sociau ";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 0) {
        echo "<p class='text-danger'>Aucun réseau social trouvé.</p>";
    }
    ?>

    <div class="row g-4">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-6 col-lg-12">
                <div class="card social-card">
                    <div class="card-header social-card-header">
                    <h5 class="card-title mb-0"><i class="bx bx-world me-3"></i>Réseau Social</h5>
                    </div>
                    <div class="card-body social-card-body">
                         <p><strong><i class="fab fa-github"></i> GitHub:</strong> <a href="<?= htmlspecialchars($row['githubReseau']) ?>" target="_blank"><?= htmlspecialchars($row['githubReseau']) ?></a></p>
                         <p><strong><i class="fab fa-linkedin"></i> LinkedIn:</strong> <a href="<?= htmlspecialchars($row['linkdinReseau']) ?>" target="_blank"><?= htmlspecialchars($row['linkdinReseau']) ?></a></p>
                         <p><strong><i class="fab fa-twitter"></i> Twitter:</strong> <a href="<?= htmlspecialchars($row['twiterReseau']) ?>" target="_blank"><?= htmlspecialchars($row['twiterReseau']) ?></a></p>
                    </div>
                    <div class="card-footer social-card-footer">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['idReseau'] ?>">
                            <i class="fas fa-edit"></i> Modifier
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal Modifier -->
            <div class="modal fade" id="editModal<?= $row['idReseau'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['idReseau'] ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="../form/modifier_reseau.php" method="POST">
                            <input type="hidden" name="idReseau" value="<?= $row['idReseau'] ?>">
                            <div class="modal-header">
                                <h5 class="modal-title">Modifier le réseau social</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>GitHub</label>
                                    <input type="url" name="githubReseau" class="form-control" value="<?= htmlspecialchars($row['githubReseau']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label>LinkedIn</label>
                                    <input type="url" name="linkdinReseau" class="form-control" value="<?= htmlspecialchars($row['linkdinReseau']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label>Twitter</label>
                                    <input type="url" name="twiterReseau" class="form-control" value="<?= htmlspecialchars($row['twiterReseau']) ?>" required>
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
