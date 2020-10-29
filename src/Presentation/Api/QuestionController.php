<?php

declare(strict_types=1);

namespace App\Presentation\Api;

use App\Application\Exception\ValidationFailed;
use App\Application\Query\GetQuestionList;
use App\Application\QuestionReader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;

final class QuestionController
{
    public QuestionReader $questionReader;

    public Serializer $serializer;

    public function __construct(QuestionReader $questionReader, Serializer $serializer)
    {
        $this->questionReader = $questionReader;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/questions", methods={"GET"})
     */
    public function getQuestions(Request $request): Response
    {
        try {
            //TODO: prettify with serializable annotations
            return new Response(
                $this->serializer->serialize(
                    $this->questionReader->getQuestionList(
                        new GetQuestionList(
                            $request->get('lang')
                        )
                    ),
                    'json'
                )
            );
        } catch (ValidationFailed $exception) {
            return new Response(
                json_encode(
                    [
                        'errors' => $exception->getMessage()
                    ]
                )
            );
        }

    }

    /**
     * @Route("/questions", methods={"POST"})
     */
    public function postQuestions(): Response
    {
        return new Response(
            json_encode(['Hello' => 'world'])
        );
    }
}