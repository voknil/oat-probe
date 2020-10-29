<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class QuestionController
{
    /**
    * @Route("/questions", methods={"GET"})
    */
    public function getQuestions(): Response
    {
        return new Response(
            json_encode(['hello' => 'world'])
        );
    }

    /**
     * @Route("/questions", methods={"POST"})
     */
    public function postQuestions(): Response
    {
        return new Response(
            json_encode(['bye' => 'forever'])
        );
    }
}