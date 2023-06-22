<?php

use Alura\Mvc\Controller\{
    Controller,
    CreateVideoController,
    DeleteVideoController,
    FormVideoController,
    UpdateVideoController,
    ReadVideoController
};
use Alura\Mvc\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo);

/** @var Controller $controller */

if ($_SERVER["PATH_INFO"] === '/' || !array_key_exists("PATH_INFO" ,$_SERVER)) {
    $controller = new ReadVideoController($videoRepository);
} elseif ($_SERVER["PATH_INFO"] === '/novo-video') {
    if ($_SERVER["REQUEST_METHOD"] === 'GET') {
        $controller = new FormVideoController($videoRepository);
    } elseif ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $controller = new CreateVideoController($videoRepository);
    }
} elseif ($_SERVER["PATH_INFO"] === '/editar-video') {
    if ($_SERVER["REQUEST_METHOD"] === 'GET') {
        $controller = new FormVideoController($videoRepository);
    } elseif ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $controller = new UpdateVideoController($videoRepository);
    }
} elseif ($_SERVER["PATH_INFO"] === '/remover-video') {
       $controller = new DeleteVideoController($videoRepository);
} else {
    http_response_code(404);
}
$controller->processRequest();