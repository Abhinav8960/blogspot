# 🚀 BlogSpot - Modern Laravel Blog Application

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-4e56a6?style=for-the-badge&logo=livewire&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Cloudinary](https://img.shields.io/badge/Cloudinary-3448C5?style=for-the-badge&logo=cloudinary&logoColor=white)
![Razorpay](https://img.shields.io/badge/Razorpay-02042B?style=for-the-badge&logo=razorpay&logoColor=white)

A modern, feature-rich blog application built with Laravel 12, featuring user authentication, admin panel, payment integration, real-time notifications, and cloud image storage.

## ✨ Features

### 🔐 Authentication & User Management
- **Laravel Jetstream** with Livewire stack
- **Two-Factor Authentication (2FA)**
- **Google OAuth** integration
- **Profile management** with avatar uploads
- **Email verification** and password reset

### 📝 Blog Management
- **CRUD operations** for blog posts
- **Soft delete** functionality
- **Image uploads** with Cloudinary integration
- **Post status management** (Active/Inactive)
- **Rich text content** support
- **Search and filtering** capabilities

### 👨‍💼 Admin Panel
- **Dashboard** with statistics
- **Post management** (Create, Read, Update, Delete, Restore)
- **Contact form management**
- **User management**
- **Real-time notifications** for new contacts
- **Responsive admin interface**

### 💳 Payment Integration
- **Razorpay** payment gateway
- **Payment success/failure** handling
- **Transaction management**

### 🔔 Real-time Features
- **Laravel Reverb** for WebSocket broadcasting
- **Real-time contact notifications**
- **Sweet Alert** notifications
- **Live updates** in admin panel

### 🎨 Frontend
- **Tailwind CSS** for styling
- **Vite** for asset compilation
- **Responsive design**
- **Modern UI/UX** with custom themes

### 🔌 APIs
- **RESTful API endpoints**
- **Product API** for external integrations
- **Sanctum** for API authentication

## 🛠️ Tech Stack

### Backend
- **Laravel 12** - PHP Framework
- **Livewire 3** - Full-stack framework
- **Jetstream** - Authentication scaffolding
- **Sanctum** - API authentication
- **Reverb** - WebSocket server

### Frontend
- **Tailwind CSS** - Utility-first CSS framework
- **Vite** - Build tool and dev server
- **Alpine.js** - Reactive JavaScript framework

### Database
- **MySQL/PostgreSQL/SQLite**
- **Database migrations** and seeders
- **Eloquent ORM**

### Third-party Services
- **Cloudinary** - Image hosting and management
- **Razorpay** - Payment processing
- **Google OAuth** - Social authentication
- **Sweet Alert** - Notification library

### Development Tools
- **Composer** - PHP dependency management
- **NPM** - Node.js package management
- **Laravel Pint** - Code styling
- **PHPUnit** - Testing framework

## 📋 Prerequisites

- **PHP 8.2 or higher**
- **Composer** (PHP dependency manager)
- **Node.js 18+ and NPM**
- **MySQL/PostgreSQL/SQLite** database
- **Git** for version control

## 🚀 Installation & Setup

### 1. Clone the Repository
```bash
git clone https://github.com/Abhinav8960/blogspot.git
cd blogspot
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node.js Dependencies
```bash
npm install
```

### 4. Environment Configuration
```bash
cp .env.example .env
```

Edit `.env` file with your configuration:

```env
APP_NAME=BlogSpot
APP_ENV=local
APP_KEY=base64:your-generated-key
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blogspot
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Mail Configuration (for notifications)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@blogspot.com"
MAIL_FROM_NAME="${APP_NAME}"

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Database Setup
```bash
# Run migrations
php artisan migrate

# Seed the database (optional)
php artisan db:seed
```

### 7. Build Assets
```bash
# For development
npm run dev

# For production
npm run build
```

### 8. Start the Application
```bash
# Using Laravel's built-in server
php artisan serve

# Or using Laravel Sail (if configured)
./vendor/bin/sail up
```

Visit `http://localhost:8000` to access the application.

## 🔧 Service Integrations Setup

### Google OAuth Setup

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select existing one
3. Enable Google+ API
4. Create OAuth 2.0 credentials
5. Add authorized redirect URI: `http://localhost:8000/auth/google/callback`
6. Update `.env`:

```env
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
```

### Cloudinary Setup

1. Sign up at [Cloudinary](https://cloudinary.com/)
2. Get your cloud name, API key, and API secret
3. Update `.env`:

```env
CLOUDINARY_CLOUD_NAME=your_cloud_name
CLOUDINARY_API_KEY=your_api_key
CLOUDINARY_API_SECRET=your_api_secret
```

### Razorpay Setup

1. Sign up at [Razorpay Dashboard](https://dashboard.razorpay.com/)
2. Get your API Key ID and Key Secret
3. Update `.env`:

```env
RAZORPAY_KEY=your_razorpay_key_id
RAZORPAY_SECRET=your_razorpay_key_secret
```

### Laravel Reverb (Real-time Notifications)

1. Install Reverb (already included in composer.json)
2. Configure broadcasting in `.env`:

```env
BROADCAST_CONNECTION=reverb
REVERB_APP_ID=my-app-id
REVERB_APP_KEY=my-app-key
REVERB_APP_SECRET=my-app-secret
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http
```

3. Start Reverb server:
```bash
php artisan reverb:start
```

## 📁 Project Structure

```
blogspot/
├── app/
│   ├── Actions/          # Jetstream actions
│   ├── Http/Controllers/ # Controllers
│   ├── Mail/            # Email templates
│   ├── Models/          # Eloquent models
│   ├── Notifications/   # Notification classes
│   ├── Providers/       # Service providers
│   └── Services/        # Custom services
├── config/              # Configuration files
├── database/
│   ├── factories/       # Model factories
│   ├── migrations/      # Database migrations
│   └── seeders/         # Database seeders
├── public/              # Public assets
│   ├── adminassets/     # Admin panel assets
│   └── storage/         # Uploaded files
├── resources/
│   ├── css/            # Stylesheets
│   ├── js/             # JavaScript files
│   ├── markdown/       # Documentation
│   └── views/          # Blade templates
├── routes/              # Route definitions
├── storage/             # File storage
├── tests/              # Test files
└── vite.config.js      # Vite configuration
```

## 🎯 Key Features Explained

### Admin Panel
- **Dashboard**: Overview with statistics and recent activities
- **Post Management**: Full CRUD operations with soft delete
- **Contact Management**: View and manage contact form submissions
- **Real-time Notifications**: Instant alerts for new contacts

### User Features
- **Registration/Login**: Standard and Google OAuth
- **Profile Management**: Update profile with avatar
- **Blog Reading**: Browse and read published posts
- **Contact Forms**: Submit inquiries to admin

### Payment System
- **Razorpay Integration**: Secure payment processing
- **Success/Failure Handling**: Proper transaction feedback
- **Payment Records**: Track all transactions

## 🔒 Security Features

- **CSRF Protection**: All forms protected
- **XSS Prevention**: Input sanitization
- **SQL Injection Prevention**: Eloquent ORM protection
- **Two-Factor Authentication**: Optional 2FA
- **Secure Password Hashing**: Bcrypt hashing
- **API Authentication**: Sanctum tokens

## 🧪 Testing

```bash
# Run PHP tests
php artisan test

# Run with coverage
php artisan test --coverage
```

## 📊 API Endpoints

### Public Endpoints
- `GET /api/products` - Get all products
- `GET /api/productnews` - Get product news

### Protected Endpoints (Require Authentication)
- `GET /api/user` - Get authenticated user info

## 🚀 Deployment

### Production Checklist
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Configure production database
- [ ] Set up proper mail configuration
- [ ] Configure all third-party services
- [ ] Run `php artisan config:cache`
- [ ] Run `npm run build`
- [ ] Set proper file permissions

### Environment Variables for Production
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database
DB_CONNECTION=mysql
DB_HOST=your_db_host
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

# Cache & Sessions
CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

# Mail
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_USERNAME=your_smtp_user
MAIL_PASSWORD=your_smtp_password

# Third-party Services
GOOGLE_CLIENT_ID=prod_client_id
CLOUDINARY_CLOUD_NAME=prod_cloud_name
RAZORPAY_KEY=prod_key
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- [Laravel](https://laravel.com/) - The PHP framework
- [Jetstream](https://jetstream.laravel.com/) - Authentication scaffolding
- [Livewire](https://laravel-livewire.com/) - Full-stack framework
- [Tailwind CSS](https://tailwindcss.com/) - Utility-first CSS
- [Cloudinary](https://cloudinary.com/) - Image management
- [Razorpay](https://razorpay.com/) - Payment gateway

## 📞 Support

For support, email abhinavpal8960@gmail.com or create an issue in the repository.

---

**Made with ❤️ using Laravel & Livewire**

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
