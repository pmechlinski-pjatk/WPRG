<?php

# Error logging template
function logfailedQuery($description = 'unknown') {
    writeLog(createLogMessage(3, "Query failed! It was: $description", "DB_CONNECTOR"));
    exit();
}
# Needle = IP of a guest that's checked for
function checkIfExists($needle) {
$mysqli = new mysqli("localhost", "php", "verySTRONGpassword1", "stock_scrapper_db");
if ($mysqli -> connect_errno) {
    writeLog(createLogMessage(3, "Connection to the database failed.", "DB_CONNECTOR"));
    exit();
} 
mysqli_select_db($mysqli, 'stock_scrapper_db');

$needle = $mysqli->real_escape_string($needle); // Sanitize the input
$query = "SELECT COUNT(*) AS record_count FROM guest_book WHERE ip='$needle'";
$result = $mysqli->query($query);
if ($result === false) {
    logfailedQuery($query);
}

$row = $result->fetch_assoc();
$recordCount = $row['record_count'];
$result->close();
$mysqli->close();

// Use the $recordCount variable as needed

    if($recordCount == 0) {
        return False;
    } else {
       return True;
    } 
}

function updateGuestBook($needle) {
    $mysqli = new mysqli("localhost", "php", "verySTRONGpassword1");
    mysqli_select_db($mysqli, 'stock_scrapper_db');
    if ($mysqli -> connect_errno) {
        writeLog(createLogMessage(3, "Connection to the database failed.", "DB_CONNECTOR"));
        exit();
    } else {
        writeLog(createLogMessage(0, "Connection to the database was successful.", "DB_CONNECTOR"));
    }
    $TIMESTAMP = date("H:I:s d-m-Y");
    if (checkIfExists($needle)) {
        # If it exists then increment search count and update timestamp
    
        # First get current search_count for a given user
        $search_count_result = mysqli_query($mysqli, "SELECT search_count FROM guest_book WHERE IP = '$needle'");
        if (!$search_count_result) {
            logfailedQuery($search_count_result);
        }
    
        $row = $search_count_result->fetch_assoc();
        $search_count = $row['search_count'];
    
        # Increment search_count for a given user (ip)
        $search_count++;
        $query = mysqli_query($mysqli, "UPDATE guest_book SET search_count = $search_count WHERE IP = '$needle'");
        if (!$query) {
            logfailedQuery($query);
        }
    
        # Update timestamp for a given user (ip)
        $query = mysqli_query($mysqli, "UPDATE guest_book SET last_visit = '$TIMESTAMP' WHERE IP = '$needle'");
        if (!$query) {
            logfailedQuery($query);
        }
    
    } else {
        # If it doesn't exist, create a new entry
        $query = mysqli_query($mysqli, "INSERT INTO guest_book (IP, search_count, last_visit) VALUES ('$needle', 1, '$TIMESTAMP')");
        if (!$query) {
            logfailedQuery($query);
        }
    }
    
    # Close the connection
    $mysqli->close();
    
    return 0;
}


# Init
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = new mysqli('localhost', 'php', 'verySTRONGpassword1');

# Check connection to the DB server
if ($mysqli -> connect_errno) {
    writeLog(createLogMessage(3, "Initial connection to the database failed.", "DB_CONNECTOR"));
    exit();
} else {
    writeLog(createLogMessage(0, "Initial connection to the database was successful.", "DB_CONNECTOR"));
}

# Check if database exists & connect to it
$query = mysqli_query($mysqli, "CREATE DATABASE IF NOT EXISTS stock_scrapper_db");
if (!$query) logfailedQuery($query);
if (mysqli_select_db($mysqli, 'stock_scrapper_db')) {
    writeLog(createLogMessage(0, "Database stock_scrapper_db was selected.", "DB_CONNECTOR"));
} else {
    writeLog(createLogMessage(3, "Cannot connect to stock_scrapper_db database.", "DB_CONNECTOR"));
    exit();
}

# Check if a table exists and select it
$query = mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS guest_book (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    IP VARCHAR(20) NOT NULL UNIQUE,
    last_visit VARCHAR(50) NOT NULL,
    search_count INT(20) UNSIGNED NOT NULL
    )");
if (!$query) logfailedQuery($query);
$mysqli->close();
?>