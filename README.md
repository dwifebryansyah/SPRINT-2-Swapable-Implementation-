Cara Install:
    1.  Clone terlebih dahulu repository ini
    2.  Composer Update di Command Prompt
    3.  Nyalakan Apache sama Mysql XAMPP
    4.  Buat Database:
            4.1 Buka pada Browser localhost/phpmyadmin
            4.2 Buka SQL Lalu perintahkan : Create database namadatabase
    5.  Masuk ke folder yang sudah di clone tadi, terus buka file .env
    6.  isi DB_DATABASE dengan database yang sudah dibikin tadi
        contoh DB_DATABASE=DOT_Sprint_Dwi
    7.  Untuk username sama password isi apabila saat masuk mysql memang ada username sama passwordnya , kalo tidak ada biarkan saja
    8.  Apabila sudah semua, buka Command Prompt dan arahkan ke folder yang sudah diclone tadi lalu jalankan
        php artisan migrate:fresh  --seed
    9.  Otomatis nanti table sudah terbuat dengan migrate
    10. Setelah itu buka file RunApi tunggu sampai ada tulisan started, dan biarkan jangan di close
    11. Untuk melakukan pengecekan API silahkan Import Collection dengan link : https://www.getpostman.com/collections/5920e4dab3f0277ff8fe
    12. Setelah berhasil import, buka folder dot dan ada beberapa request, langkah pertama masuk ke folder Auth dan jalankan perintah Register
    13. Setelah melakukan Register lanjut ke login , result dari login ada apiToken , silahkan COPY apiToken tersebut
    15. Untuk melakukan fetching data Province , klik RunFetchingProvince , pastikan sudah jalan RunApinya
    14. Untuk melakukan fetching data City, klik RunFetchingCities , pastikan sudah jalan RunApinya , pastikan setelah RunFetchingProvince
    16. Lihat di database yang sudah dibikin tadi , otomatis table Province sama City sudah terisi
        atau bisa dilihat dengan membuka browser , lalu ketik:

        Untuk Melihat Province keseluruhan klik request Search Provinsi di postman
            url     : http://localhost:8000/api/search/province
            terus masuk ke menu header lalu copykan ApiToken yang sudah dicopy tadi lalu paste kan di Authorization dengan format 'bearer initokenyangdicopy'
            apabila anda belum login , authorization formatnya tidak sesuai, atau apiTokennya salah akan muncul result error 

        Untuk Melihat Province satuan klik request Search Provinsi di postman: 
            url     : http://localhost:8000/api/search/province?id=5
            terus masuk ke menu header lalu copykan ApiToken yang sudah dicopy tadi lalu paste kan di Authorization dengan format 'bearer initokenyangdicopy'
            apabila anda belum login , authorization formatnya tidak sesuai, atau apiTokennya salah akan muncul result error 

        Untuk Melihat City keseluruhan klik request Search City di postman: 
            url     : http://localhost:8000/api/search/cities
            terus masuk ke menu header lalu copykan ApiToken yang sudah dicopy tadi lalu paste kan di Authorization dengan format 'bearer initokenyangdicopy'
            apabila anda belum login , authorization formatnya tidak sesuai, atau apiTokennya salah akan muncul result error 

        Untuk Melihat City satuan klik request Search City di postman:
            url     : http://localhost:8000/api/search/cities?id=5
            terus masuk ke menu header lalu copykan ApiToken yang sudah dicopy tadi lalu paste kan di Authorization dengan format 'bearer initokenyangdicopy'
            apabila anda belum login , authorization formatnya tidak sesuai, atau apiTokennya salah akan muncul result error 
    17. Untuk melakukan Unit Test anda bisa jalankan di Command Prompt:
        .\vendor\bin\phpunit
        nanti otomatis register user, bisa di cek didatabase
    18. Cukup sekian tutorial yang bisa saya sampaikan , apabila ada pertanyaan bisa hubungi saya 
        email: dwifebryansyah5@gmail.com
        notelp: 082258130886