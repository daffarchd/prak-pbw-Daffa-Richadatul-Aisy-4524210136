
    1. Penjelasan Arsitektur


    A. Diagram ERD (Entity Relationship Diagram)

    B. Penjelasan Relasi Antar Tabel

    • Relasi authors ke books (One-to-Many): Satu penulis (Author) dapat menulis banyak buku (Books), tetapi satu buku hanya ditulis oleh satu penulis terdaftar. Relasi ini dijaga oleh kolom author_id di tabel books sebagai Foreign Key yang merujuk pada id di tabel authors dengan aturan penghapusan data otomatis (onDelete cascade).
    • Relasi books ke categories (Many-to-Many): Satu buku dapat memiliki lebih dari satu kategori (misalnya novel fiksi sekaligus sastra), dan satu kategori dapat menampung banyak buku yang berbeda. Relasi ini dihubungkan secara tidak langsung melalui tabel perantara (pivot) bernama category_book yang menampung kolom book_id dan category_id.

    C. Penjelasan Flow Aplikasi (Dari Request Hingga Response)

    1. Request Pengguna: Pengguna berinteraksi dengan panel admin Filament di browser (misalnya mengklik tombol simpan atau mengetik di bar pencarian).
    2. Komunikasi Livewire: Karena Filament dibangun di atas Livewire, interaksi tersebut tidak memicu reload halaman penuh. Request dikirimkan secara asynchronous (AJAX backend) ke server Laravel.
    3. Controller & Engine Filament: Internal routing Filament memproses request tersebut, lalu melakukan validasi data masukan sesuai dengan skema aturan yang telah didefinisikan pada komponen Resource (seperti maxLength atau required).
    4. Manipulasi Database (ORM Eloquent): Sistem memeriksa hak akses pengguna melalui berkas Laravel Policies (BookPolicy/AuthorPolicy). Jika diizinkan, Laravel Eloquent Model akan melakukan operasi manipulasi data (CRUD) ke file database SQLite.
    5. Render Response: Setelah database berubah, Livewire mendeteksi perubahan state, melakukan render ulang komponen HTML di server secara dinamis, dan mengirimkannya kembali ke browser dalam bentuk potongan response JSON/HTML untuk diperbarui di layar pengguna secara instan menggunakan Alpine.js dan Tailwind CSS.

    2. Perbandingan dengan Pendekatan Tradisional


    A. Perbandingan Membuat CRUD dengan Filament vs Manual

    • Filament (Deklaratif): Pembuatan CRUD dilakukan dengan mendefinisikan struktur data langsung di dalam satu berkas Resource. Kita cukup menuliskan fungsi komponen seperti TextInput::make() atau TextColumn::make(), dan framework otomatis menyusun visual form, tabel, pagination, validasi, pencarian, dan pengurutan data di backend.
    • Manual / Tradisional (Imperatif): Developer harus membangun struktur komponen satu per satu secara terpisah. Mulai dari membuat file Route, Controller khusus CRUD, berkas Form Request untuk validasi data, hingga menulis beberapa file visual Blade View (seperti index.blade.php, create.blade.php, dan edit.blade.php), serta menyusun skrip JavaScript/CSS manual untuk interaktivitas komponen tabel.

    B. Kelebihan dan Kekurangan Masing-Masing

    • Filament Panel Admin Panel:
        • Kelebihan: Kecepatan pengembangan sangat tinggi (Rapid Application Development), tampilan visual bawaan rapi dan modern out-of-the-box, ekosistem fitur manajemen bawaan sangat kaya (Widget, Policy, File Upload), dan hemat baris kode.
        • Kekurangan: Struktur tampilan antarmuka sangat terikat konvensi Filament. Cukup sulit diubah secara drastis jika aplikasi membutuhkan desain frontend yang sangat custom atau tidak standar.
    • Pendekatan Manual (Custom Build):
        • Kelebihan: Fleksibilitas tanpa batas. Developer memiliki kontrol penuh 100% terhadap arsitektur kode, performa query, alur logika, dan desain tampilan antarmuka aplikasi.
        • Kekurangan: Waktu pembuatan sangat lama, rentan terjadi kesalahan logika keamanan/validasi jika kurang teliti, serta menghasilkan banyak sekali boilerplate code (kode berulang).

    C. Kapan Sebaiknya Menggunakan Filament dan Kapan Tidak

    • Gunakan Filament untuk: Sistem manajemen internal data (Backoffice), panel admin CMS, dashboard monitoring internal perusahaan, sistem berbasis data intensif (CRUD-heavy), pembuatan purwarupa cepat (Prototype), atau produk minimum layak (MVP).
    • Jangan Gunakan Filament untuk: Situs web publik berskala umum yang mengutamakan nilai estetika keunikan desain merek dagang (seperti landing page e-commerce konsumen, portofolio interaktif, atau aplikasi web dengan UI yang sangat spesifik).
