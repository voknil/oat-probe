<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class Choice implements \App\Domain\Choice
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }
}