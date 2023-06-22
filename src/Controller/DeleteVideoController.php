<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class DeleteVideoController implements Controller
{
    public function __construct(private readonly VideoRepository $videoRepository)
    {
    }

    public function processRequest(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $result = $this->videoRepository->remove($id);

        if ($result === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}