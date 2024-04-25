<?php
include '../server.php';

if (!isset($_SESSION['role_id']) || empty($_SESSION['role_id'])) {
  session_destroy();
  header("location: ../index.php"); 
  exit;
}

$name = $_SESSION['salutation'] . " ".$_SESSION['lname'];
$role_name = $_SESSION['role_name'];
$mail = $_SESSION['email'];
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <title>CPR</title>
    <?php include "_head.php"?>
    <style>
    .max-img-size {
        
        max-width: 50%; /* Adjust as needed */
        max-height: 400px; /* Adjust as needed */
    }
    </style>
  </head>

  <body>
    <?php include "_topbar.php"?>
    <?php include "_sidebar.php"?>

      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-5 align-self-center">
              <h4 class="page-title">CARDIOPULMONARY RESUSCITATION (CPR) Training</h4>
            </div>
            <div class="col-7 align-self-center">
              <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      CPR
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <div class="row"></div>
          <div class="row p-3">
        <!--cpr start-->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-center"><h4>Hands-only CPR</h4> </div>
                    <div class="card-subtitle">To carry out a chest compression:</div>
                    <ul>
                        <li>The heel of your hand on the breastbone at the centre of the person's chest. Place your other hand on top of your first hand and interlock your fingers.</li>
                        <li>Position yourself with your shoulders above your hands.</li>
                        <li>Using your body weight (not just your arms), press 
                        straight down by 5 to 6cm (2 to 2.5 inches) on their chest.</li>
                        <li>Keeping your hands on their chest, release the compression 
                        and allow the chest to return to its original position. </li>
                        <li>Repeat these compressions at a rate of 100 to 120 times 
                        a minute until an ambulance arrives or you become exhausted.</li>
                    </ul>
                    <img src="img/CPR 072204 v2.jpg" class="img-fluid  max-img-size mx-auto d-block" alt="Responsive image">
                    <p>Watch this demo video</p>
                </div>
                <iframe class="embed-responsive-16by9 embed-responsive-item" src="https://www.youtube.com/embed/VIDEO_ID_HERE" allowfullscreen></iframe>
            </div>
        </div> 
        <!--cpr end-->
                <!--cpr start-->
                <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-center"><h4>Hands-only CPR</h4> </div>
                    <div class="card-subtitle">To carry out a chest compression:</div>
                    <ul>
                        <li>The heel of your hand on the breastbone at the centre of the person's chest. Place your other hand on top of your first hand and interlock your fingers.</li>
                        <li>Position yourself with your shoulders above your hands.</li>
                        <li>Using your body weight (not just your arms), press 
                        straight down by 5 to 6cm (2 to 2.5 inches) on their chest.</li>
                        <li>Keeping your hands on their chest, release the compression 
                        and allow the chest to return to its original position. </li>
                        <li>Repeat these compressions at a rate of 100 to 120 times 
                        a minute until an ambulance arrives or you become exhausted.</li>
                    </ul>
                    <img src="img/CPR 072204 v2.jpg" class="img-fluid  max-img-size mx-auto d-block" alt="Responsive image">
                    <p>Watch this demo video</p>
                </div>
                <iframe class="embed-responsive-16by9 embed-responsive-item" src="https://www.youtube.com/embed/VIDEO_ID_HERE" allowfullscreen></iframe>
            </div>
        </div> 
        <!--cpr end-->

        <!---test--->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-center">
                        <h2>Test Your Knowledge</h2>
                        <p>Take this short quiz to test your knowledge on how to perform CPR:</p>
                        <button class="btn btn-primary"><a href="QUIZ/index.php" style="color: black; text-decoration: none;" >Start Quiz </a></button>
                    </div>          
                </div>
            </div>

          </div>
        <!---test--->

          
            </div>
          <!-- ============================================================== -->
          <!-- Email campaign chart -->
          <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
      <?php include "_footer.php"?>
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
<?php include "_scripts.php"?>
  </body>
</html>
