<?php

declare(strict_types=1);

final class InvalidClosingBraceException extends RuntimeException
{
    public function __construct(private Parenthesis $parenthesis)
    {
        parent::__construct();
    }

    public function parenthesis(): Parenthesis
    {
        return $this->parenthesis;
    }
}
