<!-- Chatbot Button -->
<div class="chat-icon" onclick="toggleChatbot()">💬</div>

<!-- Chatbot UI -->
<div class="chatbot-container" id="chatbot">
    <div class="chat-header">
        Blood Bank Chatbot
        <span class="close-btn" onclick="toggleChatbot()">&times;</span>
    </div>
    <div class="chat-body" id="chat-body">
        <div class="bot-message">Hi! Ask me about blood donation.</div>
    </div>
    <input type="text" id="chat-input" class="chat-input" placeholder="Type your question..." onkeypress="handleChat(event)">
</div>

<!-- Chatbot Styles -->
<style>
.chatbot-container {
    position: fixed;
    bottom: 20px;
    left: 20px;
    width: 300px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    display: none;
    z-index: 9999;
    flex-direction: column;
}
.chat-header {
    background: #e60000;
    color: #fff;
    padding: 10px;
    text-align: center;
    position: relative;
    font-weight: bold;
}
.close-btn {
    position: absolute;
    top: 10px;
    right: 12px;
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
    font-size: 14px;
}
.chat-input {
    width: 100%;
    padding: 10px;
    border: none;
    border-top: 1px solid #ddd;
    box-sizing: border-box;
    font-size: 14px;
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
    max-width: 80%;
}
.bot-message {
    background: #eee;
    padding: 8px;
    border-radius: 5px;
    align-self: flex-start;
    max-width: 80%;
}
</style>

<!-- Chatbot Script -->
<script>
function toggleChatbot() {
    const bot = document.getElementById("chatbot");
    bot.style.display = (bot.style.display === "flex") ? "none" : "flex";
}

function handleChat(event) {
    if (event.key === "Enter") {
        const input = document.getElementById("chat-input");
        const message = input.value.trim();
        if (message === "") return;

        const chatBody = document.getElementById("chat-body");
        chatBody.innerHTML += `<div class="user-message">${message}</div>`;
        input.value = "";

        fetch("chatbot-response.php", {
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: "message=" + encodeURIComponent(message)
        })
        .then(res => res.text())
        .then(reply => {
            chatBody.innerHTML += `<div class="bot-message">${reply}</div>`;
            chatBody.scrollTop = chatBody.scrollHeight;
        });
    }
}
</script>
