<?php

namespace EnvChecker;

use Dotenv\Dotenv;
use EnvChecker\Exception;

class Env
{
    protected $dotenv;

    public function load($env_file)
    {
        if (! file_exists($env_file))
            throw new Exception\MissingFile(sprintf('Unable to read %s', $env_file));

        $this->dotenv = new Dotenv(dirname($env_file), basename($env_file));
    }

    public function to_array()
    {
        $lines = [];

        foreach ($this->dotenv->load() as $line)
        {
            list ($key, $value) = $this->split_string_to_key_value($line);
            $lines[$key] = $value;
        }

        return $lines;
    }

    /**
     * If the $name contains an = sign, then we split it into 2 parts, a name & value.
     * @see https://github.com/vlucas/phpdotenv/blob/1.1/src/Dotenv.php#L164
     */
    protected function split_string_to_key_value($string)
    {
        list($name, $value) = array_map('trim', explode('=', $string, 2));
        return [$name, $value];
    }
}
