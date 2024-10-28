<?php
session_start();

// Enable error reporting for development (remove in production)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database connection
$conn = new mysqli('localhost', 'root', '', 'mobilemarvels');
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed.']));
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($username) && !empty($password)) {
        // Prepare and execute the query
        $stmt = $conn->prepare("SELECT password FROM reguser WHERE username = ?");
        if ($stmt === false) {
            die(json_encode(['success' => false, 'message' => 'Database query failed.']));
        }

        $stmt->bind_param("s", $username);
        if ($stmt->execute() === false) {
            die(json_encode(['success' => false, 'message' => 'Query execution failed.']));
        }

        $stmt->bind_result($hashedPassword);
        $stmt->fetch();
        $stmt->close();

        // Check if user exists
        if ($hashedPassword) {
            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // Password is correct, start a session
                session_regenerate_id(true); // Prevent session fixation attacks
                $_SESSION['username'] = $username;

                // Send success response
                echo json_encode(['success' => true, 'message' => 'Login successful.']);
                exit();
            } else {
                // Password incorrect
                echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
            }
        } else {
            // Username not found
            echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Please enter both username and password.']);
    }
}

$conn->close();
?>
