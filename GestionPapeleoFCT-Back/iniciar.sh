echo 'Iniciando el servicio...'

#Instala las dependencias necesarias
composer install

#Construye los contenedores
docker-compose down
docker-compose build
docker-compose up -d

#Inicia la bd
docker exec api_laravel php artisan migrate
docker exec api_laravel php artisan db:seed