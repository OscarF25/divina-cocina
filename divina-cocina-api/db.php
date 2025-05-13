<?php
header("Access-Control-Allow-Origin: http://localhost:5372");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email'];
$password = $data['password'];

$stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($user_id, $hashed_password);
$stmt->fetch();

if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
    echo json_encode(["success" => true, "user_id" => $user_id]);
} else {
    http_response_code(401);
    echo json_encode([
        "success" => false, 
        "message" => "Credenciales inválidas",
        "error_detail" => ($stmt->num_rows === 0) ? "Usuario no existe" : "Contraseña incorrecta"
    ]);
}

$stmt->close();
$conn->close();
?>