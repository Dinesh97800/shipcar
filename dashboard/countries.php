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
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class=" card-title text-start">Countries</h4>
                            <button type="button" class="btn btn-dark w-auto" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">Create Countries</button>
                        </div>

                        </p>
                        <div class="table-responsive pt-3">

                            <?php
                            $tableColumn = ['#', 'Country Name', 'Created', 'Action'];
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Distributor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo $APP_URL ?>Api/admin/countries.php" method="post" class="signin-form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Name</label>
                        <input type="text" name="name" class="form-control" id="countryNameInput" placeholder="Name here" >
                        <input type="hidden" name="id" id="countryIdInput"> 
                    </div>
                </div>
                <div class="modal-footer">
                <button type="submit" name="create" id="submitBtn" class="btn btn-dark btn-rounded btn-fw">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade " id="staticBackdropPort" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">View Ports</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="portForm" action="<?php echo $APP_URL ?>Api/admin/addUpdatePort.php" method="post">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="portNameInput">Name</label>
                            <input type="text" name="portNameInput" class="form-control" id="portNameInput" placeholder="Name here">
                            <input type="hidden" name="countryId" id="countryId">
                            <input type="hidden" name="portId" id="portId">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" id="portSubmitButton" name="create" style="margin-top:15%;" class="btn btn-dark btn-rounded btn-fw">Add Port</button>
                        </div>
                    </div>
                </form>
                    <br><br>
                    <div class="row">
                    <table id="portTable" class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="portTableBody">

                        </tbody>
                    </table>
                    </div>
                </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        // Handle the 'Edit' button click event
        $('.edit-country-btn').click(function () {
            var countryId = $(this).data('country-id');
            var countryName = $(this).data('country-name');
            // Set the modal for editing
            $('#staticBackdropLabel').text('Edit Country');
            $('#countryForm').attr('action', '<?php echo $APP_URL ?>Api/admin/countries.php');
            $('#countryNameInput').val(countryName);
            $('#countryIdInput').val(countryId);
            $('#submitBtn').text('Edit');
            $('#submitBtn').attr('name', 'edit'); // Change the button name to "edit"
        });
        $('.btn-close').click(function () {
            $('#staticBackdropLabel').text('Create Country');
            $('#countryForm').trigger('reset');
            $('#submitBtn').text('Create');
            $('#submitBtn').attr('name', 'create');
            $('#countryNameInput').val("");
            $('#countryIdInput').val('');

        })

        $('.view-port-btn').click(function() {
        var countryId = $(this).data('country-id');
        $('#countryId').val(countryId);

        $.ajax({
            url: '<?php echo $APP_URL; ?>Api/admin/getPorts.php', // Adjust the URL as needed
            type: 'GET',
            data: { country_id: countryId },
            dataType: 'json',
            success: function(response) {
                populatePortsTable(response);
            },
            error: function() {
                alert('Error fetching ports data.');
            }
        });
    });

    function populatePortsTable(ports) {
        var tableBody = $('.portTableBody');
        tableBody.empty(); // Clear the table before appending new rows

        $.each(ports, function(index, port) {
            var row = $('<tr>');
            row.append('<td>' + (index + 1) + '</td>');
            row.append('<td>' + port.name + '</td>');
            row.append('<td>' +
                '<button class="btn btn-primary btn-sm edit-port-btn" data-name="'+port.name+'" data-id="' + port.id + '">Edit</button> ' +
                '<button class="btn btn-danger btn-sm delete-port-btn" data-id="' + port.id + '">Delete</button>' +
                '</td>');
            tableBody.append(row);
        });

        // Initialize DataTable
        $('#portTable').DataTable();
    }
    });

    $(document).on('click', '.edit-port-btn', function() {
        var portId = $(this).data('id');
        var portName = $(this).data('name');
        $("#portNameInput").val(portName);
        $("#portId").val(portId);
        $("#portNameInput").focus();
        $("#portSubmitButton").text('Update Port');
        $("#portSubmitButton").attr('name', 'update');
        // alert('Edit port with ID ' + portId);
    });

    $(document).on('click', '.delete-port-btn', function() {
        var portId = $(this).data('id');
        if (confirm('Are you sure you want to delete this port?')) {
            $.ajax({
                url: '<?php echo $APP_URL; ?>Api/admin/deletePort.php',
                type: 'POST',
                data: { id: portId },
                success: function(response) {
                    var row = $(this).closest('tr');
                    
                    // var dataTable = $('#portTable').DataTable();
                    // dataTable.row(row).remove().draw(false);
                    // $("#staticBackdropPort").hide();
                    // $("#portForm")[0].reset();
                    alert('Port deleted successfully.');
                    window.location.href = window.location.origin + window.location.pathname;
                },
                error: function() {
                    alert('Error deleting port.');
                }
            });
        }
    });
</script>

</html>
