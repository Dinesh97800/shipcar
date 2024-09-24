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

        <?php
        include('navbar.php');
        ?>
        
        <div class="container-fluid page-body-wrapper">
            <?php
            include('sidebar.php');
            ?>