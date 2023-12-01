# Laravel, Inertia + Vue, Breeze and Sail

Simpe To-Do CRUD app

## Project

```bash
git clone git@gitlab.com:leonwisdom/laravel-vue-spa-todo-app.git
cd laravel-vue-spa-todo-app
```

## Installation

```bash
composer install && yarn install 
```

I was using the package manager [yarn](https://yarnpkg.com/) to install dependancies.

## Config
Make the .env file
```
cp .env.example .env
```

## Run Sail
Running the sail up command will start the artisan serve command and the vite dev server.
```node
# run sail
./vendor/bin/sail up

# run migration
./vendor/bin/sail artisan migrate:fresh

# run seeders
./vendor/bin/sail artisan db:seed
```
A default user will be created for you incase you dont want to register, the login details are:
```
email: example@example.com
password: example
```

## Access Mailpit
The mailpit interface will be available at the following address: 
```
http://localhost:8025
```
## Stop Sail

```
./vendor/bin/sail stop
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)