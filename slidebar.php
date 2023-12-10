<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="" class="brand-link text-center">
    <img class="img-fluid" src="<?php
                                if (isset($_SESSION['user'])) {

                                  echo $_SESSION['img'];
                                }; ?>" alt="" style="width: 100px; border-radius:15px;">
  </a>
  <div class="sidebar">

    <div class="user-panel mt-3 d-flex">
      <div class="info">
        <a href="https://play.google.com/store/apps/details?id=com.garage.merigarage" class="nav-link"><?php
                                                                                                        if (isset($_SESSION['user'])) {

                                                                                                          echo $_SESSION['user'];
                                                                                                        }; ?><br>
          <font color="#ffffff"><b>Download NEW Mobile App</b></font>
        </a><br>
      </div>

    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="createjobcard.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Create JobCards</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Bookings
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="ShowJobCard.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>View All Jobcards</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="Appdashboard.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Customer App Booking (Premium)
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="order.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Customer App Orders (Premium)
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="change_price.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Edit Price on App<br>(Premium)
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="whatsapp_invoice.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Send Invoice</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Logout</p>
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <p>___________</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="training_video.php" class="nav-link">
            <p>Training Video<br>
          </a>
          <a href="training_video.php" class="nav-link">
            <p>Support<br>
              +91 9958300122<br>
              info@merigarage.com
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">

            <p>___________</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>