let listbutton = document.getElementById("list-btn")

function func () {
    listbutton.addEventListener("click",redirectFunc)
}
function redirectFunc()
{
    window.location.href= "edit.html"
}
 
func()