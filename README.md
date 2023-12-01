# Laravel, Inertia + Vue, Breeze and Sail

Simpe To-Do CRUD app

## Get project

```bash
git clone git@gitlab.com:leonwisdom/laravel-vue-spa-todo-app.git
cd laravel-vue-spa-todo-app
```

## Installation

```bash
composer install && yarn install 
```

I was using the package manager [yarn](https://yarnpkg.com/) to install dependancies.

## Add config
Rename .env.example to .env

## Running sail
Running the sail up command will start the artisan serve command and the vite dev server.
```node
# run sail
./vendor/bin/sail up

# run migration
./vendor/bin/sail artisan migrate:fresh

# run seeders
./vendor/bin/sail artisan db:seed
```

## Accessing mailpit
The mailpit interface will be available at the following address: 
```
http://localhost:8025
```
## Stopping sail

```
./vendor/bin/sail stop
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)