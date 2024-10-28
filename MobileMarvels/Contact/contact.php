

<?php
session_start();

// Create connection
$conn = new mysqli('localhost', 'root', '', 'mobilemarvels');

// Check connection
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    echo 'Connection successful <br>';
    
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'] ?? '';
    $lname = $_POST['lname'] ?? '';
    $email = $_POST['email'] ?? '';
    $country = $_POST['country'] ?? '';
    $subject = $_POST['subject'] ?? '';

     // Debugging: Output the form data
     var_dump($fname, $lname, $email, $country, $subject);

    // Correct the table name from 'cotact' to 'contact'
    $stmt = $conn->prepare("INSERT INTO contact (fname, lname, email, country, subject) VALUES (?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("sssss", $fname, $lname, $email, $country, $subject);

    // Execute the statement
 if ($stmt->execute()) {
    echo '<div class="success-message">';
    echo '<p>Contact information successfully submitted!</p>';
    echo '<p>Thank you for reaching out. We will get back to you soon.</p>';
    echo '</div>';
} else {
    echo '<div class="error-message"><p>Error: ' . $stmt->error . '</p></div>';
}


    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
