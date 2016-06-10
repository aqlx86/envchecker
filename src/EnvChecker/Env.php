<?php

namespace EnvChecker;

use josegonzalez\Dotenv;
use EnvChecker\Exception;

class Env
{
    protected $dotenv;

    public function load($env_file)
    {
        if (! file_exists($env_file))
            throw new Exception\MissingFile(sprintf('Unable to read %s', $env_file));

        $this->dotenv = new Dotenv\Loader($env_file);
    }

    public function to_array()
    {
        return $this->dotenv->parse()->toArray();
    }
}
