<?php

declare(strict_types=1);

final class School
{
    /** @var array<LanternFish> */
    private array $fishes;

    /**
     * @param array<LanternFish> $fishes
     */
    public function __construct(array $fishes)
    {
        $this->fishes = $fishes;
    }

    public function passADay(): void
    {
        foreach ($this->fishes as $fish) {
            $newborn = $fish->passADay();
            if ($newborn instanceof LanternFish) {
                $this->fishes[] = $newborn;
            }
        }
    }

    public function passDays(int $days): void
    {
        for ($i = 0; $i < $days; $i++) {
            $this->passADay();
        }
    }

    public function fishCount(): int
    {
        return count($this->fishes);
    }
}
