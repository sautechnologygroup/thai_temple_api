<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once './../database.php';
include_once './../models/introduction.php';

$database = new Database();
$db = $database->getConnectDB();

$intro = new Introduction($db);

// Get data from the request body
$data = json_decode(file_get_contents("php://input"));

// Validate required fields
if (
    !empty($data->introTempleImage) &&
    !empty($data->introTempleName) &&
    !empty($data->introTempleDetail)
) {
    // Set introduction values from the request data
    $intro->introTempleImage = $data->introTempleImage;
    $intro->introTempleName = $data->introTempleName;
    $intro->introTempleDetail = $data->introTempleDetail;

    // Create the introduction
    if ($intro->createIntroduction()) {
        http_response_code(201);
        echo json_encode(array("message" => "Introduction created successfully."));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Unable to create introduction."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Missing required data."));
}

?>