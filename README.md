# Laravel 11 - Project Perpustakaan Digital

Aplikasi **Perpustakaan Digital** yang dibangun menggunakan Laravel 11. Aplikasi ini memungkinkan pengguna untuk mengelola data buku, anggota, dan transaksi peminjaman.

## Software install

Pastikan sudah menginstal perangkat lunak berikut di lokal sistem :

-   **PHP >= 8.2**
-   **Composer**
-   **MySQL**

## Instalasi

1. **Clone repository** :

    ```cmd
    git clone https://github.com/feryndka/perpustakaan-digital.git
    cd perpustakaan-digital
    ```

2. **Install dependencies with composer** :

    ```cmd
    composer install
    ```

3. **Copy file `.env` dari template `.env.example`** :

    ```cmd
    cp .env.example .env
    ```

4. **Generate application key**:
    ```cmd
    php artisan key:generate
    ```

## Konfigurasi Database

-   **Buka file `.env` dan sesuaikan pengaturan database**:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=perpustakaan_digital
    DB_USERNAME=root
    DB_PASSWORD=
    ```

## How to run project

-   php artisan serve
-   php artisan migrate:fresh --seed
-   run database mysql
