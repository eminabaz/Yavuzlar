package main

import (
	"errors"
	"fmt"
	"os"
	"time"

	"github.com/gocolly/colly"
)

var Reset = "\033[0m"
var Green = "\033[32m"
var Clear = "\033[2J"

func scrapeHackerN() {
	scrapeUrl := "https://www.thehackernews.com"

	c := colly.NewCollector(colly.AllowedDomains("www.thehackernews.com", "thehackernews.com"))

	c.OnHTML("div.body-post", func(h *colly.HTMLElement) {

		h.DOM.Find("i").Remove()
		title := h.ChildText(".home-title")

		desc := h.ChildText("div.home-desc")

		date := h.ChildText("span.h-datetime")

		result := fmt.Sprintf("Başlık: %s \n\n Açıklama: %s \n\n Tarih: %s \n\n", title, desc, date)
		result += "----------------------------------------------------\n"

		saveToFile(result)
	})

	c.Visit(scrapeUrl)
}

func clearFile() {
	file, _ := os.OpenFile("data/cikti.txt", os.O_TRUNC|os.O_CREATE|os.O_WRONLY, 0644)
	defer file.Close()
	file.WriteString(" ")
}

func saveToFile(data string) {

	file, err := os.OpenFile("data/cikti.txt", os.O_APPEND|os.O_CREATE|os.O_WRONLY, 0644)
	if errors.Is(err, os.ErrNotExist) {
		fmt.Println("Dosya bulunuamadı.")
	} else if err != nil {
		fmt.Println("Dosya açılamadı!", err)
	}
	defer file.Close()

	_, err = file.WriteString(data)

	if err != nil {
		fmt.Println("Veri yazılamadı!", err)
	}

}

func menuGoster() {
	fmt.Println("Web Scraper Uygulaması")
	fmt.Println("1. Hacker News'ten veri çek")
	fmt.Println("2. Site 2'den veri çek")
	fmt.Println("3. Site 3'ten veri çek")
	fmt.Println("4. Çıkış yap")
}

func main() {

	for {
		fmt.Println(Clear)
		menuGoster()

		var secim int
		fmt.Print("Seçim yapın: ")
		fmt.Scan(&secim)

		switch secim {
		case 1:
			clearFile()
			fmt.Println("Dosya içeriği temizleniyor bekleyin...")
			time.Sleep(10 * time.Second)
			fmt.Print(Clear)
			fmt.Println("The Hacker News'ten veri çekiliyor...")
			scrapeHackerN()
			fmt.Println(Green + "Veri Başarıyla çekildi ve data/cikti.txt dosyasına kaydedildi!" + Reset)
			time.Sleep(5 * time.Second)

		case 2:
			fmt.Println("Site 2'den veri çekiliyor...")
		case 3:
			fmt.Println("Site 3'ten veri çekiliyor...")
		case 4:
			fmt.Println("Çıkılıyor...")
			return
		default:
			fmt.Println("Geçersiz seçenek, tekrar deneyin.")
		}
	}
}
