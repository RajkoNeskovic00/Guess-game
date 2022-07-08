<?php

namespace Guess\Controller\Player;

use Exception;
use Guess\Application\Handler\Player\MakeGuessHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GuessController extends AbstractController
{
    private MakeGuessHandler $guessHandler;

    public function __construct(MakeGuessHandler $guessHandler)
    {
        $this->guessHandler = $guessHandler;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function index(Request $request): JsonResponse
    {
        $guessArray = json_decode($request->getContent(), true);

        $this->guessHandler->handle(
            [
                'gameId' => $guessArray['gameId'],
                'guess' => $guessArray['guess'],
                'username' => $this->getUser()->getUsername()
            ]
        );

        return new JsonResponse('Guess has been made');
    }
}