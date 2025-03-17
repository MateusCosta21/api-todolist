#!/bin/bash

# Função para verificar se o comando foi bem-sucedido
check_success() {
  if [ $? -ne 0 ]; then
    echo "❌ Ocorreu um erro. Abortando o processo."
    exit 1
  fi
}

echo "⚙️ Copiando as variaveis de ambiente..."
cp .env.example .env
check_success

echo "🚀 Iniciando o ambiente Docker..."
docker compose up -d --build
check_success

echo "⌛ Aguardando o container do Laravel subir..."


echo "📦 Instalando dependências do Composer..."
docker compose exec app composer install
check_success

echo "⚙️ Gerando chave da aplicação..."
docker compose exec app php artisan key:generate -q
docker compose exec app php artisan j:s -f 
check_success


echo "📂 Rodando migrations..."
docker compose exec app php artisan migrate --force
check_success

echo "🌱 Rodando o seeder TaskSeeder..."
docker compose exec app php artisan db:seed --class=Database\\Seeders\\TaskSeeder --force
check_success

echo "⚙️ configurando permissões"
docker compose restart
check_success

sleep 20
echo "✅ Ambiente pronto! Acesse http://localhost:8000"
