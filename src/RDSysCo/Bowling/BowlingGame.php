<?php

namespace RDSysCo\Bowling;

class BowlingGame
{

    private $rolls = [];

    public function roll($pins)
    {
        $this->rolls[] = $pins;
    }

    public function score()
    {
       $score = 0;

       $frameIndex = 0;
       for($frame = 0; $frame < 10; $frame++) {
           if($this->isStrike($frameIndex)) {
               $score += 10 + $this->rolls[$frameIndex+1] + $this->rolls[$frameIndex+2];
               $frameIndex += 1;
           }
           elseif($this->isSpare($frameIndex)) {
               $score += 10 + $this->rolls[$frameIndex + 2];
               $frameIndex += 2;
           } else {
               $score += $this->rolls[$frameIndex] + $this->rolls[$frameIndex + 1];
               $frameIndex += 2;
           }

       }

       return $score;
    }

    /**
     * @param $frameIndex
     *
     * @return bool
     */
    private function isSpare($frameIndex): bool
    {
        return $this->rolls[$frameIndex] + $this->rolls[$frameIndex + 1] == 10;
    }

    /**
     * @param $frameIndex
     *
     * @return bool
     */
    private function isStrike($frameIndex): bool
    {
        return $this->rolls[$frameIndex] == 10;
    }

}
