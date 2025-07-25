<?php 

session_start();            //Запускаем сессию - starting session
session_unset();            // Очищаем все переменные сессии - clear all session variable
session_destroy();          //Удаляем сессию - delete the session

//Устанавливаем flash-сообщение через cookie(на  5 секунд) - Set flash-message via cookie (for 5 seconds) 
setcookie("logout_success", "Вы успешно вышли!", time() + 5, "/");

header('Location: ?page=login');
exit;

if(ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]
    );
}