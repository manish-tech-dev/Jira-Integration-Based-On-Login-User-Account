# Jira-Based Assignment (Laravel 10)

This Laravel 10 project integrates with the Jira REST API to display and manage tasks. It uses Laravel Breeze for authentication and Tailwind CSS for styling.

## System Requirements

- PHP 8.2.12  
- Composer 2.8.9  
- Node.js v22.16.0  
- npm 10.9.2 (comes with Node.js)  
- MySQL (any recent version)

## Packages and Tools Used

- Laravel Breeze (Auth scaffolding)  
- Laravel Sanctum (API token auth)  
- Tailwind CSS (Frontend styling)  
- Alpine.js (JavaScript)  
- Axios (HTTP requests)  
- Vite (Frontend asset bundler)

## Node.js & NPM Setup

1. Download and install Node.js from https://nodejs.org/  
2. Verify:
3. To update npm (if needed):



## Project Setup----------------------------------------------------------------

### 1. Extract the ZIP

Extract the ZIP file to your desired location and open the terminal in that directory.

### 2. Install PHP Dependencies
composer install


### 3. Environment Configuration

1. Copy `.env.example` to `.env`:
2.  DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
3. Generate application key: php artisan key:generate


### 4. Database Setup

1. Create a new MySQL database called `laravel`.  
2. Run migrations: 
3. Import the provided `users.sql` file into your database using a tool like phpMyAdmin or:
Existing Users with Jira API Email and Password

- Aditya have'nt assigned any task so he can't see any task
1. aditya123@mailinator.com - Aditya123

- Manish have assigned task so he can see the task
2. admmanish688@gmail.com - Manish123

- Hemant have assigned task so he can see the task
3. ibansalbro@gmail.com - Hemant123

### 5. Install Frontend Dependencies
1. npm install


### 6. Start Development Servers
1. php artisan serve
2. http://localhost:8000


Visit the app at `http://localhost:8000`

## Features

- User Authentication using Laravel Breeze  
- API Token Auth using Laravel Sanctum  
- Integration with Jira REST API  
- Tasks fetched and displayed per logged-in Jira user  
- Tasks include: Project Name, Summary, Key, Status, Priority  
- Tasks sorted by Project Priority → Task Priority
- open details edit popup with fields details
- Editable Jira Task Fields (status, summary) via UI with Jira Account

## Auth Routes

- `/register` – Register a new user  
- `/login` – Login  
- `/logout` – Logout  
- `/forgot-password` – Request password reset  
- `/reset-password` – Reset form  
- `/verify-email` – Verify user email  
- `/profile` – User profile update

## Sample Users

After importing the `users.sql`, use the provided credentials to log in and see assigned Jira tasks. Make sure these users have valid Jira credentials and access to tasks.

## Common Commands
php artisan serve
php artisan migrate
php artisan route:list


**Frontend**

npm install
npm run dev


## Notes

- Ensure `.env` is configured correctly with Jira Acccount key and Jira Api URL and Jira Admin Email. 
- Imported users must have Jira API tokens stored.  










