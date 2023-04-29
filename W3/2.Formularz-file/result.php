<html>
<body>
<?php         
 ini_set('display_errors', 1); // set to 0 for production version
 error_reporting(E_ALL);
if(isset($_POST['text']))
{
    $filename = 'log.txt';
    $this_directory = dirname(__FILE__);
    // $filename = ($this_directory . '/' . $filename);
    $text=$_POST['text'];
    $timestamp=date('[ m/d/Y h:i:s a ]', time());

    function safe_append($filename, $data) {
        if (!is_writable($filename)) {
            echo("<br>File detected, but has no permission to be writable! Trying to fix that...");
            // $results = @chmod($filename, 0777);  
        }

        if (is_writable($filename)) {
            if (!$fp = fopen($filename, 'a')) {
                echo "Cannot open file ($filename)";
                return 1;
            }

            if (fwrite($fp, $data) === FALSE) {
                echo "Cannot write to file ($filename)";
                return 1;
            }

            echo "Success, wrote ($data) to file ($filename)";

            fclose($fp);
        }    else {
            echo "<br>The file $filename is not writable";
            return 1;
        }
        return 0;
    }

    safe_append($filename, $timestamp);
    safe_append($filename, $text);
    safe_append($filename, "\n");
echo("Dane zapisane poprawnie!");
} else {
    echo("Uwaga! Wykryto puste pole tekstowe! Dane nie zostały zapisane...");
}

?>
</body>
</html> 