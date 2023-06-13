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

    // Get data from the request body
    $data = json_decode(file_get_contents("php://input"));

    // Validate required fields
    if (
        !empty($data->introTempleImage) &&
        !empty($data->introTempleName) &&
        !empty($data->introTempleDetail)
    ) {
        // Set introduction values from the request data
        $intro->introId = $introId;
        $intro->introTempleImage = $data->introTempleImage;
        $intro->introTempleName = $data->introTempleName;
        $intro->introTempleDetail = $data->introTempleDetail;

        // Update the introduction
        if ($intro->updateIntroduction()) {
            http_response_code(200);
            echo json_encode(array("message" => "Introduction updated successfully."));
        } else {
            http_response_code(500);
            echo json_encode(array("message" => "Unable to update introduction."));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Missing required data."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Missing introId parameter."));
}
