# 📦 Laravel 12 + Livewire Starter Kit

Project ini menggunakan **Laravel 12** dengan **Livewire (Volt + Flux)**

---

## 🚀 Requirement

* PHP >= 8.2
* Composer
* Node.js & NPM
* Database (MySQL / SQLite / PgSQL)

---

## 📥 Cara Install (Setelah Clone / Download ZIP)

### 1. Clone Repository / Extract ZIP

```bash
git clone <repo-url>
cd nama-project
```

---

### 2. Install Dependency PHP

```bash
composer install
```

---

### 3. Setup Environment

Copy file `.env`:

```bash
cp .env.example .env
```

Generate app key:

```bash
php artisan key:generate
```

---

### 4. Konfigurasi Database

Edit file `.env` lalu sesuaikan:

```
DB_DATABASE=nama_db
DB_USERNAME=root
DB_PASSWORD=
```

---

### 5. Migrasi Database & Seedernya

```bash
php artisan migrate
php artisan db:seed
```

---

### 6. Install Dependency Frontend

```bash
npm install
```

---

### 8. Build Vite

```bash
npm run build
```

---

### 9. Jalankan Server

```bash
php artisan serve
```

Akses di browser:

```
http://127.0.0.1:8000
```

---

## ⚙️ Menjalankan Semua Service Sekaligus (dev mode)

```bash
composer run dev
```
