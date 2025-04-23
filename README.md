## Installation Steps

1. **Clone the Repository**: Clone the project repository to your local machine.

2. **Install PHP Dependencies**:

    - Open a terminal in the project root directory.
    - Run the following command to install the PHP dependencies:
        ```bash
        composer install
        ```

3. **Set Up Environment**:

    - Copy the `.env.example` file to `.env`:
        ```bash
        cp .env.example .env
        ```
    - Generate an application key:
        ```bash
        php artisan key:generate
        ```
    - Configure your database settings in the `.env` file:
        ```
        DB_CONNECTION=sqlite
        DB_DATABASE=/absolute/path/to/database.sqlite
        ```

4. **Set Up Database**:

    - Create the database directory (if it doesn't exist):

        ```powershell
        # For Windows (PowerShell):
        New-Item -ItemType Directory -Path "database" -Force

        # For Linux/Mac:
        mkdir -p database
        ```

    - Create an empty SQLite database file:

        ```powershell
        # For Windows (PowerShell):
        New-Item -ItemType File -Path "database/database.sqlite" -Force

        # For Linux/Mac:
        touch database/database.sqlite
        ```

5. **Install JavaScript Dependencies**:

    - Run the following command to install the JavaScript dependencies:
        ```bash
        npm install
        ```

6. **Build Assets**:

    - For production, build the assets:
        ```bash
        npm run build
        ```
    - For development, you can run:
        ```bash
        npm run dev
        ```

7. **Run Migrations**:

    - The migrations will run in the following order:
        1. Drop all existing tables (if any)
        2. Create users table
        3. Create cache table
        4. Create jobs table
        5. Create sessions table
        6. Create businesses table
        7. Create categories table
        8. Create services table
        9. Create listings table
        10. Create activities table
        11. Create bookings table
        12. Create reviews table
        13. Create saved_listings table
        14. Create personal_access_tokens table
        15. Create saved_services table
    - Run the migrations:
        ```bash
        php artisan migrate
        ```

8. **Start the Development Server**:
    - You can start the Laravel development server with:
        ```bash
        php artisan serve
        ```

### Additional Notes

-   Make sure you have PHP 8.1 or higher installed
-   Ensure you have Composer and Node.js installed
-   If you encounter any issues during installation, check the error messages for guidance
-   For production deployment, make sure to set appropriate environment variables in `.env`
-   The database will be automatically created and tables will be set up when you run the migrations
-   If you need to reset the database, you can delete the database.sqlite file and run migrations again
