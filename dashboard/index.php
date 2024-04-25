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
    <title>Dashboard</title>
    <?php include "_head.php"?>
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
              <h4 class="page-title">Dashboard</h4>
            </div>
            <div class="col-7 align-self-center">
              <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Dashboard
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
                <?php
                    if ($_SESSION['role_name'] === 'Admin'){
                    ?>  
                                <div class="col-md-4">
                                    <a href="./modules.php">
                                        <div class="card card-hover">
                                            <div class="box bg-primary text-center">
                                                <h1 class="font-light text-white">
                                                    <i class="mdi mdi-school"></i>
                                                </h1>
                                                <h6 class="text-white">Modules</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-4">
                                    <a href="./complains.php">
                                        <div class="card card-hover">
                                            <div class="box bg-info text-center">
                                                <h1 class="font-light text-white">
                                                    <i class="mdi mdi-book-multiple"></i>
                                                </h1>
                                                <h6 class="text-white">Complains</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="./users.php">
                                        <div class="card card-hover">
                                            <div class="box bg-success text-center">
                                                <h1 class="font-light text-white">
                                                <i class="mdi mdi-account-multiple-outline"></i>
                                                </h1>
                                                <h6 class="text-light">Users</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="./reports.php">
                                        <div class="card card-hover">
                                            <div class="box bg-cyan text-center">
                                                <h1 class="font-light text-white">
                                                    <i class="mdi mdi-file-pdf"></i>
                                                </h1>
                                                <h6 class="text-white">Reports</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                <?php } ?>
                <?php
               if ($_SESSION['role_name'] == 'User'){
              ?>
              <h3>Welcome <?php echo $_SESSION['fname']; ?></h3>                  
              <p> <h5>This is the Maseno First Aid Training System. 
                Here, you will learning about different medical emergencies 
                and how to respond in each situation.</h5></p>

                <div class="col-md-4">
                      <a href="./cpr.php">
                          <div class="card card-hover">
                              <div class="box bg-primary text-center">
                                  <h1 class="font-light text-white">
                                      <i class="mdi mdi-account-alert"></i>
                                  </h1>
                                  <h6 class="text-white">CPR</h6>
                              </div>
                          </div>
                      </a>
                </div>
                <div class="col-md-4">
                      <a href="./poisoning.php">
                          <div class="card card-hover">
                              <div class="box bg-secondary text-center">
                                  <h1 class="font-light text-white">
                                      <i class="mdi mdi-skull"></i>
                                  </h1>
                                  <h6 class="text-white">Poisoning</h6>
                              </div>
                          </div>
                      </a>
                </div>
                <div class="col-md-4">
                      <a href="./bleeding.php">
                          <div class="card card-hover">
                              <div class="box bg-danger text-center">
                                  <h1 class="font-light text-white">
                                      <i class="mdi mdi-water"></i>
                                  </h1>
                                  <h6 class="text-white">Bleeding</h6>
                              </div>
                          </div>
                      </a>
                </div>
                <div class="col-md-4">
                      <a href="./chocking.php">
                          <div class="card card-hover">
                              <div class="box bg-info text-center">
                                  <h1 class="font-light text-white">
                                      <i class="mdi mdi-food-off"></i>
                                  </h1>
                                  <h6 class="text-white">Choking</h6>
                              </div>
                          </div>
                      </a>
                </div>
                <div class="col-md-4">
                      <a href="./electric.php">
                          <div class="card card-hover">
                              <div class="box bg-warning text-center">
                                  <h1 class="font-light text-white">
                                      <i class="mdi mdi-power-plug"></i>
                                  </h1>
                                  <h6 class="text-white">Electric</h6>
                              </div>
                          </div>
                      </a>
                </div>
                <div class="col-md-4">
                      <a href="./accident.php">
                          <div class="card card-hover">
                              <div class="box bg-success text-center">
                                  <h1 class="font-light text-white">
                                      <i class="mdi mdi-car"></i>
                                  </h1>
                                  <h6 class="text-white">Accident</h6>
                              </div>
                          </div>
                      </a>
                </div>
                <div class="col-md-4">
                      <a href="./burns.php">
                          <div class="card card-hover">
                              <div class="box bg-primary text-center">
                                  <h1 class="font-light text-white">
                                      <i class="mdi mdi-fire"></i>
                                  </h1>
                                  <h6 class="text-white">Burns</h6>
                              </div>
                          </div>
                      </a>
                </div>
                <div class="col-md-4">
                      <a href="./drowning.php">
                          <div class="card card-hover">
                              <div class="box bg-info text-center">
                                  <h1 class="font-light text-white">
                                      <i class="mdi mdi-weather-lightning"></i>
                                  </h1>
                                  <h6 class="text-white">Drowning</h6>
                              </div>
                          </div>
                      </a>
                </div>
                <div class="col-md-4">
                      <a href="./others.php">
                          <div class="card card-hover">
                              <div class="box bg-info text-center">
                                  <h1 class="font-light text-white">
                                      <i class="mdi mdi-numeric"></i>
                                  </h1>
                                  <h6 class="text-white">Others</h6>
                              </div>
                          </div>
                      </a>
                </div>
                <div class="col-md-4">
                      <a href="./complains.php">
                          <div class="card card-hover">
                              <div class="box bg-info text-center">
                                  <h1 class="font-light text-white">
                                      <i class="mdi mdi-book-multiple"></i>
                                  </h1>
                                  <h6 class="text-white">Complains</h6>
                              </div>
                          </div>
                      </a>
                </div>
                <div class="col-md-4">
                      <a href="./resources.php">
                          <div class="card card-hover">
                              <div class="box bg-info text-center">
                                  <h1 class="font-light text-white">
                                      <i class="mdi mdi-book-multiple"></i>
                                  </h1>
                                  <h6 class="text-white">Resources</h6>
                              </div>
                          </div>
                      </a>
                </div>

              <?php
                   }
              ?>
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
