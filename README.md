## Cara Menjalankan Project (tanpe Docker)
- pastikan sudah menginstall Composer
- jalankan command `composer install` pada root directory
- copy `.env.example` ke file `.env` kemudian sesuaikan semua env variable di dalamnya termasuk setting Databse
- jalankan command `php artisan key:generate` 
- jalankan command `php artisan jwt:secret` 
- jalankan command `php artisan cache:clear` 
- jalankan command `php artisan config:clear` 
- jalankan command `php artisan migrate`
- jalankan command `php artisan db:seed`
- jalankan command `php artisan serve` untuk menjalankan local server misal pada `http://localhost:8000/`

### Credential
bisa login menggunakan email: `a@a.com` dan password: `password` sebagai Admin. Atau bisa register sebagai Pasien baru