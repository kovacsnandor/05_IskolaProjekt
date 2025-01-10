<?php

namespace App\Console\Commands;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InitializeTestDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:initdb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize the test database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Ez a kifejezés parancssorból így nézne ki: php artisan migrate --database=testing

        // $this->call('migrate', ['--database' => 'testing']);
        // $this->call('db:seed', ['--class' => DatabaseSeeder::class, '--database' => 'testing']);
        $this->call('migrate');
        $this->call('db:seed', ['--class' => DatabaseSeeder::class]);
    }
}
