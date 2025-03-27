<?php

require __DIR__ . '/../../vendor/autoload.php';

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Bridge\Twig\Extension\RoutingExtension;
use Symfony\Component\HttpFoundation\Request;

$routes = new RouteCollection();
$routes->add('Home', new Route('/Home', ['_controller' => 'Home']));
$routes->add('Games', new Route('/Games', ['_controller' => 'Games']));
$routes->add('Leaderboards', new Route('/Leaderboards', ['_controller' => 'Leaderboards']));
$routes->add('Account', new Route('/Account', ['_controller' => 'Account']));
$routes->add('Contact', new Route('/Contact', ['_controller' => 'Contact']));

$context = new RequestContext();
$matcher = new UrlMatcher($routes, $context);

$urlGenerator = new UrlGenerator($routes, $context);

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader, [
    'debug' => true,
    'cache' => false,
]);

$twig->addExtension(new RoutingExtension($urlGenerator));

$request = Request::createFromGlobals();
$context->fromRequest($request);

try {
    $parameters = $matcher->match($request->getPathInfo());
    $controller = $parameters['_controller'];

    switch ($controller) {
        case 'Home':
            $renderedContent = $twig->render('Admin/Home/Dashboard.html.twig');
            break;
        case 'Games':
            $renderedContent = $twig->render('Admin/Games/Games.html.twig');
            break;
        case 'Leaderboards':
            $renderedContent = $twig->render('Admin/Leaderboards/Leaderboards.html.twig');
            break;
        case 'Account':
            $renderedContent = $twig->render('Admin/Account/Account.html.twig');
            break;
        case 'Contact':
            $renderedContent = $twig->render('Admin/Contact/Contact.html.twig');
            break;
        default:
            throw new \Exception('Unknown controller');
    }

    echo $renderedContent;
} catch (\Twig\Error\LoaderError $e) {
    echo 'Template loading error: ' . $e->getMessage();
} catch (\Twig\Error\RuntimeError $e) {
    echo 'Runtime error: ' . $e->getMessage();
} catch (\Twig\Error\SyntaxError $e) {
    echo 'Syntax error: ' . $e->getMessage();
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
