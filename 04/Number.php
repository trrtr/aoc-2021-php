<?php

declare(strict_types=1);

final class Number
{
    private bool $isMarked = false;

    public function __construct(public readonly int $number)
    {
    }

    public function mark(): void
    {
        $this->isMarked = true;
    }

    public function isMarked(): bool
    {
        return $this->isMarked;
    }
}
