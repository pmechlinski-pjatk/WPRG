<html>
<body>
    <?php
    ini_set('display_errors', 1); // set to 0 for production version
    error_reporting(E_ALL);
    session_start(); 
    setcookie("person_number", $_POST["person_number"], time()+60*60);
    // Client's personals
    setcookie("name", $_POST["name"], time()+60*60);
    setcookie("surname", $_POST["surname"], time()+60*60);
    
    // Address
    setcookie("street", $_POST["street"], time()+60*60);
    setcookie("house_num", $_POST["house_num"], time()+60*60);
    setcookie("flat_num", $_POST["flat_num"], time()+60*60);
    setcookie("postal_code", $_POST["postal_code"], time()+60*60);
    setcookie("city", $_POST["city"], time()+60*60);

    // Contact data
    setcookie("tel_num", $_POST["tel_num"], time()+60*60);
    setcookie("email", $_POST["email"], time()+60*60);

    // Payment data
    setcookie("card_num", $_POST["card_num"], time()+60*60);
    setcookie("card_exp_date", $_POST["card_exp_date"], time()+60*60);
    setcookie("card_cvv", $_POST["card_cvv"], time()+60*60);

    // Visit time
    setcookie("date_arrival", $_POST["date_arrival"], time()+60*60);
    setcookie("date_departure", $_POST["date_departure"], time()+60*60);
    setcookie("arrival_hour", $_POST["arrival_hour"], time()+60*60);

    // Extra features
    setcookie("air_conditioning", $_POST["air_conditioning"], time()+60*60);
    setcookie("baby_bed", $_POST["baby_bed"], time()+60*60);
    setcookie("ashtray", $_POST["ashtray"], time()+60*60);
    setcookie("welcome_gift", $_POST["welcome_gift"], time()+60*60);
    setcookie("comments", $_POST["comments"], time()+60*60);

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

    function generate_extra_forms($i) {
        $j = 2;
        echo("<form action=\"result_extra_persons.php\" method=\"post\">");
        while($j < $i+1 ) {
            echo("<br>Gość $j<br>
            Imię* <input type=\"text\" name=\"name${j}\" required><br>
            Nazwisko* <input type=\"text\" name=\"surname${j}\" required><br>");
            $j++;
        }

        echo("<input type=\"submit\" name=\"send\" value=\"Uzupełnij\"></form>");
    }

    // Get results
    $arrival_hours_parsed = get_hour_range($_COOKIE['arrival_hour']);
    echo("Podsumowanie rezerwacji:<br><b>1. Dane osoby zamawiającej</b><br>");
    echo("{$_COOKIE['name']} {$_COOKIE['surname']}<br>{$_COOKIE['city']}");
    if(! empty($_COOKIE['street'])) { echo(" <br>Ul."); }
    echo("{$_COOKIE['street']} {$_COOKIE['house_num']} {$_COOKIE['flat_num']}<br>{$_COOKIE['postal_code']}");
    echo("<br><b>2. Dane kontaktowe:</b><br>Tel. {$_COOKIE['tel_num']}<br>E-mail: {$_COOKIE['email']}<br>");
    echo("<b>3. Dane do płatności:</b><br>nr karty {$_COOKIE['card_num']}<br>{$_COOKIE['card_exp_date']} {$_COOKIE['card_cvv']}<br>");
    echo("<b>4. Informacje o rezerwacji:</b><br>Liczba gości: {$_COOKIE['person_number']}<br>Przyjazd {$_COOKIE['date_arrival']} w godzinach $arrival_hours_parsed<br>Odjazd {$_COOKIE['date_departure']}<br>");
    echo("Wybrane dodatkowe udogodnienia:<br>");
    if(! empty($_COOKIE['air_conditioning'])) { echo("- Klimatyzacja<br>"); }
    if(! empty($_COOKIE['baby_bed'])) { echo("- Dostawka<br>"); }
    if(! empty($_COOKIE['ashtray'])) { echo("- Popielniczka (pokój dla palących)<br>"); }
    if(! empty($_COOKIE['welcome_gift'])) { echo("- Zestaw powitalny<br>"); }

    if(! empty($_COOKIE['comments'])) { 
        echo("<br>Dodatkowe komentarze:<br>{$_COOKIE['comments']}<br>");
    } else echo("Brak dodatkowych komentarzy.");
    
    generate_extra_forms($_COOKIE['person_number']);
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