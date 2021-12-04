<?php

declare(strict_types=1);

final class Bit
{
    public function __construct(private int $value) { }

    public function toInt(): int
    {
        return $this->value;
    }

    public function flip(): self
    {
        return new self((int)!(bool)$this->value);
    }

    public function isSame(Bit $bit): bool
    {
        return $this->value === $bit->value;
    }
}
