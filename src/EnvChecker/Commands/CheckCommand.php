<?php

namespace EnvChecker\Commands;

use Illuminate\Console\Command;
use EnvChecker\Env;
use EnvChecker\EnvChecker;

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
        $template = app()->make(Env::class);
        $template->load(\Config::get('envchecker.example'));

        $local = app()->make(Env::class);
        $local->load(\Config::get('envchecker.local'));

        $envchecker = new EnvChecker($template, $local);

        $new_keys = $envchecker->get_new_vars(\Config::get('envchecker.optional'));

        if ($new_keys)
        {
            $this->info('template file contains new values.');

            $data = [];

            foreach ($new_keys as $key => $value)
                $data[] = [$key, $value];

            $this->table(['New Keys', 'Default Value'], $data);

            $update = $this->confirm('Would you like to apply new values to your env file?');

            if ($update)
            {
                $string_data = '';

                foreach ($new_keys as $key => $value)
                    $string_data.= sprintf("%s=%s\n", $key, $value);

                file_put_contents('.env', $string_data, FILE_APPEND);

                $this->info('.env updated');
            }
        }
        else
        {
            $this->info('.env file is up to date.');
        }
    }
}
