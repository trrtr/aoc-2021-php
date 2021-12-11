<?php

declare(strict_types=1);

final class Octopus
{
    /** @var array<Octopus> */
    private array $neighbours = [];

    private int $lastEnergyIncrease = 0;

    private bool $hasFlashed = false;

    public function __construct(
        private int $energy,
        private int $xLocation,
        private int $yLocation,
        private FlashTracker $flashTracker,
        private CurrentStep $currentStep
    ) {
    }

    public function addNeighbour(Octopus $octopus): void
    {
        $this->neighbours[] = $octopus;
    }

    public function increaseEnergy(): void
    {
        if ($this->resetNeeded()) {
            $this->energy = 0;
            $this->hasFlashed = false;
        }
        if ($this->hasFlashed) {
            return;
        }

        $this->lastEnergyIncrease = $this->currentStep->step();

        if (++$this->energy > 9) {
            $this->flash();
            foreach ($this->neighbours as $neighbour) {
                $neighbour->increaseEnergy();
            }
        }
    }

    private function flash(): void
    {
        $this->hasFlashed = true;
        $this->flashTracker->recordFlash();
    }

    private function resetNeeded(): bool
    {
        return $this->lastEnergyIncrease < $this->currentStep->step()
            && $this->hasFlashed;
    }

    public function energy(): int
    {
        return $this->energy;
    }
}
