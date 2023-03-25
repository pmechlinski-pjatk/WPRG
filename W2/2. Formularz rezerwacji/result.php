<html>
<body>
    <?php 
    $person_number = $_POST["person_number"];
    // Client's personals
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    
    // Address
    $street = $_POST["street"];
    $house_num = $_POST["house_num"];
    $flat_num = $_POST["flat_num"];
    $postal_code = $_POST["postal_code"];
    $city = $_POST["city"];

    // Contact data
    $tel_number = $_POST["tel_number"];
    $email = $_POST["email"];

    // Payment data
    $card_num = $_POST["card_num"];
    $card_exp_date = $_POST["card_exp_date"];
    $card_cvv = $_POST["card_cvv"];

    // Visit time
    $date_arrival = $_POST["date_arrival"];
    $date_departure = $_POST["date_departure"];
    $arrival_hour = $_POST["arrival_hour"];

    // Extra features
    $air_conditioning = $_POST["air_conditioning"];
    $baby_bed = $_POST["baby_bed"];
    $ashtray = $_POST["ashtray"];
    $welcome_gift = $_POST["welcome_gift"];
    $comments = $_POST["comments"];

    function get_hour_range($a) {
        switch($a) {
            case "morning":
                return "porannych (6-12)";
            case "afternoon":
                return "popołudniowych (12-18)";
            case "evening":
                return "wieczornych (18-24)";
            case "night":
                return "nocnych (0-6)";
            default:
                return null;
        }
    }

    
    function handle_person_number($person_number) {
        switch($person_number) {
            case 2:
                generate_extra_forms(1);
                break;
            case 3:
                generate_extra_forms(2);
                break;
            case 4:
                generate_extra_forms(3);
                break;
            default:
                break;
        }
    }

    function generate_extra_forms($i) {
        $j = 2;
        echo("<form action=\"result_extra_persons.php\" method=\"post\">");
        while($j <= $i +1) {
            echo("<br>Gość $j<br>
            Imię* <input type=\"text\" name=\"name\" required><br>
            Nazwisko* <input type=\"text\" name=\"surname\" required><br>");
            $j++;
        }

        echo("<input type=\"submit\" name=\"send\" value=\"Uzupełnij\"></form>");
    }

    // Get results
    $arrival_hours_parsed = get_hour_range($arrival_hour);
    echo("Podsumowanie rezerwacji:<br><b>1. Dane osoby zamawiającej</b><br>");
    echo("$name $surname<br>$city");
    if(! empty($street)) { echo(" <br>Ul."); }
    echo("$street $house_num $flat_num<br>$postal_code");
    echo("<br><b>2. Dane kontaktowe:</b><br>Tel. $tel_num<br>E-mail: $email<br>");
    echo("<b>3. Dane do płatności:</b><br>nr karty $card_num<br>$card_exp_date $card_cvv<br>");
    echo("<b>4. Informacje o rezerwacji:</b><br>Liczba gości: $person_number<br>Przyjazd $date_arrival w godzinach $arrival_hours_parsed<br>Odjazd $date_departure<br>");
    echo("Wybrane dodatkowe udogodnienia:<br>");
    if(! empty($air_conditioning)) { echo("- Klimatyzacja<br>"); }
    if(! empty($baby_bed)) { echo("- Dostawka<br>"); }
    if(! empty($ashtray)) { echo("- Popielniczka (pokój dla palących)<br>"); }
    if(! empty($welcome_gift)) { echo("- Zestaw powitalny<br>"); }

    if(! empty($comments)) { 
        echo("<br>Dodatkowe komentarze:<br>$comments<br>");
    } else echo("Brak dodatkowych komentarzy.");
    
    generate_extra_forms(3);
    echo("<br>
    Czy powyższe dane są poprawne?<br>
    <form action=\"finalize.html\" method=\"post\">
    <input type=\"submit\" name=\"send\" value=\"Potwierdzam\">
    </form>
    <form action=\"index.html\" method=\"post\">
    <input type=\"submit\" name=\"send\" value=\"Popraw\">
    </form>
    ");
    ?>
</body>
</html> 