<?php
header("Access-Control-Allow-Origin: http://localhost:5222");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

// Validar campos vacíos
if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios"]);
    exit;
}

$name = $data['name'];
$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    // Manejar error de email duplicado
    if ($conn->errno == 1062) {
        http_response_code(409);
        echo json_encode(["success" => false, "message" => "El correo ya está registrado"]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Error del servidor: " . $conn->error]);
    }
}

$stmt->close();
$conn->close();
?>