<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class UpdateVideoController implements Controller
{
    public function __construct(private readonly videoRepository $videoRepository)
    {
    }

    public function processRequest(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === false) {
            header('Location: /?sucesso=0');
            exit();
        }

        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);

        if ($url === false) {
            header('Location: /?sucesso=0');
            exit();
        }

        $title = $_POST['titulo'];
        $video = new Video($url, $title);
        $video->setId($id);

        $result = $this->videoRepository->update($video);

        if ($result === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}