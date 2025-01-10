# Cikkek
[Feature Testing in Laravel — Beginner’s Guide](https://zubairidrisaweda.medium.com/feature-testing-in-laravel-beginners-guide-d2cb4498acee)

# Alapfogalmak



## Feature Teszt

Feature teszt alatt azt értjük, hogy **az alkalmazásunk egy adott funkcióját**, vagyis egy feature-jét egészében teszteljük. Ez azt jelenti, hogy nem csak egyetlen osztály vagy függvény működését vizsgáljuk, hanem azt, hogy az adott funkció hogyan viselkedik, amikor az alkalmazás többi részével együttműködik.

A Laravelben a feature tesztek írásához általában a _tests/Feature_ könyvtárat használjuk. A tesztekben HTTP kéréseket szimulálunk, és ellenőrizzük a válaszokat. A PHPUnit keretrendszer segítségével írhatunk olyan teszteket, amelyek az egész alkalmazásunkat lefedik.

## Unit teszt

Az egységteszt (unit test) a szoftverfejlesztés egyik alapvető eszköze, melynek célja, hogy egy adott kódrészlet (egység) helyes működését ellenőrizze. Ez az egység lehet egy függvény, egy osztály vagy egy kis modul.

## Smoke tesztek

A smoke teszt egy olyan tesztelési módszer a szoftverfejlesztésben, amelynek célja, hogy gyorsan és egyszerűen megállapítsa, egy új vagy módosított szoftververzió alapvető funkciói működnek-e megfelelően. Gyakran nevezik sanity testingnek vagy build verification testnek is.

A smoke teszt az első lépcsőfok a szoftver tesztelésében. Ha a smoke teszt sikeres, akkor a fejlesztők és a tesztelők biztosak lehetnek abban, hogy a szoftver alapvető funkciói működnek, és a további tesztelésre érdemes időt fordítani.

# REST API tesztek

A REST API-k megbízhatóságának és funkcionalitásának biztosítása érdekében számos különböző tesztelési típus alkalmazható. Ezek a tesztek segítenek azonosítani a hibákat, biztosítani a megfelelő működést és a változtatások hatásainak nyomon követését.

Általánosságban a következő tesztelési típusok különíthetők el:

1. Unit tesztek
Cél: Az egyes API végpontok (endpoint) vagy összetevők izolált tesztelése.
Fókusz: Az egyes függvények vagy metódusok helyes működésének ellenőrzése adott bemeneti adatok esetén.
Példa: Egy adott felhasználó lekérdezésekor a várt adatok visszaadásának ellenőrzése.
2. Integrációs tesztek
Cél: Az API különböző összetevőinek együttes működésének tesztelése.
Fókusz: Az API-k közötti adatáramlás, hitelesítés és jogosultságkezelés ellenőrzése.
Példa: Egy felhasználó regisztrációjának tesztelése, amely több API-t is érint (pl. felhasználói adatok mentése, e-mail küldése).
3. Funkcionális tesztek
Cél: Az API által nyújtott funkcióknak való megfelelés ellenőrzése.
Fókusz: Az API specifikációjában leírt összes funkció tesztelése, beleértve a normál és hibás eseteket is.
Példa: Egy termék hozzáadása a kosárhoz, a fizetés és a rendelés megerősítése.
4. Nem-funkcionális tesztek
Cél: Az API teljesítményének, biztonságának, használhatóságának és megbízhatóságának értékelése.
Fókusz: A válaszidő, a hiba kezelése, a biztonsági rések, a felhasználói élmény és az API stabilitása.
Példa: Terheléses tesztek a rendszer válaszidejének mérése, biztonsági tesztek a jogosulatlan hozzáférés megakadályozására.
5. Kontraktus tesztek
Cél: Az API és a fogyasztói alkalmazások közötti szerződésnek megfelelő működés ellenőrzése.
Fókusz: Az API által biztosított adatok formátuma, struktúrája és a fogyasztói alkalmazások által várt adatok egyezőségének ellenőrzése.
Példa: Egy API, amely JSON formátumban ad vissza adatokat, a fogyasztói alkalmazás pedig képes értelmezni ezt a formátumot.
6. Fekete doboz tesztelés
Cél: Az API működésének tesztelése a belső működés ismerete nélkül.
Fókusz: Az API kimeneteinek ellenőrzése adott bemeneti adatok esetén.
Példa: Egy felhasználó bejelentkezésekor a megfelelő státuszkód és válaszüzenetek ellenőrzése.
7. Fehér doboz tesztelés
Cél: Az API belső működésének tesztelése.
Fókusz: Az API kódjának átvizsgálása, az ágak és feltételek lefedettsége.
Példa: Az API kódjának lefedtségi elemzése, hogy megbizonyosodjunk arról, hogy minden sor végrehajtásra került a tesztek során.
További fontos tesztelési típusok:

8. End-to-end tesztek: Az end-to-end tesztekben az egész alkalmazást teszteljük, így itt is inkább a valódi környezetben futtatjuk a teszteket.

Regressziós tesztek: A korábban talált hibák újbóli megjelenésének megelőzése.
Dohányzás tesztelés: Az API határainak felderítése, hogy milyen bemeneti adatok okoznak váratlan viselkedést.
Felhasználói elfogadási tesztelés (UAT): A felhasználók által a rendszer használatának ellenőrzése.



# Teszt adatbázis környezet.

## phpunit.xml

Itt van definiálva többek közt:

- a teszt fájlok helye,
    - <directory>tests/Unit</directory>
    - <directory>tests/Feature</directory>
- melyik env fájl legyen a teszthez használva:
    - <env name="APP_ENV" value="testing"/>
- melyik adatbázis legyen a teszt adatbázis:
    - <env name="DB_DATABASE" value="database/test.sqlite"/>
    - Ha ezt kivesszük, akkor a .env.testing érvényesül
    - Tehát ezt a sor kommenteljük ki


```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="vendor/phpunit/phpunit/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         colors="true"
>
    <testsuites>
        <testsuite name="Unit">
            <directory>tests/Unit</directory>
        </testsuite>
        <testsuite name="Feature">
            <directory>tests/Feature</directory>
        </testsuite>
    </testsuites>
    <source>
        <include>
            <directory>app</directory>
        </include>
    </source>
    <php>
        <env name="APP_ENV" value="testing"/>
        <env name="APP_MAINTENANCE_DRIVER" value="file"/>
        <env name="BCRYPT_ROUNDS" value="4"/>
        <env name="CACHE_STORE" value="array"/>
        <env name="DB_CONNECTION" value="mysql"/>
        <env name="DB_DATABASE" value="database/test.sqlite"/>
        <env name="MAIL_MAILER" value="array"/>
        <env name="PULSE_ENABLED" value="false"/>
        <env name="QUEUE_CONNECTION" value="sync"/>
        <env name="SESSION_DRIVER" value="array"/>
        <env name="TELESCOPE_ENABLED" value="false"/>
    </php>
</phpunit>
```

## .env.testing

A tesztek ezeket a beállításokat tartalmazzák
A helyes szemlélet az, hogy a teszthez egy másik adatbázist használunk


# Teszt indítása

A tesztek az alkalmazás **tests/Feature**, és a **tests/Unit** mapáiban vannak.
Példa: tests/Feature/ExampleTest.php

```php
public function test_the_api_returns_a_successful_response(): void
{
    $response = $this->get('/api');
    //A válasz tartalmazza-e az API szót?
    $response->assertSee('API');
    //A válasz státusza 200-e?
    $response->assertStatus(200);
}
```

- Összes teszt indítása: `php artisan test`
- Tesztek párhuzamos tuttatása: 
    - `php artisan test --parallel`
    - `php artisan test -p`

- Egy adott Teszt függvény futtatása: `php artisan test --filter test_the_api_returns_a_successful_response`
- Egy adott teszt osztály (UserTest.php) futtatása: `php artisan test --filter UserTest`

# Teszt generálás
- Feature teszt osztály generálás: `php artisan make:test SportsTest`
    - Alapértelmezésben a laravel Feature tesztet hoz létre a **test/Feature** mappába
- Unit teszt generálás: `php artisan make:test SportsTest -u`
    - A **test/Unit** mappába készíti el a testz osztályt

## Integrációs teszt készítés
1. Hozzunk létre egy **test/Integration** mappát
2. A phpunit.xml fájlba hozzunk létre új bejegyzést az új mappának:
    - Ez azért kell, hogy a rendszer az összes teszt lefuttatásakor ezeket is belevegye.
```xml
<testsuites>
    <testsuite name="Unit">
        <directory>tests/Unit</directory>
    </testsuite>
    <testsuite name="Feature">
        <directory>tests/Feature</directory>
    </testsuite>
    <testsuite name="Integration">
        <directory>tests/Integration</directory>
    </testsuite>
</testsuites>
```
3. Integrációs teszt létrehozása **test/Feature** mappába: 
    - `php artisan make:test IntegrationSportTest`
4. Másoljuk át a **test/Integration** mappába    


# Teszt és éles adatbázis környezet létrehozása

1. **setup/database.php** saját kapcolatokat hozhatunk létre, 
    - hogy egyszerre több adatbázissal dolgozhassunk
    - A tesztek számára létrehozunk egy test.sqlite adatbázishoz tartozó kapcsolatot
    - ezt azonban felülírja, ha az .env fájlban ezek meg vannak adva
    - Ez azért van, hogyha nem lenne env fájl, akkor mi legyen az alapértelmezett
   
A teszt adatbázis alapadatai:

```php
'testing' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'testing_db'),
        'username' => env('DB_USERNAME', 'testing'),
        'password' => env('DB_PASSWORD', ''),
    ],
    //...
]
```

## Teszt környezet
elsődlegesen ez hatázoss mag a teszt adatbázist.
Ez kommenteljük ki, hogy a **.env.testing** érvényesüljön
**phpunit.xml**
```xml
<php>
    <env name="APP_ENV" value="testing"/>
    <env name="APP_MAINTENANCE_DRIVER" value="file"/>
    <env name="BCRYPT_ROUNDS" value="4"/>
    <env name="CACHE_STORE" value="array"/>
    <env name="DB_CONNECTION" value="mysql"/>

    <!-- <env name="DB_DATABASE" value="laravel-iskola2"/> -->
    <!-- <env name="DB_DATABASE" value=":memory"/> -->

    <!-- <env name="DB_CONNECTION" value="sqlite"/>
    <env name="DB_DATABASE" value="database/test.sqlite"/>
    <env name="DB_DATABASE" value=":memory"/> -->

    
    <env name="MAIL_MAILER" value="array"/>
    <env name="PULSE_ENABLED" value="false"/>
    <env name="QUEUE_CONNECTION" value="sync"/>
    <env name="SESSION_DRIVER" value="array"/>
    <env name="TELESCOPE_ENABLED" value="false"/>
</php>

```


A tesztek az **.env.testing** fájlból veszik az adatbázis-kapcsolatot

**.env.testing**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-iskola-test
DB_USERNAME=root
DB_PASSWORD=
```
## Éles környezet
_Az éles környezet a **.env** fájlból veszi az adatbázis-kapcsolatot

**.env**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-iskola3
DB_USERNAME=root
DB_PASSWORD=
```

- Fontos!!!
- **DB_CONNECTION=mysql** bejegyzés csak akkor lép életbe, ha alatta nem adjuk meg az adtbázi-kapcsolatot
- Ha ez így van, akkor nem a **.env**-ből veszi a kpcsolatot, hanem a **config/database.php**-ben **mysql** bejegyzésből:
**config/database.php**
```php
'mysql' => [
    'driver' => 'mysql',
    'url' => env('DB_URL'),
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE', 'laravel'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD', ''),
    'unix_socket' => env('DB_SOCKET', ''),
    'charset' => env('DB_CHARSET', 'utf8mb4'),
    'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
    'prefix' => '',
    'prefix_indexes' => true,
    'strict' => true,
    'engine' => null,
    'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
    ]) : [],
],

```

## Tesz és éles adatbázis létrehozása
### 1. Saját artisan parancs

Saját artisan parancs létrehozása a teszt adatbázis generálásához:

`php artisan make:command InitializeTestDatabase`

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Seeder;

class InitializeTestDatabase extends Command
{
    protected $signature = 'db:initdb';

    protected $description = 'Initialize the test database';

    public function handle()
    {
        //php artisan migrate
        $this->call('migrate');
        //php artisan db:seed --class=DatabaseSeeder
        $this->call('db:seed', ['--class' => DatabaseSeeder::class]);
    }
  }
}
```

- Éles adatbázis készítés (migrate, seed)
    - A parancs futtatása: `php artisan db:initdb`
    - **.env**-ből dolgozik

- Teszt adatbázis készítés
    - A parancs futtatása: `APP_ENV=testing php artisan db:initdb`
        - az  APP_ENV=testing beállítást kényszerítjük a .env fájl környezeti változójára.
    - **.env.testing**-ből dolgozik

## Seeder alágazás
A seederünk arról függően, hogy mi az APP_ENV, vagy a teszt, vagy az éles adatbázis adatait tölti fel.
A migráció ugyanaz.
Példa: Diaks tábla seedere:
```php
class DiakSeeder extends Seeder
{
    public function run(): void
    {

        $data = [
['id' => 1, 'osztalyId' => 1, 'nev' => 'Rudi', 'neme' => true, 'szuletett' => '2018-01-12', 'helyseg' => 'Szolnok', 'osztondij' => 5000,  'atlag' => 3.5],
['id' => 2, 'osztalyId' => 1, 'nev' => 'Péter', 'neme' => true, 'szuletett' => '2018-03-02', 'helyseg' => 'Szolnok', 'osztondij' => 5000,  'atlag' => 3.7],
['id' => 3, 'osztalyId' => 1, 'nev' => 'Béla', 'neme' => true, 'szuletett' => '2017-06-24', 'helyseg' => 'Abony', 'osztondij' => 5000,  'atlag' => 4.5],
['id' => 4, 'osztalyId' => 1, 'nev' => 'Enikő', 'neme' => false, 'szuletett' => '2016-05-17', 'helyseg' => 'Szolnok', 'osztondij' => 5000,  'atlag' => 3.9],
['id' => 5, 'osztalyId' => 1, 'nev' => 'Ágnes', 'neme' => false, 'szuletett' => '2018-04-22', 'helyseg' => 'Abony', 'osztondij' => 5000,  'atlag' => 4.7],
['id' => 6, 'osztalyId' => 2, 'nev' => 'Anikó', 'neme' => false, 'szuletett' => '2018-11-02', 'helyseg' => 'Szolnok', 'osztondij' => 5000,  'atlag' => 3.1],
['id' => 7, 'osztalyId' => 2, 'nev' => 'Feri', 'neme' => true, 'szuletett' => '2018-03-21', 'helyseg' => 'Abony', 'osztondij' => 5000,  'atlag' => 3.6],
        ];

        if (env('APP_ENV')=='testing') {
            //teszt adatbázisban: 300 véletlen diák
            if (Diak::count() === 0) {
                Diak::factory(300)->create();
            }
        } else {
            //éles adatbázisban: a megadott diákok
            if (Diak::count() === 0) {
                Diak::factory()->createMany($data);
            }
        }
    }
}

```




