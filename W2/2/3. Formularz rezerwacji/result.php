<html>
<body>
    <?php
    session_start(); 
    $_SESSION['person_number'] = $_POST["person_number"];
    // Client's personals
    $_SESSION['$name'] = $_POST["name"];
    $_SESSION['$surname'] = $_POST["surname"];
    
    // Address
    $_SESSION['$street'] = $_POST["street"];
    $_SESSION['$house_num'] = $_POST["house_num"];
    $_SESSION['$flat_num'] = $_POST["flat_num"];
    $$_SESSION['postal_code'] = $_POST["postal_code"];
    $_SESSION['$city'] = $_POST["city"];

    // Contact data
    $_SESSION['$tel_number'] = $_POST["tel_number"];
    $_SESSION['$email'] = $_POST["email"];

    // Payment data
    $_SESSION['$card_num'] = $_POST["card_num"];
    $_SESSION['$card_exp_date'] = $_POST["card_exp_date"];
    $_SESSION['$card_cvv'] = $_POST["card_cvv"];

    // Visit time
    $_SESSION['$date_arrival'] = $_POST["date_arrival"];
    $_SESSION['$date_departure'] = $_POST["date_departure"];
    $_SESSION['$arrival_hour'] = $_POST["arrival_hour"];

    // Extra features
    $_SESSION['$air_conditioning'] = $_POST["air_conditioning"];
    $_SESSION['$baby_bed'] = $_POST["baby_bed"];
    $_SESSION['$ashtray'] = $_POST["ashtray"];
    $_SESSION['$welcome_gift'] = $_POST["welcome_gift"];
    $_SESSION['$comments'] = $_POST["comments"];

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
        while($j <= $i +1) {
            echo("<br>Gość $j<br>
            Imię* <input type=\"text\" name=\"name$j\" required><br>
            Nazwisko* <input type=\"text\" name=\"surname$j\" required><br>");
            $j++;
        }

        echo("<input type=\"submit\" name=\"send\" value=\"Uzupełnij\"></form>");
    }

    // Get results
    $arrival_hours_parsed = get_hour_range($_SESSIO['arrival_hour']);
    echo("Podsumowanie rezerwacji:<br><b>1. Dane osoby zamawiającej</b><br>");
    echo("{$_SESSION['name']} {$_SESSION['surname']}<br>$city");
    if(! empty({$_SESSION['street']})) { echo(" <br>Ul."); }
    echo("{$_SESSION['street']} {$_SESSION['house_num']} {$_SESSION['flat_num']}<br>{$_SESSION['postal_code']}");
    echo("<br><b>2. Dane kontaktowe:</b><br>Tel. {$_SESSION['tel_num']}<br>E-mail: $_SESSION['email']<br>");
    echo("<b>3. Dane do płatności:</b><br>nr karty {$_SESSION['card_num']}<br>{$_SESSION['card_exp_date']} {$_SESSION['card_cvv']}<br>");
    echo("<b>4. Informacje o rezerwacji:</b><br>Liczba gości: {$_SESSION['person_number']}<br>Przyjazd {$_SESSION['date_arrival']} w godzinach {$_SESSION['arrival_hours_parsed']}<br>Odjazd {$_SESSION['date_departure']}<br>");
    echo("Wybrane dodatkowe udogodnienia:<br>");
    if(! empty({$_SESSION['air_conditioning']})) { echo("- Klimatyzacja<br>"); }
    if(! empty({$_SESSION['baby_bed']})) { echo("- Dostawka<br>"); }
    if(! empty($_SESSION['ashtray'])) { echo("- Popielniczka (pokój dla palących)<br>"); }
    if(! empty($_SESSION['welcome_gift'])) { echo("- Zestaw powitalny<br>"); }

    if(! empty($_SESSION['comments'])) { 
        echo("<br>Dodatkowe komentarze:<br>$_SESSION['comments']<br>");
    } else echo("Brak dodatkowych komentarzy.");
    
    generate_extra_forms($_SESSION['person_number']);
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