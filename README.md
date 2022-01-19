<h1>Successfully dokerised laravel app</h1>
#### Setup:

1. Open a new instance of the terminal, navigate to the root directory of the project and execute the following command to bring all the containers up.
    ```
    $ docker-compose up -d
    ```
    The command will take a while to run, since it will download/build the images for the first time.
    After the images are ready, it will start the containers. 
    The next time you run this command it will be way faster to execute.
    
    *note: any change you make to the Dockerfile or any other file that the Dockerfile uses (excluding docker-compose.yaml) you will need to build the images again for the changes to take effect by executing the following command.*
    ```
    $ docker-compose build && docker-compose up -d
    ```

2. When all containers are up and running, enter the app container by executing the following command.
    ```
    $ docker-compose exec laravel_app bash
    ```

3. Install all composer packages included in composer.json
    ```
    $ composer install
    ```

4. Install all npm packages included in package.json
    ```
    $ npm install
    ```

5. Run all mix tasks.
   ```
   $ npm run dev
   ```

6. Create a .env file from the existing .env.example
    ```
    $ cp .env.example .env
    ```

7. Generate a Laravel App Key.
    ```
    $ php artisan key:generate
    ```
   
8. Run the database migrations.
    ```
    $ php artisan migrate
    ```

9. Modify the following fields in your .env file to use the values specified in the database container.
    ```
   DB_CONNECTION=pgsql
    DB_HOST=pgsql
    DB_PORT=5432
    DB_DATABASE=larapi2
    DB_USERNAME=larapi2
    DB_PASSWORD=larapi2
    ```

10. To access your Laravel Application visit [http://localhost:8080](http://localhost:8000)

## Watching assets for changes

If you intend to modify the assets (JS/CSS) make sure to run 
```
$ npm run watch
```
This command will continue to run in your terminal and watch relevant files for changes.

## Running Tests

To run the tests you should be inside the application container.

1. Enter the application container
    ```
    $ docker-compose exec laravel_app bash
    ```

2. Run the tests
    ```
    $ vendor/bin/phpunit
    ```

## Stopping the containers

1. Exit the app container.
    ```
    $ exit
    ```

2. Bring all the containers down.
    ```
    $ docker-compose down
    ```
   

Sehr wichtig!!! Man muss unbedingt linien zu docker-composer.yaml

extra_hosts:
- "host.docker.internal:host-gateway"

hinzufuegen!
