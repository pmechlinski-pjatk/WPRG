<?php
include 'getClientIP.php';
function createLogMessage($LEVEL, $DESCRIPTION, $source = '') {
    # Get general vars
    $CLIENT_IP = getClientIP();
    $TIMESTAMP = date("H:I:s d-m-Y");

    # Construct pre-JSON object
    $logJSON = new stdClass();
    # Add current time
    $logJSON -> timestamp = $TIMESTAMP;
    # Add log level as checked by updateLog function
    switch($LEVEL) {
        # OK
        case 0:
            $logJSON -> type = "OK";
            break;
        # INFO
        case 1:
            $logJSON -> type = "INFO";
            break;
        # WARN
        case 2:
            $logJSON -> type = "WARN";
            break;
        # ERROR
        case 3:
            $logJSON -> type = "ERROR";
            break;
        # Don't allow other log levels
        default:
            return 1;                   
    }
    # Add client's IP
    if ($CLIENT_IP != 1) {
        $logJSON -> IP = $CLIENT_IP;
        $logJSON -> description = $DESCRIPTION;
    } else {
        $logJSON -> IP = "UNKNOWN";
        $logJSON -> type = "ERROR";
    }

    # Add info about log source - if it's not set, then use basename of the script invoking the function.
    if (!isset($source)) {
        $logJSON -> source = basename(__FILE__);
    } else {
        $logJSON -> source = $source;
    }
    
    return json_encode($logJSON);    
}

# Function for validating controller output and mending log message based on that
function updateLog($html, $code, $source = '') {
    # Prepare log message based on current page status check
    if (!isset($code)) {
        $message = createLogMessage(3, "Couldn't find code variable from the form!", $source);
    } elseif (!$html) {
        $message = createLogMessage(1, "User requested data for a stock code that wasn't found in the external database. Code in the request: $code!", $source);
    } elseif ($html) {
        $message = createLogMessage(0, "User requested data for $code and the request was finalized with success.", $source);
    }

   if ($message == 1) {
    die("Unexpected error during decoding of the log level info!");
   }
   return $message;
}

# Generic function for log saving; when no filename set, scraper.log is used as the default one.
function writeLog($message, $filename = "scraper.log") {
   # Append to the .log file
   $fpointer = fopen($filename, "a") or die("Unable to open file!");
   fwrite($fpointer, "\n". $message);
   fclose($fpointer);
   return 0;
}
?>