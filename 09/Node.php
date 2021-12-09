<?php

declare(strict_types=1);

final class Node
{
    private bool $isInBasin = false;

    public function __construct(private int $x, private int $y, private int $value)
    {
    }

    public function spread(array $nodes): ?int
    {
        if ($this->isInBasin || $this->value === 9) {
            return null;
        }
        $this->isInBasin = true;

        $neighbours = $this->getNotClaimedNeighbours($nodes);

        return 1 + array_sum(array_map(fn(Node $node) => $node->spread($nodes), $neighbours));
    }

    private function getNotClaimedNeighbours(array $nodes): array
    {
        $neighbours = [];
        $neighbours[] = $nodes[$this->y - 1][$this->x] ?? null;
        $neighbours[] = $nodes[$this->y][$this->x + 1] ?? null;
        $neighbours[] = $nodes[$this->y + 1][$this->x] ?? null;
        $neighbours[] = $nodes[$this->y][$this->x - 1] ?? null;

        $removeNulls = array_filter($neighbours);

        return array_filter($removeNulls, fn(Node $node) => $node->notInBasin() && $node->notHighest());
    }

    private function notInBasin(): bool
    {
        return !$this->isInBasin;
    }

    private function notHighest(): bool
    {
        return $this->value !== 9;
    }
}
