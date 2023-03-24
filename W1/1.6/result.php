<html>
<body>
    <?php 
    $a = $_POST["a"];
    $b = $_POST["b"];
    $c = $_POST["c"];
    
    function test_a($a, $b, $c) {
       if  (($a + $b) > $c) {
        echo("A and B when summed are greater than C<br>");
        return 0;
       } else {
        echo("A and B when summed are NOT greater than C!<br>");
        return 1;
       }
    }

    function test_b($a, $b, $c) {
        if  (($a + $c) > $b) {
         echo("A and C when summed are greater than B<br>");
         return 0;
        } else {
         echo("A and C when summed are NOT greater than B!<br>");
         return 1;
        }
     }

     function test_c($a, $b, $c) {
        if  (($b + $c) > $a) {
         echo("B and C when summed are greater than A<br>");
         return 0;
        } else {
         echo("B and C when summed are NOT greater than A!<br>");
         return 1;
        }
     }

    function wrong() {
        echo("Wrong triangle data!");
    }

    function good() {
        echo("Triangle data are valid!");
    }
    function triangle_test($a, $b, $c) {
        if (test_a($a, $b, $c) == 0 && test_b($a, $b, $c) == 0 && test_c($a, $b, $c) == 0) {
            good();           
        } else {
            wrong();
        }
    }

    if (! (ctype_digit($a) && ctype_digit($b) && ctype_digit($c)) || $a <= 0 || $b <= 0 || $c <= 0) {
        echo("BŁĄÐ");
    } else {
        triangle_test($a, $b, $c);
    }
    
    ?>
</body>
</html> 