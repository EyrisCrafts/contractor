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