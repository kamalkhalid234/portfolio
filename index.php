<?php 
session_start();
include "forms/connexion.php";
?>


  <!-- portfolio KAMAL KHALID -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>KAMAL</title>
    <?php include "inc/links.php"; ?>
  </head>

  <body>
    <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>
    <?php include "inc/header.php"; ?>

    <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
      <div class="hero-container" data-aos="fade-in">
        <h1>Kamal Khalid</h1>
        <p>
          I'm a <span class="typed" data-typed-items="Big Data and Cloud Computing Engineer,Mobile developer, Freelancer"></span>
        </p>
      </div>
    </section>

    <?php 
    $sql_About = "SELECT * FROM  about";
    $result_About = mysqli_query($con , $sql_About);
    $data_About = mysqli_fetch_assoc($result_About);
    ?>

    <main id="main">
      <!-- About Section -->
      <section id="about" class="about">
        <div class="container">
          <div class="section-title">
            <h2>About</h2>
          </div>
          <div class="row">
            <div class="col-lg-4" data-aos="fade-right">
              <img src="admin/assets/img/<?= $data_About['image']?>" class="img-fluid dor" alt="" />
            </div>
            <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
              <h3><?= $data_About['titre'];?></h3>
              <p class="fst-italic"> <?= $data_About['texteAboute'];?> </p>
              <div class="row">
                <div class="col-lg-6">
                  <ul>
                    <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong> <span><?= $data_About['dateNaissance'];?></span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Website:</strong> <span><?= $data_About['Website'];?></span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Phone:</strong> <span><?= $data_About['telephone'];?></span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>City:</strong> <span><?= $data_About['city'];?></span></li>
                  </ul>
                </div>
                <div class="col-lg-6">
                  <ul>
                    <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong> <span><?= $data_About['Age'];?></span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Degree:</strong> <span><?= $data_About['degree'];?></span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span><?= $data_About['email'];?></span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Freelance:</strong> <span><?= $data_About['Freelance'];?></span></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Skills Section -->
      <?php 
      $sql_Skills = "SELECT * FROM  skills";
      $result_Skills = mysqli_query($con , $sql_Skills);
      $data_Skills  = mysqli_fetch_assoc($result_Skills);
      $sql_Skills_degre = "SELECT * FROM   skills_degre";
      $result_Skills_degre = mysqli_query($con , $sql_Skills_degre);

      $allSkills = [];
      while ($row = mysqli_fetch_assoc($result_Skills_degre)) {
        $allSkills[] = $row;
      }
      $skillsLeft = array_slice($allSkills, 0, ceil(count($allSkills)/2));
      $skillsRight = array_slice($allSkills, ceil(count($allSkills)/2));
      ?>
      <section id="skills" class="skills section-bg">
        <div class="container">
          <div class="section-title">
            <h2>Skills</h2>
            <p><?= $data_Skills['texteSkills']?></p>
          </div>
          <div class="row skills-content">
            <div class="col-lg-6" data-aos="fade-up">
              <?php foreach ($skillsLeft as $skill) { ?>
              <div class="progress">
                <span class="skill"><?= $skill['nomSkillsDegre'] ?><i class="val"><?= $skill['degreSkillsDegre'] ?>%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="<?= $skill['degreSkillsDegre'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $skill['degreSkillsDegre'] ?>%;"></div>
                </div>
              </div>
              <?php } ?>
            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              <?php foreach ($skillsRight as $skill) { ?>
              <div class="progress">
                <span class="skill"><?= $skill['nomSkillsDegre'] ?><i class="val"><?= $skill['degreSkillsDegre'] ?>%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="<?= $skill['degreSkillsDegre'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $skill['degreSkillsDegre'] ?>%;"></div>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </section>

      <!-- Resume Section -->
      <?php 
      $sql_education = "SELECT * FROM  education";
      $result_education = mysqli_query($con , $sql_education);
      $sql_experience = "SELECT * FROM  experience";
      $result_experience = mysqli_query($con , $sql_experience);
      ?>
      <section id="resume" class="resume">
        <div class="container">
          <div class="section-title">
            <h2>Resume</h2>
            <p><a target="_blank" href="https://drive.google.com/file/d/1xx7Pu9LzgRsyPG8vUb9zRzCkLZTPAgxH/view?usp=share_link">Download resume</a></p>
          </div>
          <div class="row">
            <div class="col-lg-6" data-aos="fade-up">
              <h3 class="resume-title">Education</h3>
              <?php while($data_education = mysqli_fetch_assoc($result_education)){ ?>
              <div class="resume-item">
                <h4><?= $data_education['nomEducation']?></h4>
                <h5><?= $data_education['datedebu']?> -<?= $data_education['datetermine']?> </h5>
                <p><em><?= $data_education['titreEducation']?></em></p>
                <p><?= $data_education['texteEducation']?></p>
              </div>
              <?php }?>
            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              <h3 class="resume-title">Professional Experience</h3>
              <?php while($data_experience = mysqli_fetch_assoc($result_experience)){ ?>
              <div class="resume-item">
                <h4><?= $data_experience['nomExperience']?></h4>
                <h5><?= $data_experience['dateDepart']?> - <?= $data_experience['dateTermine']?></h5>
                <p><em><?= $data_experience['titreExperience']?></em></p>
                <ul><li><?= $data_experience['texteExperience']?></li></ul>
              </div>
              <?php }?>
            </div>
          </div>
        </div>
      </section>

      <!-- Projects Section -->
      <?php 
      $sql_projects = "SELECT * FROM   projects";
      $result_projects = mysqli_query($con , $sql_projects);
      ?>
      <section id="portfolio" class="portfolio section-bg">
        <div class="container">
          <div class="section-title">
            <h2>Projects</h2>
            <p>Here are some of my projects</p>
          </div>
          <div class="row" data-aos="fade-up">
            <div class="col-lg-12 d-flex justify-content-center">
              <ul id="portfolio-flters">
                <li data-filter="*" class="filter-active">All</li>
                <li data-filter=".filter-app">App</li>
                <li data-filter=".filter-web">Web</li>
              </ul>
            </div>
          </div>
          <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">
            <?php while($data_projects = mysqli_fetch_assoc($result_projects)){ ?>
            <div class="col-lg-4 col-md-6 portfolio-item filter-<?= $data_projects['typeProjects']?>">
              <div class="portfolio-wrap">
                <img src="admin/assets/img/portfolio/<?= $data_projects['imageProjects'];?>" class="img-fluid" alt="" />
                <div class="portfolio-links">
                  <a href="admin/assets/img/portfolio/<?= $data_projects['imageProjects'];?>" target="_blank" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?= $data_projects['nomProjects']?>"><i class="bx bx-plus"></i></a>
                  <a href="<?= $data_projects['nomProjects']?>" target="_blank" title="link"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </section>

      <!-- Testimonials Section -->
      <?php 
      $sql_testimonials = "SELECT * FROM   testimonials";
      $result_testimonials = mysqli_query($con , $sql_testimonials);
      ?>
      <section id="testimonials" class="testimonials section-bg">
        <div class="container">
          <div class="section-title">
            <h2>Testimonials</h2>
          </div>
          <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
            <?php while($data_testimonials = mysqli_fetch_assoc($result_testimonials)){ ?>
              <div class="swiper-slide">
                <div class="testimonial-item" data-aos="fade-up">
                  <p><i class="bx bxs-quote-alt-left quote-icon-left"></i>kamal<i class="bx bxs-quote-alt-right quote-icon-right"></i></p>
                  <img src="admin/assets/img/testimonials/<?= $data_testimonials['imageTestimonials']?>" class="testimonial-img" alt="" />
                  <h3><?= $data_testimonials['nomTestimonials']?></h3>
                  <h4><?= $data_testimonials['texteTestimonials']?></h4>
                </div>
              </div>
              <?php }?>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </section>



      <?php 
      
      // INSERT MESSAGE CONTACTE

      if(isset($_POST['contacte'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $stmt = $con->prepare("INSERT INTO `contact`(`nameContact`, `emailContact`, `subjectContact`, `messageContact`) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss",$name,$email,$subject,$message);

        if($stmt->execute()){
           $_SESSION['success'] = "Message envaei.";
        }else{
          $_SESSION['error'] = "Probleme sur contacte.";
        }
      }
      
      ?>
      <!-- Contact Section -->
      <section id="contact" class="contact">
        <div class="container">
          <div class="section-title">
            <h2>Contact</h2>
            <p>Get in touch with me</p>
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
          ?>
          <form method="POST" action="#contact">
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required />
              </div>
              <div class="col-md-6 form-group">
                <input type="email" name="email" class="form-control" id="email" placeholder="Your Email" required />
              </div>
            </div> <br>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required />
            </div><br>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div><br>
            <div class="text-center">
              <button type="submit"  class="btn btn-primary" name="contacte">Send Message</button>
            </div>
          </form>
        </div>
      </section>
    </main>

    <?php include "inc/footer.php"; ?>

    <a href="#" class="back-to-top"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/typed.js/typed.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>