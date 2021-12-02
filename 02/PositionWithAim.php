<?php

declare(strict_types=1);

class PositionWithAim extends Position
{
    private int $aim;

    public static function new(): self
    {
        $self = new self();
        $self->horizontal = 0;
        $self->depth = 0;
        $self->aim = 0;

        return $self;
    }

    public function move(Direction $direction, int $distance): void
    {
        if ($direction === Direction::FORWARD) {
            $this->horizontal += $distance;
            $this->depth += $this->aim * $distance;
        }

        $this->aim += match ($direction) {
            Direction::DOWN => $distance,
            Direction::UP => -$distance,
            default => 0,
        };
    }
}
