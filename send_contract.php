<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Include Composer's autoloader
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
require $serverRoot . '/vendor/autoload.php';


// Include the variables file
require 'variables.php';
require 'functions.php';
// variable called $CONTRACT_HTML

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_contract'])) {
    $clientName = htmlspecialchars($_POST['client_name']);
    $clientEmail = filter_var($_POST['client_email'], FILTER_VALIDATE_EMAIL);

    if (!$clientEmail) {
        $error = "Invalid email address provided.";
    } else {
        try {
            // Generate the contract and send it to the client
            $contract_path = generate_contract($clientName, $clientEmail);
            if ($contract_path === false) {
                $success = "Email already sent to $clientName at $clientEmail.";
            } else {
                sendEmail($dev_email, $clientEmail, 'Contract Notification', 'Thank you for signing up with us. You can go ahead and sign the contract at localhost:3000/' . $contract_path, null);

                $success = "Email successfully sent to $clientName at $clientEmail.";
            }
        } catch (Exception $e) {
            $error = "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Contract</title>
    <link rel="preconnect" href="https://cdn.skypack.dev">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <?php echo $CONTRACT_STYLES; ?>
    <style>
        body {
            display: flex;
            justify-content: space-between;
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        form {
            width: 45%;
        }

        #contract-section {
            width: 50%;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
    </style>
    <script>
        function updateContract() {
            const clientNameInput = document.getElementById('client_name').value;
            const clientNameDisplay = document.getElementById('client-name-display');

            // Update the contract display with the entered client name
            if (clientNameInput) {
                clientNameDisplay.textContent = clientNameInput;
            } else {
                clientNameDisplay.textContent = '[Client Name]';
            }
        }
    </script>
</head>

<body>
    <form action="" method="post">
        <?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <p>Send Contract</p>
        <br />
        <label for="client_name">Client Name:</label><br>
        <input type="text" id="client_name" name="client_name" oninput="updateContract()" required><br><br>

        <label for="client_email">Client Email:</label><br>
        <input type="email" id="client_email" name="client_email" required><br><br>

        <button type="submit" name="send_contract">Send Contract</button>

    </form>
    <div id="contract-section">
        <?php echo $CONTRACT_HTML; ?>
    </div>
</body>

</html>