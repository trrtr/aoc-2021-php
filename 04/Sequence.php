<?php

declare(strict_types=1);

final class Sequence
{
    /** @var array<int> */
    private array $sequence;

    private function __construct() {}

    public static function fromString(string $sequence): self
    {
        $self = new self();
        $self->sequence = array_map('intval', explode(',', $sequence));

        return $self;
    }

    public function sequence(): array
    {
        return $this->sequence;
    }
}
