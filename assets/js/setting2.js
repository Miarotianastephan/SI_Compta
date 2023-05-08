const menuHamburger = document.querySelector(".menu-hamburger");
const navLinks = document.querySelector(".nav-links");

menuHamburger.addEventListener("click", ()=>{
    navLinks.classList.toggle("mobile-menu");
})

function readForm(){
    var formData = {};
    formData["code_tier"] = document.getElementById("code_tier").value;
    formData["intitule_num_value"] = document.getElementById("intitule_num_value").value;
    formData["intitule_value"] = document.getElementById("intitule_value").value;
    return formData;
}


function insertnewRow(newData,encode){
    var table = document.getElementById("my_update_table")
    var newRow = table.insertRow(table.length)

    newRow.id = encode.id

    // cellule 1
    cell1 = newRow.insertCell(0)
    cell1.id = "tooltip"
    cell1.className = "component"
    cell1.setAttribute('data-target','code_tier')

    var span1 = document.createElement('span')
    span1.id = "code_tier"

    var a_link1 = document.createElement('a')
    a_link1.appendChild(document.createTextNode(newData.code_tier))
    span1.appendChild(a_link1)
    cell1.appendChild(span1)

    // cellule 2
    cell2 = newRow.insertCell(1)
    cell2.className = "component"
    cell2.setAttribute('data-target','intitule_num')

    var span2 = document.createElement("span")
    span2.id = "intitule_num_value"

    var a_link2 = document.createElement('a')
    a_link2.appendChild(document.createTextNode(newData.intitule_num_value));
    a_link2.id = "open-popup"
    a_link2.setAttribute('data-role','update')
    a_link2.setAttribute('data-id',encode.id)
    // add event listeners
    a_link2.addEventListener('click', function(){
        addClasses_fun()
        var id = $(this).data('id')
        var the_code = $('#' + id + ' #code_tier a').text()
        var the_num = $('#' + id + ' #intitule_num_value a').text()
        var the_title = $('#' + id + ' #intitule_value a').text()
        $('#userId').val(id)
        $('#codetier').val(the_code)
        $('#numero').val(the_num)
        $('#intitule').val(the_title)
        console.log(the_code);
        console.log(the_title);
    })
    span2.appendChild(a_link2)
    cell2.appendChild(span2)

    // cellule 3
    cell3 = newRow.insertCell(2)
    cell3.className = "component"
    cell3.setAttribute('data-target','intitule')

    var span3 = document.createElement("span")
    span3.id = "intitule_value"

    var a_link3 = document.createElement('a')
    a_link3.appendChild(document.createTextNode(newData.intitule_value));
    a_link3.id = "open-popup"
    a_link3.setAttribute('data-role','update')
    a_link3.setAttribute('data-id',encode.id)
    // add event listeners
    a_link3.addEventListener('click', function(){
        addClasses_fun()
        var id = $(this).data('id')
        var the_code = $('#' + id + ' #code_tier a').text()
        var the_num = $('#' + id + ' #intitule_num_value a').text()
        var the_title = $('#' + id + ' #intitule_value a').text()
        $('#userId').val(id)
        $('#codetier').val(the_code)
        $('#numero').val(the_num)
        $('#intitule').val(the_title)
        console.log(the_code);
        console.log(the_title);
    })
    span3.appendChild(a_link3)
    cell3.appendChild(span3)

    // cellule 4
    cell4 = newRow.insertCell(3)
    cell4.className = "component"
    cell4.innerHTML = `<a onClick="onDelete(this)" data-id="${encode.id}">Delete</a>`;

}


function addUpdateBtn(){
    var champ_button = document.getElementById("champ_button");
    champ_button.innerHTML = ""
    var button = document.createElement("button");
    button.setAttribute("id", "save");
    button.setAttribute("class", "btn btn-primary");
    button.innerHTML = "Update !";
    button.addEventListener("click", function(){
        var id = $('#userId').val()
        var the_code = $('#codetier').val()
        var the_num = $('#numero').val()
        var the_title = $('#intitule').val()
        $.ajax({
            url:`${base_url}InsertionCI/update_list_tier`,
            method:'post',
            data:{id : id, num : the_num, code : the_code, intitule : the_title},
            success: function(response){
                console.log(response);
                $('#' + id + ' #code_jrn a').text(the_code)
                $('#' + id + ' #intitule_num_value a').text(the_num)
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
    button.innerHTML = "Insert data!";
    button.addEventListener("click", function(){
        var id = $('#userId').val()
        var the_num = $('#numero').val()
        var the_title = $('#intitule').val()
        var data = readForm()
    
        $.ajax({
            url:`${base_url}InsertionCI/insertionjrn`,
            method:'post',
            // dataType: "json",
            data:{id : id, numero : the_num, intitule : the_title},
            success:function(response){
                var data_json = jQuery.parseJSON(response)
                // create the row
                insertnewRow(data,data_json)
                document.body.classList.remove("active-popup")
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
        $('#userId').val(id)
        $('#usercpt_collectif').val($('#' + id + ' #idplancompte').text())
        $('#codetier').val($('#' + id + ' #code_tier a').text())
        $('#numero').val($('#' + id + ' #intitule_num_value a').text())
        $('#intitule').val($('#' + id + ' #intitule_value a').text())
        console.log(id);
        console.log($('#' + id + ' #code_tier a').text());
        console.log($('#' + id + ' #intitule_num_value a').text());
    })
})

// insert
$(document).ready(function(){
    $(document).on("click", "a[data-role=ajouter]",function(){
        addInsertBtn();
        $('#userId').val("")
        $('#usercpt_collectif').val("")
        $('#codetier').val("")
        $('#numero').val("")
        $('#intitule').val("")
    })
})

// delete
function onDelete(td){
    
    var id = $(td).data('id')
    var the_code = $('#' + id + ' #code_tier a').text()
    var the_num = $('#' + id + ' #intitule_num_value a').text()
    var the_title = $('#' + id + ' #intitule_value a').text()
    $('#codejrn').val(the_code)
    $('#intitule').val(the_title)
    $('#userId').val(id)
    console.log(id);
    console.log(the_code);
    console.log(the_num);
    console.log(the_title);

    if(confirm(`Deleting : ${the_title}?`)){
        row = td.parentElement.parentElement;
        $.ajax({
            url:`${base_url}InsertionCI/deletejrn`,
            method:'post',
            data:{id : id},
            success: function(response){
                console.log(response);
                document.getElementById("my_update_table").deleteRow(row.rowIndex);
            }
        })
    }
}

// SANS FONCTION BACK END 
