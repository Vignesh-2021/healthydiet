<?php
// Replace these variables with your actual database credentials
$host = 'localhost';
$dbName = 'contact';
$username = 'root';
$password = 'Koushik@0617';

// Establish a database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Check if data already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        echo '<script>alert("Duplicate Data not allowed!");</script>';
    } else {
        // Prepare and execute the SQL query to insert data
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, message) VALUES (:name, :email, :message)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':message', $message);
            $stmt->execute();

            echo '<script>alert("Request Send successfully!");</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>

