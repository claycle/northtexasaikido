<?php
//
// A simple example of json in and out!!
//
$data = json_decode(file_get_contents('php://input'));

$a = [
    "hello" => "world",
    "data" => $data
];

echo json_encode($a);
http_response_code(200);