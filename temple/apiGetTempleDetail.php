<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../database.php';
include_once '../models/temple.php';

$database = new Database();
$db = $database->getConnectDB();

$temple = new Temple($db);

// Get the temple ID from the URL
$temple->templeId = isset($_GET['id']) ? $_GET['id'] : die();

// Fetch the temple details
$temple->getTempleDetail();

if ($temple->templeName != null) {
    // Create array
    $temple_arr = array(
        "id" =>  $temple->templeId,
        "name" => $temple->templeName,
        "address" => $temple->templeAddress,
        "latitude" => $temple->templeLatitude,
        "longitude" => $temple->templeLongitude,
        "mainImage" => $temple->templeMainImage,
        "detail" => $temple->templeDetail,
        "tell" => $temple->templeTell,
        "districtId" => $temple->districtId,
        "status" => $temple->status,
        "verifiedBy" => $temple->verifiedBy,
        "verifiedDate" => $temple->verifiedDate
        // Add all the other fields
    );

    // Set response code - 200 OK and show data in json format
    http_response_code(200);
    echo json_encode($temple_arr);
} else {
    // Set response code - 404 Not found and tell the user
    http_response_code(404);
    echo json_encode(array("message" => "Temple does not exist."));
}
