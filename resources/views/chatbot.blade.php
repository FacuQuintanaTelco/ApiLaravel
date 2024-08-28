<!-- resources/views/chatbot.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('/assets/js/jquery-2.1.3.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>

    <title>Chatbot</title>
    <style>

                /*--------------------
                        Body
                --------------------*/
                *,
                *::before,
                *::after {
                box-sizing: border-box;
                }

                html,
                body {
                height: 100%;
                }

                body {
                /* background: linear-gradient(135deg, #044f48, #2a7561); */
                background-size: cover;
                font-family: 'Open Sans', sans-serif;
                font-size: 12px;
                line-height: 1.3;
                overflow: hidden;
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


                /*--------------------
                        Chat
                --------------------*/
                .chat {
                    opacity: 0;
                    backdrop-filter: blur(6px);
                    position: relative;
                    width: 300px;
                    height: 80vh;
                    max-height: 500px;
                    z-index: 2;
                    overflow: hidden;
                    box-shadow: 7px 9px 21px 1px rgba(0,0,0, 0.4);
                    background: rgba(0, 0, 0, .5);
                    border-radius: 20px;
                    display: flex;
                    justify-content: space-between;
                    flex-direction: column;
                    margin-inline: auto;
                }


                /*--------------------
                    Chat Title
                --------------------*/
                .chat-title {
                flex: 0 1 45px;
                position: relative;
                z-index: 2;
                background: rgba(0, 0, 0, 0.2);
                color: #fff;
                text-transform: uppercase;
                text-align: left;
                padding: 10px 10px 10px 50px;
                
                h1, h2 {
                    font-weight: normal;
                    font-size: 10px;
                    margin: 0;
                    padding: 0;
                }
                
                h2 {
                    color: rgba(255, 255, 255, .5);
                    font-size: 8px;
                    letter-spacing: 1px;
                }
                
                .avatar {
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
                    
                    img {
                    width: 100%;
                    height: auto;
                    }
                }
                }


                /*--------------------
                    Messages
                --------------------*/
                .messages {
                flex: 1 1 auto;
                color: rgba(255, 255, 255, .5);
                overflow: hidden;
                position: relative;
                width: 100%;
                
                & .messages-content {
                    position: absolute;
                    top: 0;
                    left: 0;
                    height: 101%;
                    width: 100%;
                }

                
                .message {
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
                    
                    .timestamp {
                    position: absolute;
                    bottom: -15px;
                    font-size: 9px;
                    color: rgba(255, 255, 255, .3);
                    }
                    
                    &::before {
                    content: '';
                    position: absolute;
                    bottom: -6px;
                    border-top: 6px solid rgba(0, 0, 0, .3);
                    left: 0;
                    border-right: 7px solid transparent;
                    }
                    
                    .avatar {
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

                    img {
                        width: 100%;
                        height: auto;
                    }
                    }
                    
                    &.message-personal {
                    float: right;
                    color: #fff;
                    text-align: right;
                    background: linear-gradient(120deg, #248A52, #257287);
                    border-radius: 10px 10px 0 10px;
                    
                    &::before {
                        left: auto;
                        right: 0;
                        border-right: none;
                        border-left: 5px solid transparent;
                        border-top: 4px solid #257287;
                        bottom: -4px;
                    }
                    }
                    
                    &:last-child {
                    margin-bottom: 30px;
                    }
                    
                    &.new {
                    transform: scale(0);
                    transform-origin: 0 0;
                    animation: bounce 500ms linear both;
                    }
                    
                    &.loading {

                    &::before {
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
                        border: none;
                        animation-delay: .15s;
                    }

                    & span {
                        display: block;
                        font-size: 0;
                        width: 20px;
                        height: 10px;
                        position: relative;

                        &::before {
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
                            margin-left: -7px;
                        }   

                        &::after {
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
                            margin-left: 7px;
                            animation-delay: .3s;
                        }
                    }
                    }
                    
                }
            }


            /*--------------------
                Message Box
            --------------------*/
            .message-box {
            flex: 0 1 40px;
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            padding: 10px;
            position: relative;
            }
            .message-box .message-input {
                background: none;
                border: none;
                outline: none!important;
                resize: none;
                color: rgba(255, 255, 255, .7);
                font-size: 11px;
                height: 17px;
                margin: 0;
                padding-right: 20px;
                width: 265px;
            }
            
            textarea:focus:-webkit-placeholder{
                color: transparent;
            }
            
            .message-submit {
                position: absolute;
                z-index: 1;
                top: 9px;
                right: 10px;
                color: #fff;
                border: none;
                background: #248A52;
                font-size: 10px;
                text-transform: uppercase;
                line-height: 1;
                padding: 6px 10px; 
                border-radius: 10px;
                outline: none!important;
                transition: background .2s ease;
            }
            .message-submit:hover {
                background: #1D7745;
            }


            /*--------------------
                Custom Srollbar
            --------------------*/
            .mCSB_scrollTools {
            margin: 1px -3px 1px 0;
            opacity: 0;
            }

            .mCSB_inside > .mCSB_container {
            margin-right: 0px;
            padding: 0 10px;
            }

            .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar {
            background-color: rgba(0, 0, 0, 0.5)!important;
            }


            /*--------------------
                Bounce
            --------------------*/
            @keyframes bounce { 
            0% { transform: matrix3d(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); }
            4.7% { transform: matrix3d(0.45, 0, 0, 0, 0, 0.45, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); }
            9.41% { transform: matrix3d(0.883, 0, 0, 0, 0, 0.883, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); }
            14.11% { transform: matrix3d(1.141, 0, 0, 0, 0, 1.141, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); }
            18.72% { transform: matrix3d(1.212, 0, 0, 0, 0, 1.212, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); }
            24.32% { transform: matrix3d(1.151, 0, 0, 0, 0, 1.151, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); }
            29.93% { transform: matrix3d(1.048, 0, 0, 0, 0, 1.048, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); }
            35.54% { transform: matrix3d(0.979, 0, 0, 0, 0, 0.979, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); }
            41.04% { transform: matrix3d(0.961, 0, 0, 0, 0, 0.961, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); }
            52.15% { transform: matrix3d(0.991, 0, 0, 0, 0, 0.991, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); }
            63.26% { transform: matrix3d(1.007, 0, 0, 0, 0, 1.007, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); }
            85.49% { transform: matrix3d(0.999, 0, 0, 0, 0, 0.999, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); }
            100% { transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); } 
            }


            @keyframes ball { 
            from {
                transform: translateY(0) scaleY(.8);
            }
            to {
                transform: translateY(-10px);
            }
            }
            .burbuja{
                width: 60px;
                height: 60px;
                background-color: #C3D500;
                border-radius: 50%;
                margin-top: 20px;
                margin-left: auto;
                margin-right: 20px;
                transition: all 200ms ease-in-out;
                align-content: center;
            }
            .burbuja:hover{
                box-shadow: 0 0 27px 1.5px rgba(0, 0, 0, .2);
            }
            .burbujaIcon{
                margin-inline: auto;
                display: flex;
                width: 40%;
            }
            .rotate {
                transition: transform 0.5s ease-in-out; 
                transform: rotate(180deg); 
            }
            .rotate2 {
                transition: transform 0.5s ease-in-out; 
                transform: rotate(-180deg); 
            }

    </style>
</head>
<body>
    <div>   
        <div class="chat">
            <div class="chat-title">
                <h1>IA.Pasante</h1>
                <h2>TelCoIA</h2>
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
        <div class="burbuja">
            <img src="{{ asset('/assets/img/burbujamsg.svg') }}" id="burbujaIcon" class="burbujaIcon" alt="Burbuja">
        </div>
    </div>
    <!-- <div class="bg"></div> -->
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function() { 
    var $messages = $('.messages-content'),
    d, h, m,
    i = 0;
    let primerMsg = true;

    $('#burbujaIcon').click(function() {
        if(primerMsg) {
            preCargaMsg();
            primerMsg = false;
        }
        let chatElement = $('.chat');
        let $this = $(this);
        if (chatElement.css('opacity') == 0) {
            $this.addClass('rotate');
            chatElement.animate({ opacity: 1 }, 250, function() {
                $this.attr('src', '{{ asset('/assets/img/burbujamsg2.png') }}');  
                $this.attr('style', 'width: 100%;');
                setTimeout(function() {
                    $this.removeClass('rotate');
                }, 250);
            });
        } else {
            $this.addClass('rotate2');
            chatElement.animate({ opacity: 0 }, 250, function() {
                $this.attr('src', '{{ asset('/assets/img/burbujamsg.svg') }}');
                $this.attr('style', '');
                $this.removeClass('rotate2');
                setTimeout(function() {
                    
                }, 250);
            });
        }
    });




    function preCargaMsg () {
        $messages.mCustomScrollbar();
        setTimeout(function() {
            fakeMessage();
        }, 100);
    };

    function updateScrollbar() {
    $messages.mCustomScrollbar("update").mCustomScrollbar('scrollTo', 'bottom', {
        scrollInertia: 10,
        timeout: 0
    });
    }

    function setDate(){
    d = new Date()
    if (m != d.getMinutes()) {
        m = d.getMinutes();
        $('<div class="timestamp">' + d.getHours() + ':' + m + '</div>').appendTo($('.message:last'));
    }
    }

    function insertMessage() {
    msg = $('.message-input').val();
    if ($.trim(msg) == '') {
        return false;
    }
    $('<div class="message message-personal">' + msg + '</div>').appendTo($('.mCSB_container')).addClass('new');
    setDate();
    $('.message-input').val(null);
    updateScrollbar();
    setTimeout(function() {
        fakeMessage();
    }, 1000 + (Math.random() * 20) * 100);
    }

    $('.message-submit').click(function() {
    insertMessage();
    });

    $(window).on('keydown', function(e) {
    if (e.which == 13) {
        insertMessage();
        return false;
    }
    })

    const Fake = [
    'Hola, soy TELCOIA, ¿y tú?',
    'Encantado de conocerte',
    '¿Cómo estás?',
    'No tan mal, gracias',
    '¿A qué te dedicas?',
    'Eso es genial',
    'TelCo es un buen lugar para estar',
    'Creo que eres una buena persona',
    '¿Por qué piensas eso?',
    '¿Puedes explicar?',
    'De todos modos, ya me tengo que ir',
    'Fue un placer charlar contigo',
    'Es hora de hacer un nuevo proyecto',
    'Adiós',
    ':)'
]


    function fakeMessage() {
    if ($('.message-input').val() != '') {
        return false;
    }
    $('<div class="message loading new"><figure class="avatar"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80.jpg" /></figure><span></span></div>').appendTo($('.mCSB_container'));
    updateScrollbar();

    setTimeout(function() {
        $('.message.loading').remove();
        $('<div class="message new"><figure class="avatar"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80.jpg" /></figure>' + Fake[i] + '</div>').appendTo($('.mCSB_container')).addClass('new');
        setDate();
        updateScrollbar();
        i++;
    }, 1000 + (Math.random() * 20) * 100);

    }
});
</script>
