<html>
<body>
    <?php 
    $arr_a = array($_POST["a_1"], $_POST["a_2"], $_POST["a_3"]);
    $arr_b = array($_POST["b_1"], $_POST["b_2"], $_POST["b_3"]);
    
    function dot($arr_a, $arr_b) {
        $sum = 0;
        $length = count($arr_a);

        foreach($arr_a as $key => $value) {
            $sum += $value * $arr_b[$key];
        }
        return $sum;
    }

    echo("Array A:<br>");
    print_r($arr_a);
    echo("<br>Array B:<br>");
    print_r($arr_b);
    echo("<br>");

    foreach($arr_a as &$a) {
        if(! ctype_digit($a) && ! ctype_digit($a * -1)) {
            echo("Value $a from the Array A is not an integer!");
            exit;
        }
    }
    
    foreach($arr_b as &$b) {
        if(! ctype_digit($b) && ! ctype_digit($b * -1)) {
            echo("Value $b from the Array B is not an integer!");
            exit;
        }
    }
    $count_a = count($arr_a);
    $count_b = count($arr_b);
    echo("Array A has length of $count_a and array B has length of $count_b. Thus you ");
    if ($count_a == $count_b) {
        echo("can count their dot product.");
    } else {
        echo("can't count their dot product.");
        exit;
    }

    echo(" Which is: ");
    echo(dot($arr_a, $arr_b));

    ?>
</body>
</html> 