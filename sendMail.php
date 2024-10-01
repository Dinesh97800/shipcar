<?php
require('fpdf.php');
include_once(__DIR__ . '/./vendor/autoload.php'); // Changed to include_once

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendpdf($email, $model, $country, $port, $length, $width, $height, $volume, $weight, $shippingCost) {
    // sendpdf($email, $model, $country, $port, $length_m, $width_m, $height_m, $volume_m3, $weight_kg, $total_cost);

    // Create instance of FPDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16); // Set font to Arial, Bold, 16pt

    // Add title
    $pdf->Cell(0, 10, 'Car Shipping Quote', 0, 1, 'C');

    // Add car details
    $pdf->SetFont('Arial', '', 12); // Set font to Arial, regular, 12pt
    $pdf->Cell(0, 10, 'Car Make/Model: ' . $model, 0, 1);
    $pdf->Cell(0, 10, 'Destination Country: ' . ucfirst($country), 0, 1);
    $pdf->Cell(0, 10, 'Port: ' . ucfirst($port), 0, 1);
    $pdf->Cell(0, 10, 'Length: ' . $length . ' meters', 0, 1);
    $pdf->Cell(0, 10, 'Width: ' . $width . ' meters', 0, 1);
    $pdf->Cell(0, 10, 'Height: ' . $height . ' meters', 0, 1);
    $pdf->Cell(0, 10, 'Volume: ' . $volume . ' cubic meters', 0, 1);
    $pdf->Cell(0, 10, 'Weight: ' . $weight . ' kg', 0, 1);
    $shippingCostFormatted = '£' . number_format($shippingCost, 2);
    $pdf->Cell(0, 10, 'Shipping Cost: ' . $shippingCostFormatted, 0, 1);

    // Output PDF
    $directory = 'quotes/';

    // Check if directory exists, if not create it
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }

    // Define file path
    $filePath = $directory . 'quote_' . time() . '.pdf';

    // Output PDF to file
    $pdf->Output('F', $filePath);

    // Now send the email with the attached PDF
    $mail = new PHPMailer(false); // Passing `true` enables exceptions
    try {
        $mail->isSMTP();  // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify the SMTP server
        $mail->SMTPAuth = true;  // Enable SMTP authentication
        $mail->Username = 'sharmasabb728@gmail.com';  // SMTP username
        $mail->Password = 'gswl jnxb oklu wrlr';  // SMTP password
        $mail->SMTPSecure = 'tls';  // Enable TLS encryption
        $mail->Port = 587;  // TCP port to connect to

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->setFrom("support@shippingcar.co.uk", "ShippingCar");
        $mail->Subject = 'ShippingCar - Your Shipping Quote';

        // Email body
        $msg = '
        <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
            <div style="margin:50px auto;width:70%;padding:20px 0">
                <div style="border-bottom:1px solid #eee">
                    <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">ShippingCar.in</a>
                </div>
                <p style="font-size:1.1em">Hi Dear,</p>
                <p>Your car shipping quote has been generated successfully on ShippingCar.in. Below are your shipping details:</p>
                <table style="width:100%; border-collapse: collapse;">';
        // (Rest of the HTML content)
        $msg .= '
                </table>
                <p style="font-size:0.9em;">If you have any questions or did not request this quote, please contact our support team immediately.</p>
                <hr style="border:none;border-top:1px solid #eee" />
                <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
                    <p>ShippingCar.in</p>
                </div>
            </div>
        </div>';

        $mail->Body = $msg;
        $mail->addAddress($email);

        // Attach the PDF file
        $mail->addAttachment($filePath);

        // Send the email
        $mail->send();

        // // Insert PDF details into the database
        // $sqlQuery = "INSERT INTO pdf_details (email, make, model, destination, port, length, width, height, volume, weight, cost) 
        //              VALUES ('$email', '$make', '$model', '$country', '$port', '$length', '$width', '$height', '$volume', '$weight', '$shippingCost')";
        // global $con; // Ensure that $con is in scope
        // $con->query($sqlQuery);

        echo json_encode([
            "status" => true,
            "message" => "PDF created and email sent successfully.",
        ]);
    } catch (Exception $e) {
        echo json_encode([
            "status" => false,
            "message" => 'PDF created but email could not be sent. Mailer Error: ' . $mail->ErrorInfo,
        ]);
    }
}
?>
