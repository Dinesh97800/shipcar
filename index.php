<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get a Quote | shippingcar.co.uk</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-selection {
            height: 38px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: flex;
            align-items: center;
        }

        .select2-selection__placeholder {
            color: #aaa;
        }

        .select2-selection__rendered {
            padding: 8px;
        }

        .select2-selection__arrow {
            height: 100%;
            top: 0;
        }

        .select2-results {
            max-height: 200px;
            overflow-y: auto;
        }

        .select2-container .select2-selection--single {
            height: 40px !important;
        }
    </style>
</head>
<?php 
include('./Api/home.php');
?>

<body>

    <header>
        <img src="img/logo.jpg" alt="Logo">
    </header>
    <main>
        <div class="form-container">
            <h2>Get a Quote</h2>
            <form>
                <label for="car-makes">Email</label>
                <input type="email" id="email" name="email" class="form-field">

                <label for="car-type">Vehicle Type</label>
                <select id="car-type" name="car_type" class="form-field">
                    <option value="" hidden selected>Select car type</option>
                    <option value="0">Bike</option>
                    <option value="1">Car</option>
                    <option value="2">Truck</option>

                </select>

                <label for="car-makes">Select Make/Model</label>
                <!-- <select id="make" name="model" class="form-field"> -->
                <select id="make" name="model" class="form-field">
                    <option value="" hidden selected>Select Make</option>
                    <?php 
                         foreach ($makes as $cars) {
                            echo '<option value="' . htmlspecialchars($cars['id']) . '">' . htmlspecialchars($cars['model']) . '</option>';
                        }
                    ?>
                </select>

                <div id="custom-dimensions" style="display:none; margin-top: 1.2rem;">
                    <label for="car-length">Car Length (cm)</label>
                    <input type="text" id="car-length" name="length_cm" class="form-field" placeholder="e.g. 450">

                    <label for="car-width">Car Width (cm)</label>
                    <input type="text" id="car-width" name="width_cm" class="form-field" placeholder="e.g. 180">

                    <label for="car-height">Car Height (cm)</label>
                    <input type="text" id="car-height" name="height_cm" class="form-field" placeholder="e.g. 180">

                    <label for="car-weight">Car Weight (kg)</label>
                    <input type="text" style="margin-bottom:0px" id="car-weight" name="weight_kg" class="form-field"
                        placeholder="e.g. 1200.0">
                </div>

                <div>
                    <label for="shipToCountry" style="margin-top: 1.2rem">Destination Country</label>
                    <select id="shipToCountry" name="shipToCountry" class="form-field">
                        <option value="" hidden selected>Select Destination</option>
                        <?php 
                         foreach ($countries as $country) {
                            echo '<option value="' . htmlspecialchars($country['id']) . '">' . htmlspecialchars($country['name']) . '</option>';
                        }
                    ?>
                    </select>
                    <label for="shipToPort" style="margin-top: 1.2rem">Destination Port</label>
                    <select id="shipToPort" name="shipToPort" class="form-field">
                        <option value="" hidden selected>Select Port</option>
                    </select>
                </div>

                <button id="calculate" style="margin-top: 1.2rem" name="submit" type="button">Get Quote</button>
            </form>
            <div id="car-model-data" style="display:none"></div>
            <div id="car-details">

            </div>
            <b id="quote-result"></b>
        </div>
    </main>
    <script>
        $(document).ready(function () {
            $('select[name="model"]').select2({
                tags: true,
                placeholder: "Select OR Add Make",
                allowClear: false
            });

            $('select[name="model"]').on('change', function () {
                var selectedOption = $(this).val();
                var isCustomMake = $(this).find("option[value='" + selectedOption + "']").attr(
                    'data-select2-tag') === "true";

                if (isCustomMake) {
                    $('#custom-dimensions').show();
                } else {
                    $('#custom-dimensions').hide();
                }
            });

            $('#car-height , #car-weight, #car-width, #car-length').on('input', function () {
                var value = $(this).val();
                if (!/^\d*(\.\d{0,1})?$/.test(value)) {
                    $(this).val(value.substring(0, value.length -
                        1));
                }
            });


            $('select[name="shipToCountry"]').select2({
                tags: true,
                placeholder: "Select Or Add Country",
                allowClear: false
            });
            $('select[name="shipToPort"]').select2({
                tags: true,
                placeholder: "Select Or Add Port",
                allowClear: false
            });

        });
        $('#car-type').on('change', function (e) {
            e.preventDefault();
            $('#make').empty();
            const val = $(this).val();

            const url = '<?php echo $APP_URL?>'
            $.ajax({
                url: `${url}Api/home.php`,
                type: 'POST',
                dataType: 'json',
                data: {
                    type: val
                },
                success: function (data) {
                    const makes = data.makes;
                    $("#make").append('<option value="" hidden selected>Select Make</option>')
                    for (var i in makes) {
                        $("#make").append(new Option(makes[i].model, makes[i]
                            .id));
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
        })


        $('#shipToCountry').on('change', function (e) {
            e.preventDefault();
            $('#shipToCountryAdd, #shipToPortAdd, #AddCountry, #AddPort').remove();
            $("#shipToPort").empty();
            const val = $(this).val();
            const url = '<?php echo $APP_URL?>'
            $.ajax({
                url: `${url}Api/home.php`,
                type: 'POST',
                dataType: 'json',
                data: {
                    country_id: val
                },
                success: function (data) {
                    var ports = data.ports;
                    for (var i in ports) {
                        $("#shipToPort").append(new Option(ports[i].name, ports[i]
                            .id));
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error: " + error);
                }
            });

        });

        $("#calculate").click(function () {
            var make = $("#make").val();
            var model = $("#make option:selected").text();
            var destinationCountry = $("#shipToCountry").val();
            var destinationPort = $("#shipToPort").val();
            var email = $("#email").val();

            // Check if the make is newly added (tagged)
            var isCustomMake = $("#make option:selected").data('select2-tag') === true;
            var isCustomCountry = $("#shipToCountry option:selected").data('select2-tag') === true;
            var isCustomPort = $("#shipToPort option:selected").data('select2-tag') === true;

            // Collect data based on whether it's a custom option
            // Initialize formData
            var formData = {
                email: email,
                car_type: $("#car-type").val(),
            };

            // Add make or new_make
            if (isCustomMake) {
                formData.new_make = model;
            } else {
                formData.make = make;
            }

            // Add country or new_country
            if (isCustomCountry) {
                formData.new_country = destinationCountry;
            } else {
                formData.country = destinationCountry;
            }

            // Add port or new_port
            if (isCustomPort) {
                formData.new_port = destinationPort;
            } else {
                formData.port = destinationPort;
            }

            // Add custom dimensions if they are visible
            if ($("#custom-dimensions").is(":visible")) {
                formData.length_cm = $("#car-length").val();
                formData.width_cm = $("#car-width").val();
                formData.height_cm = $("#car-height").val();
                formData.weight_kg = $("#car-weight").val();
            }


            const url = '<?php echo $APP_URL?>'

            $.ajax({
                url: `${url}generateEnquiry.php`,
                type: 'POST',
                dataType: 'json',
                data: {
                    ...formData
                },
                success: function (response) {
                    window.location.href = "success.php"
                },
                error: function (xhr, status, error) {
                    window.location.href = "success.php"
                }
            });



        });
    </script>
</body>

</html>