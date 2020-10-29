<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Dto\ChoiceItem;
use App\Application\Dto\ChoiceList;
use App\Application\Dto\QuestionItem;
use App\Application\Dto\QuestionList;
use App\Application\Exception\ValidationFailed;
use App\Application\Query\GetQuestionList;
use App\Application\Query\QuestionQuery;
use App\Application\QuestionReadRepository;
use App\Domain\Choice;
use App\Domain\Question;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class QuestionReader implements \App\Application\QuestionReader
{
    private ValidatorInterface $validator;

    private QuestionReadRepository $repository;

    private QuestionTranslator $translator;

    public function __construct(
        ValidatorInterface $validator,
        QuestionReadRepository $repository,
        QuestionTranslator $translator
    ) {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->translator = $translator;
    }

    public function getQuestionList(GetQuestionList $query): QuestionList
    {
        $this->validate($query);

        $questions = $this->translator->translate(
            $this->repository->get(),
            $query->getLang()
        );

        return $this->mapQuestionList($questions);
    }

    /**
     * @throws ValidationFailed
     */
    private function validate(QuestionQuery $query): void
    {
        $errors = $this->validator->validate($query);

        if (0 !== $errors->count()) {
            //TODO: Prettify output
            throw new ValidationFailed((string) $errors);
        }
    }

    /**
     * @param Question[] $questions
     */
    private function mapQuestionList(array $questions): QuestionList
    {
        return new QuestionList(
            array_map(
                fn (Question $question): QuestionItem => new QuestionItem(
                    $question->getText(),
                    $question->getCreatedAt(),
                    $this->mapChoiceList(
                        $question->getChoices()
                    )
                ),
                $questions
            )
        );
    }

    /**
     * @param Choice[] $choices
     */
    private function mapChoiceList(array $choices): ChoiceList
    {
        return new ChoiceList(
            array_map(
                fn (Choice $choice): ChoiceItem => new ChoiceItem(
                    $choice->getText(),
                ),
                $choices
            )
        );
    }
}
