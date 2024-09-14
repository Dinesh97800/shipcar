<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get a Quote | shippingcar.co.uk</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

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

                <label for="car-makes">Select Make</label>
                <select id="make" name="model" class="form-field">
                    <option value="" hidden selected>Select Make</option>
                </select>

                <label for="car-models">Select Model</label>
                <select id="model" name="model" required class="form-field">
                    <option value="" hidden selected>Select Model</option>
                </select>

                <label for="shipToCountry">Destination Country</label>
                <select id="shipToCountry" name="shipToCountry" class="form-field">
                    <option value="usa">USA</option>
                    <option value="australia">Australia</option>
                    <option value="canada">Canada</option>
                    <option value="uk">UK</option>
                    <option value="turkey">Turkey</option>
                </select>

                <button id="calculate" name="submit" type="button">Get Quote</button>
            </form>
            <div id="car-model-data" style="display:none"></div>
            <div id="car-details">

            </div>
            <b id="quote-result"></b>
        </div>
    </main>
    <script>
        // Populate car makes dynamically
        $.getJSON("https://www.carqueryapi.com/api/0.3/?callback=?", {
            cmd: "getMakes",
            year: "2020"
        }, function (data) {
            var makes = data.Makes;
            for (var i in makes) {
                $("#make").append(new Option(makes[i].make_display, makes[i].make));
            }
        });

        // Populate car models based on selected make
        $("#make").change(function () {
            var make = $(this).val();
            $("#model").empty().append(new Option("Select Model", ""));
            $.getJSON("https://www.carqueryapi.com/api/0.3/?callback=?", {
                cmd: "getModels",
                make: make
            }, function (data) {
                var models = data.Models;
                for (var i in models) {
                    $("#model").append(new Option(models[i].model_name, models[i].model_name));
                }
            });
        });


        // Fetch car details and calculate shipping cost
        $("#calculate").click(function () {
            var make = $("#make").val();
            var model = $("#model").val();
            // var sourceCountry = $("#shipFromCountry").val();
            var destinationCountry = $("#shipToCountry").val();

            if (make && model && destinationCountry) {
                $.getJSON("https://www.carqueryapi.com/api/0.3/?callback=?", {
                    cmd: "getTrims",
                    make: make,
                    model: model
                }, function (data) {
                    if (data.Trims.length > 0) {
                        var trim = data.Trims[0];

                        // Default values in case data is missing
                        var default_length = 4.5; // 4.5 meters
                        var default_width = 1.8; // 1.8 meters
                        var default_height = 1.4; // 1.4 meters

                        // Use API values if available, otherwise fallback to defaults
                        var length = trim.model_length_mm ? (trim.model_length_mm / 1000).toFixed(2) :
                            default_length;
                        var width = trim.model_width_mm ? (trim.model_width_mm / 1000).toFixed(2) :
                            default_width;
                        var height = trim.model_height_mm ? (trim.model_height_mm / 1000).toFixed(2) :
                            default_height;

                        var volume = (length * width * height).toFixed(2);

                        // var shipping_cost;

                        // // First Way: Use predefined rates based on destination and car size
                        // if (destinationCountry === "turkey") {
                        //     if (length <= 5 && height <= 1.6) {
                        //         shipping_cost = 645.00;
                        //     } else if (length <= 6 && height <= 2.0) {
                        //         shipping_cost = 765.00;
                        //     } else if (length <= 6 && height <= 2.2) {
                        //         shipping_cost = 995.00;
                        //     } else {
                        //         shipping_cost = 1100.00;
                        //     }
                        // } else if (destinationCountry === "australia") {
                        //     if (length <= 5.2 && height <= 1.6) {
                        //         shipping_cost = 1195.00;
                        //     } else if (length <= 5.2 && height <= 2.0) {
                        //         shipping_cost = 1395.00;
                        //     } else {
                        //         shipping_cost = 2100.00;
                        //     }
                        // } else {
                        //     // Second Way: Calculate based on volume for other destinations
                        //     shipping_cost = ((130 + 15.5 + 0.58) * volume).toFixed(2);
                        // }

                        // $("#car-details").html(`
                        //     <h1>Car Details:</h1>
                        //     <p>Model: ${trim.model_make_display}</p>
                        //     <p>Length: ${length} meters</p>
                        //     <p>Width: ${width} meters</p>
                        //     <p>Height: ${height} meters</p>
                        //     <p>Volume: ${volume} cubic meters</p>
                        //     <h2>Shipping Cost to ${destinationCountry.toUpperCase()}: £${shipping_cost}</h2>
                        // `);
                        // Prepare data to send to PDF generation script
                        var postData = {
                            make: make,
                            model: model,
                            destinationCountry: destinationCountry,
                            length: length,
                            width: width,
                            height: height,
                            volume: volume,
                            // shippingCost: shipping_cost,
                            email: $('#email').val()
                        };

                        // Send data to PHP script to generate PDF
                        // $.post('generate_pdf.php', postData);
                        $.ajax({
                            url: 'generate_pdf_new.php',
                            type: 'POST',
                            data: JSON.stringify(postData),
                            success: function (response) {
                                const res = typeof response === "string" ? JSON.parse(response) :response
                                console.log(res);
                                if(res.status === true){
                                    window.location.href = "success.php"
                                }
                                // Handle the response, e.g., show a success message or handle the PDF file
                            },
                            error: function (error) {
                                console.error("Error:", error);
                            }
                        });

                    } else {
                        $("#car-details").html("<p>No car data found.</p>");
                    }
                });
            } else {
                alert("Please fill out all fields.");
            }
        });

        // Fetch car details and calculate shipping cost
        // $("#calculate").click(function () {
        //     var make = $("#make").val();
        //     var model = $("#model").val();
        //     // var source = $("#source").val();
        //     // var destination = $("#destination").val();
        //     // && source && destination
        //     if (make && model) {
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
        //                 var default_weight = 1500; // 1500 kg

        //                 // Use API values if available, otherwise fallback to defaults
        //                 var length = trim.model_length_mm ? (trim.model_length_mm / 1000).toFixed(2) :
        //                     default_length;
        //                 var width = trim.model_width_mm ? (trim.model_width_mm / 1000).toFixed(2) :
        //                     default_width;
        //                 var height = trim.model_height_mm ? (trim.model_height_mm / 1000).toFixed(2) :
        //                     default_height;
        //                 var weight = trim.model_weight_kg ? trim.model_weight_kg : default_weight;

        //                 var volume = (length * width * height).toFixed(2);
        //                 var shipping_cost = (volume * weight * 0.5).toFixed(2); // Example formula

        //                 $("#car-details").html(`
        //                     <h1>Car Details:</h1>
        //                     <p>Model: ${trim.model_make_display}</p>
        //                     <p>Length: ${length} meters</p>
        //                     <p>Width: ${width} meters</p>
        //                     <p>Height: ${height} meters</p>
        //                     <p>Weight: ${weight} kg</p>
        //                     `);
        //                 // <h2>Shipping Cost from ${source} to ${destination}: $${shipping_cost}</h2>
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