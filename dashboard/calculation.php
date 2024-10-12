<?php
include('./partials/headers.php');
include(__DIR__ . '/../Api/admin/countries.php');
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<!-- DataTables Responsive CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
<div class="main-panel">
    <div class="content-wrapper">
        <?php
        if (isset($_GET['status']) && isset($_GET['message'])) {
            $status = $_GET['status'];
            $message = urldecode($_GET['message']);
            
            if ($status === 'success') {
                echo "<div class='alert alert-success'>$message</div>";
            } elseif ($status === 'fail') {
                echo "<div class='alert alert-danger'>$message</div>";
            }
        }
    ?>
        <form id="formula-form" class="forms-sample">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Create Custom Formula</h4>
                            <div class="form-group">
                                <label for="formula">Enter Formula</label>
                                <!-- Admin enters a custom formula using variables like length, width, height, etc. -->
                                <input type="text" class="form-control" id="formula" name="formula"
                                    placeholder="E.g. (length * width * height) + handlingFee + destinationFee">
                                <small>Use variables: length, width, height, handlingFee, destinationFee, etc.</small>
                            </div>
                            <button type="button" id="calculate" class="btn btn-primary me-2">Calculate</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form class="forms-sample">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Default calculation values</h4>
                            <div class="form-group">
                                <label for="exampleSelectGender">Type</label>
                                <select class="form-select" id="type" name="type">
                                    <option value="" hidden selected>Select vehicle type</option>
                                    <option value="0">Bike</option>
                                    <option value="1">Car</option>
                                    <option value="2">Truck</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="length">Default Length CM</label>
                                <input type="text" class="form-control" id="length" name="length"
                                    placeholder="Length CM">
                            </div>
                            <div class="form-group">
                                <label for="height">Default Height CM</label>
                                <input type="text" class="form-control" id="height" name="height"
                                    placeholder="Height CM">
                            </div>
                            <div class="form-group">
                                <label for="width">Default Width CM</label>
                                <input type="text" class="form-control" id="width" name="width" placeholder="Width CM">
                            </div>
                            <div class="form-group">
                                <label for="weight">Default Weight KG</label>
                                <input type="text" class="form-control" id="weight" name="weight"
                                    placeholder="Weight KG">
                            </div>
                            <div class="form-group">
                                <label for="destination">Default Destination Fee</label>
                                <input type="text" class="form-control" id="destination" name="destination"
                                    placeholder="Destination Fee">
                            </div>
                            <div class="form-group">
                                <label for="handling_fee">Handling Fee</label>
                                <input type="text" class="form-control" id="handling_fee" name="handling_fee" placeholder="Handling Fee">
                            </div>
                            <div class="form-group">
                                <label for="cost_per_cbm">Default Cost Per CBM</label>
                                <input type="text" class="form-control" id="cost_per_cbm" name="cost_per_cbm"
                                    placeholder="Cost Per CBM">
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

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
<script src="<?php echo $APP_URL; ?>dashboard/common.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?php echo $APP_URL; ?>dashboard/assets/js/jquery.cookie.js" type="text/javascript"></script>

<script>
    document.getElementById("calculate").addEventListener("click", function() {
        var formula = document.getElementById("formula").value;
        var length = parseFloat(document.getElementById("length").value) || 0;
        var width = parseFloat(document.getElementById("width").value) || 0;
        var height = parseFloat(document.getElementById("height").value) || 0;
        var weight = parseFloat(document.getElementById("weight").value) || 0;
        var destinationFee = parseFloat(document.getElementById("destination").value) || 0;
        var costPerCbm = parseFloat(document.getElementById("cost_per_cbm").value) || 0;
        var handlingFee = parseFloat(document.getElementById("handling_fee").value) || 0;

        try {
            var estimatedCost = eval(formula);

            alert("Estimated cost: " + estimatedCost);
        } catch (e) {
            alert("Error in formula: " + e.message);
        }
    });
</script>


</html>