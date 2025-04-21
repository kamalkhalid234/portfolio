<?php 

//connexion a la base de donne 
include "forms/connexion.php";

// la requete de la base de donne Sql aboute
$sql = "SELECT * FROM  about";
$result = mysqli_query($con , $sql);
$data = mysqli_fetch_assoc($result);


// la requete de la base de donne Sql reseau sausio
$sql_Reseau = "SELECT * FROM  reseau_sociau";
$result_Reseau = mysqli_query($con , $sql_Reseau);
$data_Reseau = mysqli_fetch_assoc($result_Reseau);


?>
<!-- ======= Header ======= -->
    <header id="header">
      <div class="d-flex flex-column">
        <div class="profile">
              <!-- ======= image de profile ======= -->
          <img
            src="admin/assets/img/<?= $data['image']?>"
            alt=""
            class="img-fluid rounded-circle"
          />
          <h1 class="text-light"><a href="index.html"><?= $data['nom'] ." ".  $data['prenom']?></a></h1>
          <div class="social-links mt-3 text-center">
            <a href="<?= $data_Reseau['twiterReseau']?>" class="twitter"
              ><i class="bx bxl-twitter"></i
            ></a>
            <a href="<?= $data_Reseau['githubReseau']?>" class="github"
              ><i class="bx bxl-github"></i
            ></a>
            <a
              href="<?= $data_Reseau['linkdinReseau']?>"
              class="linkedin"
              ><i class="bx bxl-linkedin"></i
            ></a>
          </div>
        </div>

        <nav id="navbar" class="nav-menu navbar">
          <ul>
            <li>
              <a href="#hero" class="nav-link scrollto active"
                ><i class="bx bx-home"></i> <span>Home</span></a
              >
            </li>
            <li>
              <a href="#about" class="nav-link scrollto"
                ><i class="bx bx-user"></i> <span>About</span></a
              >
            </li>
            <li>
              <a href="#resume" class="nav-link scrollto"
                ><i class="bx bx-file-blank"></i> <span>Resume</span></a
              >
            </li>
            <li>
              <a href="#portfolio" class="nav-link scrollto"
                ><i class="bx bx-book-content"></i> <span>Portfolio</span></a
              >
            </li>
            <li>
              <a href="#contact" class="nav-link scrollto"
                ><i class="bx bx-envelope"></i> <span>Contact</span></a
              >
            </li>
          </ul>
        </nav>
        <!-- .nav-menu -->
      </div>
    </header>
    <!-- End Header -->