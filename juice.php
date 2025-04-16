<?php
session_start();

// shitty ass dualhook panel for discord webhook
// password (change it if you use this)
$adminPassword = '#MontanaBlack123!';
$updateDelay = 2;

if (!isset($_SESSION['lastUpdateTime'])) {
    $_SESSION['lastUpdateTime'] = time();
}

$currentWebhookURL = '';
if (file_exists('config.php')) {
    $config = include('config.php');
    $currentWebhookURL = $config['webhookURL'] ?? '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password'])) {
        if ($_POST['password'] === $adminPassword) {
            $_SESSION['loggedin'] = true;
        } else {
            echo "<div class='error'>Incorrect password!</div>";
        }
    } elseif (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        if (isset($_POST['newWebhookURL'])) {
            $newWebhookURL = trim($_POST['newWebhookURL']); // Trim whitespace
            $currentTime = time();

            if (!filter_var($newWebhookURL, FILTER_VALIDATE_URL)) {
                echo "<div class='error'>Invalid URL format.</div>";
            } elseif (!preg_match('/^https:\/\/discord\.com\/api\/webhooks\/\d+\/[a-zA-Z0-9_-]+$/', $newWebhookURL)) {
                echo "<div class='error'>Invalid Discord webhook URL.</div>";
            } elseif (($currentTime - $_SESSION['lastUpdateTime']) < $updateDelay) {
                echo "<div class='error'>You must wait a bit before updating the webhook URL again.</div>";
            } else {
                $configContent = "<?php\nreturn [\n    'webhookURL' => '$newWebhookURL'\n];\n";
                if (file_put_contents('config.php', $configContent) !== false) {
                    $_SESSION['lastUpdateTime'] = $currentTime;
                    $currentWebhookURL = $newWebhookURL;
                    echo "<div class='success'>Webhook URL updated successfully!</div>";
                } else {
                    echo "<div class='error'>Failed to update the webhook URL. Please check file permissions.</div>";
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #1e1e1e;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            width: 600px;
            text-align: center;
        }
        .container h2 {
            margin-bottom: 25px;
            font-size: 28px;
            color: #ffffff;
        }
        .container label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 18px;
            color: #ffffff;
        }
        .container input[type="password"], .container input[type="text"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 2px solid #333;
            border-radius: 8px;
            font-size: 16px;
            background-color: #333;
            color: #ffffff;
        }
        .container input[type="password"]:focus, .container input[type="text"]:focus {
            border-color: #28a745;
            outline: none;
        }
        .container button {
            width: 100%;
            padding: 15px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .container button:hover {
            background-color: #218838;
        }
        .error {
            color: #ff4444;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .success {
            color: #28a745;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .current-url {
            font-size: 18px;
            margin-bottom: 20px;
            color: #ffffff;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: pre-wrap;
        }
        .current-url strong {
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            echo '
            <h2>Admin Login</h2>
            <form method="post">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                <button type="submit">Login</button>
            </form>';
        } else {
            echo '
            <h2>Webhook URL Management</h2>
            <p class="current-url">Current Webhook URL: <strong>' . htmlspecialchars($currentWebhookURL) . '</strong></p>
            <form method="post">
                <label for="newWebhookURL">New Webhook URL:</label>
                <input type="text" name="newWebhookURL" id="newWebhookURL" required>
                <button type="submit">Update</button>
            </form>';
        }
        ?>
    </div>
</body>
</html>
