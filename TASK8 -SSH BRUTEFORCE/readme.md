   _____ _____ _    _   ____  _____  _    _ _______ ______ 
  / ____/ ____| |  | | |  _ \|  __ \| |  | |__   __|  ____|
 | (___| (___ | |__| | | |_) | |__) | |  | |  | |  | |__   
  \___ \\___ \|  __  | |  _ <|  _  /| |  | |  | |  |  __|  
  ____) ____) | |  | | | |_) | | \ \| |__| |  | |  | |____ 
 |_____|_____/|_|  |_| |____/|_|  \_\\____/   |_|  |______|  SSH-BRUTE TOOL ( codded by : (E_A) )

Programın yardım sayfası için: sshbrut3.exe  -h komutunu çalıştırın.

Örnek kullanım:

sshbrut3.exe attack -u (kullanıcı-adı) -U (*1) -p (şifre) -P -w (wordlist yolu *2)  -t (hedef ip) -W (thread sayısı)


UYARILAR: 

*1: -u -U parametrelerini ve -p -P parametrelerini beraber kullanmayın. Tek mod seçmelisiniz.

*2: wordlist örnekleri /wordlist dizini altında bulunmaktadır. Dosya formatları aşağıdaki gibi olmalıdır.

-U -P (full brute-force) modunda .txt formatı -> (username:password)

-u -P (password brute-force modunda) .txt formatı -> (password)

-U -p (username brute-force modunda) .txt formatı -> (username)  
şeklinde olmalıdır.

