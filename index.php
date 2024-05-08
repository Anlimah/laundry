<?php

require_once 'Router.php';
require_once 'Controller/CustomerController.php';

$router = new Router();

$router->route('GET', '/laundry/customers/{id}', 'CustomerController@show');
$router->route('POST', '/laundry/customers', 'CustomerController@create');
$router->route('PUT', '/laundry/customers/{id}', 'CustomerController@update');
$router->route('DELETE', '/laundry/customers/{id}', 'CustomerController@delete');

$router->handle();
