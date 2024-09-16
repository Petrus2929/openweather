# Mini webová aplikácia na predpoveď počasia pre konkrétny deň a mesto

## Pre spustenie si stačí naklonovať repozitár k sebe na server, v koreňovom adresári spustiť cez cmd príkaz 'composer install' a cez prehliadač zavolať linku http://localhost/openweather/index.php

### Z dostupných free API rozhraní OpenWeather využívam https://openweathermap.org/forecast5 -> príklad endpointu na OpenWeatherData je "http://api.openweathermap.org/data/2.5/forecast?q=Bratislava&appid={>apiKey}&units=metric";
### Na zapisovanie dát do excelu využívam knižnicu dostupnú na https://github.com/PHPOffice/PhpSpreadsheet
### Aplikácia zapisuje do logu API volaní chyby:
- v prípade, že užívateľ zadal mesto, ktoré v databáze miest OpenWeather neexistuje - zápis do logu, že nevieme získať dáta z tohto mesta
- v prípade, že užávateľ vybral dátum, pre ktorý ešte nie je vydaná predpoveď - zápis do logu, že nevieme získať dáta pre vybraný dátum

P.S.: s OpenWeather API som pracoval zhodou okolností aj na svojej diplomovej práci - v prípade záujmu odporúčam pozrieť https://github.com/Petrus2929/oze. Nie je potrebné nič klonovať, inštalovať, len spustiť linku http://34.18.82.249/oze/index.php, keďže aplikácia beží v GoogleCloude.
