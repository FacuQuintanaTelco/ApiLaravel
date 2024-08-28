<!-- resources/views/chatbot.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.min.css">
    <title>Chatbot</title>
    <style>
        /* Definir los mixins */
        .center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .ball {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            content: '';
            display: block;
            width: 3px;
            height: 3px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .5);
            z-index: 2;
            margin-top: 4px;
            animation: ball .45s cubic-bezier(0, 0, 0.15, 1) alternate infinite;
        }

        /* Estilos del CodePen */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            height: 100%;
            background: linear-gradient(135deg, #044f48, #2a7561);
            background-size: cover;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        .bg {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            background: url('https://images.unsplash.com/photo-1451186859696-371d9477be93?crop=entropy&fit=crop&fm=jpg&h=975&ixjsv=2.1.0&ixlib=rb-0.3.5&q=80&w=1925') no-repeat 0 0;
            filter: blur(80px);
            transform: scale(1.2);
        }

        .chat {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 80vh;
            max-height: 500px;
            z-index: 2;
            overflow: hidden;
            box-shadow: 0 5px 30px rgba(0, 0, 0, .2);
            background: rgba(0, 0, 0, .5);
            border-radius: 20px;
            display: flex;
            justify-content: space-between;
            flex-direction: column;
        }

        .chat-title {
            flex: 0 1 45px;
            position: relative;
            z-index: 2;
            background: rgba(0, 0, 0, 0.2);
            color: #fff;
            text-transform: uppercase;
            text-align: left;
            padding: 10px 10px 10px 50px;
        }

        .chat-title h1, .chat-title h2 {
            font-weight: normal;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }

        .chat-title h2 {
            color: rgba(255, 255, 255, .5);
            font-size: 8px;
            letter-spacing: 1px;
        }

        .chat-title .avatar {
            position: absolute;
            z-index: 1;
            top: 8px;
            left: 9px;
            border-radius: 30px;
            width: 30px;
            height: 30px;
            overflow: hidden;
            margin: 0;
            padding: 0;
            border: 2px solid rgba(255, 255, 255, 0.24);
        }

        .chat-title .avatar img {
            width: 100%;
            height: auto;
        }

        .messages {
            flex: 1 1 auto;
            color: rgba(255, 255, 255, .5);
            overflow: hidden;
            position: relative;
            width: 100%;
        }

        .messages .messages-content {
            position: absolute;
            top: 0;
            left: 0;
            height: 101%;
            width: 100%;
        }

        .messages .message {
            clear: both;
            float: left;
            padding: 6px 10px 7px;
            border-radius: 10px 10px 10px 0;
            background: rgba(0, 0, 0, .3);
            margin: 8px 0;
            font-size: 11px;
            line-height: 1.4;
            margin-left: 35px;
            position: relative;
            text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
        }

        .messages .message .timestamp {
            position: absolute;
            bottom: -15px;
            font-size: 9px;
            color: rgba(255, 255, 255, .3);
        }

        .messages .message::before {
            content: '';
            position: absolute;
            bottom: -6px;
            border-top: 6px solid rgba(0, 0, 0, .3);
            left: 0;
            border-right: 7px solid transparent;
        }

        .messages .message .avatar {
            position: absolute;
            z-index: 1;
            bottom: -15px;
            left: -35px;
            border-radius: 30px;
            width: 30px;
            height: 30px;
            overflow: hidden;
            margin: 0;
            padding: 0;
            border: 2px solid rgba(255, 255, 255, 0.24);
        }

        .messages .message .avatar img {
            width: 100%;
            height: auto;
        }

        .messages .message.message-personal {
            float: right;
            color: #fff;
            text-align: right;
            background: linear-gradient(120deg, #248A52, #257287);
            border-radius: 10px 10px 0 10px;
        }

        .messages .message.message-personal::before {
            left: auto;
            right: 0;
            border-right: none;
            border-left: 5px solid transparent;
            border-top: 4px solid #257287;
            bottom: -4px;
        }

        .messages .message:last-child {
            margin-bottom: 30px;
        }

        .messages .message.new {
            transform: scale(0);
            transform-origin: 0 0;
            animation: bounce 500ms linear both;
        }
    </style>
</head>
<body>
    <div class="chat">
        <div class="chat-title">
            <h1>Fabio Ottaviani</h1>
            <h2>Supah</h2>
            <figure class="avatar">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80.jpg" />
            </figure>
        </div>
        <div class="messages">
            <div class="messages-content"></div>
        </div>
        <div class="message-box">
            <textarea type="text" class="message-input" placeholder="Type message..."></textarea>
            <button type="submit" class="message-submit">Send</button>
        </div>
    </div>
    <div class="bg"></div>
</body>
</html>
