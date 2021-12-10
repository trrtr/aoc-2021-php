<?php

declare(strict_types=1);

final class Chunk
{
    private Parenthesis $expected;

    private ?Chunk $openedChild;

    /** @var array<Chunk> */
    private array $innerChunks;

    private bool $isComplete = false;

    private bool $corrupt = false;

    public function __construct(private Parenthesis $opening)
    {
        $this->expected = $this->opening->closer();
    }

    public function feed(Parenthesis $parenthesis): self
    {
        if (isset($this->openedChild)) {
            $this->openedChild->feed($parenthesis);
            if ($this->openedChild->isComplete()) {
                $this->innerChunks[] = $this->openedChild;
                $this->openedChild = null;
            }

            return $this;
        }

        if ($parenthesis->isOpening()) {
            $this->openedChild = new Chunk($parenthesis);

            return $this;
        }

        if ($parenthesis->isClosing() && $this->expected->equals($parenthesis)) {
            $this->isComplete = true;

            return $this;
        }

        throw new InvalidClosingBraceException($parenthesis);
    }

    public function isComplete(): bool
    {
        return $this->isComplete;
    }

    public function corrupt(): void
    {
        $this->corrupt = true;
    }

    public function isCorrupt(): bool
    {
        return $this->corrupt;
    }

    public function score(): int
    {
        $total = isset($this->openedChild)
            ? $this->openedChild->score()
            : 0
        ;

        $total *= 5;
        $total += $this->expected->autocompleteScore();

        return $total;
    }
}
