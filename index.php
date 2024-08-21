<?php


// Use the correct namespace

use App\controller\HomeController;


require_once __DIR__ . '/App/Router.php'; // Ensure this path is correct

use App\Router;

$router = new Router('/Routes');

$router
    ->get('/', [HomeController::class, 'index']);
$router->register('/about', function () {
    return 'This is the About Page.';
});

$router->register('/contact', function () {
    return 'Contact us at contact@example.com.';
});

// Resolve the current request URI and display the result
echo $router->resolve($_SERVER['REQUEST_URI']);

