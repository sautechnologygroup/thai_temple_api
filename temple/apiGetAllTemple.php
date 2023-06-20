<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once './../database.php';
include_once './../models/temple.php';

$database = new Database();
$db = $database->getConnectDB();

$temple = new Temple($db);

// Retrieve user's location (latitude and longitude)
$userLatitude = $_GET['userLatitude']; // Update with the parameter name you use to get the latitude
$userLongitude = $_GET['userLongitude']; // Update with the parameter name you use to get the longitude

$stmt = $temple->getTemplesWithinRadius($userLatitude, $userLongitude, 20); // Change the radius value as needed

if ($stmt->rowCount() > 0) {
    $temple_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    http_response_code(200);
    echo json_encode($temple_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No temples found."));
}

?>
