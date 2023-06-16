<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once './../database.php';
include_once './../models/temple.php';

$database = new Database();
$db = $database->getConnectDB();

$temple = new Temple($db);

$stmt = $temple->getAllTemples();
$num = $stmt->rowCount();

if ($num > 0) {
    $temple_arr = array();
    $temple_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $temple_item = array(
            "templeId" => $templeId,
            "templeName" => $templeName,
            "templeAddress" => $templeAddress,
            "templeLatitude" => $templeLatitude,
            "templeLongitude" => $templeLongitude,
            "templeMainImage" => $templeMainImage,
            "templeDetail" => $templeDetail,
            "templeTell" => $templeTell,
            "districtId" => $districtId,
            "status" => $status,
            "verifiedBy" => $verifiedBy,
            "verifiedDate" => $verifiedDate
        );

        array_push($temple_arr["records"], $temple_item);
    }

    http_response_code(200);
    echo json_encode($temple_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No temples found.")
    );
}
?>
