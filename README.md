# Streamhive

Streamhive is a full-stack streaming platform built with Laravel. It provides a user-facing storefront for browsing and watching movies and series, a subscription and payment system, a personal watchlist, real-time user-to-user messaging, and a protected admin dashboard for managing the entire platform.

## Features

- Email/password authentication with role-based access control (user and admin)
- Browsable movie and series catalog with search and like/trending support
- Subscription tiers (Free, Individual, Family) with coupon code support
- Payment flow with automated PDF receipt generation and email delivery
- Personal watchlist per user with add and remove support
- Real-time messaging between users (chat system)
- User profile management with name and password update
- Per-session usage time tracking (login/logout timestamps)
- Downloadable PDF user report (profile, subscription, watchlist summary)
- User feedback submission with aggregate star rating display
- Protected admin dashboard covering users, movies, series, subscriptions, and watchlists
- Admin controls: add/delete content, assign roles, and update subscription status

## Tech Stack

| Area | Technologies |
|---|---|
| Backend | PHP 8.1, Laravel 10, Laravel Sanctum |
| Frontend | Blade templates, Vite, Tailwind CSS |
| Database | MySQL (via Eloquent ORM) |
| Authentication | Laravel Auth, bcrypt, session-based |
| PDF Generation | barryvdh/laravel-dompdf |
| Email | Laravel Mail (SMTP / Mailpit) |
| HTTP Client | Guzzle |
| Storage | AWS S3 (via league/flysystem-aws-s3-v3) |
| Testing | PHPUnit 10, Mockery |

## Project Structure

```
Streamhive-main/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Request handlers (User, Admin, Subscription, Chat, PDF, etc.)
│   │   └── Middleware/      # Authentication and HTTP middleware
│   ├── Mail/                # Mailable classes (subscription receipt)
│   ├── Models/              # Eloquent models (User, Movie, Series, Subscription, Watchlist, Message, Feedback)
│   └── Providers/           # Service providers
├── config/                  # Laravel configuration files
├── database/
│   ├── factories/           # Model factories for testing
│   ├── migrations/          # Database schema migrations
│   └── seeders/             # Database seeders
├── resources/
│   ├── css/                 # Application styles
│   ├── js/                  # Frontend JavaScript
│   └── views/               # Blade templates (storefront, admin, emails, PDF)
├── routes/
│   └── web.php              # All web routes
└── tests/
    ├── Feature/             # Feature tests
    └── Unit/                # Unit tests
```

## Getting Started

### Prerequisites

- PHP 8.1 or later
- Composer
- MySQL
- Node.js and npm
- Optional: an SMTP provider or [Mailpit](https://github.com/axllent/mailpit) for local email testing
- Optional: an AWS S3 bucket for file storage

### 1. Clone the Repository

```bash
git clone <your-repository-url>
cd Streamhive-main
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Configure the Environment

```bash
cp .env.example .env
php artisan key:generate
```

On Windows PowerShell, copy the environment file with:

```powershell
Copy-Item .env.example .env
php artisan key:generate
```

Update `.env` with your own values:

| Variable | Purpose | Example / Default |
|---|---|---|
| `APP_NAME` | Application name shown in emails and UI | `Streamhive` |
| `APP_URL` | Full base URL of the application | `http://localhost` |
| `DB_CONNECTION` | Database driver | `mysql` |
| `DB_HOST` | Database host | `127.0.0.1` |
| `DB_PORT` | Database port | `3306` |
| `DB_DATABASE` | Database name | `streamhive` |
| `DB_USERNAME` | Database username | `root` |
| `DB_PASSWORD` | Database password | _(empty by default)_ |
| `MAIL_MAILER` | Mail transport | `smtp` |
| `MAIL_HOST` | SMTP host | `mailpit` |
| `MAIL_PORT` | SMTP port | `1025` |
| `MAIL_FROM_ADDRESS` | Sender address for outgoing emails | `hello@example.com` |
| `AWS_ACCESS_KEY_ID` | AWS key for S3 file storage | Optional |
| `AWS_SECRET_ACCESS_KEY` | AWS secret for S3 file storage | Optional |
| `AWS_DEFAULT_REGION` | AWS region | `us-east-1` |
| `AWS_BUCKET` | S3 bucket name | Optional |
| `PUSHER_APP_ID` | Pusher app ID for broadcasting | Optional |
| `PUSHER_APP_KEY` | Pusher app key | Optional |
| `PUSHER_APP_SECRET` | Pusher app secret | Optional |

### 4. Run Migrations

```bash
php artisan migrate
```

### 5. Build Frontend Assets

```bash
npm run dev
```

### 6. Start the Development Server

```bash
php artisan serve
```

The application runs at `http://localhost:8000` by default.

## Admin Account Setup

Public registration creates a standard `user` account. To promote a user to admin, update the `role` column for that user directly in the database:

```sql
UPDATE users SET role = 'admin' WHERE email = 'your@email.com';
```

Once logged in as an admin, you will be directed to a decision page where you can choose to enter the admin dashboard or the regular storefront.

## Subscription Plans

| Plan | Price | Coupon (`STREAM50`) |
|---|---|---|
| Free | — | — |
| Individual | 100 BDT / 30 days | 50 BDT |
| Family | 250 BDT / 30 days | 200 BDT |

After a successful subscription, a PDF receipt is generated automatically and sent to the user's registered email address.

## Route Overview

| Method | Path | Description |
|---|---|---|
| `GET` | `/` | Redirects to login |
| `GET / POST` | `/login` | User login |
| `GET / POST` | `/signup` | User registration |
| `POST` | `/logout` | User logout |
| `GET` | `/UI` | Main storefront (top movies and series) |
| `GET` | `/movies` | Full movie catalog |
| `GET` | `/series` | Full series catalog |
| `GET` | `/search` | Search movies and series |
| `GET` | `/watchlist` | User's personal watchlist |
| `POST` | `/addwatchlist` | Add item to watchlist |
| `DELETE` | `/watchlist/{id}` | Remove item from watchlist |
| `GET` | `/subscription` | Subscription plans page |
| `POST` | `/payment` | Initiate payment flow |
| `PUT` | `/subscription` | Confirm and save subscription |
| `GET` | `/profile` | User profile page |
| `PUT` | `/profile/update` | Update name or password |
| `GET` | `/feedback` | Feedback form with aggregate rating |
| `POST` | `/store` | Submit feedback |
| `GET` | `/chat` | Real-time messaging (auth required) |
| `POST` | `/messages` | Send a message |
| `GET` | `/messages/{user}` | Fetch conversation with a user |
| `GET` | `/generate-report` | Download PDF user report |
| `GET` | `/admin` | Admin: user management |
| `GET` | `/admin_movies` | Admin: movie management |
| `GET` | `/admin_series` | Admin: series management |
| `GET` | `/admin_subscription` | Admin: subscription management |
| `GET` | `/admin_watchlist` | Admin: watchlist overview |
| `PUT` | `/admin_assign_role` | Admin: promote/demote user role |
| `PUT` | `/admin_change_status` | Admin: update subscription manually |
| `POST` | `/addmovie` | Admin: add a new movie |
| `POST` | `/addseries` | Admin: add a new series |
| `DELETE` | `/deletemovie/{id}` | Admin: delete a movie |
| `DELETE` | `/deleteseries/{id}` | Admin: delete a series |
| `DELETE` | `/deleteuser/{id}` | Admin: delete a user |

## Available Scripts

### Backend (Laravel / Artisan)

```bash
php artisan serve          # Start the development server
php artisan migrate        # Run all database migrations
php artisan migrate:fresh  # Drop all tables and re-run migrations
php artisan db:seed        # Run database seeders
php artisan tinker         # Interactive REPL
php artisan test           # Run the PHPUnit test suite
```

### Frontend (Vite / npm)

```bash
npm run dev      # Start the Vite development server with HMR
npm run build    # Compile and bundle assets for production
```

## Testing

The project uses PHPUnit 10 with Mockery for mocking. Tests are located in the `tests/` directory, split into `Feature` and `Unit` suites.

```bash
php artisan test
```

Or run PHPUnit directly:

```bash
./vendor/bin/phpunit
```

## Production Notes

- Set `APP_ENV=production` and `APP_DEBUG=false` before deploying.
- Set `APP_URL` to your deployed domain.
- Use a strong, private `APP_KEY` and never commit `.env` files.
- Configure a real SMTP provider in the `MAIL_*` variables for subscription receipts.
- Configure `AWS_*` variables if you intend to store uploaded images in S3.
- Run `php artisan config:cache` and `php artisan route:cache` for improved performance in production.
- Ensure the `storage/` and `bootstrap/cache/` directories are writable by the web server.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
