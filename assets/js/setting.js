const menuHamburger = document.querySelector(".menu-hamburger");
const navLinks = document.querySelector(".nav-links");

menuHamburger.addEventListener("click", ()=>{
    navLinks.classList.toggle("mobile-menu")
})

function readForm(){
    var formData = {}
    formData["codejrn"] = document.getElementById("codejrn").value
    formData["intitule"] = document.getElementById("intitule").value
    return formData
}

function insertnewRow(newData,encode){
    // var table = document.getElementById("my_update_table")
    var table =  document.getElementById("uptable")
    var newRow = table.insertRow(table.length)
    // var newRow = document.createElement("tr")

    newRow.id = encode.id

    // cellule 1
    cell1 = newRow.insertCell(0)
    cell1.id = "tooltip"
    cell1.className = "component"
    cell1.setAttribute('data-target','code_jrn')

    var span1 = document.createElement('span')
    span1.id = "code_jrn"

    var a_link1 = document.createElement('a')
    a_link1.appendChild(document.createTextNode(newData.codejrn))
    // a_link1.href = "#"
    span1.appendChild(a_link1)
    cell1.appendChild(span1)

    // cellule 2
    cell2 = newRow.insertCell(1)
    cell2.className = "component"
    cell2.setAttribute('data-target','intitule')

    var span2 = document.createElement("span")
    span2.id = "intitule_value"

    var a_link2 = document.createElement('a')
    a_link2.appendChild(document.createTextNode(newData.intitule));
    a_link2.id = "open-popup"
    // a_link2.href = "#"
    a_link2.setAttribute('data-role','update')
    a_link2.setAttribute('data-id',encode.id)
    // add event listeners
    a_link2.addEventListener('click', function(){
        addClasses_fun()
        var id = $(this).data('id')
        var the_code = $('#' + id + ' #code_jrn a').text()
        var the_title = $('#' + id + ' #intitule_value a').text()
        $('#codejrn').val(the_code)
        $('#intitule').val(the_title)
        console.log(the_code);
        console.log(the_title);
        $('#userId').val(id)
    })
    span2.appendChild(a_link2)
    cell2.appendChild(span2)

    // cellule 3
    cell3 = cell2 = newRow.insertCell(2)
    cell3.className = "component"
    cell3.innerHTML =   `<a onClick="onDelete(this)" data-id="${encode.id}">
                            <div class="img_"> 
                                <img class="img_del" src="${base_url}assets/fonts/icon/del.png" alt="Deletfevde">
                            </div>
                        </a>`;

}

function addUpdateBtn(){
    var champ_button = document.getElementById("champ_button");
    champ_button.innerHTML = ""
    var button = document.createElement("button");
    button.setAttribute("id", "save");
    button.setAttribute("class", "btn");
    button.innerHTML = `<img class="img_update" src="${base_url}assets/fonts/icon/update.png" alt="Deletfevde"></img>`;
    button.addEventListener("click", function(){
        var id = $('#userId').val()
        var the_code = $('#codejrn').val()
        var the_title = $('#intitule').val()
    
        $.ajax({
            url:`${base_url}InsertionCI/updatejrn`,
            method:'post',
            data:{id : id, code : the_code, intitule : the_title},
            success: function(response){
                console.log(response);
                $('#' + id + ' #code_jrn a').text(the_code)
                $('#' + id + ' #intitule_value a').text(the_title)
                document.body.classList.remove("active-popup")
            }
        })
    })
    champ_button.appendChild(button);
}

function addInsertBtn(){
    var champ_button = document.getElementById("champ_button");
    champ_button.innerHTML = ""
    var button = document.createElement("button");
    button.setAttribute("id", "insert");
    button.setAttribute("class", "btn btn-primary");
    button.innerHTML ="INSERT";
    button.addEventListener("click", function(){
        var the_code = $('#codejrn').val()
        var the_title = $('#intitule').val()
        var data = readForm()
    
        $.ajax({
            url:`${base_url}InsertionCI/insertionjrn`,
            method:'post',
            // dataType: "json",
            data:{code : the_code, intitule : the_title},
            success:function(response){
                var data_json = jQuery.parseJSON(response)
                // create the row
                insertnewRow(data,data_json)
                document.body.classList.remove("active-popup")
                // alert(data_json.intitule)
            }
        })
    })
    champ_button.appendChild(button);
}

// update
// on click in lien update
$(document).ready(function(){
    $(document).on("click", "a[data-role=update]",function(){
        addUpdateBtn();
        var id = $(this).data('id')
        var the_code = $('#' + id + ' #code_jrn a').text()
        var the_title = $('#' + id + ' #intitule_value a').text()
        $('#codejrn').val(the_code)
        $('#intitule').val(the_title)
        console.log(the_code);
        console.log(the_title);
        $('#userId').val(id)
    })
})

// insert
$(document).ready(function(){
    $(document).on("click", "a[data-role=ajouter]",function(){
        addInsertBtn();
        var id = ""
        var the_code = ""
        var the_title = ""
        $('#codejrn').val(the_code)
        $('#intitule').val(the_title)
        console.log(the_code);
        console.log(the_title);
        $('#userId').val(id)
    })
})

// delete
function onDelete(td){
    
    var id = $(td).data('id')
    var the_code = $('#' + id + ' #code_jrn a').text()
    var the_title = $('#' + id + ' #intitule_value a').text()
    $('#codejrn').val(the_code)
    $('#intitule').val(the_title)
    $('#userId').val(id)
    console.log(id);
    console.log(the_code);
    console.log(the_title);

    if(confirm(`Deleting : ${the_title}?`)){
        row = td.parentElement.parentElement;
        $.ajax({    
            url:`${base_url}InsertionCI/deletejrn`,
            method:'post',
            data:{id : id, code : the_code, intitule : the_title},
            success: function(response){
                console.log(response);
                document.getElementById("uptable").deleteRow(row.rowIndex-1);
            }
        })
    }
}