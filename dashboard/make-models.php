<?php
include('./partials/headers.php');
include(__DIR__ . '/../Api/admin/make-models.php');
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
                            <h4 class=" card-title text-start">Make Models</h4>
                            <button type="button" class="btn btn-dark w-auto" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">Add a new Vehicle</button>
                        </div>

                        </p>
                        <div class="table-responsive pt-3">

                            <?php
                            $tableColumn = ['#', 'Make/Model','length','width','height','weight_kg', 'Status','Action'];
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
<script>
    $(document).ready(function() {
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add a new Vehicle</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo $APP_URL ?>Api/admin/make-models.php" method="post" class="signin-form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Make/Model</label>
                        <input type="text" name="model" class="form-control" id="exampleInputUsername1" placeholder="Model here">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Length in CM</label>
                        <input type="text" name="length_cm" class="form-control" id="exampleInputUsername1" placeholder="Length here">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Width in CM</label>
                        <input type="text" name="width_cm" class="form-control" id="exampleInputUsername1" placeholder="Width here">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Height in CM</label>
                        <input type="text" name="height_cm" class="form-control" id="exampleInputUsername1" placeholder="Height here">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Weight in Kg</label>
                        <input type="text" name="weight_kg" class="form-control" id="exampleInputUsername1" placeholder="Weight here">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Make Type</label>
                        <select name="type" class="form-select form-select-lg" id="exampleFormControlSelect1">
                        <option value="0">Bike</option>
                        <option value="1">Car</option>
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
        // Allow only numbers in the specified input fields
        $('input[name="length_cm"], input[name="width_cm"], input[name="height_cm"], input[name="weight_kg"]').on('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, ''); // Replace non-numeric characters
            this.value = this.value.replace(/(\..*)\./g, '$1');

        });
    });
</script>


</html>