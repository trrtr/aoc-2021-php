<?php

declare(strict_types=1);

include __DIR__ . '/Line.php';

final class Board
{
    private array $score = [];

    /** @var array<Line> */
    private array $lines;

    private bool $isWinning = false;

    private int $winningNumber;

    private function __construct() { }

    public static function fromArrayOfStrings(array $lines): self
    {
        $self = new self();
        $intBoard = array_map(fn(string $line) => array_map('intval', preg_split('/\s+/', trim($line))), $lines);
        foreach ($intBoard as $intLine) {
            $self->score = [...$self->score, ...$intLine];
        }
        $self->lines = array_map(fn (array $line) => new Line($line), $intBoard);
        foreach (array_keys($intBoard) as $index) {
            $self->lines[] = new Line(array_column($intBoard, $index));
        }
        $firstDiagonal = [];
        $secondDiagonal = [];
        $length = count($intBoard);
        for($i = 0; $i < $length; $i++){
            $firstDiagonal[] = $intBoard[$i][$i];
            $secondDiagonal[] = $intBoard[$length - 1 - $i][$length - 1 - $i];
        }
        $self->lines[] = new Line($firstDiagonal);
        $self->lines[] = new Line($secondDiagonal);

        return $self;
    }

    public function mark(int $number): void
    {
        $this->score = array_diff($this->score, [$number]);
        foreach ($this->lines as $line) {
            $line->tryMarking($number);
            if ($line->areAllMarked()) {
                $this->boardWins($number);
            }
        }
    }

    private function boardWins(int $winningNumber): void
    {
        $this->winningNumber = $winningNumber;
        $this->isWinning = true;
    }

    public function wins(): bool
    {
        return $this->isWinning;
    }

    public function score(): int
    {
        return array_sum($this->score) * $this->winningNumber;
    }
}
