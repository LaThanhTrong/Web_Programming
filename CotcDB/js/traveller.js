/**
 * 
 * @param {HTMLTableElement} table The table to sort
 * @param {number} column The index of the column to sort 
 * @param {boolean} asc Determine whether acsending or not 
 */
function sortTableByColumn(table, column, asc = true){
    const dirModifier = asc ? 1 : -1
    const tBody = table.tBodies[0]
    const rows = Array.from(tBody.querySelectorAll("tr"))
    
    const sortedRows = rows.sort((a,b)=>{
        const aColTex = a.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim()
        const bColTex = b.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim()
        if (aColTex?.match(/^[0-9]/g) && bColTex?.match(/^[0-9]/g)) {
            const aNum = parseInt(aColTex);
            const bNum = parseInt(bColTex);
            return (aNum - bNum) > 0 ? (1 * dirModifier) : (-1 * dirModifier);
        }
        else{
            return aColTex > bColTex ? (1 * dirModifier) : (-1 * dirModifier)
        }
    })

    // Remove all tr
    while(tBody.firstChild){
        tBody.removeChild(tBody.firstChild)
    }
    // Append new tr
    tBody.append(...sortedRows)

    // Toggle asc and desc
    table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc", "th-sort-desc"))
    table.querySelector(`th:nth-child(${ column + 1 })`).classList.toggle("th-sort-asc", asc)
    table.querySelector(`th:nth-child(${ column + 1 })`).classList.toggle("th-sort-desc", !asc)
}

document.querySelectorAll(".table-sortable th.sort").forEach(headerCell => {
    headerCell.addEventListener("click", () => {
        const tableElement = headerCell.parentElement.parentElement.parentElement
        const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell)
        const currentIsAscending = headerCell.classList.contains("th-sort-asc")

        sortTableByColumn(tableElement, headerIndex, !currentIsAscending)

    })
})

function travellerTable(){
    var ajax_request = new XMLHttpRequest()
    var asynchronous = true
    ajax_request.open('GET','./php/traveller.php',asynchronous)
    ajax_request.send()
    ajax_request.onreadystatechange = function(){
        if(ajax_request.readyState == 4 && ajax_request.status == 200){
            var data = JSON.parse(this.responseText)
            var html = ""
            for(var i=0; i<data.length; i++){
                tId = data[i].t_id
                tName = data[i].t_name
                tRarity = data[i].t_rarity
                tJob = data[i].t_job
                tElement = data[i].t_element
                tRole = data[i].t_role
                tTotal = data[i].t_total
                tImage = "./images/travellers/"+data[i].t_image
                html += "<tr>"
                    html += '<td><img src='+tImage+'></td>'
                    html += '<td>'+tName+'</td>'
                    html += '<td>'+tRarity+'★</td>'
                    html += '<td>'+tJob+'</td>'
                    html += '<td>'+tElement+'</td>'
                    html += '<td>'+tRole+'</td>'
                    html += '<td>'+tTotal+'</td>'
                    if(sessionStorage.getItem('u_email') != null){
                        html += '<td class="action"><a href="editTraveller.html?tName='+tName+'&tRarity='+tRarity+'&tJob='+tJob+'&tElement='+tElement+'&tRole='+tRole+'&tTotal='+tTotal+'">Edit</a></td>'
                        html += '<td class="action"><button onclick="deleteTraveller(`'+tId+'`,`'+tName+'`)">Delete</button></td>'
                    }
                    else{
                        html += '<td class="action"><a href="login.html">Edit</a></td>'
                        html += '<td class="action"><a href="login.html">Delete</a></td>'
                    }
                html += "</tr>"
            }
            document.querySelector(".container .table-sortable tbody").innerHTML = html
        }
    }
}

function deleteTraveller(tId, tName){
    if(confirm('Are you sure to delete traveller '+tName+'')){
        var form_data = new FormData()
        form_data.append('tId',tId)

        var ajax_request = new XMLHttpRequest()
        ajax_request.open('POST','./php/deleteTraveller.php')
        ajax_request.send(form_data)
        ajax_request.onreadystatechange = function(){
            if(ajax_request.readyState == 4 && ajax_request.status == 200){
                try{
                    var response = JSON.parse(ajax_request.responseText);
                    if(response.error == ""){
                        alert("Traveller "+tName+" is removed from the database!")
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

function searchTraveller(){
    const name = document.getElementById('searchTraveller').value
    var form_data = new FormData()
    form_data.append('name', name)
    var ajax_request = new XMLHttpRequest()
    ajax_request.open('POST','./php/searchTraveller.php',true)
    ajax_request.send(form_data)
    ajax_request.onreadystatechange = function(){
        if(ajax_request.readyState == 4 && ajax_request.status == 200){
            var data = JSON.parse(this.responseText)
            var html = ""
            for(var i=0; i<data.length; i++){
                tId = data[i].t_id
                tName = data[i].t_name
                tRarity = data[i].t_rarity
                tJob = data[i].t_job
                tElement = data[i].t_element
                tRole = data[i].t_role
                tTotal = data[i].t_total
                tImage = "./images/travellers/"+data[i].t_image
                html += "<tr>"
                    html += '<td><img src='+tImage+'></td>'
                    html += '<td>'+tName+'</td>'
                    html += '<td>'+tRarity+'★</td>'
                    html += '<td>'+tJob+'</td>'
                    html += '<td>'+tElement+'</td>'
                    html += '<td>'+tRole+'</td>'
                    html += '<td>'+tTotal+'</td>'
                    if(sessionStorage.getItem('u_email') != null){
                        html += '<td class="action"><a href="editTraveller.html?tName='+tName+'&tRarity='+tRarity+'&tJob='+tJob+'&tElement='+tElement+'&tRole='+tRole+'&tTotal='+tTotal+'">Edit</a></td>'
                        html += '<td class="action"><button onclick="deleteTraveller(`'+tId+'`,`'+tName+'`)">Delete</button></td>'
                    }
                    else{
                        html += '<td class="action"><a href="login.html">Edit</a></td>'
                        html += '<td class="action"><a href="login.html">Delete</a></td>'
                    }
                html += "</tr>"
            }
            document.querySelector(".container .table-sortable tbody").innerHTML = html
        }
    }
}