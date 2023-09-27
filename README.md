<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## About project

this is the laravel-management-api project for making science sweeft Acceleration program, this project contains crud operations of book, search of them and additionally i make authorization functionality.



### Used packages

- **[Sanctum for authorization](https://laravel.com/docs/10.x/sanctum)**
- **[Pest for testing](https://pestphp.com/)**
- **[Pint for code formatting](https://laravel.com/docs/10.x/pint)**
- **[Spatie Query Builder for filters](https://spatie.be/docs/laravel-query-builder/v5/installation-setup)**


### Project setup

```bash
cp .env.example .env
```
```bash
composer install
```
```bash
php artisan key:generate
```
```bash
php artisan migrate:fresh --seed
```
```bash
php artisan serve
```
### Running tests

```bash
php artisan test
```

### See available routes

```bash
php artisan route:list
```

