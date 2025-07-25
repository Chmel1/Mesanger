document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById("chat-form");
    const input = document.getElementById("message-input");
    const messagesDiv = document.getElementById("messages");

    // Загрузка сообщений с сервера - load messages from server 
    async function loadMessages() {
        try {
            const messages = await fetchJson('/app/Controllers/fetch_messages.php');
            messagesDiv.innerHTML = '';

            // Обратный порядок, чтобы новые  сообщения были снизу
            messages.reverse().forEach(msg => {
                const el = document.createElement('div');
                el.className = 'mb-1';

                // Используем escapeHtml для безопасности - Using escapeHtml for security
                el.innerHTML = `<strong>${escapeHtml(msg.username)}</strong>: ${escapeHtml(msg.content)} <small class="text-muted">[${msg.created_at}]</small>`;
                messagesDiv.appendChild(el);
            });

            scrollToBottom(messagesDiv);
        } catch (error) {
            // Ошибка уже обработана в fetchJson, если надо — можно добавить доп. логику
        }
    }

    // Отправка нового сообщения - send new message
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const content = input.value.trim();
        if (isEmptyString(content)) {
            showNotification('Сообщение не может быть пустым', 'warning');
            return;
        }

        try {
            // Отправляем данные на сервер - send data to the server
            await fetchJson('/app/Controllers/send_message.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({ content }),
            });

            input.value = '';
            await loadMessages();
        } catch (error) {
            // Ошибка уже показана через showNotification в fetchJson
        }
    });

    // Автообновление каждые 3 секунды - auto-load every 3 seconds
    setInterval(loadMessages, 3000);

    // Первая загрузка сообщений сразу при открытии чата - first loading of messages immediately when you open the chat room 
    loadMessages();
});
