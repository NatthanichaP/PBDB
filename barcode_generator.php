<?php
// Include the library
require 'vendor/autoload.php';

// Connect to your database
require_once 'config/db.php';

// Retrieve data from the database to generate barcode
$session_useremail = $_SESSION['useremail'];
$sql = "SELECT * FROM tbcard WHERE memberid = '$session_useremail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $barcode = $row['barcode'];

    // Set up the barcode generator
    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();

    // Generate the barcode image
    $barcodeImage = $generator->getBarcode($barcode, $generator::TYPE_CODE_128, 2, 60);

    // Output the barcode image to the browser
    echo '<img src="data:image/png;base64,' . base64_encode($barcodeImage) . '" alt="Barcode">';
} else {
    echo "No barcode found";
}

// Close the database connection
$conn->close();
?>
