<?php

# Init
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// $pass = ini_get("mysql.default.password");
$pass = "verySTRONGpassword1";
echo("TEST");
$mysqli = new mysqli("localhost", "root", "VAIO_2137kghm");
# Check connection
if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }
$databaseName = 'stock_scrapper_db';
$query = 'CREATE DATABASE IF NOT EXISTS ' . $databaseName;

if (empty (mysqli_fetch_array(mysqli_query($mysqli,"SHOW DATABASES LIKE '$databaseName'")))) 
{
    if (!$result = $mysqli->query($query)) logfailedQuery($query);
}
mysqli_select_db($mysqli, $databaseName);

$query = "CREATE TABLE IF NOT EXISTS guest_book (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    IP VARCHAR(20) NOT NULL UNIQUE,
    last_visit VARCHAR(50) NOT NULL,
    search_count INT(20) UNSIGNED NOT NULL
    )";
if (!$result = $mysqli->query($query)) logfailedQuery($query);
$mysqli->close();

# Error logging template
function logfailedQuery($description = 'unknown') {
    writeLog(createLogMessage(3, "Query failed! It was: $description", "DB_CONNECTOR"));
    return 0;
}
# Needle = IP of a guest that's checked for
function checkIfExists($needle) {
    $mysqli = new mysqli("localhost", "php", "verySTRONGpassword1");

    $query="SELECT id FROM stock_scrapper_db WHERE ip = $needle";
    if (!$result = $mysqli->query($query)) logfailedQuery($query);
    $mysqli->close();
    if($result->num_rows == 0) {
        return False;
    } else {
       return True;
    } 
}

function updateGuestBook($needle) {
    $mysqli = new mysqli("localhost", "php", "verySTRONGpassword1");
    $TIMESTAMP = date("H:I:s d-m-Y");
    if (checkIfExists($needle)) {
        # If it exists then increment search count and update timestamp

        # First get current search_count for a given user
        $query = "SELECT search_count FROM guest_book WHERE IP = $needle";
        if (!$search_count = $mysqli->query($query)) logfailedQuery($query);

        # Increment search_count for a given user (ip)
        $search_count++;
        $query = "UPDATE guest_book set search_count = $search_count where IP = $needle";
        if (!$mysqli->query($query)) logfailedQuery($query);

        # Update timestamp for a given user (ip)
        $query = "UPDATE guest_book set last_visit = $TIMESTAMP where IP = $needle";
        if (!$mysqli->query($query)) logfailedQuery($query);

    } else {
        # If it exists, create a new entry
        $query = "INSERT INTO guest_book (IP, search_count, last_visit) VALUES ($needle, 1, $TIMESTAMP)";
    }
    # Close the connection
    $mysqli->close();
    return 0;
}
?>