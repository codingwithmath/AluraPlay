<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use PDO;

class ReadVideoController implements Controller
{
    public function __construct(private readonly VideoRepository $videoRepository)
    {
    }

    public function processRequest(): void
    {
        $videoList = $this->videoRepository->getAll();

           require_once __DIR__.('/../../views/video-list.php');
    }
}