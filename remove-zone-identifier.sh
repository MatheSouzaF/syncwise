#!/bin/bash

# Caminho do diretório do projeto
PROJECT_PATH="."

# Listar todos os arquivos para verificação
echo "Listando todos os arquivos no diretório..."
find "$PROJECT_PATH" -type f -exec ls -l {} +

# Encontra e remove os arquivos com :Zone.Identifier
echo "\nProcurando e removendo arquivos :Zone.Identifier..."
for file in $(find "$PROJECT_PATH" -type f); do
  if [[ "$file" == *":Zone.Identifier" ]]; then
    rm -f "$file"
    echo "Removido: $file"
  fi
done

echo "Processo concluído."
