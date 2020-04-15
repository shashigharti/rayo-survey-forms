## How to install
1. composer install 
2. npm install
3. git submodule init
4. git submodule update

## Env
5. cp .env.example .env
6. Update database name and password in .env

## Migration and Seeding
7. php artisan robust:migrate-all

## Reset Permission for the default user
8. php artisan robust:reset-permission


## Reset menu and urls for the menus
9. php artisan robust:reset-menu  (update url in .env file before running this menu)

## Compile js and css
10. gulp
