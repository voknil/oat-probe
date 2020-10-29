<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Question;

interface QuestionReadRepository
{
    /**
     * @return Question[]
     */
    public function get(): array;
}