<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - KAMAL</title>
  <link rel="stylesheet" href="assets/css/login.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body>
  <div class="wrapper">
    <?php 
      if (isset($_GET['msg'])) {
          echo "<div class='alert alert-danger text-center'>" . htmlspecialchars($_GET['msg']) . "</div>";
      }
    ?>
    <div class="title"><span>Login Form</span></div>
    <form action="form/login_process.php" method="POST">
      <div class="row">
        <i class="fas fa-user"></i>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required />
      </div>
      <div class="row">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" placeholder="Mot de passe" required />
      </div>
      <div class="row button">
        <input type="submit" value="Se connecter" name="conecte" />
      </div>
    </form>
  </div>
</body>
</html>
