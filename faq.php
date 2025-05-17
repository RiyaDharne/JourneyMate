<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "train_db";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch FAQs from database
$faqData = [];
$sql = "SELECT * FROM faq";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $faqData[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .faq-container {
            width: 90%;
            max-width: 500px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .faq-header {
            background-color: #0078d7;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 22px;
            font-weight: bold;
            border-radius: 8px 8px 0 0;
        }

        .faq-item {
            margin-top: 10px;
        }

        .faq-question {
            width: 100%;
            padding: 15px;
            background-color: #0078d7;
            color: white;
            text-align: left;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .faq-question:hover {
            background-color: #005bb5;
        }

        .faq-answer {
            display: none;
            padding: 10px;
            background-color: #f1f1f1;
            border-radius: 5px;
            margin-top: 5px;
        }

        /* Expand animation */
        @keyframes expand {
            0% { max-height: 0; opacity: 0; }
            100% { max-height: 200px; opacity: 1; }
        }

        .faq-answer.expanded {
            animation: expand 0.5s ease-out forwards;
        }

        /* Collapse animation */
        @keyframes collapse {
            0% { max-height: 200px; opacity: 1; }
            100% { max-height: 0; opacity: 0; }
        }

        .faq-answer.collapsed {
            animation: collapse 0.5s ease-out forwards;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.faq-question').forEach(button => {
                button.addEventListener('click', function () {
                    const answer = this.nextElementSibling;

                    if (answer.style.display === 'block') {
                        answer.classList.remove('expanded');
                        answer.classList.add('collapsed');
                        setTimeout(() => answer.style.display = 'none', 500);
                    } else {
                        answer.style.display = 'block';
                        answer.classList.remove('collapsed');
                        answer.classList.add('expanded');
                    }
                });
            });
        });
    </script>
</head>
<body>

    <div class="faq-container">
        <div class="faq-header">Frequently Asked Questions (FAQ)</div>

        <?php foreach ($faqData as $faq): ?>
            <div class="faq-item">
                <button class="faq-question"><?= htmlspecialchars($faq['question']); ?></button>
                <div class="faq-answer">
                    <p><?= htmlspecialchars($faq['answer']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

</body>
</html>
