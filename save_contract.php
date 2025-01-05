<?php

// Get JSON payload
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Ensure required fields are present
if (!isset($data['name']) || !isset($data['html'])) {
    http_response_code(400);
    echo json_encode(["message" => "Invalid input data"]);
    exit;
}

// Path to the contracts file
$filePath = 'my_contracts.json';

// Read existing contracts or initialize an empty array
if (file_exists($filePath)) {
    $contracts = json_decode(file_get_contents($filePath), true);
    if (!is_array($contracts)) {
        $contracts = [];
    }
} else {
    $contracts = [];
}

// Check if 'id' is provided in the input
if (isset($data['id'])) {
    $existingId = $data['id'];
    $contractFound = false;

    // Search for the contract with the given ID and update it
    foreach ($contracts as &$contract) {
        if ($contract['id'] === $existingId) {
            $contract['name'] = $data['name'];
            $contract['html'] = $data['html'];
            $contractFound = true;
            break;
        }
    }

    // If the contract was updated
    if ($contractFound) {
        if (file_put_contents($filePath, json_encode($contracts, JSON_PRETTY_PRINT))) {
            http_response_code(200);
            echo json_encode([
                "message" => "Contract updated successfully",
                "contract" => $data
            ]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Failed to update contract"]);
        }
    } else {
        // If the ID was provided but doesn't exist, return an error
        http_response_code(404);
        echo json_encode(["message" => "Contract with the given ID not found"]);
    }
} else {
    // Generate a unique ID for the new contract
    $newContractId = uniqid("contract_", true);

    // Create new contract entry
    $newContract = [
        "id" => $newContractId,
        "name" => $data['name'],
        "html" => $data['html'],
    ];

    // Add the new contract to the list
    $contracts[] = $newContract;

    // Save the updated contracts list to the file
    if (file_put_contents($filePath, json_encode($contracts, JSON_PRETTY_PRINT))) {
        http_response_code(200);
        echo json_encode([
            "message" => "Contract saved successfully",
            "contract" => $newContract
        ]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Failed to save contract"]);
    }
}
