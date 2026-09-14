# Library With Inertia

A library management application built with Laravel 13, Inertia.js, and Vue 3. This project implements a simple book management system with CRUD operations and a modern admin dashboard interface.

## Features

- View all books in a table
- Add new book data
- Edit existing book data
- Search books by title or author
- Pagination support
- Responsive dashboard UI
- Laravel + Inertia.js full-stack implementation

## Tech Stack

- Laravel 13
- PHP 8.3
- Inertia.js
- Vue 3
- Vite
- MySQL / SQLite-compatible database

## Requirements

- PHP >= 8.2
- Composer
- Node.js and npm
- Database for Laravel

## Installation

1. Clone the repository:

```bash
git clone https://github.com/egirizaldi/library-withinnertia.git
cd library-withinnertia
```

2. Install PHP dependencies:

```bash
composer install
```

3. Install frontend dependencies:

```bash
npm install
```

4. Create environment file:

```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in `.env` and run migrations:

```bash
php artisan migrate
```

6. Run the application:

```bash
php artisan serve
npm run dev
```

Then open:

```bash
http://localhost:8000
```

## Notes

This project is intended as a practical CRUD learning project using the Laravel + Inertia + Vue stack.

## License

This project is open for personal learning and development purposes.
