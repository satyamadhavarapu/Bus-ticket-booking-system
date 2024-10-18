<?php
// Start session if needed
session_start();

// Retrieve user input
$name = $_POST['usrnam_name'] ?? '';
$email = $_POST['mail_name'] ?? '';
$number = $_POST['contct_name'] ?? '';
$pswrd = $_POST['pass_name'] ?? '';
$cpswrd = $_POST['cpass_name'] ?? '';

// Check if password and confirm password match
if ($pswrd !== $cpswrd) {
    echo "<font color='red' size='5'>Passwords do not match. Please try again.</font>";
    exit();
}

// Hash the password
$hashed_password = password_hash($pswrd, PASSWORD_DEFAULT);

// Connect to the database
$db = mysqli_connect('localhost', 'root', 'satya', 'online_bus') or die("Could not connect to Database");

// Use prepared statement to prevent SQL injection
$query = "INSERT INTO user__details (name, email, password, cont_num) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, 'sssi', $name, $email, $hashed_password, $number);

// Execute the query and check for success
if (mysqli_stmt_execute($stmt)) {
    header('Location: login_page.html'); // Redirect to login page on success
} else {
    echo "<font color='red' size='5'>Error inserting data. Please try again.</font>";
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($db);
?>
