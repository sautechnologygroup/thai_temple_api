<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once './../database.php';
include_once './../models/introduction.php';

$database = new Database();
$db = $database->getConnectDB();

$intro = new Introduction($db);

$stmt = $intro->getAllIntroduction();
$num = $stmt->rowCount();

if ($num > 0) {
    $intro_arr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $intro_item = array(
            "introId" => $introId,
            "introTempleImage" => $introTempleImage,
            "introTempleName" => $introTempleName,
            "introTempleDetail" => $introTempleDetail,
            "geographies" => $geographies // added this line
        );

        array_push($intro_arr, $intro_item);
    }

    http_response_code(200);
    echo json_encode($intro_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No introduction found.")
    );
}
?>
