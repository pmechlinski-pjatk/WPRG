<html>
<body>
    <?php 
    $a = $_POST["a"];
    $b = $_POST["b"];
    $c = $_POST["c"];



    // function process($a) {
    //     if (! ctype_digit($a)) {
    //         $a = round($a);
    //     }
    //     if ($a < 0) {
    //         $a *= -1;
    //     }

    //     while($a > 365) {
    //         $a -= 365;
    //     }
    //     return $a;
    // }

    // function count_month($a) {
    //     $count = 1;
    //     $long_months= array(1, 3, 5, 7, 8, 10, 12);
    //     $short_months= array(4, 6, 9, 11);

    //     while(true) {
    //         if(in_array($count, $long_months)) {
    //             // echo("<br>[DEBUG] LONG MONTH DETECTED.");
    //             $a -= 31;
    //             $count++;
    //             if($a <= 30) { 
    //                 // echo("<br>[DEBUG] NOT ENOUGH FOR ANOTHER MONTH.");
    //                 break; 
    //             }
    //         } elseif(in_array($count, $short_months)) {
    //             // echo("<br>[DEBUG] SHORT MONTH DETECTED.");
    //             $a -= 30;
    //             $count++;
    //             if($a <= 31) { 
    //                 // echo("<br>[DEBUG] NOT ENOUGH FOR ANOTHER MONTH.");
    //                 break; 
    //             }
    //         } elseif($count == 2) {
    //             // echo("<br>[DEBUG] FEBRUARY MONTH DETECTED.");
    //             $a -= 28;
    //             $count++;
    //             if($a <= 31) { 
    //                 // echo("<br>[DEBUG] NOT ENOUGH FOR ANOTHER MONTH.");
    //                 break; 
    //             }
    //         } 
    //     }
    //     // echo("<br>[DEBUG] Final result: $count.");
    //     return $count;
    // }
    // function get_month($a) {
    //     $a_processed = process($a);
    //     echo "Liczba wskazuje na $a_processed. dzień roku. Zatem szukany miesiąc to: ";
    //     switch (count_month($a_processed)) {
    //         case 1:
    //             echo "Styczeń";
    //             break;
    //         case 2:
    //             echo "Luty";
    //             break;
    //         case 3:
    //             echo "Marzec";
    //             break;
    //         case 4:
    //             echo "Kwiecień";
    //             break;
    //         case 5:
    //             echo "Maj";
    //             break;
    //         case 6:
    //             echo "Czerwiec";
    //             break;
    //         case 7:
    //             echo "Lipiec";
    //             break;
    //         case 8:
    //             echo "Sierpień";
    //             break;
    //         case 9:
    //             echo "Wrzesień";
    //             break;
    //         case 10:
    //             echo "Październik";
    //             break;
    //         case 11:
    //             echo "Listopad";
    //             break;
    //         case 12:
    //             echo "Grudzień";
    //             break;
    //         default:
    //             echo "[UNEXPECTED ERROR]";
    //             break;
    //     }
    // }

    // function manual_sort($a, $b, $c) {
    //     // $num_array = array($a, $b, $c);
    //     // $arr_max = 2;
    //     // $get_end = false;
    //     // while(! $get_end) {
    //     //     for($i = 0; $i < $arr_max-1; $i++) {

    //     //         # Check node and the next one.
    //     //         if($num_array[$i] > $num_array[$i+1]) {
    //     //             # if unsorted - sort and start checking again.
    //     //             $tmp = $num_array[$i+1];
    //     //             $num_array[$i+1] = $num_array[$i];
    //     //             $num_array[$i] = $tmp;
    //     //             break;
    //     //         } elseif ($i+1 == $arr_max) {
    //     //             # If sorted, check if those are the last ones and stop if yes.
    //     //             $get_end = true;
    //     //         }
    //     //     }
    //     // }
    //     // print_r($num_array);
    // }

    # Main
    if(is_numeric($a) && is_numeric($b) && is_numeric($c)) {
        $num_array = array($a, $b, $c);
        echo("Najmniejsze to w kolejności:<br>");
        $min_index = array_search(min($num_array), $num_array);
        echo(min($num_array));
        $max_index = array_search(max($num_array), $num_array);
        $medium_value;
        foreach($num_array as $key => $value) {
            if ($key != $min_index && $key != $max_index) {
                $medium_value = $value;
                echo("<br>$medium_value");
            }
        }
        echo("<br>");
        echo(max($num_array));

        echo("<br>Z kolei największe to w kolejności:<br>");
        echo(max($num_array));
        echo("<br>$medium_value<br>");
        echo(min($num_array));

    } else {
        echo("At least one variable is not a real number!");
    }
    
    ?>
</body>
</html> 