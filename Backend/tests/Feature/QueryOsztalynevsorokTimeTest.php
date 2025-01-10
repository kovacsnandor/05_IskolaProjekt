<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QueryOsztalynevsorokTimeTest extends TestCase
{
    private $startTime;
    private $endTime;
    private $responseTime;

    /**
     * A basic test example.
     */
    public function test_the_queryOsztalynevsorok_response_time(): void
    {
        $this->startTime = microtime(true);
        $response = $this->get('/api/queryOsztalynevsorok');
        // $response = $this->get('/api/queryOsztalytasrsak/Balla Albert');
        $this->endTime = microtime(true);

        $response->assertStatus(200);
        $this->responseTime = round(($this->endTime - $this->startTime) * 1000, 2);
        $this->assertLessThan(200, $this->responseTime);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        echo PHP_EOL."\tA válaszidő (queryOsztalynevsorok): {$this->responseTime} ms";
    }
}
