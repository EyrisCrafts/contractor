<?php
// Set the response content type to JSON
header('Content-Type: application/json');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["message" => "Only POST requests are allowed"]);
    exit;
}

// Get the JSON payload from the POST body
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Ensure the 'id' is provided
if (!isset($data['id'])) {
    http_response_code(400); // Bad Request
    echo json_encode(["message" => "Contract ID not provided"]);
    exit;
}

$contractId = $data['id'];

// Path to the contracts file
$filePath = 'my_contracts.json';

// Check if the file exists
if (!file_exists($filePath)) {
    http_response_code(404); // Not Found
    echo json_encode(["message" => "Contracts file not found"]);
    exit;
}

// Read and decode the JSON file
$contracts = json_decode(file_get_contents($filePath), true);

// Check for JSON decoding errors
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500); // Internal Server Error
    echo json_encode(["message" => "Error reading contracts file"]);
    exit;
}

// Find and remove the contract with the given ID
$found = false;
$updatedContracts = array_filter($contracts, function ($contract) use ($contractId, &$found) {
    if ($contract['id'] === $contractId) {
        $found = true;
        return false; // Exclude this contract
    }
    return true; // Keep other contracts
});

// Save the updated contracts back to the file
if ($found && file_put_contents($filePath, json_encode(array_values($updatedContracts), JSON_PRETTY_PRINT))) {
    http_response_code(200);
    echo json_encode(["message" => "Contract deleted successfully"]);
} elseif (!$found) {
    http_response_code(404); // Not Found
    echo json_encode(["message" => "Contract not found"]);
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(["message" => "Failed to delete contract"]);
}
?>
