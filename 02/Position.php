<?php

declare(strict_types=1);

class Position
{
    protected int $horizontal;

    protected int $depth;

    public static function new(): self
    {
        $self = new self();
        $self->horizontal = 0;
        $self->depth = 0;

        return $self;
    }

    public function move(Direction $direction, int $distance): void
    {
        $this->horizontal += match ($direction) {
            Direction::FORWARD => $distance,
            default => 0,
        };
        $this->depth += match ($direction) {
            Direction::UP => -$distance,
            Direction::DOWN => $distance,
            default => 0,
        };
    }

    public function horizontal(): int
    {
        return $this->horizontal;
    }

    public function depth(): int
    {
        return $this->depth;
    }
}
