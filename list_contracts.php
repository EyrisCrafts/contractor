<?php
session_start();
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
require $serverRoot . '/variables.php';


// Handle the PIN submission
if (isset($_POST['pin'])) {
    $entered_pin = $_POST['pin'];
    if ($entered_pin === $correct_pin) {
        $_SESSION['authenticated'] = true;
    } else {
        echo "<script>alert('Incorrect PIN');</script>";
    }
}

// Check if user is authenticated
$is_authenticated = isset($_SESSION['authenticated']) && $_SESSION['authenticated'];

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
            input {
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
            <input name="pin" required>
            <button type="submit" name="pin_login">Login</button>
        </form>
    </body>
    </html>
    <?php
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIN Login</title>
</head>
<style>
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

<body>

    <?php if (!$is_authenticated): ?>
        <h2>Please enter the PIN to login</h2>
        <form method="POST">
            <input type="password" name="pin" maxlength="5" placeholder="Enter PIN" required>
            <button type="submit">Login</button>
        </form>
    <?php else: ?>
        <!-- Send to /send_contract.php -->
        <!-- <h4> <a href="send_contract.php">Send Contract to a client</a></h4> -->
        <button onclick="window.location.href='send_contract.php'">Send Contract to a client</button>

        <h2>List of Files</h2>

        <?php
        // Define the directories with their respective file types
        $directories = [
            'unsigned_contracts' => ['label' => 'Unsigned Contracts', 'extension' => 'php'],
            'signed_contracts' => ['label' => 'Signed Contracts', 'extension' => 'html'],
            'signed_contracts_pdf' => ['label' => 'Signed Contracts (PDF)', 'extension' => 'pdf'],
        ];

        // Iterate over each directory and display its contents
        foreach ($directories as $dir => $info) {
            echo "<h3>{$info['label']}</h3>";
            echo "<ul>";

            if (is_dir($dir)) {
                $files = scandir($dir);

                // Display files with the specified extension
                $hasFiles = false;
                foreach ($files as $file) {
                    if (pathinfo($file, PATHINFO_EXTENSION) === $info['extension']) {
                        echo "<li><a href='$dir/$file' target='_blank'>$file</a></li>";
                        $hasFiles = true;
                    }
                }

                if (!$hasFiles) {
                    echo "<li>No {$info['extension']} files found in this directory.</li>";
                }
            } else {
                echo "<li>Directory not found: $dir</li>";
            }

            echo "</ul>";
        }
        ?>
    <?php endif; ?>

</body>

</html>