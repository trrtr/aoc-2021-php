<?php

declare(strict_types=1);

final class PointOnBoard
{
    private int $markedTimes;

    public static function newMarked(): self
    {
        $self = new self();
        $self->markedTimes = 1;

        return $self;
    }

    public function mark(): self
    {
        $self = new self();
        $self->markedTimes = $this->markedTimes + 1;

        return $self;
    }

    public function markedTimes(): int
    {
        return $this->markedTimes;
    }
}
