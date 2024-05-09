<?php
require 'vendor/autoload.php';

use Controller\CustomerController;
use Core\Router;
use Core\Functions;

$router = new Router();
// /Functions::dd($_SERVER);

$router->route('GET', '/laundry/customers', 'CustomerController@show');
$router->route('GET', '/laundry/customers/{id}', 'CustomerController@show');
$router->route('POST', '/laundry/customers', 'CustomerController@create');
$router->route('PUT', '/laundry/customers/{id}', 'CustomerController@update');
$router->route('DELETE', '/laundry/customers/{id}', 'CustomerController@delete');

$router->handle();
