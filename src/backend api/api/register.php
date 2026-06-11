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

// $data = json_decode(
//     file_get_contents("php://input"),
//     true
// );

$fullname = $data['fullname'];
$email = $data['email'];
$password = $data['password'];
$confirmPassword = $data['confirmPassword'];

if ($password !== $confirmPassword) {
    echo json_encode([
        "success" => false,
        "message" => "Passwords do not match"
        
    ]);
    exit();
}
$passwordH = password_hash(
    $password,
    PASSWORD_DEFAULT
);

$passwordV = password_verify(
    $password,
    $passwordH
);
if ($passwordV == true){

$checkEmail = mysqli_query(
    $conn,
    "SELECT id FROM users WHERE email = '$email'"
);
if (mysqli_num_rows($checkEmail) > 0) {
    echo json_encode([
        "success" => false,
        "message" => "Email already exists"
    ]);
    exit();
}

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
        // "data" => $data
    ]);

}else{

    echo json_encode([
        "success" => false,
        "message" => mysqli_error($conn)
    ]);

}
}

else {
     echo json_encode([
        "success" => false,
        "message" => "Passwords not verified"
        
    ]);
    exit();
}