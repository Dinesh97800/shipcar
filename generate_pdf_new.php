<?php

 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
require('fpdf.php');
include(__DIR__ . '/./vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Decode JSON data
$postData = json_decode(file_get_contents('php://input'), true);
// $con = new mysqli("localhost", "root", "", "shippingcar");
$con = new mysqli("sg1-ts102.a2hosting.com", "khojiinf_shippingcar", "shippingcar@123", "khojiinf_shippingcar");

if ($con->connect_error) die("Connection failed: " . $con->connect_error);

// Check if the necessary keys exist in the $postData array
if (isset($postData['make']) && isset($postData['model']) && isset($postData['destinationCountry'])) {
  
    $make = $postData['make'];
    $model = $postData['model'];
    $destinationCountry = $postData['destinationCountry'];
    $length = $postData['length'];
    $width = $postData['width'];
    $height = $postData['height'];
    $volume = $postData['volume'];
    // $shippingCost = $postData['shippingCost'];
    $email = $postData['email'];

    $makeModel = $make . ' ' . $model;

    $sql = "SELECT * FROM car_details WHERE model LIke '%$makeModel%'";
    $result = $con->query($sql);

    $cars = $result->fetch_assoc();
    $length = isset($cars['length_cm']) ? $cars['length_cm'] / 100 : (isset($postData['length']) ? $postData['length'] : 4.5);
    $width = isset($cars['width_cm']) ? $cars['width_cm'] / 100 : (isset($postData['width']) ? $postData['width'] : 1.8);
    $height = isset($cars['height_cm']) ? $cars['height_cm'] / 100 : (isset($postData['height']) ? $postData['height'] : 1.4);
    
    
    $volume = $length * $width * $height;


    $shippingCost;
    $destinationCountry = strtolower($destinationCountry);

    if ($destinationCountry === "turkey") {
        if ($length <= 5 && $height <= 1.6) {
            $shippingCost = 645.00;
        } elseif ($length <= 6 && $height <= 2.0) {
            $shippingCost = 765.00;
        } elseif ($length <= 6 && $height <= 2.2) {
            $shippingCost = 995.00;
        } else {
            $shippingCost = 1100.00;
        }
    } elseif ($destinationCountry === "australia") {
        if ($length <= 5.2 && $height <= 1.6) {
            $shippingCost = 1195.00;
        } elseif ($length <= 5.2 && $height <= 2.0) {
            $shippingCost = 1395.00;
        } else {
            $shippingCost = 2100.00;
        }
    } else {
        $shippingCost = number_format((130 + 15.5 + 0.58) * $volume, 2);
    }

    // Create instance of FPDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16); // Set font to Arial, Bold, 16pt
   
    // Add title
    $pdf->Cell(0, 10, 'Car Shipping Quote', 0, 1, 'C');

    // Add car details
    $pdf->SetFont('Arial', '', 12); // Set font to Arial, regular, 12pt
    $pdf->Cell(0, 10, 'Car Make: ' . $make, 0, 1);
    $pdf->Cell(0, 10, 'Car Model: ' . $model, 0, 1);
    $pdf->Cell(0, 10, 'Length: ' . $length . ' meters', 0, 1);
    $pdf->Cell(0, 10, 'Width: ' . $width . ' meters', 0, 1);
    $pdf->Cell(0, 10, 'Height: ' . $height . ' meters', 0, 1);
    $pdf->Cell(0, 10, 'Volume: ' . $volume . ' cubic meters', 0, 1);
    $pdf->Cell(0, 10, 'Shipping Cost to ' . ucfirst($destinationCountry) . ': £' . $shippingCost, 0, 1);

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
        $mail->Host = 'fussfreecars.com';  // Specify the SMTP server
        $mail->SMTPAuth = true;  // Enable SMTP authentication
        $mail->Username = 'support@fussfreecars.com';  // SMTP username
        $mail->Password = 'fjg8$JW),LHg';  // SMTP password
        $mail->SMTPSecure = 'tls';  // Enable TLS encryption
        $mail->Port = 587;  // TCP port to connect to
        // support@shippingcar.co.uk
        // a#xpZDr*}d_2
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->setFrom("support@shippingcar.co.uk", "ShippingCar");
        $mail->Subject = 'ShippingCar - Your Shipping Quote';

        $msg = '
         <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
             <div style="margin:50px auto;width:70%;padding:20px 0">
                 <div style="border-bottom:1px solid #eee">
                     <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">ShippingCar.in</a>
                 </div>
                 <p style="font-size:1.1em">Hi Dear,</p>
                 <p>Your car shipping quote has been generated successfully on ShippingCar.in. Below are your shipping details:</p>
                 <table style="width:100%; border-collapse: collapse;">
                     <tr>
                         <th style="border: 1px solid #ddd; padding: 8px;">Car Make</th>
                         <td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($make) . '</td>
                     </tr>
                     <tr>
                         <th style="border: 1px solid #ddd; padding: 8px;">Car Model</th>
                         <td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($model) . '</td>
                     </tr>
                     <tr>
                         <th style="border: 1px solid #ddd; padding: 8px;">Destination Country</th>
                         <td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars(ucfirst($destinationCountry)) . '</td>
                     </tr>
                     <tr>
                         <th style="border: 1px solid #ddd; padding: 8px;">Length</th>
                         <td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($length) . ' meters</td>
                     </tr>
                     <tr>
                         <th style="border: 1px solid #ddd; padding: 8px;">Width</th>
                         <td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($width) . ' meters</td>
                     </tr>
                     <tr>
                         <th style="border: 1px solid #ddd; padding: 8px;">Height</th>
                         <td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($height) . ' meters</td>
                     </tr>
                     <tr>
                         <th style="border: 1px solid #ddd; padding: 8px;">Shipping Cost</th>
                         <td style="border: 1px solid #ddd; padding: 8px;">£' . htmlspecialchars($shippingCost) . '</td>
                     </tr>
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

        $mail->send();

        $sqlQuery = "Insert into pdf_details (email,make,model,destination,length,width,height,cost)Values('$email','$make','$model','$destinationCountry','$length','$width','$height','$shippingCost')";
        $con->query($sqlQuery);

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

} else {
    // Handle the error if necessary
    echo json_encode([
        "status" => false,
        "message" => "Invalid data received.",
    ]);
}
?>