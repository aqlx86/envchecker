<?php

namespace spec\EnvChecker;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use josegonzalez\Dotenv;

class EnvSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('EnvChecker\Env');
    }

    function it_can_load_the_env_file()
    {
        $this->shouldThrow('Envchecker\Exception\MissingFile')
            ->duringLoad(realpath('./tests/.nonexisting-env'));

        $this->load(realpath('./tests/.env'));
    }

    function it_can_parse_env_lines_to_array()
    {
        $this->it_can_load_the_env_file();

        $this->to_array()->shouldReturn([
            'APP_ENV' => 'local',
            'APP_DEBUG' => true,
            'APP_KEY' => 'SomeRandomString',
        ]);
    }
}
