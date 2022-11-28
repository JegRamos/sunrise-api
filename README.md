## About Sunrise API

Sunrise API is a Laravel 9 RESTFul starter kit for SPA and mobile clients. This kit includes the following features:
- Implementation of a Token-based Authentication with [Sanctum](https://laravel.com/docs/9.x/sanctum)
- Implementation of Role-based Access Control with [Spatie](https://spatie.be/docs/laravel-permission/v5/introduction)
- Implementation of CRUD for user profile with profile picture upload
- Implementation Forgot and Reset Password with Email Notification
- Implementation of S3 upload with pre-signed URL
- Pipeline implementation of HTTP query filters
- Composer and Git hook automation with GrumpPhp
- Github PR document template in `docs/pull_request_template.md`
- Feature and Unit tests coverage

## Set up your local development environment
- Minimum of PHP 8.1 installed with a database engine that supports JSON types and Full text search (eg. MySQL8, MariaDB 10.5)
- Create a **.env** file from the **.env.example** that came with this project
- In the **.env** file, update the **APP_NAME**, **APP_URL**, the **DB_** variables, and the MAIL variables if you decide to use a different test mailing service or account. You may also change the **SPA_RESET_PASSWORD_URL** if you're spinning a different URL for your SPA.
- Locate your **php.ini** file and change the value **upload_max_filesize** to **8M**. See this [guide](https://devanswers.co/ubuntu-php-php-ini-configuration-file/) if you're having trouble finding the directory of your php.ini file
- Run the command `composer install`  to install all the project and dev dependencies
- Run the command `php artisan app:init` to initialize the project. This will run:
  - App key generation
  - DB migrations
  - DB Seeders
## Tools ready for you
- `php artisan app:styler` Runs a [code styler](https://github.com/stechstudio/Laravel-PHP-CS-Fixer) for consistency and generate [IDE helper PHP Docs](https://github.com/barryvdh/laravel-ide-helper). See the command at `app/Console/Commands/StyleFixer.php`
- `php artisan user:create` Create a user with role. See the command at `app/Console/Commands/CreateUser.php`
- Running `composer install`, `composer update`, `git commit` will trigger automated tasks specified in `grumphp.yml`
   - PSR-compliant code formatting
   - Package security checks
   - Unit and feature tests

## Style Guide Ver. 0.1
- Use **FormRequest** validators when available
- Favor single quotes over double quotes
- Make use of type-hinting
- Extend the **ApiController** for all your API controllers
- Use `snake_case` for DB table columns, request inputs, and resource views
- Use `PascalCase` for class names
- User `camelCase` for variable, method, and function names
- Create separate API route files per resource/feature. Load all of them in `routes/api.php`
- Follow and implement the [PHPDoc](https://docs.phpdoc.org/3.0/guide/guides/docblocks.html) style guide
- Use `app\Exceptions\Handler.php` for centralized error handling

## Note
- All dates and timestamps are stored and compared in UTC timezone. Clients must convert their local dates to UTC before submitting to the API

## Authors
- Jego Carlo Ramos (JegRamos)
