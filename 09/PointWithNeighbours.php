<?php

declare(strict_types=1);

final class PointWithNeighbours
{
    private int $x;

    private int $y;

    private int $height;

    private array $neighbours;

    private bool $isLowest = true;

    public static function fromBoard(int $x, int $y, array $board): self
    {
        $self = new self();
        $self->x = $x;
        $self->y = $y;
        $self->height = $board[$y][$x];
        $neighbours[] = $board[$y - 1][$x] ?? null;
        $neighbours[] = $board[$y][$x + 1] ?? null;
        $neighbours[] = $board[$y + 1][$x] ?? null;
        $neighbours[] = $board[$y][$x - 1] ?? null;
        $self->neighbours = array_filter($neighbours, 'is_int');
        foreach ($self->neighbours as $neighbour) {
            if ($self->height >= $neighbour) {
                $self->isLowest = false;
                break;
            }
        }

        return $self;
    }

    public function isLowest(): bool
    {
        return $this->isLowest;
    }

    public function riskLevel(): int
    {
        return 1 + $this->height;
    }
}
