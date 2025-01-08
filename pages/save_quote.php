<?php
require_once "functions.php";
dbConnect();

$data = json_decode(file_get_contents("php://input"), true);

$quote = $data['quote'] ?? null;
$userId = $_SESSION['userid'] ?? null; // Correct way to access session variable
$mood = $data['mood'] ?? null;

// Validate inputs
if (!$quote || !$userId || !$mood) {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
    exit;
}

// Current timestamp for saved_at
$savedAt = date("Y-m-d H:i:s");

// Save the data
$stmt = $conn->prepare("INSERT INTO quotes (user_id, quote, mood, saved_at) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $userId, $quote, $mood, $savedAt);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Quote saved successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
