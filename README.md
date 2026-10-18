# Tasks-Management-App

A simple **Laravel** REST API for task management that allows users to view all tasks, view a specific task, create, update, and delete tasks, with optional filtering by status.

## Requirements

- PHP 8.2+
- Composer
- MySQL (or any database supported by Laravel)

## Installation

```bash
git clone https://github.com/ShahedBeram/Tasks-Management-App.git
cd Tasks-Management-App

composer install
cp .env.example .env
php artisan key:generate
```

Set your database credentials in `.env`, then run:

```bash
php artisan migrate
php artisan serve
```

Base URL: `http://127.0.0.1:8000/api`.

## Task Fields

| Field         | Type     | Rules                                                      |
| ------------- | -------- | ---------------------------------------------------------- |
| `title`       | string   | required, max 150 characters                               |
| `description` | text     | optional                                                   |
| `status`      | enum     | `pending`, `in_progress`, `completed` (default: `pending`) |
| `due_date`    | datetime | optional                                                   |

## API Endpoints

Base URL: `/api/tasks`

| Method | Endpoint                    | Description                                      |
| ------ | --------------------------- | ------------------------------------------------ |
| GET    | `/api/tasks`                | List all tasks (latest first)                    |
| GET    | `/api/tasks?status=pending` | Filter tasks by status (query param is optional) |
| GET    | `/api/tasks/{task}`         | Show a single task                               |
| POST   | `/api/tasks`                | Create a new task                                |
| PATCH  | `/api/tasks/{task}`         | Update a task                                    |
| DELETE | `/api/tasks/{task}`         | Delete a task                                    |

> When testing with Postman, add the header `Accept: application/json` so validation errors are returned as JSON.
