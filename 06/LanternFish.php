<?php

declare(strict_types=1);

final class LanternFish
{
    private const INITIAL = 6;

    private const NEWBORN_INITIAL = 8;

    private int $daysLeft;

    public static function new(int $daysLeft): self
    {
        $self = new self();
        $self->daysLeft = $daysLeft;

        return $self;
    }

    public static function newborn(): self
    {
        $self = new self();
        $self->daysLeft = self::NEWBORN_INITIAL;

        return $self;
    }

    public function passADay(): ?self
    {
        if ($this->daysLeft === 0) {
            $this->daysLeft = self::INITIAL;

            return self::newborn();
        }

        $this->daysLeft--;

        return null;
    }

    public function daysLeft(): int
    {
        return $this->daysLeft;
    }
}
