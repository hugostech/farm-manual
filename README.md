# Farm manual management system

## Project Summary

This project is a comprehensive LU farm manual management system built using Laravel and Soft UI Dashboard. It allows administrators to manage manuals by creating, editing, and deleting them. Additionally, it provides a subscription management system for readers, controlling which books they can access based on their subscription.

## Features

- **Manuals Management**: Admins can create, edit, and delete manuals.
- **Reader Subscription Management**: Control which books readers can access based on their subscription.
- **User Authentication**: Register, login, and manage user profiles.
- **Dashboard**: A visually appealing dashboard with various UI components.
- **Responsive Design**: Built with Bootstrap 5 for a responsive and modern design.
- **Docker Support**: Easily set up and run the project using Docker.
- **Asset Management**: Use Laravel Mix and npm for managing and compiling assets.

## Prerequisites

- **Node.js and npm**: [Install Node.js and npm](https://nodejs.org/)
- **Composer**: [Install Composer](https://getcomposer.org/doc/00-intro.md)
- **Docker**: [Install Docker](https://docs.docker.com/get-docker/)

## Setup

### Step 1: Clone the Repository

```sh
git clone https://github.com/hugostech/farm-manual.git
cd farm-manual
```

### Step 2: Install Dependencies

```sh
composer install
npm install
```

### Step 3: Configure Environment

Copy the `.env.example` file to `.env` and update the necessary configurations, mainly the database settings.

```sh
cp .env.example .env
php artisan key:generate
```

### Step 4: Run Migrations and Seeders

```sh
php artisan migrate --seed
```

### Step 5: Set Up Storage Link

```sh
php artisan storage:link
```

### Step 6: Compile Assets

For development:

```sh
npm run dev
```

For production:

```sh
npm run prod
```

### Step 7: Run the Application

#### Using Local Environment

```sh
php artisan serve
```

#### Using Docker

Build and run the Docker containers:

```sh
docker-compose up --build
```

## References

- [Laravel Documentation](https://laravel.com/docs/10.x)
- [Soft UI Dashboard](https://www.creative-tim.com/product/soft-ui-dashboard)
- [Docker Documentation](https://docs.docker.com/)
- [npm Documentation](https://docs.npmjs.com/)

