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

    function it_tests_gutter_game(){
        $this->rollMany(20, 0);
        $this->score()->shouldReturn(0);
    }

    function it_tests_all_ones(){
        $this->rollMany(20,1);
        $this->score()->shouldReturn(20);
    }

    function it_tests_one_spare() {
        $this->rollSpare();
        $this->roll(3);
        $this->rollMany(17, 0);
        $this->score()->shouldReturn(16);
    }

    function it_tests_one_strike() {
        $this->rollStrike();
        $this->roll(4);
        $this->roll(5);
        $this->rollMany(17, 0);
        $this->score()->shouldReturn(28);
    }

    function it_tests_perfect_game() {
        $this->rollMany(12, 10);
        $this->score()->shouldReturn(300);
    }

    /**
     * @param $count
     * @param $pins
     */
    private function rollMany($count, $pins)
    {
        for ($i = 0; $i < $count; $i++) {
            $this->roll($pins);
        }
    }

    private function rollSpare()
    {
        $this->roll(5);
        $this->roll(5);
    }

    private function rollStrike()
    {
        $this->roll(10);
    }

}
