<?php

namespace Aqlx86\EnvChecker\Commands;

use Illuminate\Console\Command;
use Aqlx86\EnvChecker\EnvChecker;

class CheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check difference between .env and .env.example';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $envchecker = new EnvChecker;

        $new_keys = $envchecker->check();

        if ($new_keys)
        {
            $data = [];

            foreach ($new_keys as $key => $value)
                $data[] = [$key, $value];

            $this->table(['New Keys', 'Default Value'], $data);
        }
    }
}
