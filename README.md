# Project Installation Guide

## Getting Started

Follow these steps to clone and set up the project on your local machine.

### Prerequisites
Ensure you have the following installed on your system:
- PHP (latest version recommended)
- Composer
- Laravel
- MySQL or any supported database
- Git

### Installation Steps

#### 1. Clone the Repository
```sh
https://github.com/sajjad-cse-ku/inisub-exam.git
cd your-repository
```

#### 2. Install Dependencies
```sh
composer install
```

#### 3. Create and Configure the `.env` File
```sh
cp .env.example .env
```
Modify the `.env` file and set up your database and other configurations.

#### 4. Generate Application Key
```sh
php artisan key:generate
```

#### 5. Run Migrations
```sh
php artisan migrate
```

#### 6. Install Tenancy
```sh
php artisan tenancy:install
```
#### 9. Start the Development Server
```sh
php artisan serve
```

#### Run Scheduler Command (check email sent or not)
```sh
php artisan schedule:run
```

#### Run Queue Worker
```sh
php artisan queue:work
```


The application will be accessible at `http://127.0.0.1:8000`.

## Contributing
Feel free to fork this repository and create pull requests.

## License
This project is licensed under the MIT License.

