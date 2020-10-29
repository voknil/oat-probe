<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Dto\QuestionList;
use App\Application\Exception\ValidationFailed;
use App\Application\Query\GetQuestionList;

interface QuestionReader
{
    /**
     * @throws ValidationFailed
     */
    public function getQuestionList(GetQuestionList $query): QuestionList;
}