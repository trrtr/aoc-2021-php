<?php

declare(strict_types=1);

include __DIR__ . '/../SolutionInterface.php';
include __DIR__ . '/Sequence.php';
include __DIR__ . '/Board.php';
include __DIR__ . '/Input.php';

final class Solution implements SolutionInterface
{
    /**
     * @param Input $input
     *
     * @return int
     */
    public function task1($input): int
    {
        foreach ($input->sequence->sequence() as $number) {
            foreach ($input->boards as $board) {
                $board->mark($number);
                if ($board->wins()) {
                    return $board->score();
                }
            }
        }

        return 0;
    }

    public function task2($input): int
    {
        $winningBoards = [];
        $undecidedBoards = $input->boards;
        foreach ($input->sequence->sequence() as $number) {
            foreach ($undecidedBoards as $index => $board) {
                $board->mark($number);
                if ($board->wins()) {
                    $winningBoards[] = $board;
                    unset($undecidedBoards[$index]);
                }
            }
        }

        return array_pop($winningBoards)->score();

        return 0;
    }

    public function prepareInput(array $lines): Input
    {
        $sequence = Sequence::fromString(array_shift($lines));
        $boards = [];
        $acc = [];
        foreach ($lines as $line) {
            if ($line === '') {
                if (!empty($acc)) {
                    $boards[] = Board::fromArrayOfStrings($acc);
                    $acc = [];
                }
                continue;
            }
            $acc[] = $line;
        }

        return new Input($sequence, $boards);
    }
}
