# How to set up and run the project

- Install Docker Desktop. See https://laravel.com/docs/8.x/installation for details.

- Change working directory to project dir.

- Set up sail dependencies:

  ```shell
  docker run --rm \
      -v $(pwd):/opt \
      -w /opt \
      laravelsail/php80-composer:latest \
      composer install
  ```

  See https://laravel.com/docs/8.x/sail#installing-composer-dependencies-for-existing-projects for details.

- Run the docker container:

  ```shell
  vendor/bin/sail up
  ```

- Connect to MySQL container shell:

  ```shell
  vendor/bin/sail exec mysql bash
  ```

- Inside that shell, create the database:

  ```shell
  mysql --password= --execute='create database laratale'
  exit
  ```

- Connect to Laravel container shell:

  ```shell
  vendor/bin/sail bash
  ```

- Copy `.env` file:

  ```shell
  cp .env.example .env
  ```

- Generate application key:

  ```shell
  php artisan key:generate
  ```

- Seed the database:

  ```shell
  php artisan migrate:fresh --seed
  ```

- Visit the site on host machine: http://localhost
