<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
require_once "../config/db.php";
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}
header("Content-Type: application/json");
$data = json_decode(
    file_get_contents("php://input"),
    true
);

echo json_encode([
    "success" => true,
    "message" => "User registered successfully",
    "data" => $data
]);
$data = json_decode(
    file_get_contents("php://input"),
    true
);

$fullname = $data['fullname'];
$email = $data['email'];
$password = password_hash(
    $data['password'],
    PASSWORD_DEFAULT
);

$sql = "
INSERT INTO users(
    fullname,
    email,
    password
)
VALUES(
    '$fullname',
    '$email',
    '$password'
)";

$result = mysqli_query(
    $conn,
    $sql
);

if($result){

    echo json_encode([
        "success" => true,
        "message" => "User registered successfully",
        "data" => $data
    ]);

}else{

    echo json_encode([
        "success" => false,
        "message" => mysqli_error($conn)
    ]);

}