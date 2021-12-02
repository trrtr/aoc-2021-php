<?php

declare(strict_types=1);

final class Submarine
{
    private Position $position;

    public static function v1(): self
    {
        $self = new self();
        $self->position = Position::new();

        return $self;
    }

    public static function v2(): self
    {
        $self = new self();
        $self->position = PositionWithAim::new();

        return $self;
    }

    public function move(Instruction $instruction): void
    {
        $this->position->move($instruction->direction(), $instruction->distance());
    }

    public function describePosition(): int
    {
        return $this->position->horizontal() * $this->position->depth();
    }
}
