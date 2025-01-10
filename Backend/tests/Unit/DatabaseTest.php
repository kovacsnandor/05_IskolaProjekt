<?php

namespace Tests\Unit;

use App\Models\Diak;
use App\Models\Osztaly;
use App\Models\Sport;
use App\Models\User;
use Illuminate\Container\Attributes\DB as AttributesDB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class DatabaseTest extends TestCase
{

    use DatabaseTransactions;

    //Adatbázis és tábláinak ellenőrzése
    public function test_database_creation_end_tables_exists()
    {
        $databaseNameConn = DB::connection()->getDatabaseName();
        // dd($databaseNameConn);
        $databaseNameEnv = env('DB_DATABASE');
        //dd($databaseNameConn == $databaseNameEnv);
        //Az adatbázis ellenőrzése
        $this->assertEquals($databaseNameConn, $databaseNameEnv);
        //Táblák létezésének 
        $this->assertDatabaseHas('diaks');
        $this->assertDatabaseHas('osztalies');
        $this->assertDatabaseHas('sportolas');
        $this->assertDatabaseHas('sports');
        $this->assertDatabaseHas('users');
        echo PHP_EOL."\tAdatbázis -> DB_DATABASE={$databaseNameEnv} | adatbázis: {$databaseNameConn}";
    }

    public function test_sports_table_structure()
    {
        // Ellenőrizzük, hogy a tábla létezik
        $this->assertTrue(Schema::hasTable('sports'));

        // Ellenőrizzük a mezőket és azok típusait
        $this->assertTrue(Schema::hasColumn('sports', 'id'));
        $this->assertTrue(Schema::hasColumn('sports', 'sportNev'));
        $this->assertEquals('int', Schema::getColumnType('sports', 'id'));
        //dd(Schema::getColumnType('sports', 'sportNev'));
        $this->assertEquals('varchar', Schema::getColumnType('sports', 'sportNev'));

        $this->assertTrue(Schema::hasColumn('sports', 'id'));

        //Elsődleges kulcs
        $indexes = DB::select('SHOW INDEX FROM sports');
        $primaryIndex = collect($indexes)->firstWhere('Key_name', 'PRIMARY');
        $this->assertNotNull($primaryIndex);

    }
    public function test_ostalies_table_structure()
    {
        $this->assertTrue(Schema::hasTable('osztalies'), 'Az "osztalies" tábla nem létezik.');

        $columns = DB::select('DESCRIBE osztalies');
        $this->assertContains('id', array_column($columns, 'Field'));
        $this->assertContains('osztalyNev', array_column($columns, 'Field'));
        $this->assertEquals('int(10) unsigned', $columns[0]->Type); // Feltételezzük, hogy az 'id' az első oszlop
        $this->assertEquals('varchar(50)', $columns[1]->Type); // Feltételezzük, hogy az 'osztalyNev' a második

        // Elsődleges kulcs ellenőrzése
        $primaryKeys = DB::select('SHOW KEYS FROM osztalies WHERE Key_name = "PRIMARY"');
        $this->assertCount(1, $primaryKeys);
        $this->assertEquals('id', $primaryKeys[0]->Column_name);

    }

    public function test_diaks_osztalies_relationships(){  

        //A diák tábla kapcsolatai
        $databaseName = env('DB_DATABASE');
        $tableName = "diaks";
        $contstraint_name = "PRIMARY";

        $query = "
            SELECT 
                TABLE_NAME,
                COLUMN_NAME,
                CONSTRAINT_NAME,
                REFERENCED_TABLE_NAME,
                REFERENCED_COLUMN_NAME
            FROM 
                information_schema.KEY_COLUMN_USAGE
            WHERE
                TABLE_NAME = ? and CONSTRAINT_SCHEMA = ? and CONSTRAINT_NAME <> ?";

                $rows= DB::select($query, [$tableName, $databaseName, $contstraint_name]);
                // dd($rows);
        //Idegen kulcs neve: osztalyId
        $this->assertEquals('osztalyId', $rows[0]->COLUMN_NAME);
        //Referencia tábla neve: osztalies
        $this->assertEquals('osztalies', $rows[0]->REFERENCED_TABLE_NAME);
        //Referencia oszlop neve: id
        $this->assertEquals('id', $rows[0]->REFERENCED_COLUMN_NAME);


        //Készítünk egy osztályt
        $dataOsztaly = 
        [
            'osztalyNev' => '99.d'
        ];
        $osztaly = Osztaly::factory()->create($dataOsztaly);

        //Az új osztállyal készítek egy diákot
        $dataDiak = 
            [
            'osztalyId' => $osztaly->id, 
            'nev' => 'Rudi', 
            'neme' => true, 
            'szuletett' => 
            '2018-01-12', 
            'helyseg' => 
            'Szolnok', 
            'osztondij' => 5000,  
            'atlag' => 3.5
        ];
        $diak = Diak::factory()->create($dataDiak);

        //visszakeressük a diákot
        $diak = DB::table('diaks')
        ->where('id', $diak->id)
        ->first();

        //A megtalált diák osztalyId-je megegyezik a új osztály id-jével        
        $this->assertEquals($osztaly->id, $diak->osztalyId);
        // dd($diak);

    }
}
