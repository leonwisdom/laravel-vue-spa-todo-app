# Laravel, Inertia + Vue and Sail

Simpe To-Do CRUD app writen using Laravel, Inertia + Vue and Sail

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
Rename .env.example to .env and add configs

## Usage

```node
# Start server
php artisan serve

# Start vite
yarn dev
```

## Sail

```node
# run sail
./vendor/bin/sail up

# stop sail
./vendor/bin/sail stop
```

Running the sail up command will start a fresh migrate, seed the database, 
serve and start the vite dev server

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)