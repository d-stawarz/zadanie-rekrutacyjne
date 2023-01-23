# Weather app
The app allows you to check current average temperature calculated from data from [openweathermap.org](https://openweathermap.org/api) and [weatherbit.io](https://www.weatherbit.io/) 

## Tech stack
1. PHP 8.2
2. MySQL 8.0
3. Symfony 6.2
4. Redis 7
5. Docker

## Instalation
1. Git clone repository to your machine
2. Go to the created directory and run command (if you are using linux run this command with sudo):
    ```
    docker-compose build
    ```
3. Start the project
    ```
    docker-compose up -d
    ```
4. Enter executable php container
    ```
    docker-compose exec php bash
    ```
5. Install dependencies
   ```
    composer install
    ```

6. Create database's tables
   ```
    php bin/console d:s:u -f
    ```
7. Create a file .env.local from .env and add credentials to it. You have to create an account at [openweathermap.org](https://openweathermap.org/api), [weatherbit.io](https://www.weatherbit.io/) and [geocode.earth](https://geocode.earth/) and get their API keys
8. Go to [http://localhost/](http://localhost/)
## Docker

### Initialize
```bash
docker-compose up -d 
```
### OR IF YOU NEED
```bash
docker-compose up -d --force-recreate
```

***

### Get access to php executable (artisan, composer, etc.) [PHP container]
```bash
docker-compose exec php bash
```