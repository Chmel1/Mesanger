<h2>Чат</h2>

<div id="messages" class="border rounded p-2 mb-3" style="height: 300px; overflow-y: scroll;">
    Загрузка сообщений...
</div>

<form id="chat-form">
    <div class="input-group">
        <input type="text" id="message-input" class="form-control" placeholder="Введите сообщение" required>
        <button class="btn btn-primary" type="submit">Отправить</button>
    </div>
</form>

<!-- Подключаем JS только на этой странице -->
<script src="/assets/js/chat.js" defer></script>
