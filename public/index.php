<?php

require __DIR__ . '/../../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../src');
$twig = new \Twig\Environment($loader, [
    'debug' => true,
    'cache' => false,
]);

echo $twig->render('Admin/Dashboard/Presentation/Dashboard.html.twig');
