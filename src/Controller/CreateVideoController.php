<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class CreateVideoController implements Controller
{
    public function __construct(private readonly VideoRepository $videoRepository)
    {
    }

    public function processRequest(): void
    {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);

        if ($url === false) {
            header('Location: /?sucesso=0');
            return;
        }

        $titulo = filter_input(INPUT_POST, 'titulo');

        if ($titulo === false) {
            header('Location: /?sucesso=0');
            return;
        }

        $video = new Video($url, $titulo);

        $result = $this->videoRepository->add($video);

        if ($result === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}