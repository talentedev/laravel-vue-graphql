# Scoleia Web App

## Ports

Ports used in the project:
| Software | Port |
|-------------- | -------------- |
| **nginx** | 8080 |
| **phpmyadmin** | 8081 |
| **mysql** | 3306 |
| **php** | 9000 |
| **xdebug** | 9001 |
| **redis** | 6379 |

## Use

To get started, make sure you have [Docker installed](https://docs.docker.com/) on your system and [Docker Compose](https://docs.docker.com/compose/install/), and then clone this repository.

1. Clone this project:

   ```sh
   git clone https://github.com/talentedev/scoleia.git
   ```

2. Inside the folder `scoleia` and Generate your own `.env` to docker compose with the next command:

   ```sh
   cp .env.example .env
   ```

3. Run the project whit the next commands:

   ```sh
   docker-compose up
   ```

---

## Remember

The configuration of the database **must be the same on both sides** .

```dotenv
# .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=db_user
DB_PASSWORD=db_password
DB_ROOT_PASSWORD=secret
```

```dotenv
# source/.env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=db_user
DB_PASSWORD=db_password
```

The only change is the `DB_HOST` in the `source/.env` where is called to the container of `mysql`:

```dotenv
# source/.env
DB_HOST=mysql
```

---

## Special Cases

To Down the volumes we use the next command:

```sh
docker-compose down
```

Install Composer:

```sh
docker-compose run composer install
```

Run compiler (Webpack.mix.js) or Show the view compiler in node:

```sh
docker-compose run npm run dev
```

Run all migrations:

```sh
docker-compose run artisan migrate
```

Seed database:

```sh
docker-compose run artisan db:seed
```
