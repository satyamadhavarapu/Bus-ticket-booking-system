<?php
// db.php - Database connection
$host = 'localhost'; // Your database host
$db   = 'online_bus'; // Your database name
$user = 'root'; // Your database username
$pass = 'satya'; // Your database password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit();
}

// save_passenger.php - Save passenger details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve contact information
    $phone_number = $_POST['contact-phone'];
    $email = $_POST['contact-email'];

    // Prepare to collect passenger details
    $passengerDetails = [];

    // Loop through POST data to collect passenger details
    foreach ($_POST as $key => $value) {
        // Check for keys that match passenger details
        if (strpos($key, 'passenger-') === 0) {
            // Extract seat number from the key
            $seat = explode('-', $key)[1];

            // Store the details in a structured way
            $passengerDetails[$seat][$key] = $value;
        }
    }

    // Loop through each passenger detail and insert into database
    foreach ($passengerDetails as $seat => $details) {
        $name = $details["passenger-$seat-name"];
        $age = $details["passenger-$seat-age"];
        $gender = $details["passenger-$seat-gender"];

        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO passenger_details (name, age, gender, phone_number, email) VALUES (?, ?, ?, ?, ?)");
        
        try {
            // Execute the statement
            $stmt->execute([$name, $age, $gender, $phone_number, $email]);
            echo "Passenger $name details saved successfully!<br>";
        } catch (PDOException $e) {
            echo "Error inserting data for passenger $name: " . $e->getMessage() . "<br>";
        }
    }
}
?>
