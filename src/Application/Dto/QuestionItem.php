<?php

declare(strict_types=1);

namespace App\Application\Dto;

use Symfony\Component\Serializer\Annotation\SerializedName;

final class QuestionItem
{
    private string $text;

    private string $createdAt;

    private ChoiceList $choices;

    public function __construct(string $text, string $createdAt, ChoiceList $choices)
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

    public function getChoices(): ChoiceList
    {
        return $this->choices;
    }

    public function jsonSerialize()
    {
        return [
            'text' => $this->getText(),
            'createdAt' => $this->getCreatedAt(),
            'choices' => $this->getChoices(),
        ];
    }
}