<!DOCTYPE html>
<html lang="en">
<?php
$current_page = basename($_SERVER['PHP_SELF']);
include(__DIR__ . '/../middlewares/index.php');
$user = $_SESSION['user'];
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CredBnk | <?php echo $current_page; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/auth.css">
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" id="pc-sidebar">
            <div class="d-flex justify-content-center">
                <a href="index.php" class="logo d-flex align-items-center">
                    <img style="height: 100%;width: 100%;" src="./assets/logo.png" alt="">
                </a>
                <button class="btn btn-primary-custom mx-2" id="toggleSidebar"><i class="fa-solid fa-bars"></i></button>
            </div>
            <ul class="nav flex-column mx-2 mt-3">
                <li class="nav-item my-1 <?= ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="dashboard.php">
                        <i class="fa fa-house"></i>
                        <span class="d-none d-md-inline mx-2">Home</span>
                    </a>
                </li>
                <?php
                if ($user === "admin") {
                    ?>
                <li class="nav-item my-1 <?= ($current_page == 'distributors.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="distributors.php">
                        <i class="fa fa-person"></i>
                        <span class="d-none d-md-inline mx-2">Distributors</span>
                    </a>
                </li>

                <?php
                } ?>


                <li class="nav-item my-1 <?= ($current_page == 'retailers.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="retailers">
                        <i class="fa fa-users"></i>
                        <span class="d-none d-md-inline mx-2">Retailers</span>
                    </a>
                </li>
                <?php
                if ($user !== "user" && $user !== "retailer") { ?>
                <li class="nav-item my-1 <?= ($current_page == 'users.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="users">
                        <i class="fa-solid fa-user"></i>
                        <span class="d-none d-md-inline mx-2">Users</span>
                    </a>
                </li>
                <?php
                } ?>
                <li class="nav-item my-1 <?= ($current_page == 'my-wallet.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="my-wallet.php">
                    <i class="fa-solid fa-wallet"></i>
                    <span class="d-none d-md-inline mx-2">My Wallet</span>
                    </a>
                </li>
                    <li class="nav-item my-1 <?= ($current_page == 'logout.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="logout.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="d-none d-md-inline mx-2">Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <nav class="navbar navbar-expand-lg bg-body-transparent border-0" id="mobile-view">
            <div class="container-fluid">
                <a class="navbar-brand" style="height: 50px;" href="dashboard">
                    <img style="height: 100%;width: 100%;" src="./assets/logo.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item mt-2">
                            <a class="nav-link <?= ($current_page == 'dashboard.php') ? 'active' : ''; ?>"
                                aria-current="page" href="dashboard.php">Home</a>
                        </li>
                        <?php
                        if ($user === "admin") {
                            ?>
                        <li class="nav-item mt-2 <?= ($current_page == 'distributors.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="distributors.php">Distributors</a>
                        </li>
                        <?php
                        } ?>

                        <?php
                        if ($user === "admin" ||$user === "distributor" ) {
                            ?>
                        <li class="nav-item mt-2 <?= ($current_page == 'retailers.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="retailers.php">Retailers</a>
                        </li>
                        <?php
                        } ?>


                        <?php
                        if ($user !== "user") { ?>
                        <li class="nav-item mt-2 <?= ($current_page == 'users.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="users.php">Users</a>
                        </li>

                        <?php
                        } ?>


                        <li class="nav-item mt-2">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <div class="main">
            <div class="container-fluid">