<?php
// Set the response content type to JSON
header('Content-Type: application/json');

// Define the path to the JSON file
$jsonFile = 'my_contracts.json';

// Read the POST body
$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);

// Check if the 'name' parameter exists
if (!isset($data['id'])) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Missing contract name']);
    exit;
}

$contractName = $data['id'];

// Check if the JSON file exists
if (!file_exists($jsonFile)) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Contracts file not found']);
    exit;
}

// Read and decode the JSON file
$contracts = json_decode(file_get_contents($jsonFile), true);

// Check for JSON decoding errors
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Error parsing contracts file']);
    exit;
}

// Find the contract by name
$matchedContract = null;
foreach ($contracts as $contract) {
    if ($contract['id'] === $contractName) {
        $matchedContract = $contract;
        break;
    }
}

// Return the result
if ($matchedContract) {
    echo json_encode([
        'id' => $matchedContract['id'],
        'name' => $matchedContract['name'],
        'html' => $matchedContract['html'],
        'signature' => $matchedContract['signature']    
    ]);
} else {
    http_response_code(404); // Not Found
    echo json_encode(['error' => 'Contract not found']);
}
?>
