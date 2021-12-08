<?php

declare(strict_types=1);

final class Wiring
{
    public function __construct(array $digits)
    {
        foreach ($digits as $digit) {
            if (strlen($digit) === 2) {
                $this->segments[1] = str_split($digit);
            }
            if (strlen($digit) === 3) {
                $this->segments[7] = str_split($digit);
            }
            if (strlen($digit) === 4) {
                $this->segments[4] = str_split($digit);
            }
            if (strlen($digit) === 7) {
                $this->segments[8] = str_split($digit);
            }
            if (strlen($digit) === 5) {
                $this->segments[2][] = str_split($digit);
                $this->segments[3][] = str_split($digit);
                $this->segments[5][] = str_split($digit);
            }
            if (strlen($digit) === 6) {
                $this->segments[0][] = str_split($digit);
                $this->segments[6][] = str_split($digit);
                $this->segments[9][] = str_split($digit);
            }
        }
        foreach ($this->segments[2] as $possible2) {
            if (count(array_diff($possible2, $this->segments[4])) === 3) {
                $this->segments[2] = $possible2;
            }
        }
        foreach ($this->segments[3] as $possible3) {
            if (count(array_diff($possible3, $this->segments[2])) === 1) {
                $this->segments[3] = $possible3;
            }
        }
        foreach ($this->segments[5] as $possible5) {
            if (count(array_diff($possible5, $this->segments[2])) === 2) {
                $this->segments[5] = $possible5;
            }
        }
        foreach ($this->segments[6] as $possible6) {
            if (count(array_diff($possible6, $this->segments[7])) === 4) {
                $this->segments[6] = $possible6;
            }
        }
        foreach ($this->segments[0] as $possible0) {
            if (count(array_diff($possible0, $this->segments[5])) === 2) {
                $this->segments[0] = $possible0;
            }
        }
        foreach ($this->segments[9] as $possible9) {
            if (count(array_diff($possible9, $this->segments[3])) === 1) {
                $this->segments[9] = $possible9;
            }
        }
    }

    public function getNumber(string $digit): int
    {
        if (strlen($digit) === 2) {
            return 1;
        }
        if (strlen($digit) === 3) {
            return 7;
        }
        if (strlen($digit) === 4) {
            return 4;
        }
        if (strlen($digit) === 7) {
            return 8;
        }
        $digit = str_split($digit);
        if (count($digit) === 5) {
            foreach ([2, 3, 5] as $item) {
                if (count(array_diff($this->segments[$item], $digit)) === 0) {
                    return $item;
                }
            }
        }
        if (count($digit) === 6) {
            foreach ([0,6,9] as $item) {
                if (count(array_diff($this->segments[$item], $digit)) === 0) {
                    return $item;
                }
            }
        }
    }
}
