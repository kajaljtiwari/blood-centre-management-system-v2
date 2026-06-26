<?php phpinfo(); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Replace with your actual secret key
$apiKey = getenv('OPENAI_API_KEY');                                                       

    header('Content-Type: application/json');

    $input = json_decode(file_get_contents('php://input'), true);
    $question = $input['message'];

    // Prepare OpenAI API request
    $data = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'system', 'content' => 'You are a helpful assistant for blood donation queries.'],
            ['role' => 'user', 'content' => $question]
        ],
        'temperature' => 0.7
    ];

    $ch = curl_init('https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo json_encode(['reply' => 'Error contacting OpenAI API.']);
        curl_close($ch);
        exit;
    }

    curl_close($ch);

    $result = json_decode($response, true);
    $reply = $result['choices'][0]['message']['content'];

    echo json_encode(['reply' => $reply]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blood Bank AI Chatbot</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
    .chatbot-container {
        position: fixed;
        bottom: 20px;
        left: 20px;
        width: 300px;
        background: #FFFFFF;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: none;
        z-index: 9999;
    }
    .chat-header {
        background: #e60000;
        color: #fff;
        padding: 10px;
        text-align: center;
        position: relative;
    }
    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 18px;
        cursor: pointer;
        color: white;
    }
    .chat-body {
        padding: 10px;
        height: 250px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .chat-input {
        width: 100%;
        padding: 10px;
        border: none;
        border-top: 1px solid #ddd;
        box-sizing: border-box;
    }
    .chat-icon {
        position: fixed;
        bottom: 90px;
        left: 20px;
        background: #e60000;
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        font-size: 24px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        z-index: 9999;
    }
    .user-message {
        background: #d1ffd6;
        padding: 8px;
        border-radius: 5px;
        align-self: flex-end;
    }
    .bot-message {
        background: #eee;
        padding: 8px;
        border-radius: 5px;
        align-self: flex-start;
    }
    </style>
</head>
<body>

<div class="chat-icon" onclick="toggleChatbot()">💬</div>

<div class="chatbot-container" id="chatbot">
    <div class="chat-header">
        Blood Bank AI Chatbot
        <span class="close-btn" onclick="toggleChatbot()">&times;</span>
    </div>
    <div class="chat-body" id="chat-body">
        <div class="bot-message">Hello! Ask me anything about blood donation.</div>
    </div>
    <input type="text" id="chat-input" class="chat-input" placeholder="Type your question..." onkeypress="handleChat(event)">
</div>

<script>
function toggleChatbot() {
    const bot = document.getElementById("chatbot");
    bot.style.display = (bot.style.display === "block") ? "none" : "block";
}

function handleChat(event) {
    if (event.key === "Enter") {
        const input = document.getElementById("chat-input");
        const message = input.value.trim();
        if (message === "") return;

        const chatBody = document.getElementById("chat-body");
        chatBody.innerHTML += `<div class="user-message">${message}</div>`;
        input.value = "";

        fetch("bloodbank2/chatbot2.php", {
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({message: message})
        })
        .then(res => res.json())
        .then(data => {
            chatBody.innerHTML += `<div class="bot-message">${data.reply}</div>`;
            chatBody.scrollTop = chatBody.scrollHeight;
        })
        .catch(err => {
            chatBody.innerHTML += `<div class="bot-message">Error: Could not connect to AI.</div>`;
        });
    }
}
</script>

</body>
</html>
