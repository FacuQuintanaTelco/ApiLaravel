const divPrincipal = document.getElementById("chatbotTelCo");
if(!divPrincipal) console.error("No se encontro el div principal");
divPrincipal.innerHTML = `
    <div class="chat">
        <div class="chat-title">
            <h1>IA.Pasante</h1>
            <h2>TelCoIA</h2>
            <figure class="avatar">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80.jpg" />
            </figure>
        </div>
        <div class="messages" id="messages-content">
            <div class="messages-content" ></div>
        </div>
        <div class="message-box">
            <textarea type="text" class="message-input" placeholder="Type message..."></textarea>
            <button type="submit" class="message-submit">Send</button>
        </div>
    </div>
    <div class="burbuja">
        <img src="" id="burbujaIcon" class="burbujaIcon" alt="Burbuja">
    </div>    
`;

const burbujaIconSVG1 = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18"><rect id="backgroundrect" width="100%" height="100%" x="0" y="0" fill="none" stroke="none"/><defs><style>.a{fill:none;}.b{fill:#4e8cff;}.c{clip-path:url(#a);}.d{fill:#fff;}.e{fill:#eff4f9;}</style><clipPath id="a"><path class="a" d="M 0 0 H 17.555 v 17.555 H 0 Z" id="svg_1" transform=""/></clipPath></defs><g class="currentLayer" style=""><title>Layer 1</title><g id="svg_2" class="selected" transform=""><g id="svg_3" transform=""><g class="c" id="svg_4" transform=""><g id="svg_5" transform=""><path class="d" d="M 17.556 8.77842 a 8.778 8.778 0 0 0 -8.778 -8.778 a 8.778 8.778 0 0 0 -8.778 8.778 a 8.745 8.745 0 0 0 2.26 5.879 v 1.442 c 0 0.8 0.492 1.457 1.1 1.457 h 5.83 a 0.843 0.843 0 0 0 0.183 -0.02 a 8.778 8.778 0 0 0 8.184 -8.757" id="svg_6" transform=""/></g><g id="svg_7" transform=""><path class="e" d="M 3.16148 8.921 a 9.292 9.292 0 0 1 6.38 -8.888 c -0.252 -0.022 -0.506 -0.033 -0.763 -0.033 a 8.774 8.774 0 0 0 -8.778 8.778 A 9.508 9.508 0 0 0 2.22447 14.7003 c 0.005 0 0 0.009 0 0.01 c -0.311 0.352 -1.924 2.849 0.021 2.849 h 2.25 c -1.23 -0.022 1.263 -2.107 0.269 -3.494 a 8.225 8.225 0 0 1 -1.6 -5.141" id="svg_8" transform=""/></g></g></g></g></g></svg>';
const burbujaIconSVG1Escaped = encodeURIComponent(burbujaIconSVG1);
const burbujaIconSVG1DataUri = `data:image/svg+xml;charset=utf-8,${burbujaIconSVG1Escaped}`;
const burbujaIcon = document.getElementById("burbujaIcon");
burbujaIcon.src = burbujaIconSVG1DataUri;

const burbujaIconSVG2 = '<?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools --><svg fill="#000000" width="800px" height="800px" viewBox="0 0 256 256" id="Flat" xmlns="http://www.w3.org/2000/svg"><path d="M202.82861,197.17188a3.99991,3.99991,0,1,1-5.65722,5.65624L128,133.65723,58.82861,202.82812a3.99991,3.99991,0,0,1-5.65722-5.65624L122.343,128,53.17139,58.82812a3.99991,3.99991,0,0,1,5.65722-5.65624L128,122.34277l69.17139-69.17089a3.99991,3.99991,0,0,1,5.65722,5.65624L133.657,128Z"/></svg>';
const burbujaIconSVG2Escaped = encodeURIComponent(burbujaIconSVG2);
const burbujaIconSVG2DataUri = `data:image/svg+xml;charset=utf-8,${burbujaIconSVG2Escaped}`;



document.addEventListener("DOMContentLoaded", () => {
const messages = document.getElementById('messages-content');
let d, h, m;
let i = 0;
let primerMsg = true;
const messageInput = document.querySelector('.message-input');
const messageSubmit = document.querySelector('.message-submit');

burbujaIcon.addEventListener('click', async function() {
    if (primerMsg) {
        chat('Saluda al usuario. SOLO EL RESULTADO, NINGUN TEXTO MAS.');            
        primerMsg = false;
    }

    const chatElement = document.querySelector('.chat');
    const chatElementDisplay = window.getComputedStyle(chatElement).display;

    if (chatElementDisplay === 'none') {
        burbujaIcon.src = burbujaIconSVG2DataUri;
        burbujaIcon.classList.add('rotate');
        chatElement.style.display = 'flex';
        setTimeout(function() {
            burbujaIcon.classList.remove('rotate');
        }, 250);
    } else {
        burbujaIcon.classList.add('rotate2');
        burbujaIcon.src = burbujaIconSVG1DataUri;
        chatElement.style.display = 'none';
        setTimeout(function() {
            burbujaIcon.classList.remove('rotate2');
        }, 250);
    }
});

messageSubmit.addEventListener('click', function() {  
    console.log('click', messageInput.value); 
    insertMessage(messageInput.value);
});

window.addEventListener('keydown', function(e) {
    if (e.which === 13) {
        console.log('enter', messageInput.value); 
        insertMessage(messageInput.value);
        e.preventDefault();
    }
});

function insertMessage(message) {
    const msg = messageInput.value.trim();
    if (msg === '') {
        return false; 
    }

    const messagePersonal = document.createElement('div');
    messagePersonal.className = 'message message-personal';
    messagePersonal.innerText = msg;
    messages.appendChild(messagePersonal);
    messagePersonal.classList.add('new');
    setDate();
    messageInput.value = '';

    updateScrollbar();

    // Obtiene la respuesta del bot y llama a insertarMensajeRespuesta
    chat(message).then(botResponse => {
        insertarMensajeRespuesta(botResponse);
    });
}

async function chat(message) {
    const url = 'https://oi.telco.com.ar/ollama/api/chat';
    const data = {
        "messages": [
            {
                "role": "system",
                "content": "Vas a actuar como un profesor de matematica que ganó el premio nobel.\nHABLAME EN ESPAÑOL POR FAVOR."
            },
            {
                "role": "user",
                "content": message
            }
        ],
        "model": "codestral:22b",
       
        "options": {
            "temperature": 0.1,
            "num_predict": 100
        }
    };

    const token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6ImVjYjkwMWI1LTNhMTItNDQ1Ni1iNWE2LWQxYmJlNWM4ZmQxYyJ9.puVYN61p6pucr7nU06umf06GlujVuK6BxLeMg077_zM";
    console.log(data);
    if(data.messages[1].content == '' || data.messages[1].content == undefined){
        data.messages[1].content = "Dile al usuario que ocurrio un error";
    }
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`,
            },
            body: JSON.stringify(data),
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const textResponse = await response.text();
        const jsonObjects = textResponse
            .trim()
            .split(/\n/)
            .map(line => JSON.parse(line))
            .map(o => o.message)
            .filter(o => o && o.content); // Filtra solo los mensajes válidos

        let reps = []
        // Solo toma el primer mensaje de respuesta        
            jsonObjects.forEach(message => {
                reps.push(message.content);
            })
        return reps
      
        

    } catch (error) {
        console.error('Error:', error);
    }
}

function updateScrollbar() {
    if (messages) {
        messages.scrollTop = messages.scrollHeight;
    }
}

function setDate() {
    d = new Date();
    if (m !== d.getMinutes()) {
        m = d.getMinutes();
        const timestamp = document.createElement('div');
        timestamp.className = 'timestamp';
        timestamp.innerText = d.getHours() + ':' + m;
        document.querySelector('.message:last-child').appendChild(timestamp);
    }
}

function insertarMensajeRespuesta(messageBot = "Lo siento, no tengo respuesta en este momento.") {
    const loadingMessage = document.createElement('div');
    loadingMessage.className = 'message loading new';
    const figure = document.createElement('figure');
    figure.className = 'avatar';
    const img = document.createElement('img');
    img.src = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80.jpg';
    figure.appendChild(img);
    loadingMessage.appendChild(figure);
    loadingMessage.appendChild(document.createElement('span'));
    messages.appendChild(loadingMessage);
    updateScrollbar();

    setTimeout(function() {
        loadingMessage.remove(); 

        const newMessage = document.createElement('div');
        newMessage.className = 'message new';
        const newFigure = document.createElement('figure');
        newFigure.className = 'avatar';
        const newImg = document.createElement('img');
        newImg.src = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80.jpg';
        newFigure.appendChild(newImg);
        newMessage.appendChild(newFigure);
        newMessage.innerHTML += messageBot;
        messages.appendChild(newMessage);
        newMessage.classList.add('new');
        setDate(); 
        updateScrollbar(); 
    }, 1000); 
}

});
