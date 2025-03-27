<?php
//
// A simple example of json in and out!!
//
error_reporting(E_ERROR | E_PARSE);
// Takes raw data from the request
$json = file_get_contents('php://input');
// Converts it into a PHP object
$data = json_decode($json, true);

$response = "world";
$rc = 200;

$a = [
    "hello" => $response,
    "data" => $data
];

http_response_code($rc);
echo json_encode($a);