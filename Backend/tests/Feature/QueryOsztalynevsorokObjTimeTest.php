<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QueryOsztalynevsorokObjTimeTest extends TestCase
{
    private $startTimeObj;
    private $endTimeObj;
    private $responseTimeObj;

    /**
     * A basic test example.
     */

    public function test_the_queryOsztalynevsorokObj_response_time(): void
    {
        $this->startTimeObj = microtime(true);
        $response = $this->get('/api/queryOsztalynevsorokObj');
        // $response = $this->get('/api/queryOsztalytasrsak/Balla Albert');
        $this->endTimeObj = microtime(true);

        $response->assertStatus(200);

        $this->responseTimeObj = round(($this->endTimeObj - $this->startTimeObj) * 1000, 2);
        $this->assertLessThan(200, $this->responseTimeObj);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        echo PHP_EOL."\tA válaszidő (queryOsztalynevsorokObj): {$this->responseTimeObj} ms";
    }
}
