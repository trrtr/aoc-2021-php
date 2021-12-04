<?php

declare(strict_types=1);

include __DIR__ . '/Bit.php';

final class Binary
{
    /** @var array<Bit> */
    private array $bits;

    private function __construct()
    {
    }

    public static function fromString(string $string): self
    {
        $self = new self();
        $self->bits = array_map(
            static fn(string $strBit): Bit => new Bit((int)$strBit),
            str_split($string)
        );

        return $self;
    }

    private static function fromBits(array $flipped): self
    {
        $self = new self();
        $self->bits = $flipped;

        return $self;
    }

    /**
     * @return array<Bit>
     */
    public function bits(): array
    {
        return $this->bits;
    }

    public function flip(): Binary
    {
        $flipped = array_map(fn(Bit $bit) => $bit->flip(), $this->bits);

        return self::fromBits($flipped);
    }

    public function toInt(): int
    {
        return bindec($this->toString());
    }

    public function isTheSameOnPosition(int $position, Binary $otherBinary): bool
    {
        $thisBit = $this->bits[$position];
        $otherBit = $otherBinary->bits[$position];

        return $thisBit->isSame($otherBit);
    }

    public function toString(): string
    {
        return implode('', array_map(fn(Bit $bit) => $bit->toInt(), $this->bits));
    }
}
