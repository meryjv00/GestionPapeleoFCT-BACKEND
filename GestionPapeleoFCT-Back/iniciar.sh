echo 'Iniciando el servicio...'

#Copia el archivo .env
cp .env.example .env

#Instala las dependencias necesarias
#composer install

#Construye los contenedores
docker-compose down
docker-compose build
docker-compose up -d

#Instala composer
echo '--------------------------INSTALANDO COMPOSER------------------------'
docker exec api_laravel_fct php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
docker exec api_laravel_fct php composer-setup.php --install-dir=/usr/local/bin --filename=composer
docker exec api_laravel_fct php -r "unlink('composer-setup.php');"

#Actualiza las dependencias
echo '-------------------------ACTUALIZANDO DEPENDENCIAS------------------------'
docker exec api_laravel_fct composer update

#Cambia los permisos y genera la clave
docker exec api_laravel_fct chmod 777 -R .
#docker exec api_laravel php artisan key:generate

#Inicia la bd
echo '-------------------------INICIANDO BD------------------------'
#docker exec api_laravel php artisan migrate
#docker exec api_laravel php artisan db:seed
#docker exec api_laravel php artisan passport:client --personal
#docker exec api_laravel php artisan passport:install