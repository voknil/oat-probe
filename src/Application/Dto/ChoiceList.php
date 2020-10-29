<?php

declare(strict_types=1);

namespace App\Application\Dto;

final class ChoiceList
{
    /**
     * @var array<ChoiceItem>
     */
    private array $choiceItems;

    public function __construct(array $choiceItems)
    {
        $this->choiceItems = $choiceItems;
    }

    /**
     * @return ChoiceItem[]
     */
    public function getChoiceItems(): array
    {
        return $this->choiceItems;
    }
}
