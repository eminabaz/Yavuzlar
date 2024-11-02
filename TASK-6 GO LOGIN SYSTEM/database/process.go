package database

import (
	"encoding/json"
	"errors"
	"fmt"
	"os"
	"sync"
	"time"
)

// renk
var Red = "\033[31m"
var Green = "\033[32m"
var Reset = "\033[0m"

var (
	users = make(map[string]User)
	mutex = &sync.Mutex{}
	dosya = "database/users.json"
)

type User struct {
	Username string
	Password string
	Role     string
}

func LoadUser() error { //users dosyasında bulunan verileri çekecek ve geçici olan boş Map'e aktaracak.
	data, err := os.ReadFile(dosya)
	if err != nil {
		if os.IsNotExist(err) {
			fmt.Println("Dosya Bulunamadı.")
			return err //dosya yoksa
		}
		return err
	}
	return json.Unmarshal(data, &users)
}

func PushDB() error {
	mutex.Lock()
	defer mutex.Unlock()

	data, err := json.MarshalIndent(users, "", "    ")
	if err != nil {
		fmt.Print("HATA! Veri Json Formatına Çevrilemedi.")
		return err
	}

	return os.WriteFile(dosya, data, 0644) // 0644 yazma izni
}

func Check(username, password string) (User, bool) {
	LoadUser()
	user, ext := users[username]

	if ext != true || user.Password != password {
		fmt.Print(Red + "Giriş başarısız" + Reset)
		logging("err", user.Username)
		return User{}, false
	}
	logging("success", user.Username)
	return user, true
}

func PassChange(user User, password string) {
	LoadUser()
	user = users[user.Username]
	user.Password = password
	users[user.Username] = user
	err := PushDB()

	if err != nil {
		fmt.Println(Red + "HATA! Şifre değiştirilemedi." + Reset)
		return
	}

	fmt.Print(Green + "Şifreniz Değiştirildi!" + Reset)

}

func UserAdd(username, pwd string) error {

	LoadUser()
	if isUserExist(username) {
		return errors.New("exists")
	}
	users[username] = User{username, pwd, "user"}
	if err := PushDB(); err != nil {
		fmt.Println(Red + "HATA: Kullanıcı Oluşturuldu, Database'e eklenemedi! proccess.go/line91" + Reset)
	}
	return nil

}

func UserDelete(username string) error {

	if !isUserExist(username) {
		fmt.Println("Mevcut Olmayan Bir kullanıcı Silinemez!")
		return errors.New("UserNotExists")
	}
	delete(users, username)
	err := PushDB()
	if err != nil {
		return err
	}
	return nil
}

func GetAllUsers() {
	LoadUser()
	fmt.Println("┌─────────────────────────────┐")
	fmt.Println("│         Bütün Kullanıcılar  │")
	fmt.Println("├─────────────────────────────┤")
	for key, value := range users {

		if value.Role == "admin" {
			continue
		}
		fmt.Printf("Kullanıcı: %s, Rolü: %v\n", key, value.Role)
	}
	fmt.Println("├─────────────────────────────┤")
}

func isUserExist(username string) bool {
	_, exist := users[username]
	return exist

}

func logging(durum, username string) {
	mutex.Lock()
	defer mutex.Unlock()

	loc, _ := time.LoadLocation("Europe/Istanbul")
	now := time.Now().In(loc)
	tarihFormat := now.Format("02-01-2006 15:04:05")

	data, _ := os.ReadFile("log/login.txt")
	switch durum {
	case "success":
		data := string(data) + "\n" + tarihFormat + " " + username + " Kullanıcısına Giriş Başarılı."
		os.WriteFile("log/login.txt", []byte(data), 0644)
	case "err":
		data := string(data) + "\n" + tarihFormat + " " + username + " Kullanıcısına Giriş Başarısız."
		os.WriteFile("log/login.txt", []byte(data), 0644)
	default:
		fmt.Println("HATA! database.go line 100")
	}

}

func GetLogs() {
	data, err := os.ReadFile("log/login.txt")

	if err != nil {
		fmt.Println("HATA! Log Dosyası okunamadı!")
		return
	}

	fmt.Print(string(data))

}
