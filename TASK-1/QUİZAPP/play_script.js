/*


 ! 105. satırda sorular bitiyor.


 EMİN ABAZ

 */




const soruno = document.getElementById("soruno")
const soruicerik = document.getElementById("soruicerik")
const siklar = document.getElementsByClassName("cevapbutonlari")[0]
const zorluk = document.getElementById("zorluduzeyi")
const nextbtn = document.getElementById("next-btn")

let count =0;
let dogrubilinen =0;
let score;
let simdikiSoru;
let simdikiSoruNo;
let randomSayi;

function startQuiz()
{
   simdikiSoruNo =0;
   soruGetir()
}

function soruGetir()
{
  resetDisplay()
  randomSayi = Math.floor(Math.random() * sorular.length)
  simdikiSoruNo++
  soruno.innerHTML = `${simdikiSoruNo}. Soru`
  simdikiSoru = sorular[randomSayi]
  soruicerik.innerHTML = simdikiSoru.soru
  zorluk.innerHTML = `Düzey: ${(simdikiSoru.zorluk)}`
  
  simdikiSoru.cevaplar.forEach( answer => 
  {
    const button = document.createElement("button");
    button.innerHTML = answer.text;
    button.classList.add("btn"); 
    siklar.appendChild(button);
    if(answer.correct)
    {
        button.dataset.correct = answer.correct;
    }
    
    button.addEventListener("click", checkAnswer)}


);

}

function resetDisplay () {
    nextbtn.style.display = "none";
    while(siklar.firstChild)
    {
        siklar.removeChild(siklar.firstChild)
    }
}

function checkAnswer(selected) {
let selectedbtn =selected.target

if (selectedbtn.dataset.correct === "true")
{

selectedbtn.classList.add("correct")
dogrubilinen++

switch (simdikiSoru.zorluk) {
    case "Kolay":
        score+=4
        alert(`Tebrikler ${simdikiSoru.zorluk} düzeyinde soru bilerek 4 puan kazandınız!`)
        break;
    case "Orta":
        score+=8
        alert(`Tebrikler ${simdikiSoru.zorluk} düzeyinde soru bilerek 8 puan kazandınız!`)
        break;
    case "Zor":
        score+=12
        alert(`Tebrikler ${simdikiSoru.zorluk} düzeyinde soru bilerek 12 puan kazandınız!`)
        break;
}

}
else
{
selectedbtn.classList.add("incorrect")
}
Array.from(siklar.children).forEach( buton => {  //yanlış cevabı işaretlediğimizde doğruyu göstermesi için

    if(buton.dataset.correct)
    {
        buton.classList.add("correct")
    }
    buton.disabled = "true";
})
nextbtn.style.display = "";
nextbtn.addEventListener("click",nextHandler)
}


function nextHandler()
{
   if (count < 3)
   {
    count+=1
    soruGetir()
   }
   else{
    alert(`Quiz tamamlandi. 4 sorudan ${dogrubilinen} adet soruyu dogru bildiniz. Skorunuz:${score}`)
    count=0
    score=0
    dogrubilinen=0
    startQuiz()
   }

}
startQuiz()