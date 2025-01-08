<?php
require_once "functions.php"; // Include your database or utility functions

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

// Check if 'mood' is provided in the request
if (isset($data['mood']) && !empty($data['mood'])) {
    $mood = htmlspecialchars($data['mood']);

    // AI21 Labs API Key
    $apiKey = "Sd24UTjxlnqhdxpwWevDJ2D9Lv1KuAm7";  // Replace with your actual API key

    // Prepare the messages to send in the API request
    $messages = [
        [
            "role" => "user",
            "content" => "Provide one different quote for someone feeling $mood."
        ]
    ];

    // Define the API request payload
    $payload = [
        "model" => "jamba-instruct",  // Ensure you're using the correct model
        "messages" => $messages,
        "temperature" => 0.8,  // Adjust temperature for creativity
        "n" => 5  // Number of tokens (adjust as needed)
    ];

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.ai21.com/studio/v1/chat/completions");  // API endpoint for chat completions
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer $apiKey"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo json_encode(["Error" => "cURL Error: " . curl_error($ch)]);
        curl_close($ch);
        exit;
    }

    curl_close($ch);

    // Decode the API response
    $result = json_decode($response, true);

    // Check if the response is valid and contains expected data
    if (isset($result['choices']) && is_array($result['choices'])) {
        $quotes = [];
        foreach ($result['choices'] as $choice) {
            // Extracting the content from the response correctly
            $quotes[] = $choice['message']['content'];
        }
        echo json_encode(["Quotes" => $quotes]);
    } else {
        // Handle errors or unexpected response format
        echo json_encode(["Error" => "Unexpected API response format.", "Details" => $response]);
    }
} else {
    echo json_encode(["Error" => "Invalid mood input."]);
}
?>
