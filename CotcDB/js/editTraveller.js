function getUrlVars() {
    var vars = {};
    window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        value = value.replaceAll("%20"," ")
        vars[key] = value;
        
    });
    return vars;
}

const tName = getUrlVars()["tName"]
const tRarity = getUrlVars()["tRarity"]
const tJob = getUrlVars()["tJob"]
const tElement = getUrlVars()["tElement"]
const tRole = getUrlVars()["tRole"]
const tTotal = getUrlVars()["tTotal"]

const getIdName = document.getElementById('name')
const getIdRarity = document.getElementById('rarity')
const getIdJob = document.getElementById('job')
const getIdElement = document.getElementById('element')
const getIdRole = document.getElementById('role')
const getIdTotal = document.getElementById('total')
const getIdImage = document.getElementById('image')

getIdName.value = tName
getIdRarity.value = tRarity
getIdJob.value = tJob
getIdElement.value = tElement
getIdRole.value = tRole
getIdTotal.value = tTotal

function update(){
    const name = getIdName.value
    const rarity = getIdRarity.value
    const job = getIdJob.value
    const element = getIdElement.value
    const role = getIdRole.value
    const total = getIdTotal.value
    const image = getIdImage.value.match(/[^\\/]*$/)[0]

    if(rarity > 5 || rarity < 3){
        alert("Traveller rarity only accepted from 3-5 stars")
    }
    else if(total > 10){
        alert("Total of the traveller must not exceed 10")
    }
    else if(total < 0){
        alert("Total of the traveller must not be lower than 0")
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

        form_data.append('oldName',tName)
        form_data.append('oldRarity',tRarity)
        form_data.append('oldJob',tJob)
        form_data.append('oldElement',tElement)
        form_data.append('oldRole',tRole)
        form_data.append('oldTotal',tTotal)

        var ajax_request = new XMLHttpRequest()
        ajax_request.open('POST','./php/editTraveller.php')
        ajax_request.send(form_data)
        ajax_request.onreadystatechange = function(){
            if(ajax_request.readyState == 4 && ajax_request.status == 200){
                try{
                    var response = JSON.parse(ajax_request.responseText);
                    if(response.error == ""){
                        alert("Traveller updated!")
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