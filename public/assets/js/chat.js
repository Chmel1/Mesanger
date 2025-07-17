document.addEventListener('DOMContentLoaded', function(){
    const contactsList = document.getElementById('contacts');
    const messagesContainer = document.getElementById('messages');
    const chatHeader = document.getElementById('chat-header');
    const messageInput = document.getElementById('message-input');
    const sendButton = document.getElementById('send-btn');

    async function loadMessages(recoverId, offset = 0){
    try{
        const response = await fetch(`/api/messages.php?receiver_id=${receiverId}&offset=${offset}`);
    const data = await response.json();
    if(data.success){
        data.messages.forEach(msg=> {
            renderMessage(msg);
        });

        if(data.has_more){
            setupScrollListener();
        }else{
            showError(data.error)
        }
    }
    }catch(error){
        console.error('Ошибка загрузки сообщения:', error);
    }
}

function renderMessage(msg){
    if(msg.message_type === 'image' && msg.attachments){
        const img = document.createElement('img');
        img.src = msg.attachments.url;
        img.alt = 'Attached image';
    }
}
})

