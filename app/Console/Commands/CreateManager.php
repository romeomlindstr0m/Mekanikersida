<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create-manager {username} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the manager user';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $password_hash = Hash::make($this->argument('password'));
        DB::insert('insert into users (username, password) values (?, ?)', [$this->argument('username'), $password_hash]);
    }
}
