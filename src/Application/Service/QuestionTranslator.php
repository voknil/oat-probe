<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Question;

final class QuestionTranslator
{
    /**
     * @param Question[] $questions
     */
    public function translate(array $questions, string $lang): array
    {
        //TODO: implement method using translation interface,
        // create factory class for translation services
        return $questions;
    }
}
