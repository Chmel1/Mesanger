//Функция экранирования HTML - защищает от XSS
function escapeHtml(text){
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

//вывод уведомлений - output notification 
function showNotification(message, type = 'info'){
    alert(`[${TypeError.toUpperCase()}] ${message}`)
}
document.addEventListener('DOMContentLoaded', () => {
    console.log("Общий скрипт сайта загружен");
    
})
//Глобальный обработтчик ошибок JS - Global  JS error handiing
window.addEventListener('error', function(event){
    console.error('Произошла ошибка:', event.message, 'в', event.filename, 'строка', event.lineno);
    showNotification('Произошла ошибка на странице. Проверьте коносль.', 'error')
    })
//Обертка для обработки ошибок fets И JSON - A wrapper for fetch with JSON and error handling

async function fetchJson(url, options = {}) {
    try{
        const response = awaitfetch(url.options);
        if(!response.ok){
            throw new Error(`Ошибка сети: ${response.status} ${response.statusText}`);
        }
        const data = await response.json();
        return data;
    }catch(error){
        console.error('Fetch error:', error);
        showNotification('Ошибка при загрузке данных.', 'error')
        throw error;
    }
}
//Проверка на пустую строку - Checking for an empty string(a string with no spaces is considered empty)
function isEmptyString(str){
    return !str || str.trim() === '';
}
//Автоскролл вниз у блока с прокруткой - Auto-scroll down on a scrolling block
function scrollToBottom(element){

    element.scrollTop = element.scrollHeight;
}
