<?php
use App\Router;
require 'Router.php';

$router = new App\Router();

$router->add('/', function() {
    echo "Welcome to the homepage!";
});

$router->add('/about', function() {
    echo "This is the about page.";
});

$router->add('/contact', function() {
    echo "Contact us at contact@example.com";
}, 'GET');

$router->add('/submit', function() {
    echo "Form submitted!";
}, 'POST');

$router->dispatch();

?>
