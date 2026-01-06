<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // Try empty first
$dbname = 'promised_petals_local';

echo "Attempting connection to MySQL as root (no password)...\n";

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed with empty password: " . $e->getMessage() . "\n";
    echo "Attempting connection with password 'root'...\n";
    try {
        $pass = 'root';
        $pdo = new PDO("mysql:host=$host", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e2) {
        die("FATAL: Could not connect to MySQL using PDO. Please ensure MySQL is running.\nError: " . $e2->getMessage());
    }
}

echo "Connected successfully.\n";

// Dropping existing db
echo "Dropping database $dbname if exists...\n";
$pdo->exec("DROP DATABASE IF EXISTS $dbname");

echo "Creating database $dbname...\n";
$pdo->exec("CREATE DATABASE $dbname");
$pdo->exec("USE $dbname");

// Read SQL file
$sqlFile = __DIR__ . '/database.sql';
if (!file_exists($sqlFile)) {
    die("Error: database.sql not found at $sqlFile");
}

$sql = file_get_contents($sqlFile);

// PDO doesn't strictly support multiple queries in one execute call reliably across all drivers/configs,
// but MySQL driver usually allows it.
// However, splitting by ; is safer for simple dumps.
// Let's try direct exec first, if it fails, fallback.

try {
    $pdo->exec($sql);
    echo "Schema imported successfully.\n";
} catch (PDOException $e) {
    echo "Error importing schema with single exec: " . $e->getMessage() . "\n";
    echo "Attempting statement split...\n";

    // Very naive splitter
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    foreach ($statements as $stmt) {
        if (!empty($stmt)) {
            try {
                $pdo->exec($stmt);
            } catch (PDOException $e2) {
                // Ignore small errors or log
                echo "Warning on statement: " . substr($stmt, 0, 50) . "... Error: " . $e2->getMessage() . "\n";
            }
        }
    }
}

echo "Setup complete.\n";
