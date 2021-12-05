<?php

declare(strict_types=1);

include __DIR__ . '/PointOnBoard.php';

final class Board
{
    /** @var array<PointOnBoard> */
    private array $points;

    public function addLine(Line $line): void
    {
        foreach ($line->points() as $point) {
            if (isset($this->points[$point->x()][$point->y()])) {
                $pp = $this->points[$point->x()][$point->y()]->mark();
                $this->points[$point->x()][$point->y()] = $pp;
            } else {
                $this->points[$point->x()][$point->y()] = PointOnBoard::newMarked();
            }
        }
    }

    public function getAnswer(): int
    {
        $answer = 0;
        foreach ($this->points as $xLines) {
            foreach ($xLines as $point) {
                if ($point->markedTimes() >= 2) {
                    $answer++;
                }
            }
        }
        return $answer;
    }
}
