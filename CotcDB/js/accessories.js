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

function accessoriesTable(){
    var ajax_request = new XMLHttpRequest()
    var asynchronous = true
    ajax_request.open('GET','./php/accessories.php',asynchronous)
    ajax_request.send()
    ajax_request.onreadystatechange = function(){
        if(ajax_request.readyState == 4 && ajax_request.status == 200){
            var data = JSON.parse(this.responseText)
            var html = ""
            for(var i=0; i<data.length; i++){
                aId = data[i].a_id
                aName = data[i].a_name
                aFrom = data[i].a_from
                aStats = data[i].a_stats
                aEffects = data[i].a_effects
                aRank = data[i].a_rank
                aExplaination = data[i].a_explaination
                html += "<tr>"
                    html += '<td>'+aName+'</td>'
                    html += '<td>'+aFrom+'</td>'
                    html += '<td>'+aStats+'</td>'
                    html += '<td>'+aEffects+'</td>'
                    html += '<td class="center">'+aRank+'</td>'
                    html += '<td>'+aExplaination+'</td>'
                html += "</tr>"
            }
            document.querySelector(".container .table-sortable tbody").innerHTML = html
        }
    }
}

function searchAccessories(){
    const name = document.getElementById('searchAccessories').value
    var form_data = new FormData()
    form_data.append('name', name)
    var ajax_request = new XMLHttpRequest()
    ajax_request.open('POST','./php/searchAccessories.php',true)
    ajax_request.send(form_data)
    ajax_request.onreadystatechange = function(){
        if(ajax_request.readyState == 4 && ajax_request.status == 200){
            var data = JSON.parse(this.responseText)
            var html = ""
            for(var i=0; i<data.length; i++){
                aId = data[i].a_id
                aName = data[i].a_name
                aFrom = data[i].a_from
                aStats = data[i].a_stats
                aEffects = data[i].a_effects
                aRank = data[i].a_rank
                aExplaination = data[i].a_explaination
                html += "<tr>"
                    html += '<td>'+aName+'</td>'
                    html += '<td>'+aFrom+'</td>'
                    html += '<td>'+aStats+'</td>'
                    html += '<td>'+aEffects+'</td>'
                    html += '<td class="center">'+aRank+'</td>'
                    html += '<td>'+aExplaination+'</td>'
                html += "</tr>"
            }
            document.querySelector(".container .table-sortable tbody").innerHTML = html
        }
    }
}