<?php

declare(strict_types=1);

final class Point
{
    private int $x;
    private int $y;

    public static function fromString(string $coordinates): self
    {
        $self = new self();
        $splitCoordinates = explode(',', $coordinates);
        [$self->x, $self->y] = array_map('intval', $splitCoordinates);

        return $self;
    }

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }

    public function nextInDirection(Point $direction): self|null
    {
        if ($this->equals($direction)) {
            return null;
        }
        $new = new self();
        $new->x = $this->x + ($direction->x <=> $this->x);
        $new->y = $this->y + ($direction->y <=> $this->y);

        return $new;
    }

    public function equals(Point $comparedPoint): bool
    {
        return $this->x === $comparedPoint->x && $this->y === $comparedPoint->y;
    }
}
