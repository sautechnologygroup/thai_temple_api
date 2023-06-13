<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once './../database.php';
include_once './../models/introduction.php';

$database = new Database();
$db = $database->getConnectDB();

$intro = new Introduction($db);

// Check if the introId parameter is set in the URL
if (isset($_GET['introId'])) {
    $introId = $_GET['introId'];

    // Delete the introduction
    if ($intro->deleteIntroduction($introId)) {
        http_response_code(200);
        echo json_encode(array("message" => "Introduction deleted successfully."));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Unable to delete introduction."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Missing introId parameter."));
}
