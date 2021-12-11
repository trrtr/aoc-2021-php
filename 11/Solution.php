<?php

declare(strict_types=1);

final class Solution implements SolutionInterface
{
    public function task1($input): int
    {
        /** @var array<array<Octopus>> $octopusGrid */
        $octopusGrid = [];
        $step = new CurrentStep();
        $flashTracker = new FlashTracker($step);
        foreach ($input as $y => $line) {
            foreach ($line as $x => $column) {
                $octopusGrid[$y][$x] = new Octopus($column, $x, $y, $flashTracker, $step);
            }
        }
        foreach ($octopusGrid as $y => $octopusLine) {
            foreach ($octopusLine as $x => $octopus) {
                $potentialNeighbours = [];
                $potentialNeighbours[] = $octopusGrid[$y - 1][$x] ?? null;
                $potentialNeighbours[] = $octopusGrid[$y - 1][$x + 1] ?? null;
                $potentialNeighbours[] = $octopusGrid[$y][$x + 1] ?? null;
                $potentialNeighbours[] = $octopusGrid[$y + 1][$x + 1] ?? null;
                $potentialNeighbours[] = $octopusGrid[$y + 1][$x] ?? null;
                $potentialNeighbours[] = $octopusGrid[$y + 1][$x - 1] ?? null;
                $potentialNeighbours[] = $octopusGrid[$y][$x - 1] ?? null;
                $potentialNeighbours[] = $octopusGrid[$y - 1][$x - 1] ?? null;
                $neighbours = array_filter($potentialNeighbours);
                foreach ($neighbours as $neighbour) {
                    $octopus->addNeighbour($neighbour);
                }
            }
        }

        for ($i = 0; $i < 200; $i++) {
            $step->increment();
            foreach ($octopusGrid as $octupusLine) {
                foreach ($octupusLine as $octop) {
                    $octop->increaseEnergy();
                }
            }
        }

        return $flashTracker->score();
    }

    private function draw(array $grid)
    {
        echo "\n";
        foreach ($grid as $line) {
            foreach ($line as $item) {
                echo $item->energy();
            }
            echo "\n";
        }
        echo "\n";
    }

    public function task2($input): int
    {
        /** @var array<array<Octopus>> $octopusGrid */
        $octopusGrid = [];
        $step = new CurrentStep();
        $flashTracker = new FlashTracker($step);
        foreach ($input as $y => $line) {
            foreach ($line as $x => $column) {
                $octopusGrid[$y][$x] = new Octopus($column, $x, $y, $flashTracker, $step);
            }
        }
        foreach ($octopusGrid as $y => $octopusLine) {
            foreach ($octopusLine as $x => $octopus) {
                $potentialNeighbours = [];
                $potentialNeighbours[] = $octopusGrid[$y - 1][$x] ?? null;
                $potentialNeighbours[] = $octopusGrid[$y - 1][$x + 1] ?? null;
                $potentialNeighbours[] = $octopusGrid[$y][$x + 1] ?? null;
                $potentialNeighbours[] = $octopusGrid[$y + 1][$x + 1] ?? null;
                $potentialNeighbours[] = $octopusGrid[$y + 1][$x] ?? null;
                $potentialNeighbours[] = $octopusGrid[$y + 1][$x - 1] ?? null;
                $potentialNeighbours[] = $octopusGrid[$y][$x - 1] ?? null;
                $potentialNeighbours[] = $octopusGrid[$y - 1][$x - 1] ?? null;
                $neighbours = array_filter($potentialNeighbours);
                foreach ($neighbours as $neighbour) {
                    $octopus->addNeighbour($neighbour);
                }
            }
        }

        while(true) {
            $step->increment();
            foreach ($octopusGrid as $octupusLine) {
                foreach ($octupusLine as $octop) {
                    $octop->increaseEnergy();
                }
            }

            if ($flashTracker->lastScore() === 100) {
                break;
            }
        }

        return $step->step();
    }

    public function prepareInput(array $input): array
    {
        return Utils::gridOfInts($input);
    }
}
