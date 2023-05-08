const menuHamburger = document.querySelector(".menu-hamburger");
const navLinks = document.querySelector(".nav-links");

menuHamburger.addEventListener("click", ()=>{
    navLinks.classList.toggle("mobile-menu")
})

//MODIF SELECT 
var codepiece = document.getElementById('codepiece');
codepiece.onchange = ()=>{  
    document.getElementById('select_codepiece').innerHTML = codepiece.value;
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


// insert
$(document).ready(function(){
    $(document).on("click", "a[data-role=ajouter]",function(){
        addInsertBtn();
        var id = $('#idjournaux').val()
        var date = $('#date').val()
        var libpiece = $('#libpiece').val()
        var codepiece = $('#codepiece').val()
        var compte_gen = $('#compte_gen').val()
        var compte_tier = $('#compte_tier').val()
        var libelle = $('#libelle').val()
        var devise = $('#devise').val()
        var debit = $('#debit').val()
        var credit = $('#credit').val()
        console.log("id:date "+id+" "+date);
        console.log("lib:codepiece "+codepiece+"/"+libpiece);
        console.log("comptegen:comptetier "+compte_gen+" "+compte_tier);
        console.log("libelle:devise "+libelle+" "+devise);
        console.log("Debit:Credit "+debit+" "+credit);

        $.ajax({
            url:`${base_url}InsertionCI/insert_ecriture`,
            method:'post',
            data:{id: id,date: date,libpiece: libpiece, codepiece: codepiece,compte_gen: compte_gen,compte_tier: compte_tier,libelle: libelle,devise: devise,debit: debit, credit: credit},
            success:function(response){
                var data_json = jQuery.parseJSON(response)
                // create the row
                // insertnewRow(data,data_json)
                // document.body.classList.remove("active-popup")
                // alert(data_json.intitule)
            }
        })
    })
})