<?php
# Uncomment lines below for debugging purposes:
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

include 'getData.php';
include 'logging.php';
include 'database.php';
include 'getClientIP.php';

$code = $_POST["code"];
$http_string = 'https://www.biznesradar.pl/raporty-finansowe-rachunek-zyskow-i-strat/'.$code;
$html = file_get_contents($http_string);

if (!$html) {
  $result="<div class=\"error-msg\">W naszej bazie nie odnaleziono danych dotyczących akcji spółki o podanym kodzie! Sprawdź, czy podałeś poprawny kod i spróbuj ponownie.</div>"; 
} else { 
  $result=getStockData($html); 
};

writeLog(updateLog($html, $code, "Main"));
updateGuestBook(getClientIP());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Scraper</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <link rel="stylesheet" href="custom.css">
</head>
<body>
  <header>
    <h1>Stock Scraper</h1>
    <p>Check stock data prices in one place, simply.</p>
  </header>
  <main class="results">
    <p>Searching stock data for:<b><br><br><span class="boxed-text"><?php echo $code; ?></span></b></p>
    <div style="overflow-x:auto;"><div class="table-container"><?php print $result;?></table></div></div>
    <p> <form action="index.html">
        <fieldset>
            <input type="submit" value="Spróbuj od nowa"></div>
        </fieldset>
      </form> 
  </main>

  <footer>
    <p>by Paweł Mechliński, 2023. Styled with  <a href="https://github.com/kevquirk/simple.css/wiki">Simple.CSS</a>.</p>
  </footer>
</body>
</html>