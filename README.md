# Jira-Based Assignment

This project is built with Laravel 10.x and uses blade for the frontend, styled with Tailwind CSS.

## System Requirements

Make sure your system meets these requirements before starting:
- PHP = 8.2.12
- Composer = 2.8.9
- Node.js = v22.16.0 (Required for frontend assets)
- npm = 10.9.2 (Comes with Node.js)
- Database MySQL

## Node.js and NPM Setup
1. Download and install Node.js from: https://nodejs.org/
   - This will automatically install npm as well
2. Verify installation:
```bash
node -v  # Should show v22.16.0
npm -v   # Should show 10.9.2
```
3. If you need to update npm:
```bash
npm install -g npm@10.9.2
```

## Packages used in this project 
- Laravel Breeze - Authentication UI scaffold (Pre-installed)
- Laravel Sanctum - API authentication system (Pre-installed)
- Tailwind CSS - Utility-first CSS framework
- Alpine.js - Minimal JavaScript framework
- Vite - Frontend build tool

## Frontend Dependencies
This project uses the following frontend packages:
- TailwindCSS - For styling
- Alpine.js - For JavaScript functionality
- Axios - For HTTP requests
- Laravel Vite - For asset compilation

## Setting Up From ZIP File

### 1. Extract the ZIP File
- Extract the zip file to your desired location
- Open a terminal/command prompt
- If you have already database then run attached query for get existing user which are associated with jira account

### 2. Install PHP Dependencies
composer install

### 3. Environment Setup
# Copy the environment file
cp .env.example .env

Then edit the `.env` file and update these important settings:
.env
- DB_DATABASE=laravel
- DB_USERNAME=root
- DB_PASSWORD=''

- Main Used Table = "users"
- Generate application key : php artisan key:generate

### 4. Create and Setup Database
1. Create a new MySQL database named `laravel`
2. Run migrations to create tables:
-  php artisan migrate
3. i have attached an user table existing user by which you can check to login and see the assinged task to them 

### 5. Frontend Setup
1. Install Node.js dependencies:
```bash
npm install
```

2. Start development server (choose one):
```bash
# For development with hot reload
npm run dev

# For production build
npm run build
```

Note: Keep the npm run dev terminal running while developing

### 6. Set Proper Permissions
For Windows, skip this step.
For Linux/Mac, run:

chmod -R 777 storage bootstrap/cache

### 7. Start the Application

php artisan serve

The application will be available at `http://localhost:8000`

## Authentication Features
This project comes with complete authentication system:

### Web Authentication (Laravel Breeze)
Available routes:
- `/register` - Create a new account
- `/login` - Login to existing account
- `/forgot-password` - Reset password request
- `/reset-password` - Reset password form
- `/verify-email` - Email verification
- `/profile` - User profile management

### API Authentication (Laravel Sanctum)
Already configured and ready to use. Protected API routes are automatically secured.

## Project Structure

- `app/` - Contains the core code of your application
- `config/` - All configuration files
- `database/` - Database migrations and seeders
- `public/` - Publicly accessible files
- `resources/` - Views, raw assets (SASS, JS, etc)
- `routes/` - All route definitions
- `storage/` - Logs, cache, and user-uploaded files

## Available Commands

### Backend (Artisan)
- `php artisan serve` - Start the development server
- `php artisan migrate` - Run database migrations
- `php artisan route:list` - List all registered routes

### Frontend Commands
- `npm install` - Install frontend dependencies
- `npm run dev` - Start Vite development server (with hot reload)
- `npm run build` - Build for production
- `npm update` - Update npm packages
- `npm audit fix` - Fix npm vulnerabilities

## Common Issues and Solutions---------------------------------------

### 1. Database Connection Error
If you see a database connection error:
- Check if MySQL is running
- Verify database credentials in `.env` file
- Make sure the database `laravel` exists

### 2. Composer Install Fails

composer install --ignore-platform-reqs

### 3. NPM Issues
If npm install fails:

rm -rf node_modules package-lock.json
npm cache clean --force
npm install

If you get node version errors:
1. Install NVM (Node Version Manager)
2. Run:
```bash
nvm install 22.16.0
nvm use 22.16.0
```

### 4. Cache Issues
If you face any weird behavior:

php artisan config:clear
php artisan cache:clear
php artisan view:clear

### 5. Sanctum Token Issues
If you have issues with API authentication:
php artisan sanctum:prune-expired

## License

