<html>
<body>
    <?php 
    $a = $_POST["pangram"];
    $a_as_array = str_split($a);
    print_r($a_as_array);

    $letter_count = 0;
    $letter_count_goal = 26;

    foreach(range('a', 'z') as $letter) {
        //echo("LETTER $letter:<br>");
        foreach($a_as_array as $charsy) {
            # Check if lowercase OR uppercase letter
            if ($letter == $charsy || $letter == strtoupper($charsy)) {
                $letter_count++;
                //echo("$letter MATCH $charsy<br>Count: $letter_count<br>");
            } else {
                // echo("$letter IS NOT $charsy<br>");
            }
            if ($letter_count == 26) {
                break;
            }
        }
        if ($letter_count == 26) {
            break;
        }
    }

    if($letter_count == $letter_count_goal) {
        echo("THIS IS A PANGRAM");
    } else {
        echo("THIS IS NOT A PANGRAM. It has only $letter_count/26 unique letters.");
    }
            
    ?>
</body>
</html> 