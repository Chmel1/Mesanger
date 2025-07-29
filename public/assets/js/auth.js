document.addEventListener('DOMContentLoaded', () => {
    const confirmLogoutBtn = document.getElementById('confirm-logout')

    if(confirmLogoutBtn){
        confirmLogoutBtn.addEventListener('click', async() =>{
            try{
                const res = await fetch('/app/Controllers/logout.php',{
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                const data = await res.json() //Получение JSON-ответа

                if(data.success){ //Закрыть модалку
                    const modalEl = document.getElementById('logoutModal')
                    const modalInstance = bootstrap.Modal.getInstance(modalEl)
                    modalInstance.hide()

                    window.location.href = '?page=login' //Перенаправление на страницу входа
                }else{
                    alert('Не удалось выйти попробуйте снова')
                }
            }catch(err){
                console.error('Ошибка при выходе:', err)
                alert('Произошла ошибка при попытке выхода')
            }
        })
    }
})