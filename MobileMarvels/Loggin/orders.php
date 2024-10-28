<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'mobilemarvels');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    echo "Database connection successful.<br>";
}

// Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fullname = $_POST['fullname'] ?? '';
        $email = $_POST['email'] ?? '';
        $address = $_POST['address'] ?? '';
        $city = $_POST['city'] ?? '';
        $province = $_POST['province'] ?? '';
        $zip = $_POST['zip'] ?? '';
        $cardname = $_POST['cardname'] ?? '';
        $cardnumber = $_POST['cardnumber'] ?? '';
        $expmonth = $_POST['expmonth'] ?? '';
        $expyear = $_POST['expyear'] ?? '';
        $cvv = $_POST['cvv'] ?? '';
    // Validate form data
    if (!empty($fullname) && !empty($email) && !empty($address) && !empty($city) && !empty($province) && !empty($zip) && !empty($cardname) && !empty($cardnumber) && !empty($expmonth) && !empty($expyear) && !empty($cvv)) {
        // Insert order details into the database
        $stmt = $conn->prepare("INSERT INTO orders (fullname, email, address, city, province, zip, cardname, cardnumber, expmonth, expyear, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssss", $fullname, $email, $address, $city, $province, $zip, $cardname, $cardnumber, $expmonth, $expyear, $cvv);
        
           // Execute the statement
    if ($stmt->execute()) {
    echo '<div class="success-message">';
    echo '<p>Your Order Confirmation is successful!</p>';
    echo '<p>Thank you for reaching out. We will get back to you soon.</p>';
    echo '</div>';
} else {
    echo '<div class="error-message"><p>Error: ' . $stmt->error . '</p></div>';
}


        $stmt->close();
    } else {
        echo "Please fill in all the required fields.";
    }
}

$conn->close();
?>
