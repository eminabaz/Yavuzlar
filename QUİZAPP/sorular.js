let sorular = [
    {
        id:0,
        soru: "Siber güvenlik nedir?",
        cevaplar: [
            { text: "Bilgisayarların virüslere karşı korunması", correct: false },
            { text: "Bilgi ve sistemlerin korunması", correct: true },
            { text: "Yalnızca ağların korunması", correct: false },
            { text: "Yazılımların güncellenmesi", correct: false }
        ],
        zorluk: "Kolay"
    },
    {
        id:1,
        soru: "Bir virüs nedir?",
        cevaplar: [
            { text: "Bir tür zararlı yazılım", correct: true },
            { text: "Bir güvenlik duvarı", correct: false },
            { text: "Bir ağ protokolü", correct: false },
            { text: "Bir veri şifreleme yöntemi", correct: false }
        ],
        zorluk: "Kolay"
    },
    {
        id:2,
        soru: "Bir sistemdeki açıkları taramak için hangi araç kullanılır?",
        cevaplar: [
            { text: "Nmap", correct: true },
            { text: "Photoshop", correct: false },
            { text: "MS Word", correct: false },
            { text: "Excel", correct: false }
        ],
        zorluk: "Orta"
    },
    {
        id:3,
        soru: "Güvenlik açığı tarama nedir?",
        cevaplar: [
            { text: "Sistemdeki zayıf noktaların belirlenmesi", correct: true },
            { text: "Veritabanı yönetimi", correct: false },
            { text: "Yazılım güncellemesi", correct: false },
            { text: "Veri yedekleme", correct: false }
        ],
        zorluk: "Orta"
    },
    {
        id:4,
        soru: "APT (Advanced Persistent Threat) nedir?",
        cevaplar: [
            { text: "Uzun süreli ve hedefli siber saldırılar", correct: true },
            { text: "Veri sıkıştırma algoritması", correct: false },
            { text: "Bir ağ yönetim aracı", correct: false },
            { text: "Bir yazılım geliştirme tekniği", correct: false }
        ],
        zorluk: "Orta"
    },
    {
        id:5,
        soru: "Siber güvenlikte honeypot nedir?",
        cevaplar: [
            { text: "Saldırganları tespit etmek amacıyla kullanılan sahte sistem", correct: true },
            { text: "Bir veri şifreleme yöntemi", correct: false },
            { text: "Bir ağ izleme aracı", correct: false },
            { text: "Bir yedekleme tekniği", correct: false }
        ],
        zorluk: "Orta"
    },
    {
        id:6,
        soru: "Bir saldırgan, bir sistemdeki 0-day açığından nasıl faydalanır?",
        cevaplar: [
            { text: "Açık hakkında bilgi sahibi olunmadan önce saldırı düzenleyerek", correct: true },
            { text: "Açığın yamanmasını bekleyerek", correct: false },
            { text: "Veri yedekleyerek", correct: false },
            { text: "Şifreyi sıfırlayarak", correct: false }
        ],
        zorluk: "Zor"
    },
    {
        id:7,
        soru: "SSL/TLS protokolü neyi sağlar?",
        cevaplar: [
            { text: "İnternet üzerinden güvenli veri iletimi", correct: true },
            { text: "Dosya sıkıştırma", correct: false },
            { text: "Veri depolama", correct: false },
            { text: "Veritabanı yönetimi", correct: false }
        ],
        zorluk: "Zor"
    },
    {
        id:8,
        soru: "Cross-Site Request Forgery (CSRF) saldırısı nedir?",
        cevaplar: [
            { text: "Kullanıcının istemediği bir eylemi gerçekleştirmesi için yapılan saldırı", correct: true },
            { text: "Veri şifreleme yöntemi", correct: false },
            { text: "Dosya sıkıştırma tekniği", correct: false },
            { text: "Bir ağ izleme yöntemi", correct: false }
        ],
        zorluk: "Zor"
    }
]