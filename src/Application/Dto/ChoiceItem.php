<?php

declare(strict_types=1);

namespace App\Application\Dto;

final class ChoiceItem
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

    public function jsonSerialize()
    {
        return [
            'text' => $this->getText(),
        ];
    }
}