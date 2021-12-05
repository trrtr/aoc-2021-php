<?php

declare(strict_types=1);

final class Line
{
    private $isHorizontalOrVertical = false;

    /** @var array<Point> */
    private array $points = [];

    public static function fromEnds(Point $oneEnd, Point $secondEnd): self
    {
        $self = new self();
        $next = $oneEnd;
        $self->points[] = $oneEnd;
        while ($next = $next->nextInDirection($secondEnd)) {
            $self->points[] = $next;
        }
        $self->isHorizontalOrVertical = $oneEnd->x() === $secondEnd->x() || $oneEnd->y() === $secondEnd->y();

        return $self;
    }

    /**
     * @return array<Point>
     */
    public function points(): array
    {
        return $this->points;
    }

    public function isHorizontalOrVertical(): bool
    {
        return $this->isHorizontalOrVertical;
    }
}
