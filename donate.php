<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate Litecoin (LTC)</title>
    <style>
        /* Modern color scheme and font */
        :root {
            --primary-color: #6c5ce7;
            --secondary-color: #a29bfe;
            --background-color: #f4f4f9;
            --text-color: #2d3436;
            --success-color: #00b894;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            text-align: center;
            padding: 50px;
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: var(--primary-color);
            font-weight: 700;
        }

        p {
            font-size: 1.1em;
            margin-bottom: 30px;
            color: var(--text-color);
            line-height: 1.6;
        }

        .wallet-address {
            font-size: 1.2em;
            margin: 20px auto;
            padding: 15px 25px;
            background-color: #fff;
            border: 2px solid var(--primary-color);
            border-radius: 12px;
            display: inline-block;
            cursor: pointer;
            transition: all 0.3s ease;
            max-width: 90%;
            word-wrap: break-word;
        }

        .wallet-address:hover {
            background-color: var(--primary-color);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(108, 92, 231, 0.2);
        }

        .wallet-address.copied {
            background-color: var(--success-color);
            border-color: var(--success-color);
            color: #fff;
        }

        .qr-code {
            margin-top: 30px;
        }

        .qr-code img {
            border: 2px solid var(--primary-color);
            border-radius: 12px;
            padding: 10px;
            background-color: #fff;
            transition: transform 0.3s ease;
        }

        .qr-code img:hover {
            transform: scale(1.05);
        }

        .thank-you {
            margin-top: 30px;
            font-size: 1.1em;
            color: var(--text-color);
            opacity: 0.8;
        }

        /* Modern button styling */
        .wallet-address strong {
            font-weight: 600;
        }

        /* Add some spacing and responsiveness */
        @media (max-width: 600px) {
            body {
                padding: 20px;
            }

            h1 {
                font-size: 2em;
            }

            .wallet-address {
                font-size: 1em;
                padding: 10px 20px;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <h1>Donate Litecoin (LTC)</h1>
    <p>If you find my work valuable, consider supporting me with a Litecoin donation.</p>

    <div class="wallet-address" id="wallet-address" onclick="copyToClipboard()">
        <strong>LTC Wallet Address:</strong> <span id="ltc-address">LPx3wMuTcuKZDm9rvUokgYuTayjNKcg1Di</span>
    </div>

    <div class="qr-code">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=LTC:LPx3wMuTcuKZDm9rvUokgYuTayjNKcg1Di" alt="LTC Donation QR Code">
    </div>

    <p class="thank-you">Thank you for your support!</p>

    <script>
        function copyToClipboard() {
            const ltcAddress = document.getElementById('ltc-address').innerText;

            navigator.clipboard.writeText(ltcAddress)
                .then(() => {
                    const walletAddressDiv = document.getElementById('wallet-address');
                    walletAddressDiv.classList.add('copied');
                    walletAddressDiv.innerHTML = `<strong>LTC Wallet Address:</strong> <span id="ltc-address">${ltcAddress}</span> <span style="color: #fff;">✔ Copied!</span>`;

                    setTimeout(() => {
                        walletAddressDiv.classList.remove('copied');
                        walletAddressDiv.innerHTML = `<strong>LTC Wallet Address:</strong> <span id="ltc-address">${ltcAddress}</span>`;
                    }, 2000);
                })
                .catch((err) => {
                    console.error('Failed to copy address: ', err);
                });
        }
    </script>

</body>
</html>