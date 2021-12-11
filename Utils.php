<?php

declare(strict_types=1);

final class Utils
{
    public static function readInput(string $path): array
    {
        $inputText = file_get_contents($path);

        return explode("\n", $inputText);
    }

    public static function gridOfInts(array $grid): array
    {
        $input = array_filter($grid);

        return array_map(fn(string $row) => array_map('intval', str_split($row)), $input);
    }
}
