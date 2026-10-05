# Streamhive

Streamhive is a full-stack streaming platform built on Laravel that provides users with a comprehensive experience to discover, watch, and save their favorite movies and series. The application features a fully responsive customer interface and a protected administration dashboard for content managers to oversee the catalog, subscriptions, and platform users.

## Features

- **Content Browsing:** Browse movies and series with search functionality.
- **User Authentication:** Secure sign-up, login, and robust session management.
- **User Profiles:** Dedicated profile pages with updatable personal information.
- **Watchlist System:** Save favorite movies and series to a persistent personal watchlist.
- **Subscription Management:** Choose tiers, process payments, and manage active plans.
- **Admin Dashboard:** Role-protected dashboard to manage users, movies, series, and subscriptions.
- **Real-Time Chat:** Interactive messaging system to chat with other users or support.
- **User Feedback:** Built-in forms for users to submit feedback and reviews.
- **PDF Reporting:** Dynamic generation of user/subscription reports as downloadable PDFs.
- **Cloud Storage:** Integrated with AWS S3 for scalable media and content hosting.

## Tech stack

| Area | Technologies |
| --- | --- |
| Frontend | Laravel Blade, Vite, HTML/CSS, Axios |
| Backend | Laravel 10, PHP 8.1+ |
| Database | MySQL, Eloquent ORM |
| Storage & Media | AWS S3 (`league/flysystem-aws-s3-v3`) |
| Real-time | Pusher (WebSocket Broadcasting) |
| Utilities | `barryvdh/laravel-dompdf` (PDF Generation) |

## Project structure

```text
Streamhive-main/
|-- app/
|   |-- Http/
|   |   |-- Controllers/ # HTTP request handlers (Admin, User, Chat, etc.)
|   |   `-- Middleware/  # Request validation and auth checks
|   `-- Models/          # Eloquent schemas (User, Movie, Series, Message, etc.)
|-- config/              # Environment, database, and third-party configuration
|-- database/            # Migrations, seeders, and model factories
|-- resources/
|   |-- css/             # Frontend stylesheets compiled by Vite
|   |-- js/              # Frontend JavaScript compiled by Vite
|   `-- views/           # Blade templates for UI, Admin, Auth, Chat, and Emails
|-- routes/
|   |-- api.php          # API routes
|   `-- web.php          # Main application web routes
`-- public/              # Static assets and Vite build output
