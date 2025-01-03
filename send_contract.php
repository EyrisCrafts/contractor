<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Include Composer's autoloader
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
require $serverRoot . '/vendor/autoload.php';

// Include the variables file
require 'variables.php';
require 'functions.php';

// Handle PIN login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pin_login'])) {
    $pin = $_POST['pin'];
    if ($pin === $correct_pin) {
        $_SESSION['authenticated'] = true;
    } else {
        $login_error = "Invalid PIN. Please try again.";
    }
}

// Redirect if not logged in
if (empty($_SESSION['authenticated'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                font-family: Arial, sans-serif;
                margin: 0;
                background-color: #f0f0f0;
            }
            #login-form {
                padding: 20px;
                border: 1px solid #ccc;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            input[type="number"] {
                width: 100%;
                /* padding: 10px; */
                padding-top: 10px;
                padding-bottom: 10px;
                padding-right: 0px;
                margin: 10px 0;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 16px;
            }
            button {
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <form id="login-form" action="" method="post">
            <?php if (!empty($login_error)) echo "<p style='color:red;'>$login_error</p>"; ?>
            <p>Please enter your PIN:</p>
            <input type="number" name="pin" required>
            <button type="submit" name="pin_login">Login</button>
        </form>
    </body>
    </html>
    <?php
    exit;
}

// Handle form submission for sending contracts
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
                $full_contract_path = "http://localhost:3000/$contract_path";

                // Create a clickable link
                $contract_link = '<a href="' . $full_contract_path . '" target="_blank">' . $full_contract_path . '</a>';

                // Replace [CONTRACT_PATH] with the clickable link
                $EMAIL_BODY_INITIAL_FOR_CONTRACT_SIGNING = str_replace('[CONTRACT_PATH]', $contract_link, $EMAIL_BODY_INITIAL_FOR_CONTRACT_SIGNING);

                sendEmail($dev_email, $clientEmail, $EMAIL_SUBJECT_INITIAL_FOR_CONTRACT_SIGNING, $EMAIL_BODY_INITIAL_FOR_CONTRACT_SIGNING, null, $dev_app_password);

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
            #login-form {
                padding: 20px;
                border: 1px solid #ccc;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            input[type="number"] {
                width: 100%;
                /* padding: 10px; */
                padding-top: 10px;
                padding-bottom: 10px;
                padding-right: 0px;
                margin: 10px 0;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 16px;
            }
            button {
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            button:hover {
                background-color: #0056b3;
            }
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
        <label for="Sending from">Sending from:</label><br>
        <input type="text" id="dev_email_address" name="dev_email_address" value="<?php echo htmlspecialchars($dev_email); ?>" disabled><br><br>
        
        <label for="client_name">Client Name:</label><br>
        <input type="text" id="client_name" name="client_name" oninput="updateContract()" required><br><br>

        <label for="client_email">Client Email:</label><br>
        <input type="email" id="client_email" name="client_email" required><br><br>

        <button type="submit" name="send_contract">Send Contract</button>
        <button type="button" onclick="window.location.href='list_contracts.php';">View Contracts</button>
    </form>
    <div id="contract-section">
        <?php echo $CONTRACT_HTML; ?>
    </div>
</body>

</html>
