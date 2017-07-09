How to start project locally?
-------
1. Clone this repo
2. Run
```shell
composer install
```
3. Copy .env.example .env if using cmd
4. Run 
```shell
php artisan key:generate
```
5. Open your .env file and change the database settings
6. Run
```shell
php artisan migrate
```