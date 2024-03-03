function emailValidate(email){
    return String(email)
    .toLowerCase()
    .match(
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
}

const login = document.getElementById('login')
login.addEventListener('click', function(){
    var email = document.getElementById('email').value
    var password = document.getElementById('password').value
    if(emailValidate(email)){
        var form_data = new FormData()
        form_data.append('email', email)
        form_data.append('password',password)
        var ajax_request = new XMLHttpRequest()
        ajax_request.open('POST','./php/login.php')
        ajax_request.send(form_data)
        ajax_request.onreadystatechange = function(){
            if(ajax_request.readyState == 4 && ajax_request.status == 200){
                var response = JSON.parse(ajax_request.responseText);
                if(response.success != ''){
                    document.getElementById('email_error').innerHTML = ''
                    document.getElementById('password_error').innerHTML = ''
                    alert('Login success')
                    sessionStorage.setItem('u_name', response.u_name)
                    sessionStorage.setItem('u_email', response.u_email)
                    sessionStorage.setItem('u_password', response.u_password)
                    sessionStorage.setItem('u_image', response.u_image)
                    window.location.href = "index.html"
                }
                else{
                    if(response.email_error == '' && response.password_error == ''){
                        alert('Email or password is invalid')
                        document.getElementById('email_error').innerHTML = ''
                        document.getElementById('password_error').innerHTML = ''
                    }
                    else{
                        document.getElementById('email_error').innerHTML = response.email_error
                        document.getElementById('password_error').innerHTML = response.password_error
                    }
                }
            }
        }
    }
    else{
       alert("Email không hợp lệ")
    }
})