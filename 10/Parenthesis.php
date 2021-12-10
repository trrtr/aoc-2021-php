<?php

declare(strict_types=1);

final class Parenthesis
{
    private const CHAR_MAP = [
        '(' => ')',
        '[' => ']',
        '{' => '}',
        '<' => '>',
    ];

    private const SCORE_MAP = [
        ')' => 3,
        ']' => 57,
        '}' => 1197,
        '>' => 25137,
    ];

    private const AUTOCOMPLETE_SCORE_MAP = [
        ')' => 1,
        ']' => 2,
        '}' => 3,
        '>' => 4,
    ];

    private bool $isClosing;

    public function __construct(private string $char)
    {
        $this->isClosing = !array_key_exists($char, self::CHAR_MAP);
    }

    public function isClosing(): bool
    {
        return $this->isClosing;
    }

    public function closer(): Parenthesis
    {
        return new self(self::CHAR_MAP[$this->char]);
    }

    public function equals(self $parenthesis): bool
    {
        return $this->char === $parenthesis->char;
    }

    public function isOpening(): bool
    {
        return !$this->isClosing;
    }

    public function score(): int
    {
        return self::SCORE_MAP[$this->char];
    }

    public function char(): string
    {
        return $this->char;
    }

    public function autocompleteScore(): int
    {
        return self::AUTOCOMPLETE_SCORE_MAP[$this->char];
    }
}
