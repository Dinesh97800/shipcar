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
                <option value="bike">Bike</option>
                <option value="car">Car</option>
                <option value="truck">Truck</option>

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

                    <label for="car-weight" >Car Weight (kg)</label>
                    <input type="text" style="margin-bottom:0px" id="car-weight" name="weight_kg" class="form-field" placeholder="e.g. 1200.0">
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



        $('#shipToCountry').on('change', function (e) {
            e.preventDefault();
            $('#shipToCountryAdd, #shipToPortAdd, #AddCountry, #AddPort').remove();
            $("#shipToPort").empty();
            const val = $(this).val();
            const url = '<?php echo $APP_URL?>'
            // if (val !== 'others') {
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
                    // $("#shipToPort").append('<option value="others">Other</option>')
                },
                error: function (xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
            // } 
            // else {
            //     $('#shipToCountry').after(`<label id="shipToCountryAdd" for="shipToCountryAdd">Add Destination Country</label>
            //     <input type="text" id="AddCountry" name="AddCountry" class="form-field">
            //     <label id="shipToPortAdd" for="shipToPortAdd">Add Destination Port</label>
            //     <input type="text" id="AddPort" name="AddPort" class="form-field">
            //     <button class="btn btn-success" style="margin-botton:5px" type="button">Add</button>
            //     `)
            // }
        });

        $("#calculate").click(function () {
            var make = $("#make").val();
            var destinationCountry = $("#shipToCountry").val();

            // Check if user added a custom make or model
            if (make && destinationCountry) {
                if ($.isArray(make) && make.length === 1 && make[0].text) {
                    console.log("New Make Added: " + make[0]);
                } else {
                    console.log("Selected Make: " + make);
                }
                console.log({
                    make,
                    destinationCountry
                })
                // Your existing AJAX call to get trims and calculate shipping cost...
            } else {
                alert("Please fill out all fields.");
            }
        });



        // Populate car makes dynamically
        // $.getJSON("https://www.carqueryapi.com/api/0.3/?callback=?", {
        //     cmd: "getMakes",
        //     year: "2020"
        // }, function (data) {
        //     var makes = data.Makes;
        //     for (var i in makes) {
        //         $("#make").append(new Option(makes[i].make_display, makes[i].make));
        //     }
        // });

        // Populate car models based on selected make
        // $("#make").change(function () {
        //     var make = $(this).val();
        //     $("#model").empty().append(new Option("Select Model", ""));
        //     $.getJSON("https://www.carqueryapi.com/api/0.3/?callback=?", {
        //         cmd: "getModels",
        //         make: make
        //     }, function (data) {
        //         var models = data.Models;
        //         for (var i in models) {
        //             $("#model").append(new Option(models[i].model_name, models[i].model_name));
        //         }
        //     });
        // });


        // Fetch car details and calculate shipping cost
        // $("#calculate").click(function () {
        //     var make = $("#make").val();
        //     var model = $("#model").val();
        //     // var sourceCountry = $("#shipFromCountry").val();
        //     var destinationCountry = $("#shipToCountry").val();

        //     if (make && model && destinationCountry) {
        //         $.getJSON("https://www.carqueryapi.com/api/0.3/?callback=?", {
        //             cmd: "getTrims",
        //             make: make,
        //             model: model
        //         }, function (data) {
        //             if (data.Trims.length > 0) {
        //                 var trim = data.Trims[0];

        //                 // Default values in case data is missing
        //                 var default_length = 4.5; // 4.5 meters
        //                 var default_width = 1.8; // 1.8 meters
        //                 var default_height = 1.4; // 1.4 meters

        //                 // Use API values if available, otherwise fallback to defaults
        //                 var length = trim.model_length_mm ? (trim.model_length_mm / 1000).toFixed(2) :
        //                     default_length;
        //                 var width = trim.model_width_mm ? (trim.model_width_mm / 1000).toFixed(2) :
        //                     default_width;
        //                 var height = trim.model_height_mm ? (trim.model_height_mm / 1000).toFixed(2) :
        //                     default_height;

        //                 var volume = (length * width * height).toFixed(2);


        //                 // Prepare data to send to PDF generation script
        //                 var postData = {
        //                     make: make,
        //                     model: model,
        //                     destinationCountry: destinationCountry,
        //                     length: length,
        //                     width: width,
        //                     height: height,
        //                     volume: volume,
        //                     // shippingCost: shipping_cost,
        //                     email: $('#email').val()
        //                 };

        //                 // Send data to PHP script to generate PDF
        //                 // $.post('generate_pdf.php', postData);
        //                 $.ajax({
        //                     url: 'generate_pdf_new.php',
        //                     type: 'POST',
        //                     data: JSON.stringify(postData),
        //                     success: function (response) {
        //                         const res = typeof response === "string" ? JSON.parse(
        //                             response) : response
        //                         console.log(res);
        //                         if (res.status === true) {
        //                             window.location.href = "success.php"
        //                         }
        //                         // Handle the response, e.g., show a success message or handle the PDF file
        //                     },
        //                     error: function (error) {
        //                         console.error("Error:", error);
        //                     }
        //                 });

        //             } else {
        //                 $("#car-details").html("<p>No car data found.</p>");
        //             }
        //         });
        //     } else {
        //         alert("Please fill out all fields.");
        //     }
        // });
    </script>
</body>

</html>