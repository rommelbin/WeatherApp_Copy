<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PublishCommand extends Command
{
    public $nameId = 0;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'publishCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Publish weather on channels";

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        while (true) {
            DB::insert('insert into users (name, email, password) values (?, ?, ?)', ["Mark{$this->nameId}",'mail','1234']);
            sleep(30);
            $this->nameId += 1;
        }
    }
}
