var btnEl = document.querySelectorAll("#open-popup")
var btnClose  = document.querySelector(".popup .close-btn")
    
// action
for(i = 0; i < btnEl.length; i++) {
    btnEl[i].addEventListener("click", addClasses_fun);
}
btnClose.addEventListener("click", remove_popup)
// ---
// function
function addClasses_fun(){
    document.body.classList.add("active-popup");
}
function remove_popup(){
    document.body.classList.remove("active-popup");
}

function gettext(el){
    var text_inside_btnEl = el.textContent
    console.log("My button title "+text_inside_btnEl)
}

