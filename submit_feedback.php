<?php
$servername = "localhost";
$username = "root";  // Change this to your database username
$password = "";  // Change this to your database password
$dbname = "ecommerce";  // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

<?php
require 'includes/common.php';  // Include the database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate the data (you can add more validation if needed)
    if (empty($email) || empty($message)) {
        echo "<script>alert('Please fill in both fields.'); window.location.href='about.php';</script>";
        exit();
    }

    // Insert the data into the database
    $stmt = $conn->prepare("INSERT INTO phanhoi (email, noidung) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $message);

    if ($stmt->execute()) {
        // On successful submission, redirect back to the page
        echo "<script>alert('Your feedback has been submitted. Thank you!'); window.location.href='about.php';</script>";
    } else {
        // On failure, show an error message
        echo "<script>alert('There was an error submitting your feedback. Please try again later.'); window.location.href='about.php';</script>";
    }

    // Close the prepared statement and connection
    $stmt->close();
    $conn->close();
}
?>
