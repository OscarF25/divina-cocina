<?php
header("Access-Control-Allow-Origin: http://localhost:5222");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

// Validar datos
if (empty($data) || !isset($data['email']) || !isset($data['password'])) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Datos incompletos"]);
    exit;
}

$email = $data['email'];
$password = $data['password'];

$stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($user_id, $user_name, $hashed_password);
$stmt->fetch();

if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
    echo json_encode(["success" => true, "user_id" => $user_id, "name" => $user_name]);
} else {
    http_response_code(401);
    echo json_encode([
        "success" => false,
        "message" => "Credenciales inválidas",
        "debug" => ($stmt->num_rows === 0) ? "El correo no existe" : "Contraseña incorrecta"
    ]);
}

$stmt->close();
$conn->close();
?>