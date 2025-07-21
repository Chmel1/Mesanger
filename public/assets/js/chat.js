document.addEventListener('DOMContentLoaded', ()=> {
    const form = document.getElementById("chat-form")
    const input = document.getElementById("message-input")
    const messagesDiv = document.getElementById("messages")

    const loadMessages = async() => {
        const res = await fetch('/app/Controllers/fetch_messages.php')
        const messages = await res.json();

        messagesDiv.innerHTML = ''
        messages.reverse().forEach(msg => {
            const el = document.createElement('div')
            el.className = 'mb-1'
            el.innerHTML = `<strong>${msg.username}</strong>: ${msg.content} <small class="text-muted">[${msg.created_at}]</small>`;
            messagesDiv.appendChild(el)
        })
        messagesDiv.scrollTop = messagesDiv.scrollHeight
    }

    form.addEventListener('submit', async (e) =>{
        e.preventDefault()
        const content = input.input.value.trim()
        if(content === '') return

        await fetch('/app/Controllers/send_message.php',{
            method: 'POST',
            body: new URLSearchParams({content})
        })

        input.value = ''
        loadMessages()
    })
})