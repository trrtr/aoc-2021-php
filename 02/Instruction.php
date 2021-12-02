<?php

declare(strict_types=1);

final class Instruction
{
    private Direction $direction;

    private int $distance;

    public static function fromString(string $instruction): self
    {
        $self = new self();
        [$direction, $distance] = explode(' ', $instruction);
        $self->direction = Direction::from($direction);
        $self->distance = (int)$distance;

        return $self;
    }

    public function direction(): Direction
    {
        return $this->direction;
    }

    public function distance(): int
    {
        return $this->distance;
    }
}
