<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Application\QuestionReadRepository;
use App\Infrastructure\Adapter\CsvQuestionRepository;
use App\Infrastructure\Adapter\JsonQuestionRepository;
use App\Infrastructure\Exception\RepositoryNotImplemented;

final class QuestionRepositoryFactory
{
    private JsonQuestionRepository $jsonRepository;

    private CsvQuestionRepository $csvRepository;

    public function __construct(JsonQuestionRepository $jsonRepository, CsvQuestionRepository $csvRepository)
    {
        $this->jsonRepository = $jsonRepository;
        $this->csvRepository = $csvRepository;
    }

    /**
     * @throws RepositoryNotImplemented
     */
    public function getReadRepositoryByType(string $type): QuestionReadRepository
    {
        switch ($type)
        {
            case 'json':
                return $this->jsonRepository;
            case 'csv':
                return $this->csvRepository;
            default:
                throw new RepositoryNotImplemented();
        }
    }
}