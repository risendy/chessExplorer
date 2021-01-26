<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends AbstractController
{
    /**
     * @var GameRepository
     */
    private $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function index(): Response
    {
        $games = $this->gameRepository->findAll();

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'games' => $games
        ]);
    }
}
