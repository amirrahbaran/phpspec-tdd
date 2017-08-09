<?php

namespace spec\RDSysCo\Bowling;

use RDSysCo\Bowling\BowlingGame;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BowlingGameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BowlingGame::class);
    }
}
