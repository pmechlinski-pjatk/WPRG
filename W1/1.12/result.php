<html>
<body>
    <?php 
    $a = $_POST["a"];
    $b = $_POST["b"];
    $non_transposed_array = array();

    echo("A=$a<br>B=$b<br>Before transposition:<br>===============<br>");
    function populate() {
        return rand(0,9);
    }

    for($i = 0; $i < $a; $i++) {
        for($j = 0; $j < $b; $j++) {
            $non_transposed_array[$i][$j] = populate();
        }

    }

    foreach ($non_transposed_array as $keys=> $b)	
	{
        echo("X  | ");
		foreach ($b as $key=> $c)
		{
            echo(" $key  | ");
                }
echo("<br>");
echo("-------------------------------<br>");
            break;
    }
    foreach ($non_transposed_array as $keys=> $b)	
	{
        echo("$keys | ");
		foreach ($b as $key=> $c)
		{
			echo $c, " | ";
		}
		echo "<br>";
	}	
            
    echo("<br>After transposition:<br>===============<br>");
    function transpose($array) {
        array_unshift($array, null);
        return call_user_func_array('array_map', $array);
    }
    
    $transposed_array = transpose($non_transposed_array);
    // Narysuj nagłówki kolumn
    foreach ($transposed_array as $keys=> $b)	
	{
        echo("T  | ");
		foreach ($b as $key=> $c)
		{
            echo(" $key  | ");
                }
echo("<br>");
echo("-------------------------------<br>");
            break;
    }
    foreach ($transposed_array as $keys=> $b)	//before $a value as $b
	{
        echo("$keys | ");
		foreach ($b as $key=> $c)
		{
			echo $c, " | ";
		}
		echo "<br>";
	}	
    ?>
</body>
</html> 