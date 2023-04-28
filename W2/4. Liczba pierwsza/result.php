<html>
<body>
    <?php 
    $a = $_POST["a"];

    function dodaj($a, $b) {
        echo $a + $b;
    }

    function trial_division($n) {
        $arr = [];
        $f = 2;
        while($n > 1) {
            if($n % $f == 0) {
                $arr[] = $f;
                $n /= $f;
            } else {
                $f += 1;
            }
        }
    print_r($arr);
    return count($arr);
    }    

    $result = trial_division($a);
    echo("<br>Długość tablicy: $result");
    
    if ($result == 1) {
        echo("<br>Liczba jest pierwsza.");
    } else {
        echo("<br>Liczba nie jest pierwsza.");
        
    }
    ?>
</body>
</html> 