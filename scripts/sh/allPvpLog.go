package main

import (
	"bufio"
	"fmt"
	"log"
	"os"
	"os/exec"
	"strings"
)

func main() {
	pwPath := "/home"
	blockSize := 1000000 // 100MB em bytes

	// Abrir o arquivo para leitura
	file, err := os.Open(fmt.Sprintf("%s/logs/world2.formatlog", pwPath))
	if err != nil {
		log.Fatalf("Erro ao abrir o arquivo: %v", err)
	}
	defer file.Close()

	// Obter informações do arquivo para contar o número total de linhas
	fileInfo, err := file.Stat()
	if err != nil {
		log.Fatalf("Erro ao obter informações do arquivo: %v", err)
	}
	totalLines := 0

	// Calcular o número total de blocos
	totalBlocks := int(fileInfo.Size()) / blockSize

	fmt.Printf("Iniciando processamento do arquivo world2.formatlog com %d blocos...\n", totalBlocks)

	// Processar o arquivo em blocos de 100MB
	buffer := make([]byte, blockSize)
	scanner := bufio.NewScanner(file)
	for i := 0; i < totalBlocks; i++ {
		// Ler um bloco do arquivo
		_, err := file.Read(buffer)
		if err != nil {
			break
		}

		// Processar o bloco
		scanner.Split(bufio.ScanLines)
		for scanner.Scan() {
			line := scanner.Text()

			if strings.Contains(line, "type=258:attacker") || strings.Contains(line, "type=2:attacker") {
				matouParts := strings.Split(line, "attacker=")
				if len(matouParts) < 2 {
					continue
				}
				matouID := strings.Split(matouParts[1], ":")[0]

				fmt.Println("")
				fmt.Println("Kill:", line)
				// Extrair o ID da vítima
				morreuParts := strings.Split(line, "die:roleid=")
				if len(morreuParts) < 2 {
					continue
				}
				morreuID := strings.Split(morreuParts[1], ":")[0]
				// Executar o comando PHP
				cmd := exec.Command("php", "../index.php", "competitivo", "salvar_kill", matouID, morreuID)

				err := cmd.Start()
				if err != nil {
					log.Fatalf("Erro ao iniciar o comando PHP: %v", err)
				}
			}

			totalLines++
			progress := (totalLines * 100) / (int(fileInfo.Size()) / blockSize)
			fmt.Printf("\rProcessando linha %d/%d (%d%%)...", totalLines, totalBlocks*blockSize, progress)
		}

		// Limpar o buffer
		for i := range buffer {
			buffer[i] = 0
		}
	}

	if err := scanner.Err(); err != nil {
		log.Fatalf("Erro ao ler o arquivo: %v", err)
	}

	fmt.Println("\nProcessamento do arquivo world2.formatlog concluído.")
}
