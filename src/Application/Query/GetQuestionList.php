<?php

declare(strict_types=1);

namespace App\Application\Query;

use Symfony\Component\Validator\Constraints as Assert;

final class GetQuestionList extends QuestionQuery
{
    /**
     * @Assert\NotBlank
     */
    private ?string $lang;

    public function __construct(?string $lang)
    {
        $this->lang = $lang;
    }

    public function getLang(): string
    {
        return $this->lang;
    }
}