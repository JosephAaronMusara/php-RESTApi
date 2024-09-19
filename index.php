<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Get the request URL
    include_once 'userController.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller->getComments();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->createUser();
    }
