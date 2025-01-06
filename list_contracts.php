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

    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        padding: 20px;
        background-color: #f9f9f9;
    }

    h2,
    h3 {
        color: #333;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    li:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    a {
        text-decoration: none;
        color: #007bff;
    }

    a:hover {
        text-decoration: underline;
    }

    .file-name {
    flex: 1; /* Allow the name to take available space */
    white-space: nowrap; /* Prevent text wrapping */
    overflow: hidden; /* Hide overflowing text */
    text-overflow: ellipsis; /* Show ellipsis for overflow */
    margin-right: 10px; /* Add space between the name and button */
}

    .open-button {
        padding: 5px 15px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    .open-button:hover {
        background-color: #0056b3;
    }

    .file-list {
        max-width: 600px;
        margin: 0 auto;
    }

    .search-container {
        margin-bottom: 20px;
    }

    .search-input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
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
        <button onclick="window.location.href='/'">Back to main page</button>

        <h2>List of client contracts</h2>
        <div class="file-list">
            <!-- Search Input -->
            <div class="search-container">
                <input
                    type="text"
                    id="file-search"
                    class="search-input"
                    placeholder="Search files by client name..."
                    onkeyup="filterFiles()" />
            </div>
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

                    // Sort files by the most recently modified
                    $filesWithTimestamps = [];
                    foreach ($files as $file) {
                        $filePath = $dir . DIRECTORY_SEPARATOR . $file;
                        if (is_file($filePath) && pathinfo($filePath, PATHINFO_EXTENSION) === $info['extension']) {
                            $filesWithTimestamps[$file] = filemtime($filePath);
                        }
                    }

                    // Sort the array by timestamps in descending order
                    arsort($filesWithTimestamps);

                    // Display files with the specified extension
                    $hasFiles = false;
                    foreach ($filesWithTimestamps as $file => $timestamp) {
                        echo "<li class='file-item'>
                                <span class='file-name'>$file</span>
                                <a href='$dir/$file' target='_blank'>
                                    <button class='open-button'>Open</button>
                                </a>
                            </li>";
                        $hasFiles = true;
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
        </div>
    <?php endif; ?>

</body>
<script>
    function filterFiles() {
        console.log('Filtering files...');
        const searchInput = document.getElementById('file-search').value.toLowerCase();
        const fileItems = document.querySelectorAll('.file-item');

        fileItems.forEach((item) => {
            const fileName = item.querySelector('.file-name').textContent.toLowerCase();
            if (fileName.includes(searchInput)) {
                item.style.display = 'flex'; // Show item
            } else {
                item.style.display = 'none'; // Hide item
            }
        });
    }
</script>

</html>