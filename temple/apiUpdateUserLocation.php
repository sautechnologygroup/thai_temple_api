<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once './../database.php';
include_once './../models/user.php';

$database = new Database();
$db = $database->getConnectDB();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->userId) &&
    !empty($data->latitude) &&
    !empty($data->longitude)
) {
    $user->userId = $data->userId;
    $user->latitude = $data->latitude;
    $user->longitude = $data->longitude;

    if ($user->updateUserLocation()) {
        http_response_code(200);
        echo json_encode(array("message" => "User location was updated."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update user location."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to update user location. Data is incomplete."));
}
?>
