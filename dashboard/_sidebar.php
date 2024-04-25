<aside class="left-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php"
                        aria-expanded="false"><i class="mdi mdi-av-timer"></i><span
                            class="hide-menu">Dashboard</span></a>
                </li>
                <?php
               if ($_SESSION['role_name'] == 'User'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="resources.php"
                        aria-expanded="false"><i class="mdi mdi-school"></i><span class="hide-menu">Resources</span></a>
                </li>
                <?php
                   }
              ?>
              
                <?php
               if ($_SESSION['role_name'] == 'User'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="complains.php"
                        aria-expanded="false"><i class="mdi mdi-book-multiple"></i><span
                            class="hide-menu">Complainss</span></a>
                </li>
                <?php
                   }
              ?>

                <?php
               if ($_SESSION['role_name'] == 'Admin'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="modules.php"
                        aria-expanded="false"><i class="mdi mdi-school"></i><span class="hide-menu">Modules</span></a>
                </li>
                <?php
                   }
              ?>
              
                <?php
               if ($_SESSION['role_name'] == 'Admin'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="access_logs.php"
                        aria-expanded="false"><i class="mdi mdi-timetable"></i><span
                            class="hide-menu">Access Logs</span></a>
                </li>
                <?php
                   }
              ?>

                <?php
               if ($_SESSION['role_name'] == 'Admin'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="complains.php"
                        aria-expanded="false"><i class="mdi mdi-book-multiple"></i><span class="hide-menu">
                          Complains</span></a>
                </li>
                <?php
                   }
              ?>

                <?php
                if ($_SESSION['role_name'] == 'Admin'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="users.php"
                        aria-expanded="false"><i class="mdi mdi-account-multiple-outline"></i><span
                            class="hide-menu">Users</span></a>
                </li>
                <?php
                   }
              ?>


                <?php
               if ($_SESSION['role_name'] == 'Admin'){
              ?>
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="reports.php"
                  aria-expanded="false">
                    <i class="mdi mdi-file-pdf"></i>
                    <span class="hide-menu">Reports</span></a>
                </li>
                <?php
                   }
              ?>
                <li class="sidebar-item mt-1">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../logout.php"
                        aria-expanded="false" style="color:red;font-weight:bold; font-size:15px;"><i
                            class="mdi mdi-power"></i><span class="hide-menu">Sign Out</span></a>
                </li>
            </ul>
        </nav>
    </div>
</aside>