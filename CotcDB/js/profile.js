function emailValidate(email){
    return String(email)
    .toLowerCase()
    .match(
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
}

function update(){
    const name = document.getElementById('editName').value
    const email = document.getElementById('editEmail').value
    const password = document.getElementById('editPassword').value
    const repassword = document.getElementById('editRePassword').value
    const image = document.getElementById('editImage').value.match(/[^\\/]*$/)[0]
    const oldEmail = sessionStorage.getItem('u_email')
    if(!emailValidate(email)){
        alert("Email or message is invalid")
    }
    else if(password != "" && repassword == ""){
        alert("Retype password field cannot be empty")
    }
    else if(password == "" && repassword != ""){
        alert("Please type in password")
    }
    else if(password != repassword){
        alert("Password and Retype password field are not correct")
    }
    else{
        var form_data = new FormData()
        form_data.append('name',name)
        form_data.append('email',email)
        form_data.append('password',password)
        form_data.append('image',image)
        form_data.append('oldEmail',oldEmail)
        var ajax_request = new XMLHttpRequest()
        ajax_request.open('POST','./php/profile.php')
        ajax_request.send(form_data)
        ajax_request.onreadystatechange = function(){
            if(ajax_request.readyState == 4 && ajax_request.status == 200){
                try{
                    var response = JSON.parse(ajax_request.responseText);
                    if(response.error == ""){
                        alert("Profile updated. Please login to take effect!")
                        sessionStorage.removeItem('u_name')
                        sessionStorage.removeItem('u_email')
                        sessionStorage.removeItem('u_password')
                        sessionStorage.removeItem('u_image')
                        window.location.href = "index.html"
                    }
                }catch(error){
                    alert("An error occur in our server")
                    console.log(error)
                }
            }
        }
    }
}