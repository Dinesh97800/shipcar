<?php
include('./partials/headers.php');
include(__DIR__.'/../Api/admin/users.php');
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<!-- DataTables Responsive CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class=" card-title text-start">Users</h4>
                            <button type="button" class="btn btn-dark w-auto" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">Create User</button>
                        </div>

                        </p>
                        <div class="table-responsive pt-3">
                            <?php 
                            $tableColumn = ['#','Name','Email','Retailer','Distributor','Commission','Created','Action'];
                            include('./table.php');
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $APP_URL; ?>dashboard/assets/vendors/js/vendor.bundle.base.js"></script>
<script src="<?php echo $APP_URL; ?>dashboard/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="<?php echo $APP_URL; ?>dashboard/assets/js/off-canvas.js"></script>
<script src="<?php echo $APP_URL; ?>dashboard/assets/js/template.js"></script>
<script src="<?php echo $APP_URL; ?>dashboard/assets/js/settings.js"></script>
<script src="<?php echo $APP_URL; ?>dashboard/assets/js/hoverable-collapse.js"></script>
<script src="<?php echo $APP_URL; ?>dashboard/assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
 
<script src="<?php echo $APP_URL; ?>dashboard/assets/js/jquery.cookie.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<!-- DataTables Responsive JS -->
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {
        $('#example').DataTable({
            responsive: true
        });
    });
</script>
<div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Users</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo $APP_URL?>Api/admin/users.php" method="post" id="createUserForm" class="signin-form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputUsername1"
                            placeholder="Name here">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputUsername1"
                            placeholder="Email here">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Select Retailer</label>
                        <select name="retailer" class="form-select" id="">
                            <option value="" hidden selected>Assign Retailer</option>
                            <?php 
                            foreach ($retailerArray as $row) {  // Loop through all distributors
                                ?>
                            <option value="<?php echo $row['id'];?>">
                                <?php echo htmlspecialchars($row['name'] . ' - ' . $row['shop']);?>
                            </option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" name="create" class="btn btn-dark btn-rounded btn-fw">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $("#createUserForm").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            retailer: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter your name"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            },
            retailer: {
                required: "Please select a retailer"
            }
        },
        submitHandler: function(form) {
            form.submit(); // Use AJAX if you want to handle form submission without reloading the page
        }
    });
});
</script>
</html>