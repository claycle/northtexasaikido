<?php
//
// A simple example of json in and out!!
// SECRET: northtexasaikido.com => bm9ydGh0ZXhhc2Fpa2lkby5jb20=
//
$secret = "bm9ydGh0ZXhhc2Fpa2lkby5jb20=";

$data = json_decode(file_get_contents('php://input'));

$respond = "";
if ($data['config']['secret'] == $secret) {
    $respond = "Secret OK: " + $data['config']['secret'];
}
else {
    $respond "Secret FAIL";
}

$a = [
    "hello" => "world",
    "response" => $respond
];

echo json_encode($a);
http_response_code(200);