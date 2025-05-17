<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');
    $userInput = strtolower(trim($_POST['message']));
    
    $responses = [
        "train status" => "Your train is on time. The train will depart at 12:30 PM.",
        "train number" => "Your train number is 12511, Rajdhani Express.",
        "booking status" => "Your ticket is confirmed. Seat Number: 25A, Coach: B1.",
        "cancel ticket" => "Your ticket has been successfully canceled.",
        "hello" => "Hi! How can I assist you today?",
        "default" => "Sorry, I couldn't understand that. Could you please rephrase?"
    ];
    
    $response = $responses[$userInput] ?? $responses['default'];
    echo json_encode(["response" => $response]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask DISHA 2.0 </title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .chat-container { width: 400px; background: #fff; border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); display: flex; flex-direction: column; }
        .chat-box { flex-grow: 1; overflow-y: auto; padding: 15px; border-bottom: 1px solid #e0e0e0; }
        .chat-message { margin: 10px 0; padding: 10px; border-radius: 10px; max-width: 75%; }
        .bot-message { background: #3498db; color: white; align-self: flex-start; }
        .user-message { background: #ecf0f1; color: #333; align-self: flex-end; }
        .input-box { display: flex; padding: 10px; border-top: 1px solid #e0e0e0; background: white; }
        input { flex: 1; padding: 10px; border-radius: 20px; border: 1px solid #ccc; font-size: 16px; }
        button { padding: 10px 15px; background: #3498db; color: white; border: none; border-radius: 25px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-box" id="chatBox">
            <div class="chat-message bot-message"><p>Hi, I'm DISHA 2.0! How can I assist you today?</p></div>
        </div>
        <div class="input-box">
            <input type="text" id="userInput" placeholder="Type your message...">
            <button id="sendBtn">Send</button>
        </div>
    </div>
    
    <script>
    document.getElementById("sendBtn").addEventListener("click", function() {
        var userInput = document.getElementById("userInput").value.trim();
        if (userInput !== "") {
            appendMessage(userInput, "user");
            document.getElementById("userInput").value = "";
            sendToServer(userInput);
        }
    });

    function appendMessage(message, sender) {
        var chatBox = document.getElementById("chatBox");
        var messageDiv = document.createElement("div");
        messageDiv.classList.add("chat-message", sender === "user" ? "user-message" : "bot-message");
        messageDiv.innerHTML = "<p>" + message + "</p>";
        chatBox.appendChild(messageDiv);
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function sendToServer(userMessage) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                appendMessage(response.response, "bot");
            }
        };
        xhr.send("message=" + encodeURIComponent(userMessage));
    }
    </script>
</body>
</html>
