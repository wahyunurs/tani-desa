# 🌾 Tani Desa - Sistem Manajemen Distribusi Barang Pertanian

![Tani Desa Logo](public/images/tani-desa.png)

**Tani Desa** adalah sistem manajemen distribusi barang pertanian berbasis web yang dirancang untuk memudahkan pengelolaan dan distribusi pupuk, bibit, dan obat pertanian dari gudang ke petani melalui jaringan distributor. Sistem ini dibangun menggunakan Laravel 11 dengan desain yang responsive dan user-friendly.

## 🚀 Fitur Utama

### 👤 Multi-Role Management

-   **Admin**: Mengelola pengguna, stok barang, distribusi, dan laporan
-   **Gudang**: Mengelola inventori dan stok barang
-   **Distributor**: Mengelola distribusi barang ke petani
-   **Petani**: Mengajukan permintaan barang pertanian

### 📦 Manajemen Inventori

-   **Stok Barang**: CRUD lengkap dengan upload foto produk
-   **Kategori Barang**: Pupuk, Bibit, dan Obat pertanian
-   **Real-time Stock Tracking**: Monitoring stok secara real-time
-   **Multi-unit Support**: Kg, Liter, dan Pcs

### 📊 Sistem Pelaporan

-   **Audit Trail**: Tracking lengkap semua transaksi barang
-   **Laporan Masuk-Keluar**: Monitoring pergerakan barang
-   **Export PDF**: Generate laporan dalam format PDF
-   **Dashboard Analytics**: Visualisasi data untuk setiap role

### 🗺️ Geographic Coverage

-   **Multi-Desa**: Support untuk multiple desa/wilayah
-   **Location-based Service**: Layanan berdasarkan lokasi geografis
-   **Service Availability**: Conditional content berdasarkan ketersediaan layanan

## 🛠️ Tech Stack

### Backend

-   **Framework**: Laravel 11.x
-   **PHP**: ^8.2
-   **Database**: SQLite/MySQL
-   **Authentication**: Laravel Breeze
-   **PDF Generation**: DomPDF

### Frontend

-   **CSS Framework**: Tailwind CSS 3.x
-   **JavaScript**: Alpine.js
-   **UI Components**: Flowbite
-   **Icons**: Heroicons
-   **Build Tool**: Vite

### Development Tools

-   **Testing**: Pest PHP
-   **Code Quality**: Laravel Pint
-   **Package Manager**: Composer & NPM

## 📋 Persyaratan Sistem

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   SQLite/MySQL Database
-   Web Server (Apache/Nginx)

## ⚡ Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/wahyunurs/tani-desa.git
cd tani-desa
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup

```bash
# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed
```

### 5. Storage Link

```bash
# Create storage link for file uploads
php artisan storage:link
```

### 6. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Run Application

```bash
# Start development server
php artisan serve
```

## 👥 Default User Accounts

Setelah menjalankan seeder, Anda dapat login dengan akun berikut:

| Role        | Email                    | Password | Desa       |
| ----------- | ------------------------ | -------- | ---------- |
| Admin       | admin@tanidesa.com       | password | -          |
| Gudang      | gudang@tanidesa.com      | password | Sukamakmur |
| Distributor | distributor@tanidesa.com | password | Sukamakmur |
| Petani      | petani@tanidesa.com      | password | Sukamakmur |

## 📁 Struktur Proyek

```
tani-desa/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/           # Admin controllers
│   │   ├── Gudang/          # Warehouse controllers
│   │   ├── Distributor/     # Distributor controllers
│   │   └── Petani/          # Farmer controllers
│   └── Models/              # Eloquent models
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/             # Database seeders
├── resources/
│   ├── views/
│   │   ├── admin/           # Admin views
│   │   ├── gudang/          # Warehouse views
│   │   ├── distributor/     # Distributor views
│   │   └── petani/          # Farmer views
│   └── js/                  # JavaScript assets
└── public/
    └── images/              # Static images
```

## 🔄 Workflow Sistem

### 1. Manajemen Stok

```
Admin/Gudang → Input Barang → Update Stok → Generate Laporan Masuk
```

### 2. Permintaan Petani

```
Petani → Request Barang → Validasi Stok → Update Inventory → Generate Laporan Keluar
```

### 3. Distribusi Barang

```
Distributor → Terima Permintaan → Proses Distribusi → Update Status → Selesai
```

## 📊 Fitur Database

### Tables Utama:

-   **users**: Multi-role user management
-   **stok_barangs**: Inventory management
-   **permintaan_barangs**: Request management
-   **distribusi_barangs**: Distribution tracking
-   **laporans**: Transaction audit trail

### Relationships:

-   User → StokBarang (One to Many)
-   StokBarang → PermintaanBarang (One to Many)
-   PermintaanBarang → DistribusiBarang (One to One)
-   StokBarang → Laporan (One to Many)

## 🎨 UI/UX Features

-   **Responsive Design**: Mobile-first approach
-   **Dark Mode Ready**: Consistent color scheme
-   **Interactive Modals**: CRUD operations with modals
-   **Real-time Filtering**: Auto-submit filters
-   **File Upload**: Image upload with validation
-   **Password Toggle**: Enhanced login experience
-   **Conditional Content**: Service availability display

## 🔧 Konfigurasi

### File Upload

-   **Max Size**: 5MB untuk foto produk
-   **Formats**: JPEG, PNG, JPG
-   **Storage**: Local storage dengan symlink

### Pagination

-   **Default**: 10 items per page
-   **Customizable**: Dapat disesuaikan per module

### Security

-   **Authentication**: Session-based
-   **Authorization**: Role-based access control
-   **CSRF Protection**: Enabled untuk semua forms
-   **File Validation**: Strict validation untuk uploads

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage
```

## 📈 Performance

-   **Eager Loading**: Optimized database queries
-   **Asset Optimization**: Minified CSS/JS
-   **Image Optimization**: Lazy loading untuk gambar
-   **Caching**: Query result caching

## 🔒 Security Features

-   **Input Validation**: Comprehensive form validation
-   **SQL Injection Protection**: Eloquent ORM
-   **XSS Protection**: Blade templating
-   **File Upload Security**: Type and size validation
-   **Role-based Access**: Middleware protection

## 🌐 Deployment

### Production Checklist:

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false`
3. Configure proper database credentials
4. Run `php artisan optimize`
5. Set up proper web server configuration
6. Configure SSL certificate
7. Set up backup strategy

## 🤝 Contributing

1. Fork repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

## 📝 License

Distributed under the MIT License. See `LICENSE` file for more information.

## 📧 Contact

**Developer**: Wahyu Nursalam  
**Email**: wahyunurs@example.com  
**Project Link**: [https://github.com/wahyunurs/tani-desa](https://github.com/wahyunurs/tani-desa)

## 🙏 Acknowledgments

-   [Laravel Framework](https://laravel.com)
-   [Tailwind CSS](https://tailwindcss.com)
-   [Alpine.js](https://alpinejs.dev)
-   [Flowbite Components](https://flowbite.com)
-   [Heroicons](https://heroicons.com)

---

<div align="center">
  <b>🌾 Tani Desa - Memajukan Pertanian Indonesia 🇮🇩</b>
</div>
