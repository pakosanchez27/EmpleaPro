# EmpleaPro - Fase 1: Fundaciones del sistema

## 1. Descripción técnica
EmpleaPro es una aplicación web desarrollada con Laravel para gestionar el sistema base de usuarios, autenticación, roles y estructura inicial del proyecto.

## 2. Requisitos del entorno
- PHP: 8.3.28
- Composer: 2.9.5
- Laravel: 13.8
- MySQL: 8.4.7
- Node.js: v25.7.0
- NPM: 11.10.1

## 3. Instalación local

```bash
git clone URL_DEL_REPO
cd empleapro
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```
## 4. Comfiguracion de base de datos

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=empleapro
DB_USERNAME=root
DB_PASSWORD=

## 5. comandos principales
php artisan serve
php artisan migrate
php artisan migrate:fresh
php artisan make:model Nombre -m
php artisan make:controller NombreController