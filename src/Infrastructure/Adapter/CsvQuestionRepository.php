<?php

declare(strict_types=1);

namespace App\Infrastructure\Adapter;

use App\Application\QuestionReadRepository;

final class CsvQuestionRepository implements QuestionReadRepository
{
    private string $dataPath;

    public function __construct(string $dataPath)
    {
        $this->dataPath = $dataPath;
    }

    public function get(): array
    {
        $data = json_decode($this->getData());

        return $data;
    }

    //TODO: TOO DIRTY, refactor
    public function getData(): string
    {
        return file_get_contents($this->dataPath);
    }
}
