<html>
<body>
    <?php 
    $a = $_POST["a"];
    $b = $_POST["b"];
    function result($a, $b) {
        $add = $a + $b;
        echo "$a + $b = $add"; //Dodawanie
        echo ("<br>");
        $sub = $a - $b;
        echo "$a - $b = $sub"; //Odejmowanie
        echo ("<br>");
        $mul = $a * $b;
        echo "$a * $b = $mul"; //Mnożenie
        echo ("<br>");
        $div = $a / $b;
        echo "$a / $b = $div"; //Dzielenie
        echo ("<br>");
        $mod = $a % $b;
        echo "$a % $b = $mod"; //Modulo
    }

    if (ctype_digit($a) && ctype_digit($b)) {
        result($a, $b);
    } else {
        echo("Those are not natural numbers!");
    }
    ?>
</body>
</html> 