<html>
<body>
    <?php 
    $a = $_POST["a"];
    $b = $_POST["b"];

    function dodaj($a, $b) {
        echo $a + $b;
    }

    function odejmij($a, $b) {
        echo $a - $b;
    }
    
    function pomnoz($a, $b) {
        echo $a * $b;
    }
    
    function podziel($a, $b) {
        echo $a / $b;
    }

    if ($_SERVER['REQUEST_METHOD']) {
         if (isset($_POST['dodawanie'])) {
             dodaj($a, $b);
         }  elseif (isset($_POST['odejmowanie'])) {
              odejmij($a, $b);
          } elseif (isset($_POST['mnożenie'])) {
              pomnoz($a, $b);
          } elseif (isset($_POST['dzielenie'])) {
              podziel($a, $b);
          } else {
              echo("UNEXPECTED ERROR!");
          };
     };
    ?>
</body>
</html> 