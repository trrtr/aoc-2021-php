<?php

declare(strict_types=1);

final class Solution implements SolutionInterface
{
    public function task1($lines): int
    {
        $chunks = [];
        $score = 0;
        /** @var Chunk $chunk */
        foreach ($lines as $line) {
            foreach ($line as $parenthesis) {
                try {
                    if (!isset($chunk) || $chunk->isComplete()) {
                        $chunk = new Chunk($parenthesis);
                    } else {
                        $chunk->feed($parenthesis);
                    }
                } catch (InvalidClosingBraceException $e) {
                    $score += $e->parenthesis()->score();
                    break;
                }
            }
            unset($chunk);
        }

        return $score;
    }

    public function task2($lines): int
    {
        $chunks = [];
        /** @var Chunk $chunk */
        foreach ($lines as $line) {
            foreach ($line as $parenthesis) {
                try {
                    if (!isset($chunk) || $chunk->isComplete()) {
                        $chunk = new Chunk($parenthesis);
                    } else {
                        $chunk->feed($parenthesis);
                    }
                } catch (InvalidClosingBraceException $e) {
                    $chunk->corrupt();

                    break;
                }
            }
            if (!$chunk->isCorrupt()) {
                $chunks[] = $chunk;
            }
            unset($chunk);
        }

        $scores = array_map(fn(Chunk $chunk) => $chunk->score(), $chunks);
        sort($scores);

        return $scores[(int)floor(count($scores) / 2)];
    }

    public function prepareInput(array $input): array
    {
        $input = array_filter($input);

        return array_map(
            fn(string $line) => array_map(
                fn(string $char) => new Parenthesis($char),
                str_split($line)
            ),
            $input
        );
    }
}
