# Laravel Auth API

A complete REST API built with Laravel 11, featuring user authentication, post management, and MySQL database integration using Laravel Sanctum for token-based authentication.

## 📋 Table of Contents

- [Features](#features)
- [Technology Stack](#technology-stack)
- [Prerequisites](#prerequisites)
- [Installation & Setup](#installation--setup)
- [Database Configuration](#database-configuration)
- [API Endpoints](#api-endpoints)
- [Authentication](#authentication)
- [Testing the API](#testing-the-api)
- [Project Structure](#project-structure)
- [Usage Examples](#usage-examples)

## ✨ Features

- **User Registration & Authentication**
- **JWT Token-based Authentication** (Laravel Sanctum)
- **Post Management** (CRUD operations)
- **MySQL Database Integration**
- **RESTful API Design**
- **Input Validation**
- **Error Handling**
- **API Documentation Endpoints**

## 🛠 Technology Stack

- **Backend:** Laravel 11
- **Database:** MySQL
- **Authentication:** Laravel Sanctum
- **Language:** PHP 8.2+
- **Testing:** Built-in Laravel testing tools

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- PHP 8.2 or higher
- Composer
- MySQL 8.0+
- Git
- A web server (Apache/Nginx) or use Laravel's built-in server

## 🚀 Installation & Setup

### 1. Clone the Repository

```bash
git clone <your-repository-url>
cd lara-auth-api
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Configuration

```bash
# Copy the environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Environment Variables

Edit your `.env` file with your database credentials:

```env
APP_NAME="Laravel Auth API"
APP_ENV=local
APP_KEY=base64:your-generated-key
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lara_auth_api
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

## 🗄 Database Configuration

### 1. Create MySQL Database

```sql
CREATE DATABASE lara_auth_api;
```

### 2. Run Migrations

```bash
php artisan migrate
```

This will create the following tables:
- `users` - User accounts
- `personal_access_tokens` - Laravel Sanctum tokens
- `posts` - Blog posts
- `cache` - Application cache
- `jobs` - Queue jobs

### 3. Verify Database Setup

```bash
php artisan migrate:status
```

## 🌐 API Endpoints

### Public Endpoints (No Authentication Required)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/posts/public` | Get all posts (public access) |
| GET | `/api/register` | Registration endpoint documentation |
| GET | `/api/login` | Login endpoint documentation |
| GET | `/api/user` | User info endpoint documentation |
| GET | `/api/logout` | Logout endpoint documentation |
| POST | `/api/register` | Register a new user |
| POST | `/api/login` | Login user |

### Protected Endpoints (Authentication Required)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/user` | Get current user info |
| POST | `/api/logout` | Logout current user |
| GET | `/api/posts` | Get all posts |
| POST | `/api/posts` | Create a new post |
| GET | `/api/posts/{id}` | Get specific post |
| PUT | `/api/posts/{id}` | Update specific post |
| DELETE | `/api/posts/{id}` | Delete specific post |

## 🔐 Authentication

This API uses **Laravel Sanctum** for token-based authentication.

### Authentication Flow:
1. **Register** a new user account
2. **Login** to receive a Bearer token
3. **Include the token** in the `Authorization` header for protected routes
4. **Logout** to invalidate the token

### Token Usage:
```
Authorization: Bearer your-token-here
```

## 🧪 Testing the API

### 1. Start the Development Server

```bash
php artisan serve
```

The API will be available at: `http://127.0.0.1:8000`

### 2. Test Endpoints in Browser

Visit these URLs to see API documentation:

- **Posts Data:** `http://127.0.0.1:8000/api/posts/public`
- **Registration Info:** `http://127.0.0.1:8000/api/register`
- **Login Info:** `http://127.0.0.1:8000/api/login`
- **User Info:** `http://127.0.0.1:8000/api/user`
- **Logout Info:** `http://127.0.0.1:8000/api/logout`

### 3. Test with PowerShell/Terminal

#### Register a User:
```powershell
$body = @{name='John Doe'; email='john@example.com'; password='password123'} | ConvertTo-Json
Invoke-RestMethod -Uri 'http://127.0.0.1:8000/api/register' -Method POST -Body $body -ContentType 'application/json'
```

#### Login:
```powershell
$loginBody = @{email='john@example.com'; password='password123'} | ConvertTo-Json
$response = Invoke-RestMethod -Uri 'http://127.0.0.1:8000/api/login' -Method POST -Body $loginBody -ContentType 'application/json'
$token = $response.token
```

#### Create a Post:
```powershell
$postBody = @{title='My First Post'; body='This is my post content'} | ConvertTo-Json
$headers = @{Authorization = "Bearer $token"}
Invoke-RestMethod -Uri 'http://127.0.0.1:8000/api/posts' -Method POST -Body $postBody -ContentType 'application/json' -Headers $headers
```

#### Get User Info:
```powershell
$headers = @{Authorization = "Bearer $token"}
Invoke-RestMethod -Uri 'http://127.0.0.1:8000/api/user' -Method GET -Headers $headers
```

### 4. Test with cURL

#### Register:
```bash
curl -X POST http://127.0.0.1:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{"name":"John Doe","email":"john@example.com","password":"password123"}'
```

#### Login:
```bash
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"john@example.com","password":"password123"}'
```

## 📁 Project Structure

```
lara-auth-api/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── API/
│   │       │   └── AuthenticationController.php
│   │       └── PostController.php
│   └── Models/
│       ├── User.php
│       └── Post.php
├── database/
│   ├── migrations/
│   │   ├── create_users_table.php
│   │   ├── create_personal_access_tokens_table.php
│   │   └── create_posts_table.php
│   └── factories/
├── routes/
│   ├── api.php          # API routes
│   └── web.php          # Web routes
├── config/
│   ├── database.php     # Database configuration
│   └── sanctum.php      # Sanctum configuration
├── .env                 # Environment variables
├── composer.json        # Dependencies
└── README.md           # This file
```

## 📝 Usage Examples

### Complete Workflow Example

```powershell
# 1. Register a new user
$registerBody = @{
    name = 'Test User'
    email = 'test@example.com'
    password = 'password123'
} | ConvertTo-Json

$registerResponse = Invoke-RestMethod -Uri 'http://127.0.0.1:8000/api/register' -Method POST -Body $registerBody -ContentType 'application/json'

# 2. Login to get token
$loginBody = @{
    email = 'test@example.com'
    password = 'password123'
} | ConvertTo-Json

$loginResponse = Invoke-RestMethod -Uri 'http://127.0.0.1:8000/api/login' -Method POST -Body $loginBody -ContentType 'application/json'
$token = $loginResponse.token

# 3. Create a post
$postBody = @{
    title = 'My First Post'
    body = 'This is the content of my first post!'
} | ConvertTo-Json

$headers = @{Authorization = "Bearer $token"}
$postResponse = Invoke-RestMethod -Uri 'http://127.0.0.1:8000/api/posts' -Method POST -Body $postBody -ContentType 'application/json' -Headers $headers

# 4. Get all posts
$allPosts = Invoke-RestMethod -Uri 'http://127.0.0.1:8000/api/posts' -Method GET -Headers $headers

# 5. Get current user info
$userInfo = Invoke-RestMethod -Uri 'http://127.0.0.1:8000/api/user' -Method GET -Headers $headers

# 6. Logout
$logoutResponse = Invoke-RestMethod -Uri 'http://127.0.0.1:8000/api/logout' -Method POST -Headers $headers
```

### API Response Examples

#### Successful Registration:
```json
{
  "message": "User registered successfully"
}
```

#### Successful Login:
```json
{
  "message": "Login successful",
  "token": "1|abc123xyz456..."
}
```

#### Post Creation:
```json
{
  "message": "Post created successfully",
  "post": {
    "id": 1,
    "user_id": 1,
    "title": "My First Post",
    "body": "This is the content of my first post!",
    "created_at": "2025-08-08T06:48:45.000000Z",
    "updated_at": "2025-08-08T06:48:45.000000Z"
  }
}
```

## 🔧 Configuration Details

### Key Configuration Files:

- **`.env`** - Environment variables and database credentials
- **`config/database.php`** - Database connection settings
- **`config/sanctum.php`** - Authentication token settings
- **`routes/api.php`** - API route definitions

### Important Middleware:

- **`auth:sanctum`** - Protects routes requiring authentication
- **Laravel's built-in validation** - Input validation and sanitization

## 🚨 Troubleshooting

### Common Issues:

1. **500 Internal Server Error**
   - Check Laravel logs in `storage/logs/laravel.log`
   - Ensure database connection is working
   - Verify all migrations have run

2. **Method Not Allowed**
   - Check if you're using the correct HTTP method (GET/POST/PUT/DELETE)
   - Ensure you're accessing the correct endpoint

3. **Unauthenticated Error**
   - Make sure you're including the Bearer token in the Authorization header
   - Verify the token is still valid (not expired or logged out)

4. **Database Connection Error**
   - Verify MySQL is running
   - Check database credentials in `.env` file
   - Ensure the database exists

### Debug Commands:

```bash
# Check migration status
php artisan migrate:status

# View routes
php artisan route:list

# Clear cache
php artisan cache:clear
php artisan config:clear

# Check logs
tail -f storage/logs/laravel.log
```

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## 📧 Support

If you encounter any issues or have questions, please open an issue in the repository

---

**Happy Coding! 🚀**
