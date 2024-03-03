const listNews = document.querySelector('.container .list-news')
var ajax_request = new XMLHttpRequest()
var asynchronous = true
ajax_request.open('GET','./php/index.php',asynchronous)
ajax_request.send()
ajax_request.onreadystatechange = function(){
    if(ajax_request.readyState == 4 && ajax_request.status == 200){
        try{
            var data = JSON.parse(this.responseText)
            var html = "<h2>What's Happening Right Meow!</h2>"
            for(var i=0; i<data.length; i++){
                newsId = data[i].n_id
                newsTitle = data[i].n_title
                newsDate = data[i].n_date
                newsDesc = data[i].n_desc
                newsImage = "./images/news/"+data[i].n_image
                html += '<div class="newCard">'
                    html += '<img src='+newsImage+' alt="">'
                    html += '<br>'
                    html += '<div class="desc">'
                        html += '<h1>'+newsTitle+'</h1>'
                        html += '<p>'+newsDate+'</p>'
                        html += '<h3>'+newsDesc+'</h3>'
                    html += '</div>'
                html += '</div>'
                listNews.innerHTML = html
            }
        }catch(error){
            alert(error)
        }
    }
}
