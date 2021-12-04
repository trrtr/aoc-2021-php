<?php

declare(strict_types=1);

final class Utils
{
    public static function readInput(string $path): array
    {
        $inputText = file_get_contents($path);

        return explode("\n", $inputText);
    }
}
