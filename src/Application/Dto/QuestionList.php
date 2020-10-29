<?php

declare(strict_types=1);

namespace App\Application\Dto;

final class QuestionList implements \JsonSerializable
{
    /**
     * @var QuestionItem[]
     */
    private array $questionItems;

    /**
     * @param QuestionItem[] $questionItems
     */
    public function __construct(array $questionItems)
    {
        $this->questionItems = $questionItems;
    }

    /**
     * @return QuestionItem[]
     */
    public function getQuestionItems(): array
    {
        return $this->questionItems;
    }

    public function jsonSerialize()
    {
        return $this->questionItems;
    }
}