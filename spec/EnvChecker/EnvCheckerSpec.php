<?php

namespace spec\EnvChecker;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EnvCheckerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('EnvChecker\EnvChecker');
    }

    /**
     * @param EnvChecker\Env $template
     * @param EnvChecker\Env $local
     */
    function let($template, $local)
    {
        $this->beConstructedWith($template, $local);
    }
}
