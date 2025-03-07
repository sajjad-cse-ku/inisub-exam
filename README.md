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

#### 6. Install Tenancy (for create multiple website in one applicaiton that's why use laravel tenancy)
```sh
php artisan tenancy:install
```
#### 9. Start the Development Server
```sh
php artisan serve
```

#### Run Scheduler Command (sent email via schedular using command)
```sh
php artisan mail:send-subscriber-emails
or
php artisan schedule:run
```

#### Run Queue Worker
```sh
php artisan queue:work
```


The application will be accessible at `http://127.0.0.1:8000`.


## API Documentation

### 1. Create Website
**Endpoint:** `POST /api/create-website`

**cURL Request:**
```sh
curl --location 'http://127.0.0.1:8000/api/create-website' \
--form 'app_name="Nofi"' \
--form 'domain="nofi.localhost"'
```

**Postman Request:**
- Method: `POST`
- URL: `http://127.0.0.1:8000/api/create-website`
- Body (form-data):
  - `app_name`: `Nofi`
  - `domain`: `nofi.localhost`

---

### 2. Subscribe User
**Endpoint:** `POST /api/subscribe`

**cURL Request:**
```sh
curl --location 'app.localhost:8000/api/subscribe' \
--header 'Cookie: XSRF-TOKEN=<your-token>; laravel_session=<your-session>' \
--form 'email="user@test.com"'
```

**Postman Request:**
- Method: `POST`
- URL: `http://app.localhost:8000/api/subscribe`
- Headers:
  - `Cookie`: `XSRF-TOKEN=<your-token>; laravel_session=<your-session>`
- Body (form-data):
  - `email`: `user@test.com`

---

### 3. Store Blog Post
**Endpoint:** `POST /api/blog-posts/store`

**cURL Request:**
```sh
curl --location 'app.localhost:8000/api/blog-posts/store' \
--header 'Cookie: XSRF-TOKEN=<your-token>; laravel_session=<your-session>' \
--form 'title="My Blog post 1"' \
--form 'description="This is Description"'
```

**Postman Request:**
- Method: `POST`
- URL: `http://app.localhost:8000/api/blog-posts/store`
- Headers:
  - `Cookie`: `XSRF-TOKEN=<your-token>; laravel_session=<your-session>`
- Body (form-data):
  - `title`: `My Blog post 1`
  - `description`: `This is Description`

---

You can import these requests into Postman and update the `XSRF-TOKEN` and `laravel_session` values before making API calls.




## Contributing
Feel free to fork this repository and create pull requests.

## License
This project is licensed under the MIT License.

