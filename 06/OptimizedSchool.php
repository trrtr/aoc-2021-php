<?php

declare(strict_types=1);

final class OptimizedSchool
{
    private array $fishes = [0, 0, 0, 0, 0, 0, 0, 0, 0];

    /**
     * @param array<LanternFish> $fishes
     */
    public function __construct(array $fishes)
    {
        foreach ($fishes as $fish) {
            $this->fishes[$fish->daysLeft()]++;
        }
    }

    public function passDay(): void
    {
        $parents = array_shift($this->fishes);
        $this->fishes[6] += $parents;
        $this->fishes[8] = $parents;

        $this->fishes = array_combine(
            [0, 1, 2, 3, 4, 5, 6, 7, 8],
            array_values($this->fishes),
        );
    }

    public function passDays(int $days): void
    {
        for ($i = 0; $i < $days; $i++) {
            $this->passDay();
        }
    }

    public function fishCount(): int
    {
        return array_sum($this->fishes);
    }
}
