<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);


class Game
{
    private const STRIKE = 'Strike';
    private const SPARE = 'Spare';
    private const OPEN = 'Open';

    private int $current_frame = 1;
    private array $frames = [];
    private int $throw = 1;
    private int $last_pins = 0;
    private bool $game_over = false;



    public function score(): int
    {
        if (!$this->game_over) {
            throw new \LogicException();
        }

        $score = 0;
        foreach ($this->frames as $key => $frame) {
            if ($key < 10) {
                switch ($frame['frameType']) {

                    case self::STRIKE:
                        $nextFrame = $this->getFrame($key + 1);
                        $firstBonus = $nextFrame[0];
                        $secondBonus = $nextFrame[1]
                            ?? $this->getFrame($key + 2)[0];

                        $score += 10 + $firstBonus + $secondBonus;
                        break;

                    case self::SPARE:
                        $nextFrame = $this->getFrame($key + 1);
                        $score += 10 + $nextFrame[0];
                        break;

                    case self::OPEN:
                        $score += $frame[0] + $frame[1];

                        break;
                }
            }
        }

        $total = $score + $this->getLastFrameScore();
        return $total;
    }


    public function roll(int $pins): void
    {
        $this->rollValidation($pins);

        if ($this->current_frame > 9) {
            $this->frames[$this->current_frame][] = $pins;

            $frame = $this->frames[10];

            switch (true) {
                case $frame[0] === 10:
                    $this->frames[$this->current_frame]['frameType'] = self::STRIKE;
                    $this->throw = 2;
                    break;

                case isset($frame[1]) && $frame[0] + $frame[1] === 10:
                    $this->frames[$this->current_frame]['frameType'] = self::SPARE;
                    break;

                default:
                    $this->frames[$this->current_frame]['frameType'] = self::OPEN;
                    break;
            }
        } else {
            $this->frames[$this->current_frame][] = $pins;
            switch (true) {
                case $pins === 10 && $this->throw === 1:
                    $this->frames[$this->current_frame]['frameType'] = self::STRIKE;
                    $this->advanceToNextFrame();
                    break;

                case ($pins + $this->last_pins) === 10 && $this->throw === 2:
                    $this->frames[$this->current_frame]['frameType'] = self::SPARE;
                    $this->advanceToNextFrame();
                    break;

                case $this->throw === 2:
                    $this->frames[$this->current_frame]['frameType'] = self::OPEN;
                    $this->advanceToNextFrame();
                    break;

                default:
                    $this->throw = 2;
                    break;
            }
        }

        $this->last_pins = $pins;

        if ($this->isGameOver()) {
            $this->game_over = true;
        }
    }

    private function rollValidation(int $pins): void
    {
        if ($this->game_over) {
            throw new \LogicException('The game is already over.');
        }

        if ($pins > 10 || $pins < 0) {
            throw new \InvalidArgumentException('Pins must be between 0 and 10.');
        }

        if ($this->last_pins !== 10 && ($pins + $this->last_pins) > 10 && $this->throw === 2) {
            throw new \LogicException("the second roll can't exceed 10");
        }
    }

    private function  advanceToNextFrame(): void
    {
        if ($this->current_frame < 10) {
            $this->current_frame++;
            $this->throw = 1;
        }
    }

    private function isGameOver(): bool
    {
        if (!isset($this->frames[10]['frameType'])) {
            return false;
        }

        $last_frame = $this->frames[10];
        switch (true) {
            case  $last_frame['frameType'] === self::OPEN && isset($last_frame[1]):
                return true;
            case (
                $last_frame['frameType'] === self::STRIKE ||
                $last_frame['frameType'] === self::SPARE
            ) && isset($last_frame[2]):
                return true;
            default:
                return false;
        }
    }

    private function getLastFrameScore(): int
    {
        $last_frame_score = 0;
        if (isset($this->frames[10])) {
            $last_frame = $this->frames[10];
            switch (true) {
                case $last_frame['frameType'] === self::OPEN:
                    $last_frame_score += $last_frame[0] + $last_frame[1];
                    break;
                case $last_frame['frameType'] === self::STRIKE || $last_frame['frameType'] === self::SPARE:
                    $last_frame_score += $last_frame[0] + $last_frame[1] + $last_frame[2];
                    break;
            }
        }
        return $last_frame_score;
    }

    private function getFrame(int $frame_number): mixed
    {
        return $this->frames[$frame_number];
    }
}
