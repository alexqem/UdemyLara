# Property Sales Website

This is a Laravel 10 application built with Inertia.js, Docker, Laravel Sail, and Tailwind CSS. It demonstrates the power of Inertia.js and Tailwind CSS, featuring responsive design for all screen sizes and support for both dark and light themes.

Demo: [https://property.runliq.com](https://property.runliq.com)

## Project Overview

This website is designed for selling properties. It includes:
- A public-facing interface for potential buyers to view properties
- A backoffice for sales managers to upload new properties, including pictures and prices
- A simple mortgage calculator to help potential buyers
- Responsive design that adapts to any screen dimension
- Support for both dark and light themes

## Technologies Used

- Laravel 10
- Inertia.js
- Vue.js
- Tailwind CSS
- Docker
- Laravel Sail
- MariaDB

## Requirements

- PHP 8.1+
- Composer
- Node.js and npm
- Docker and Docker Compose

## Installation

1. Clone the repository:
   ```
   git clone git@github.com:alexqem/property.git
   cd property
   ```

2. Install PHP dependencies:
   ```
   composer install
   ```

3. Copy the example environment file:
   ```
   cp .env.example .env
   ```

4. Update the .env file:
   ```
   APP_PORT=8000
   ```

5. Build and start the Docker containers:
   ```
   vendor/bin/sail build
   vendor/bin/sail up -d
   ```

6. Set proper permissions:
   ```
   vendor/bin/sail root-shell
   chown -R sail:sail ./
   exit
   ```

7. Generate application key:
   ```
   vendor/bin/sail artisan key:generate
   ```

8. Run database migrations:
   ```
   vendor/bin/sail artisan migrate
   ```

9. Install Node.js dependencies and build assets:
   ```
   vendor/bin/sail npm install
   vendor/bin/sail npm run build
   ```

## Development

To start the development server:

```
vendor/bin/sail up -d
```

To compile assets and watch for changes:

```
vendor/bin/sail npm run dev
```

## Production Deployment

1. Install MariaDB on your production server.

2. Install Docker and Docker Compose:
   ```
   apt install docker docker-compose
   ```

3. Clone the repository and navigate to the project directory.

4. Copy the environment file:
   ```
   cp .env.example .env
   ```

5. Update the .env file with your production settings, including:
   ```
   APP_PORT=8000
   ```

6. Install PHP dependencies:
   ```
   composer install --optimize-autoloader --no-dev
   ```

7. Build the frontend assets:
   ```
   npm run build
   ```

8. Set up your web server (e.g., Nginx) with the following configuration:

   ```nginx
   server {
       listen 80;
       server_name DOMAIN;

       location / {
           proxy_pass http://127.0.0.1:8000;
           proxy_set_header Host $host;
           proxy_set_header X-Real-IP $remote_addr;
           proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
           proxy_set_header X-Forwarded-Proto $scheme;
           proxy_pass_request_headers on;
           proxy_buffering off;
       }

       error_log /var/log/nginx/runliq_error.log;
       access_log /var/log/nginx/runliq_access.log;
   }
   ```

   Replace `DOMAIN` with your actual domain name.

9. Ensure the correct permissions are set:
   ```
   chown -R www-data:www-data ./
   ```

## Troubleshooting

If you encounter issues with port 80 being in use:

```
sudo lsof -i :80
```

This will show you which process is using port 80.

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
```
