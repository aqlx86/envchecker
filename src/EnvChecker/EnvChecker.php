<?php

namespace EnvChecker;

use EnvChecker\Env;

class EnvChecker
{
    protected $template;
    protected $local;

    public function __construct(Env $template, Env $local)
    {
        $this->template = $template;
        $this->local = $local;
    }

    public function get_new_vars($exclude = [])
    {
        $diff_vars = array_diff_key($this->template->to_array(), $this->local->to_array());

        return $this->remove_optional_vars($diff_vars, $exclude);
    }

    protected function remove_optional_vars($env_vars, $optional_vars)
    {
        foreach ($optional_vars as $var)
            if (array_key_exists($var, $env_vars))
                unset ($env_vars[$var]);

        return $env_vars;
    }
}
