<html>
<body>
    <?php 
    $a = $_POST["a"];

    function print_next($a) {
        switch($a) {
            case 1:
            case 6:
            case 9:
            case 10:
                echo("*<br>");
                break;
            case 2:
            case 5:
            case 8:
            case 11:
                echo("**<br>");
                break;
            default:
                echo("***<br>");
                break;
        }
    }

    function pattern($a) {
        $full_count = $a * 4;
        $current_count = 1;


        while($current_count <= $full_count) {
            print_next($current_count); 
            $current_count++;
            if($current_count == 13) {
                $full_count -= 12;
                $current_count -=12; 
            }
        }
    }

    if (ctype_digit($a) && $a > 0) {
        pattern($a);
    } else {
        echo("Please submit natural number!");
    }
    ?>
</body>
</html> 