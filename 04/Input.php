<?php

declare(strict_types=1);

final class Input
{
    /**
     * @param array<Board> $boards
     */
    public function __construct(
        public readonly Sequence $sequence,
        public readonly array $boards,
    ) {
    }
}
