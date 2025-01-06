<?php
session_start();
require 'variables.php';
// Handle PIN login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pin'])) {
    $entered_pin = $_POST['pin'];
    if ($entered_pin === $correct_pin) {
        $_SESSION['authenticated'] = true;
        // Redirect to the home page
        header('Location: /');
        exit;
    } else {
        echo "<script>alert('Incorrect PIN');</script>";
    }
}

// Redirect if not logged in
if (empty($_SESSION['authenticated'])) {

    echo <<<HTML
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
    <p>Please enter your PIN:</p>
        <input name="pin" required>
        <button type="submit" name="pin_login">Login</button>
    </form>
</body>

</html>
HTML;
exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contracts Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background: #ffffff;
            border-radius: 10px;
            padding: 20px 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2rem;
            color: #333333;
            margin-bottom: 30px;
        }

        .button {
            display: inline-block;
            margin: 10px 5px;
            padding: 10px 20px;
            font-size: 1rem;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Contracts Manager</h1>
        <a href="/send_contract.php" class="button">Send Contract</a>
        <a href="/list_contracts.php" class="button">Client Contracts</a>
        <a href="/my_contracts.php" class="button">My Contracts</a>
    </div>
</body>

</html>