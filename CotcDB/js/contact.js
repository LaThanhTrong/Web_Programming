document.getElementById('contactEmail').value = sessionStorage.getItem('u_email')
function emailValidate(email){
    return String(email)
    .toLowerCase()
    .match(
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
}


function send(){
    const email = document.getElementById('contactEmail').value
    const message = document.getElementById('contactMessage').value
    const timestamp = new Date().toLocaleString()
    if(!emailValidate(email) || message == ""){
        alert("Email or message is invalid")
    }
    else{
        var form_data = new FormData()
        form_data.append('email',email)
        form_data.append('message',message)
        form_data.append('timestamp',timestamp)
        var ajax_request = new XMLHttpRequest()
        ajax_request.open('POST','./php/contact.php')
        ajax_request.send(form_data)
        ajax_request.onreadystatechange = function(){
            if(ajax_request.readyState == 4 && ajax_request.status == 200){
                try{
                    var response = JSON.parse(ajax_request.responseText);
                    if(response.error == ""){
                        alert("Message sent")
                    }
                }catch(error){
                    alert("An error occur in our server")
                }
            }
        }
    }
}