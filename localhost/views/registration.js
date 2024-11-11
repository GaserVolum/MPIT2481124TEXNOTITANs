// Массив для хранения зарегистрированных пользователей
const users = [];

document.getElementById('submitButton').addEventListener('click', function() {
 
    const login = document.getElementById('login').value.trim();
    const password = document.getElementById('password').value.trim();
   // const confirmPassword = document.getElementById('confirmPassword').value.trim();
    
    
    const errorMessage = document.getElementById('errorMessage');
    
  
    if (!login || !password ) {
        alert('Пожалуйста, заполните все поля.');
        return;
    }
     
  

  
    if (users.some(user => user.login === login)) {
        errorMessage.textContent = 'Пользователь с таким логином уже существует!';
        errorMessage.style.display = 'block';
        return;
    }

   
    users.push({ login: login, password: password });

    
    errorMessage.style.display = 'none';

    
    
   
    document.getElementById('login').value = '';
    document.getElementById('password').value = '';
    //document.getElementById('confirmPassword').value = '';

  
    window.location.href = "dashboard.html";
});
