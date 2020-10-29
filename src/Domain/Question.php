<?php

declare(strict_types=1);

namespace App\Domain;

interface Question
{
    public function getText(): string;

    public function getCreatedAt(): string;

    /**
     * @return Choice[]
     */
    public function getChoices(): array;
}