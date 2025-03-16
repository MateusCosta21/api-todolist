#!/bin/bash

echo "🚀 Iniciando o ambiente Docker..."
docker-compose up -d --build

echo "⌛ Aguardando o container do Laravel subir..."
sleep 10

echo "📦 Instalando dependências do Composer..."
docker exec -it laravel_app composer install

echo "⚙️ Gerando chave da aplicação..."
docker exec -it laravel_app php artisan key:generate

echo "📂 Rodando migrations..."
docker exec -it laravel_app php artisan migrate

echo "🌱 Rodando o seeder TaskSeeder..."
docker exec -it laravel_app php artisan db:seed --class=Database\\Seeders\\TaskSeeder

echo "✅ Ambiente pronto! Acesse http://localhost:8000"
