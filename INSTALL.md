# CARA INSTALASI APLIKASI

## Requirement :
1. Web server & mySQL server (XAMPP)
2. PHP 7.4 atau lebih
3. Extensions PHP (intl, libcurl, mbstring, json, xml, mysqlnd)
   - Buka file php.ini (bisa lewat XAMPP control panel, klik config di bagian apache)
   - cari baris extension (aktifkan extensi intl (ada tanda ; didepan jika blm aktif))
4. Import DB
   - Buat database dg nama bebas
   - import database
5. Edit file configurasi (.env)
   - edit database sesui dg nama database yg dibuat
   - edit username sesuaikan dg username database (root : bawaan XAMPP)
   - edit password jika ada


## Ada 2 cara untuk menjalankan aplikasi ini :
1. Cara Biasa
   - Harus meletakan folder aplikasi di folder htdocs (xampp)
   - Edit file “app/Config/App.php”
   - Akses aplikasi dg “localhost/{namafolder}/public”

2. Menggunakan cmd (memanfaatkan file spark)
   - Letakan folder aplikasi dimana saja
   - buka cmd, arahkan root-nya ke folder app
   - jalankan perintah “php spark serve”
   - akses aplikasi “localhost:8080”