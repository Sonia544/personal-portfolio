<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize response message (optional, only used if not redirecting)
$responseMessage = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection settings
    $servername = "localhost";
    $username = "root";
    $password = ""; // Use empty string, not a space
    $dbname = "ta_portfolio";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect and sanitize form data
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName  = trim($_POST['lastName'] ?? '');
    $phone     = trim($_POST['phone'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $message   = trim($_POST['message'] ?? '');

    // Validate required fields
    if (!$firstName || !$lastName || !$phone || !$email || !$message) {
        $responseMessage = "❌ All fields are required.";
    } else {
        // Prepare and bind statement
        $stmt = $conn->prepare("INSERT INTO contact_messages (first_name, last_name, phone, email, message) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sssss", $firstName, $lastName, $phone, $email, $message);
            if ($stmt->execute()) {
                // Redirect to homepage on success jvgnvjg
                header("Location: index.html");
                exit();
            } else {
                $responseMessage = "❌ Error inserting message: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $responseMessage = "❌ Prepare failed: " . $conn->error;
        }
    }

    $conn->close();
}
?>
