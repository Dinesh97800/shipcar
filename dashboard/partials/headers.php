<!DOCTYPE html>
<html lang="en">
<?php
include(__DIR__.'/../../env.php');


$current_page = basename($_SERVER['PHP_SELF']);
include(__DIR__ . '/../../middlewares/index.php');
include(__DIR__.'/../../Api/getUser.php');
$user = $_SESSION['user'];

?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CredBnk | <?php echo $current_page; ?> </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo $APP_URL; ?>/dashboard/assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?php echo $APP_URL; ?>/dashboard/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo $APP_URL; ?>/dashboard/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet"
        href="<?php echo $APP_URL; ?>/dashboard/assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $APP_URL; ?>/dashboard/assets/vendors/typicons/typicons.css">
    <link rel="stylesheet"
        href="<?php echo $APP_URL; ?>/dashboard/assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo $APP_URL; ?>/dashboard/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet"
        href="<?php echo $APP_URL; ?>/dashboard/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet"
        href="<?php echo $APP_URL; ?>/dashboard/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $APP_URL; ?>/dashboard/assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo $APP_URL; ?>/dashboard/assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo $APP_URL; ?>/dashboard/assets/images/favicon.png" />
    <style>
        #example_length{
            margin-bottom: 15px !important;
        }
        .error {
    color: #F95F53 !important;
}
    </style>
</head>

<body class="with-welcome-text">
    <div class="container-scroller">
        <!-- <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <div class="card-body card-body-padding px-3 d-flex align-items-center justify-content-between">
                    <div class="ps-lg-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 fw-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more
                                with this template!</p>
                            <a href="https://www.bootstrapdash.com/product/star-admin-pro/" target="_blank"
                                class="btn me-2 buy-now-btn border-0">Buy Now</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="https://www.bootstrapdash.com/product/star-admin-pro/"><i
                                class="ti-home me-3 text-white"></i></a>
                        <button id="bannerClose" class="btn border-0 p-0">
                            <i class="ti-close text-white"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div> -->

        <?php
        include(__DIR__.'./navbar.php');
        ?>
        <div class="container-fluid page-body-wrapper">
            <?php
            include(__DIR__.'./sidebar.php');
            ?>