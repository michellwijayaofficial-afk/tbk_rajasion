<!DOCTYPE html>
<html lang="zxx">

<style>
.footer-area {
    background-color: #114225;
    color: #ffffff !important;
}
.footer-item h5,
.footer-item p {
    color: #ffffff !important;
}


footer.footer-area {
    background-color: #114225 !important;
    padding: 18px !important; 
}

/* RATA TENGAH SECARA VERTIKAL */
footer.footer-area .row {
    display: flex;
    align-items: center;
    
}
footer.footer-area .footer-item {
    margin-bottom: 20px;
}

footer.footer-area .footer-item h5 {
    color: #FFFF !important;
    font-weight: 600;
    margin-bottom: 10px;
}

footer.footer-area .footer-item p {
    color: #ffffff !important;
    font-size: 14px;
    line-height: 22px;
    margin: 0;
}

footer.footer-area .footer-bottom {
    color: #ffffff !important;
    text-align: center;
    font-size: 13px;
    margin-top: 30px;
    padding-top: 15px;
    border-top: 1px solid rgba(255,255,255,0.3);
}

</style>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | TBK RajaSion</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('/template/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/css/elegant-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/css/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

    <script src="{{ asset('/template/js/jquery-3.3.1.min.js') }}"></script>
</head>

<body>

    @include('partials.header_shop')

    @yield('content')

    {{-- SATU-SATUNYA FOOTER --}}
    @include('layouts.footer')

    {{-- SCRIPTS (TIDAK DIUBAH) --}}
    <script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/template/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/template/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('/template/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/template/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('/template/js/main.js') }}"></script>

    <!-- AI Chatbot -->
    <div id="chatbot" class="chatbot-container">
        <div class="chatbot-header">
            <span>🤖 AI Assistant</span>
            <button id="chatbot-toggle" class="chatbot-toggle-btn">−</button>
        </div>
        <div class="chatbot-body">
            <div id="chatbot-messages" class="chatbot-messages">
                <div class="message bot-message">
                    Hello! I'm your AI assistant. How can I help you today?
                </div>
            </div>
            <div class="chatbot-input-container">
                <input type="text" id="chatbot-input" placeholder="Type your message..." maxlength="1000">
                <button id="chatbot-send">Send</button>
            </div>
        </div>
    </div>

    <style>
        .chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 350px;
            height: 500px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.2);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            font-family: 'Cairo', sans-serif;
            transition: all 0.3s ease;
        }

        .chatbot-container.minimized {
            height: 60px;
        }

        .chatbot-header {
            background: linear-gradient(135deg, #0d5f0d 0%, #1a7a1a 50%, #0d5f0d 100%);
            color: white;
            padding: 15px;
            border-radius: 12px 12px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
        }

        .chatbot-toggle-btn {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            padding: 0;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }

        .chatbot-toggle-btn:hover {
            background: rgba(255,255,255,0.2);
        }

        .chatbot-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .chatbot-container.minimized .chatbot-body {
            display: none;
        }

        .chatbot-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background: #f9f9f9;
        }

        .message {
            margin-bottom: 15px;
            padding: 10px 15px;
            border-radius: 18px;
            max-width: 80%;
            word-wrap: break-word;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .bot-message {
            background: #e3f2fd;
            color: #1565c0;
            align-self: flex-start;
            border-bottom-left-radius: 4px;
        }

        .user-message {
            background: linear-gradient(135deg, #0d5f0d 0%, #1a7a1a 100%);
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 4px;
            margin-left: auto;
        }

        .chatbot-input-container {
            padding: 15px;
            border-top: 1px solid #e0e0e0;
            display: flex;
            gap: 10px;
            background: white;
        }

        #chatbot-input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 25px;
            outline: none;
            font-family: 'Cairo', sans-serif;
            font-size: 14px;
        }

        #chatbot-input:focus {
            border-color: #0d5f0d;
            box-shadow: 0 0 0 2px rgba(13, 95, 13, 0.2);
        }

        #chatbot-send {
            background: linear-gradient(135deg, #0d5f0d 0%, #1a7a1a 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        #chatbot-send:hover {
            background: linear-gradient(135deg, #0a4a0a 0%, #156515 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(13, 95, 13, 0.3);
        }

        #chatbot-send:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .typing-indicator {
            display: none;
            padding: 10px 15px;
            background: #e3f2fd;
            border-radius: 18px;
            border-bottom-left-radius: 4px;
            max-width: 80px;
        }

        .typing-indicator.active {
            display: block;
        }

        .typing-indicator span {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #1565c0;
            margin: 0 2px;
            animation: typing 1.4s infinite;
        }

        .typing-indicator span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-indicator span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-10px); }
        }

        @media (max-width: 768px) {
            .chatbot-container {
                width: 300px;
                height: 450px;
                right: 10px;
                bottom: 10px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatbotContainer = document.getElementById('chatbot');
            const chatbotToggle = document.getElementById('chatbot-toggle');
            const chatbotInput = document.getElementById('chatbot-input');
            const chatbotSend = document.getElementById('chatbot-send');
            const chatbotMessages = document.getElementById('chatbot-messages');
            
            let isMinimized = false;

            // Toggle chatbot minimize/maximize
            chatbotToggle.addEventListener('click', function() {
                isMinimized = !isMinimized;
                chatbotContainer.classList.toggle('minimized');
                chatbotToggle.textContent = isMinimized ? '+' : '−';
                
                if (!isMinimized) {
                    chatbotInput.focus();
                }
            });

            // Add message to chat
            function addMessage(content, isUser = false) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${isUser ? 'user-message' : 'bot-message'}`;
                messageDiv.textContent = content;
                chatbotMessages.appendChild(messageDiv);
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
            }

            // Show typing indicator
            function showTypingIndicator() {
                const typingDiv = document.createElement('div');
                typingDiv.className = 'typing-indicator active';
                typingDiv.innerHTML = '<span></span><span></span><span></span>';
                chatbotMessages.appendChild(typingDiv);
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
                return typingDiv;
            }

            // Hide typing indicator
            function hideTypingIndicator(typingDiv) {
                if (typingDiv && typingDiv.parentNode) {
                    typingDiv.parentNode.removeChild(typingDiv);
                }
            }

            // Send message to API
            async function sendMessage(message) {
                try {
                    const response = await fetch('/api/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            message: message
                        })
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();
                    
                    if (data.error) {
                        addMessage('Sorry, I encountered an error. Please try again.', false);
                    } else {
                        addMessage(data.message, false);
                    }
                } catch (error) {
                    console.error('Chatbot error:', error);
                    addMessage('Sorry, I\'m having trouble connecting. Please check your internet connection and try again.', false);
                }
            }

            // Handle send button click
            chatbotSend.addEventListener('click', function() {
                const message = chatbotInput.value.trim();
                if (message) {
                    addMessage(message, true);
                    chatbotInput.value = '';
                    chatbotSend.disabled = true;
                    
                    const typingIndicator = showTypingIndicator();
                    
                    sendMessage(message).finally(() => {
                        hideTypingIndicator(typingIndicator);
                        chatbotSend.disabled = false;
                        chatbotInput.focus();
                    });
                }
            });

            // Handle Enter key press
            chatbotInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    chatbotSend.click();
                }
            });

            // Auto-focus input when chatbot is opened
            if (!isMinimized) {
                chatbotInput.focus();
            }
        });
    </script>

</body>
</html>