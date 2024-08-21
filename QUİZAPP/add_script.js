function soruEkle() {

   let lastID = sorular[sorular.length-1].id
   console.log(lastID)
   let soruİcerik = document.getElementById("soruİcerik").value
   let soruZorluk = document.getElementById("zorlukSecim").value
   let sik1 = document.getElementById("00").value
   let sik2 = document.getElementById("01").value
   let sik3 = document.getElementById("02").value
   let sik4 = document.getElementById("03").value
   
   lastID++
   let newEleman = {id:lastID,
   soru: soruİcerik,
   cevaplar: [
       { text: sik1.split("-")[0], correct: sik1.split("-")[1] },
       { text: sik2.split("-")[0], correct: sik2.split("-")[1] },
       { text: sik3.split("-")[0], correct: sik3.split("-")[1] },
       { text: sik4.split("-")[0], correct: sik4.split("-")[1] }
   ], zorluk:soruZorluk} 

   sorular.push(newEleman)
   alert("db kurmadığım için array'deki değişiklik soruları gösterme sayfasına geçtiğimde kayboluyor. Eklediğim soruyu gösteremiyorum. Eğer görmek istersen hemen şimdi tamam'a bas ve konsolu aç!")
   console.log(sorular)
   setInterval( () => {
   window.location.href = "edit.html" }, 30000)
   

}
