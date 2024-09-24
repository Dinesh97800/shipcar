<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <div class="me-3">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
    </div>
    <div>
      <!-- <a class="navbar-brand brand-logo" href="../index.html">
        <img src="<?php echo $APP_URL; ?>assets/logo.png" alt="logo" />
      </a>
      <a class="navbar-brand brand-logo-mini" href="../index.html">
        <img src="<?php echo $APP_URL; ?>assets/logo-min.png" alt="logo" />
      </a> -->
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-top">
    <ul class="navbar-nav">
      <li class="nav-item fw-semibold d-none d-lg-block ms-0">
        <h1 class="welcome-text">Hi, <span class="text-black fw-bold"><?php echo $userData->name; ?></span></h1>
        <h3 class="welcome-sub-text">Your summary this week </h3>
      </li>
    </ul>
    <ul class="navbar-nav ms-auto">
      <!-- <li class="nav-item dropdown d-none d-lg-block">
        <a class="nav-link dropdown-bordered dropdown-toggle dropdown-toggle-split" id="messageDropdown" href="#"
          data-bs-toggle="dropdown" aria-expanded="false"> Select Category </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
          aria-labelledby="messageDropdown">
          <a class="dropdown-item py-3">
            <p class="mb-0 fw-medium float-start">Select category</p>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-item-content flex-grow py-2">
              <p class="preview-subject ellipsis fw-medium text-dark">Bootstrap Bundle </p>
              <p class="fw-light small-text mb-0">This is a Bundle featuring 16 unique dashboards</p>
            </div>
          </a>
        </div>
      </li> -->
      <li class="nav-item">
        <form class="search-form" action="#">
          <i class="icon-search"></i>
          <input type="search" class="form-control" placeholder="Search Here" title="Search here">
        </form>
      </li>
      <li class="nav-item dropdown d-lg-block user-dropdown">
        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <img class="img-xs rounded-circle" src="<?php echo $APP_URL; ?>dashboard/assets/images/faces/face8.jpg"
            alt="Profile image"> </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <div class="dropdown-header text-center">
            <img class="img-md rounded-circle" src="<?php echo $APP_URL; ?>dashboard/assets/images/faces/face8.jpg"
              alt="Profile image">
            <p class="mb-1 mt-3 fw-semibold"><?php echo $userData->name; ?></p>
            <p class="fw-light text-muted mb-0"><?php echo $userData->email; ?></p>
          </div>
          <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My
            Profile <span class="badge badge-pill badge-danger">1</span></a>
          <a class="dropdown-item" href="<?php echo $APP_URL; ?>dashboard/logout.php"><i
              class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
      data-bs-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>