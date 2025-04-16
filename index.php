<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="canonical" href="https://discord-stealer.de" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discord Webhook Protector</title>
    <meta property="og:title" content="Discord Webhook Protector">
    <meta property="og:description" content="This is a backend Discord webhook protector that prevents spamming and deletion by forwarding all content to your real webhook securely.">
    <meta property="og:image" content="https://cdn-icons-png.flaticon.com/128/2592/2592258.png">
    <meta name="theme-color" content="#6A5ACD">
    <meta property="og:site_name" content="Tg:t.me/Webhook_protect">
    <meta property="og:url" content="https://dcwh.my/">
    <meta property="og:type" content="website">
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/128/2592/2592258.png">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #1E1F29, #0B0E14);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
            overflow: hidden;
        }

        .top-box {
            background: rgba(106, 90, 205, 0.2);
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 1.1rem;
            color: #6A5ACD;
            border: 1px solid rgba(106, 90, 205, 0.3);
            transition: all 0.3s ease;
            cursor: default; 
        }

        .top-box:hover {
            background: rgba(106, 90, 205, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 90, 205, 0.4);
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
            animation: fadeIn 1.5s ease-in-out;
        }

        .header h1 {
            font-size: 2.5rem;
            color: #6A5ACD;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 10px rgba(106, 90, 205, 0.5);
        }

        .header p {
            color: #B9BBBE;
            font-size: 1rem;
        }

        .container {
            background: rgba(30, 31, 41, 0.8);
            padding: 2rem;
            border-radius: 20px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            text-align: center;
            animation: slideUp 1s ease-in-out;
            border: 1px solid rgba(106, 90, 205, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(106, 90, 205, 0.4);
        }

        .container h2 {
            color: #6A5ACD;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-shadow: 0 0 10px rgba(106, 90, 205, 0.5);
        }

        form {
            width: 100%;
        }

        label {
            color: #B9BBBE;
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            text-align: left;
        }

        input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(106, 90, 205, 0.3);
            border-radius: 10px;
            color: #FFFFFF;
            margin-bottom: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #6A5ACD;
            box-shadow: 0 0 0 3px rgba(106, 90, 205, 0.25);
        }

        .button {
            width: 100%;
            padding: 0.75rem;
            background: #6A5ACD;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 0.5rem;
        }

        .button:hover {
            background: #7B68EE;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 90, 205, 0.4);
        }

        .button:active {
            transform: translateY(0);
        }

        .copy-btn {
            width: 100%;
            padding: 0.75rem;
            background: #6A5ACD;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 0.5rem;
        }

        .copy-btn:hover {
            background: #7B68EE;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 90, 205, 0.4);
        }

        .copy-btn:active {
            transform: translateY(0);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .footer-link {
            margin-top: 2rem;
            text-align: center;
        }

.footer-link a {
    color: #6A5ACD;
    text-decoration: none;
    font-size: 1rem;
    transition: color 0.3s;
}

.footer-link a:hover {
    color: #7B68EE;
}

.top-box a {
    color: #f005d4; 
    text-decoration: none;
    transition: color 0.3s;
}

.top-box a:hover {
    color: #730366; 
}

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: rgba(30, 31, 41, 0.9);
            margin: auto;
            padding: 2rem;
            border-radius: 20px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            text-align: center;
            animation: slideUp 0.5s ease-in-out;
            border: 1px solid rgba(106, 90, 205, 0.2);
        }

        .modal-content h2 {
            color: #6A5ACD;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-shadow: 0 0 10px rgba(106, 90, 205, 0.5);
        }

        .modal-content p {
            color: #B9BBBE;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .modal-content .button {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="top-box">
        You can buy the source code for $35. <a href="/contact">Contact Me</a>
    </div>

    <div id="termsModal" class="modal">
        <div class="modal-content">
            <h2>Terms and Conditions</h2>
            <p>
                By using this service, you agree to the following terms and conditions:
                <br><br>
                1. You must not use this service for any illegal activities.
                <br>
                2. You are responsible for the content you send through the webhook.
                <br>
                3. We reserve the right to block any user who violates these terms.
                <br><br>
                Please read the full terms and conditions before proceeding.
            </p>
            <button id="acceptTerms" class="button">Accept</button>
        </div>
    </div>

    <div class="header">
        <h1>Discord Webhook Protector</h1>
        <p>Protect your webhooks from spam and deletion.</p>
    </div>

    <div class="container">
        <h2>Protect Your Webhook</h2>
        <form id="webhook-form">
            <label for="webhook">Enter Discord Webhook URL:</label>
            <input type="text" id="webhook" name="webhook" placeholder="https://discord.com/api/webhooks/..." required>
            <button type="submit" class="button">Protect Webhook</button>
        </form>
        <div id="copy-btn-container"></div>
    </div>

    <div class="footer-link">
      <a href="/contact">Contact Me</a> | <a href="/donate">Donate</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('termsModal');
            const acceptButton = document.getElementById('acceptTerms');

            if (!localStorage.getItem('termsAccepted')) {
                modal.style.display = 'flex';
            }

            acceptButton.addEventListener('click', function() {
                localStorage.setItem('termsAccepted', 'true');
                modal.style.display = 'none';
            });
        });
    </script>
    <script src="script.js"></script>
</body>
</html>
