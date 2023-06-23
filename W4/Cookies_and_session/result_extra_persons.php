<html>
<body>
<?php echo $_POST['category'].'<br>'.$_POST['subcategory'].'<br>'.$_POST['comments']; ?>
    <?php 
    setcookie("name2", $_POST["name2"], time()+60*60);
    print_r($_COOKIE['name2']);
    setcookie("surname2", $_POST["surname2"], time()+60*60);
    setcookie("name3", $_POST["name3"], time()+60*60);
    setcookie("surname3", $_POST["surname3"], time()+60*60);
    setcookie("name4", $_POST["name4"], time()+60*60);
    setcookie("surname4", $_POST["surname4"], time()+60*60);

        
    
    ini_set('display_errors', 1); // set to 0 for production version
    error_reporting(E_ALL);
    session_start();
    $i = 2;


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


    // Get results
    $arrival_hours_parsed = get_hour_range($_COOKIE['arrival_hour']);
    echo("Podsumowanie rezerwacji:<br><b>1. Dane osoby zamawiającej</b><br>");
    echo("{$_COOKIE['name']} {$_COOKIE['surname']}<br>{$_COOKIE['city']}");
    if(! empty($_COOKIE['street'])) { echo(" <br>Ul."); }
    echo("{$_COOKIE['street']} {$_COOKIE['house_num']} {$_COOKIE['flat_num']}<br>{$_COOKIE['postal_code']}");
    echo("<br><b>2. Dane kontaktowe:</b><br>Tel. {$_COOKIE['tel_num']}<br>E-mail: {$_COOKIE['email']}<br>");
    echo("<b>3. Dane do płatności:</b><br>nr karty {$_COOKIE['card_num']}<br>{$_COOKIE['card_exp_date']} {$_COOKIE['card_cvv']}<br>");
    echo("<b>4. Informacje o rezerwacji:</b><br>Liczba gości: {$_COOKIE['person_number']}<br>Przyjazd {$_COOKIE['date_arrival']} w godzinach {$_COOKIE['arrival_hours_parsed']}<br>Odjazd {$_COOKIE['date_departure']}<br>");
    echo("Wybrane dodatkowe udogodnienia:<br>");
    if(! empty($_COOKIE['air_conditioning'])) { echo("- Klimatyzacja<br>"); }
    if(! empty($_COOKIE['baby_bed'])) { echo("- Dostawka<br>"); }
    if(! empty($_COOKIE['ashtray'])) { echo("- Popielniczka (pokój dla palących)<br>"); }
    if(! empty($_COOKIE['welcome_gift'])) { echo("- Zestaw powitalny<br>"); }

    if(! empty($_COOKIE['comments'])) { 
        echo("<br>Dodatkowe komentarze:<br>{$_COOKIE['comments']}<br>");
    } else echo("Brak dodatkowych komentarzy.");
    
    if(intval($_COOKIE['person_number']) > 1) {
        $i = 2;
        echo("<br>Gość 2<br>
        
        Imię {$_COOKIE[${"name".$i}]}<br>
        Nazwisko {$_COOKIE["surname2"]}<br>");
    };
    if(intval($_COOKIE['person_number']) > 2) {
    echo("<br>Gość 3<br>
    Imię {$_COOKIE["name3"]}<br>
    Nazwisko {$_COOKIE["surname3"]}<br>");
    };
    if(intval($_COOKIE['person_number']) > 3) {
        echo("<br>Gość 4<br>
        Imię {$_COOKIE["name4"]}<br>
        Nazwisko {$_COOKIE["surname4"]}<br>");
        };

    echo("<br>Czy powyższe dane są poprawne?<br>");
    echo("<form action=\"finalize.html\" method=\"post\">");
    
    echo("<input type=\"submit\" name=\"send\" value=\"Potwierdź\"></form>");
    ?>
</body>
</html> 