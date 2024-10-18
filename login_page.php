<?php
session_start(); // Start the session to manage user login state

// Retrieve user input safely
$name = $_POST['email'] ?? ''; // Use null coalescing operator to avoid undefined index
$pswrd = $_POST['password'] ?? '';

// Connect to the database
$db = mysqli_connect('localhost', 'root', 'satya', 'online_bus') or die("Could not connect to Database");

// Use a prepared statement to prevent SQL injection
$query = "SELECT * FROM user__details WHERE email = ?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, 's', $name);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if the user exists
if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    
    // Verify the password (assuming you are using password_hash() to store it)
    if (password_verify($pswrd, $row['password'])) {
        $_SESSION['user'] = $name; // Store user information in session
        header('Location: bus-selection.html'); // Redirect to landing page
        exit();
    } else {
        echo "<font size='5' color='red'>Invalid user ID or password</font>";
    }
} else {
    echo "<font size='5' color='red'>Invalid user ID or password</font>";
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($db);
?>
