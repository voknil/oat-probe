<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Choice;

final class Question implements \App\Domain\Question
{
    private string $text;

    private string $createdAt;

    /**
     * @var Choice[]
     */
    private array $choices;

    /**
     * @param Choice[] $choices
     */
    public function __construct(string $text, string $createdAt, array $choices)
    {
        $this->text = $text;
        $this->createdAt = $createdAt;
        $this->choices = $choices;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return Choice[]
     */
    public function getChoices(): array
    {
        return $this->choices;
    }
}