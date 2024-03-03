const getIdName = document.getElementById('name')
const getIdRarity = document.getElementById('rarity')
const getIdJob = document.getElementById('job')
const getIdElement = document.getElementById('element')
const getIdRole = document.getElementById('role')
const getIdTotal = document.getElementById('total')
const getIdImage = document.getElementById('image')

function insert(){
    const name = getIdName.value
    const rarity = getIdRarity.value
    const job = getIdJob.value
    const element = getIdElement.value
    const role = getIdRole.value
    const total = getIdTotal.value
    const image = getIdImage.value.match(/[^\\/]*$/)[0]

    if(name == ""){
        alert("Must include a traveller name")
    }
    else if(rarity == ""){
        alert("Must include a traveller rarity")
    }
    else if(rarity > 5 || rarity < 3){
        alert("Traveller rarity only accepted from 3-5 stars")
    }
    else if(job == ""){
        alert("Must include a traveller job")
    }
    else if(role == ""){
        alert("Must include a traveller role")
    }
    else if(total == ""){
        alert("Must include a traveller total")
    }
    else if(total > 10){
        alert("Total of the traveller must not exceed 10")
    }
    else if(total < 0){
        alert("Total of the traveller must not be lower than 0")
    }
    else if(image == ""){
        alert("Please include a sprite for the traveller")
    }
    else{
        var form_data = new FormData()
        form_data.append('name',name)
        form_data.append('rarity',rarity)
        form_data.append('job',job)
        form_data.append('element',element)
        form_data.append('role',role)
        form_data.append('total',total)
        form_data.append('image',image)

        var ajax_request = new XMLHttpRequest()
        ajax_request.open('POST','./php/addTraveller.php')
        ajax_request.send(form_data)
        ajax_request.onreadystatechange = function(){
            if(ajax_request.readyState == 4 && ajax_request.status == 200){
                try{
                    var response = JSON.parse(ajax_request.responseText);
                    if(response.error == ""){
                        alert("A new traveller is added to the database!")
                        window.location.href = "traveller.html"
                    }
                }catch(error){
                    alert("An error occur in our server")
                    console.log(error)
                }
            }
        }
    }
}