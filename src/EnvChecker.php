<?php

namespace Aqlx86\EnvChecker;

use Dotenv\Dotenv;

class EnvChecker
{

    public function check()
    {
        $example_envs = $this->load('example');
        $local_envs = $this->load('local');

        $diff_vars = array_diff_key($example_envs, $local_envs);
        $diff_vars = $this->remove_optional_vars($diff_vars);

        return $diff_vars;
    }

    public function load($env)
    {
        $file = \Config::get('envchecker.'.$env);
        $dotenv = new Dotenv(dirname($file), basename($file));

        return $this->to_array($dotenv->load());
    }

    protected function to_array($env_lines)
    {
        $lines = [];

        foreach ($env_lines as $line)
        {
            list ($key, $value) = $this->split_string_to_key_value($line);
            $lines[$key] = $value;
        }

        return $lines;
    }

    protected function split_string_to_key_value($string)
    {
        list($name, $value) = array_map('trim', explode('=', $string, 2));
        return [$name, $value];
    }

    protected function remove_optional_vars($env_vars)
    {
        $optional_vars = \Config::get('envchecker.optional');

        foreach ($optional_vars as $var)
            if (array_key_exists($var, $env_vars))
                unset ($env_vars[$var]);

        return $env_vars;
    }
}
