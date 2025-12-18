# EasyNote 📝

**EasyNote** adalah aplikasi manajemen produktivitas berbasis web yang dibangun dengan **Laravel 12**. Aplikasi ini membantu Anda mencatat ide, mengatur jadwal kegiatan, dan memantau tugas harian dengan efisien, dilengkapi fitur notifikasi otomatis ke **Telegram** setiap pagi.

![EasyNote Preview](https://github.com/tunggulalmajid/EasyNote/blob/main/Screenshot%202025-12-19%20043502.png)

![EasyNote Preview](https://github.com/tunggulalmajid/EasyNote/blob/main/Screenshot%202025-12-19%20043519.png)

![EasyNote Preview](https://github.com/tunggulalmajid/EasyNote/blob/main/Screenshot%202025-12-19%20043529.png)


## 🚀 Fitur Utama

### 1. 📒 Manajemen Catatan (Notes)
- **Rich Text Editor:** Menggunakan **CKEditor 5 (Super Build)** dengan dukungan *formatting* lengkap.
- **Responsive:** Editor menyesuaikan layar HP dan Desktop tanpa *scroll* horizontal.
- **Dark Mode Native:** Antarmuka gelap yang nyaman di mata.

### 2. 📅 Jadwal Kegiatan (Schedule)
- Mengatur agenda harian berdasarkan tanggal dan waktu.
- Filter otomatis untuk melihat kegiatan hari ini.
- Visualisasi waktu dengan indikator warna.

### 3. ✅ Daftar Tugas (Task List)
- Manajemen tugas dengan **Deadline**.
- **Indikator Urgensi:** Icon warna berubah otomatis (🔴 Terlewat, 🟡 Hari ini/Besok, 🟢 Masih Lama).
- Pengelompokan berdasarkan kategori.

### 4. 🤖 Integrasi Telegram Bot (Fitur Unggulan)
- **Webhook Integrasi:** Bot otomatis membalas dan menyimpan Chat ID pengguna saat user mengetik `/start`.
- **Morning Briefing:** Server mengirim notifikasi otomatis setiap jam **07:00 WIB** berisi:
  - Jadwal kegiatan hari ini.
  - Daftar tugas yang *deadline*-nya sudah dekat atau terlewat.

## 🛠️ Teknologi yang Digunakan

- **Backend:** Laravel 12 ⚡
- **Frontend:** Blade Templates, Tailwind CSS
- **Interaktivitas:** Alpine.js
- **Database:** MySQL
- **Editor:** CKEditor 5
- **Icons:** Lucide Icons
- **API:** Telegram Bot API

## 📋 Persyaratan Sistem

Pastikan server Anda memenuhi syarat untuk Laravel 12:
- **PHP** >= 8.2
- **Composer**
- **Node.js** & **NPM**

## ⚙️ Cara Instalasi (Localhost)

Ikuti langkah ini untuk menjalankan project di komputer Anda:

1.  **Clone Repository**
    ```bash
    git clone [https://github.com/username/easynote.git](https://github.com/username/easynote.git)
    cd easynote
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install && npm run build
    ```

3.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env`:
    ```bash
    cp .env.example .env
    ```
    Atur koneksi database dan timezone di `.env`:
    ```ini
    DB_DATABASE=easynote_db
    DB_USERNAME=root
    DB_PASSWORD=
    
    # Setting Timezone Wajib (Agar Cron Job Akurat)
    APP_TIMEZONE='Asia/Jakarta'
    ```

4.  **Generate Key & Migrate**
    ```bash
    php artisan key:generate
    php artisan migrate
    ```

5.  **Jalankan Server**
    ```bash
    php artisan serve
    ```

## 🤖 Konfigurasi Telegram Bot

Agar fitur notifikasi berjalan, Anda perlu membuat bot di Telegram:

1.  Chat dengan **@BotFather** di Telegram, buat bot baru, dan dapatkan **API Token**.
2.  Masukkan token ke file `.env`:
    ```ini
    TELEGRAM_BOT_TOKEN=123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11
    ```
3.  **Set Webhook (PENTING):**
    Agar bot bisa membalas chat secara otomatis, Anda harus mendaftarkan URL project Anda (harus HTTPS / Hosting Publik / Ngrok):
    
    Buka browser dan akses:
    `https://api.telegram.org/bot<TOKEN_ANDA>/setWebhook?url=https://domain-anda.com/telegram/webhook`

## ⏰ Konfigurasi Otomatisasi (Cron Job)

Fitur notifikasi pagi (`notify:morning`) berjalan otomatis menggunakan Laravel Scheduler.

### Jika di Server Hosting (cPanel):
Tambahkan entri berikut pada menu **Cron Jobs** di cPanel:

* **Schedule:** `* * * * *` (Once Per Minute)
* **Command:**
    ```bash
    cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
    ```

### Cara Tes Manual:
Anda bisa memaksa pengiriman notifikasi sekarang juga melalui terminal:
```bash
php artisan notify:morning
