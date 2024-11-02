package main

import (
	"bufio"
	"fmt"
	"login-app/database"
	"os"
	"strconv"
	"strings"
)

// renk
var Red = "\033[31m"
var Green = "\033[32m"
var Reset = "\033[0m"
var clear = "\033[2J"

func main() {
	art()
	var secim string
	fmt.Println("Hoşgeldiniz!  \033[42mAdmin (0) User(1)\033[0m  Hangisine Giriş Yapacaksınız ?")
	fmt.Print("Seçin:")
	fmt.Scanf("%s", &secim)

	sonuc, err := strconv.Atoi(secim)
	if err != nil {
		fmt.Print("Sadece tam sayı girin.")
	} else {
		switch sonuc {

		case 0:
			fmt.Println("Admin girişine Yönlendiriliyorsun...")
			Login(0)
		case 1:
			fmt.Println("Kullanıcı girişine Yönlendiriliyorsun...")
			Login(1)
		default:
			fmt.Println("Yanlış Seçenek Girildi...")
			return
		}
	}
}

func Login(role int) {
	if role == 0 {
		fmt.Println("Admin Girişine Hoş Geldin!")
	} else {
		fmt.Println("Kullanıcı Girişine Hoş Geldin!")
	}

	reader := bufio.NewReader(os.Stdin)
	fmt.Println("--------------------------------------")
	fmt.Print("Kullanıcı Adı: ")

	fmt.Scanln()
	un, _ := reader.ReadString('\n')

	un = strings.TrimSpace(un)
	fmt.Println("--------------------------------------")
	fmt.Print("Parola: ")
	pwd, _ := reader.ReadString('\n')
	fmt.Println("--------------------------------------")
	pwd = strings.TrimSpace(pwd)

	user, durum := database.Check(un, pwd)

	if role == 0 && user.Role == "user" {
		fmt.Println("KULLANICILAR ADMİN PANELİNDEN GİRİŞ YAPAMAZ!")
		return
	} // 0'ı seçmiş olarak

	if durum == true && user.Role == "admin" {
		fmt.Print(clear)
		fmt.Println(Green + "Hoş Geldin Admin!" + Reset)
		processChoice("admin", user)
	} else if durum == true {
		fmt.Print(clear)
		fmt.Println(Green + "Hoşgeldin User!" + Reset)
		processChoice("user", user)
	} else {
		return
	}

}

func processChoice(role string, user database.User) {
	var secim int
	fmt.Println("---------------------------------")
	fmt.Println("İŞLEMLER")
	fmt.Println("---------------------------------")
	fmt.Println("Profili Görüntüle (1)")
	fmt.Println("Şifre Değiştir (2)")
	fmt.Println("---------------------------------")

	if role == "admin" {
		fmt.Println(Red + "---------------------------------")
		fmt.Println("ADMİN İŞLEMLERİ")
		fmt.Println("---------------------------------" + Reset)
		fmt.Println("Müşteri Ekle (3)")
		fmt.Println("Müşteri Sil (4)")
		fmt.Println("Logları Görüntüle (5)")
		fmt.Println(Red + "---------------------------------" + Reset)
	}

	fmt.Println("Çıkış Yap (9)")
	fmt.Println("---------------------------------")
	fmt.Print("İşlem Seçiniz: ")
	fmt.Scan(&secim)

	if role == "admin" {
		switch secim {
		case 1:
			userProcesses(1, user, "admin")
		case 2:
			userProcesses(2, user, "admin")
		case 3:
			adminProcesses(3, user)
		case 4:
			adminProcesses(4, user)
		case 5:
			adminProcesses(5, user)
		case 9:
			return

		default:
			fmt.Print("Yanlış Girdi!")

		}
	} else {
		switch secim {
		case 1:
			userProcesses(1, user, "user")
		case 2:
			userProcesses(2, user, "user")
		case 9:
			return
		default:
			fmt.Print("Yanlış Girdi!")

		}
	}

}

func userProcesses(choice int, user database.User, role string) {
	reader := bufio.NewReader(os.Stdin)

	switch choice {

	case 1:
		fmt.Print(clear)
		fmt.Println("┌─────────────────────────────┐")
		fmt.Println("│         Kullanıcı Bilgileri │")
		fmt.Println("├─────────────────────────────┤")
		fmt.Printf("│  Kullanıcı Adı         : %s\n", user.Username)
		fmt.Printf("│  Kullanıcı Rolü          : %s\n", user.Role)
		fmt.Printf("└─────────────────────────────┘\n")
		fmt.Print(Red + "Geriye dönmek için (ENTER)" + Reset)
		fmt.Scanln()
		reader.ReadString('\n')
		fmt.Print(clear)
		if role == "admin" {
			processChoice("admin", user)
			return
		}
		processChoice("user", user)

	case 2:
		fmt.Println(clear)
		fmt.Println("┌─────────────────────────────┐")
		fmt.Println("│  Parola Değiştirme Ekranı   │")
		fmt.Println("├─────────────────────────────┤")
		fmt.Scanln()
		fmt.Print("Mevcut Şifrenizi Girin:")
		input, _ := reader.ReadString('\n')
		input = strings.Trim(input, " ")

		if bl := strings.Compare(input, user.Password); bl != 0 {
			fmt.Println("├─────────────────────────────┤")
			fmt.Print("Yeni Parolanızı Girin: ")
			newpass, _ := reader.ReadString('\n')
			newpass = strings.TrimSpace(newpass)
			fmt.Println("├─────────────────────────────┤")
			database.PassChange(user, newpass)
			fmt.Print(Red + "Geriye dönmek için (ENTER)" + Reset)
			fmt.Scanln()
			fmt.Println(clear)
			if role == "admin" {
				processChoice("admin", user)
				return
			}
			processChoice("user", user)

		} else {
			fmt.Println(Red + "Eski Şifreniz Yanlış!" + Reset)
			fmt.Print(Green + "Geriye dönmek için (ENTER)" + Reset)
			fmt.Scanln()
			fmt.Println(clear)
			if role == "admin" {
				processChoice("admin", user)
				return
			}
			processChoice("user", user)
		}

	}
}

func adminProcesses(choice int, user database.User) {
	reader := bufio.NewReader(os.Stdin)

	switch choice {

	case 3:
		fmt.Println(clear)
		fmt.Println("┌─────────────────────────────┐")
		fmt.Println("│  Kullanıcı Ekleme  Ekranı   │")
		fmt.Println("├─────────────────────────────┤")
		fmt.Scanln()
		fmt.Print("Yeni Kullanıcı Adı: ")
		uname, _ := reader.ReadString('\n')
		uname = strings.TrimSpace(uname)
		fmt.Println("├─────────────────────────────┤")
		fmt.Print("Yeni Kullanıcı Şifresi: ")
		pwd, _ := reader.ReadString('\n')
		pwd = strings.TrimSpace(pwd)
		fmt.Println("├─────────────────────────────┤")

		if err := database.UserAdd(uname, pwd); err != nil {
			fmt.Println(Red + "Kullanıcı Zaten Mevcut" + Reset)
			fmt.Print(Green + "Geriye dönmek için (ENTER)" + Reset)
			fmt.Scanln()
			fmt.Println(clear)
			processChoice("admin", user)
			return
		} else {
			fmt.Println(Green + "Kullanıcı Oluşturuldu!" + Reset)
			fmt.Print(Green + "Geriye dönmek için (ENTER)" + Reset)
			fmt.Scanln()
			fmt.Println(clear)
			processChoice("admin", user)
			return
		}

	case 4:
		database.GetAllUsers()
		fmt.Print("Silmek İstediğiniz Kullanıcı Adını Girin: ")
		fmt.Scanln()
		selected, _ := reader.ReadString('\n')
		selected = strings.TrimSpace(selected)

		if err := database.UserDelete(selected); err != nil {
			fmt.Println(Red + "Kullanıcı Silinemedi" + Reset)
			fmt.Print(Green + "Geriye dönmek için (ENTER)" + Reset)
			fmt.Scanln()
			fmt.Println(clear)
			processChoice("admin", user)
		}

		fmt.Println(Green + "Kullanıcı Başarıyla Silindi!" + Reset)
		fmt.Print(Green + "Geriye dönmek için (ENTER)" + Reset)
		fmt.Scanln()
		fmt.Println(clear)
		processChoice("admin", user)

	case 5:
		database.GetLogs()
		fmt.Println(Green + "Log dosya sonu" + Reset)
		fmt.Scanln()
		fmt.Print(Green + "Geriye dönmek için (ENTER)" + Reset)
		fmt.Scanln()
		fmt.Println(clear)
		processChoice("admin", user)
	}

}

func art() {
	asciiArt := `
       ___               ___         ___   ___  
 \ /  |   | |  /  |   |    /  |     |   | |   | 
  +   |-+-| | +   |   |   +   |     |-+-| |-+-  
  |   |   | |/    |   |  /    |     |   | |  \  
                   ---   ---   ---             WEB SECURITY AND DEVELOPMENT TEAM
                                               CODER:V4D3R`
	fmt.Println(Red + asciiArt + Reset)
}
