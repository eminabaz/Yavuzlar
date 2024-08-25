const manageDiv = document.getElementById("manage")
const sorularContainer = document.getElementById("sorucont")

let yedekArray = [];



function ekraniTemizle() { //ekrandaki boş kutuyu temizler.
while(sorularContainer.firstChild){
    sorularContainer.removeChild(sorularContainer.firstChild)
}
}

function sorulariBas(sorular) {
ekraniTemizle()
sorular.forEach(q =>  {
let str = `<h2>Soru: ${q.soru}</h2>
<h3>Zorluk Düzeyi: ${q.zorluk}</h3><div id="secenekler">`

q.cevaplar.forEach( a => {   // doğru şıkları belirler ve şıkların button elementini oluşturur
    if(a.correct){
    str+= `<button class="correct" id="secenek"> ${a.text} </button>`}
else{
    str+= `<button id="secenek"> ${a.text} </button>`
} })
str += `<br><button id="sil" onclick="soruSil(${q.id})">Sil</button>
<button id="düzenle" onclick="soruDüzenle(${q.id})">düzenle</button></div>`

const yeniDiv = document.createElement("div")
yeniDiv.innerHTML = str
yeniDiv.classList.add("soruContainer")
sorularContainer.appendChild(yeniDiv) 
 })
}

function aramaYap() {
    const aramaKutusu = document.getElementById("search")
    const arananDeğer = aramaKutusu.value.toLowerCase()
    console.log(typeof arananDeğer)
    if(arananDeğer === ""){
        sorulariBas(sorular)
    }
    const newArray = sorular.filter(f => f.soru.toLowerCase().includes(`${arananDeğer}`))
    sorulariBas(newArray)

}

function soruSil (id) {
    let index = sorular.findIndex(soru => soru.id == id)
    console.log(index)
    sorular.splice(index,1)
    sorulariBas(sorular)

    
}

function soruDüzenle(id) 
{
    const simdikiSoru = sorular.filter(soru => soru.id == id)
    const düzenlenenMetin = prompt("Yeni soru içeriğini girin:")
    if(düzenlenenMetin != ""){
    simdikiSoru[0].soru = düzenlenenMetin;
    alert("Soru içeriği başarıyla değiştirildi.")
    }
    else alert("İllegal girdi!")
    sorulariBas(sorular)
}


function reload(){
    location.reload()
}


if(location.href.includes("edit.html")){
window.addEventListener("load" , () => { //sayfa yüklendiğinde tüm soruları ekrana basacak.

    sorulariBas(sorular)
})}





