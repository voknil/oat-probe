<?php

declare(strict_types=1);

namespace App\Infrastructure\Adapter;

use App\Application\QuestionReadRepository;
use App\Domain\Choice;
use App\Domain\Question;
use App\Infrastructure\Exception\FileDoesNotExist;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

final class JsonQuestionRepository implements QuestionReadRepository
{
    private string $basePath;

    private string $dataPath;

    private PropertyAccessorInterface $propAccessor;

    public function __construct(string $basePath, string $dataPath)
    {
        $this->basePath = $basePath;
        $this->dataPath = $dataPath;
        $this->propAccessor = PropertyAccess::createPropertyAccessor();
    }

    /**
     * @return Question[]
     */
    public function get(): array
    {
        $data = json_decode($this->getData(), true);

        return array_map(
            fn(array $question): Question => $this->mapQuestion($question),
            $data
        );
    }


    /**
     * @return string
     * @throws FileDoesNotExist
     */
    private function getData(): string
    {
        $filePath = $this->getFilePath();
        if (!file_exists($filePath)) {
            throw new FileDoesNotExist($filePath);
        }

        return file_get_contents($filePath);
    }

    private function getFilePath(): string
    {
        return $this->basePath.'/'.$this->dataPath;
    }

    private function mapQuestion(array $data): Question
    {

        return new \App\Domain\Entity\Question(
            $this->propAccessor->getValue($data, '[text]'),
            $this->propAccessor->getValue($data, '[createdAt]'),
            array_map(
                fn(array $choice): Choice => $this->mapChoice($choice),
                $this->propAccessor->getValue($data, '[choices]')
            )
        );
    }

    private function mapChoice(array $data): Choice
    {
        return new \App\Domain\Entity\Choice(
            $this->propAccessor->getValue($data, '[text]'),
        );
    }
}