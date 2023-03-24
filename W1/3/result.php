<html>
<body>
    <?php 
    $a = $_POST["a"];
    
    $result = sqrt($a);
    echo(number_format($result, 2, ',', ''));
    ?>
</body>
</html> 