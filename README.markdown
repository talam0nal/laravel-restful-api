1. Clone this repo
2. Run
```shell
composer install
```
3. Copy .env.example to .env
4. Run 
```shell
php artisan key:generate
```
5. Open your .env file and change the database settings
6. Run
```shell
php artisan migrate
```
7. Generate JWT secret key
```shell
php artisan jwt:generate
```
