@echo off
REM 1. Install The Following Dependencies

ECHO STEP 1. INSTALLING DEPENDENCIES

composer install
IF ERRORLEVEL 1 (
    ECHO Failed to install Composer dependencies. Exiting...
    exit /b 1
)

npm install
IF ERRORLEVEL 1 (
    ECHO Failed to install NPM packages. Exiting...
    exit /b 1
)

REM 2. Build the following assets (JS, CSS, etc.)...

ECHO STEP 2. BUILDING ASSETS

npm run build
IF ERRORLEVEL 1 (
    ECHO Failed to build assets. Exiting...
    exit /b 1
)


ECHO Make Sure You already configure  `DB_PASSWORD` and  `DB_USERNAME`...

ECHO STEP 3. RUN MIGRATIONS

php artisan migrate
IF ERRORLEVEL 1 (
    ECHO Failed to run migrations. Exiting...
    exit /b 1
)

REM 3. Seeding time...

ECHO STEP 4. SEEDING NECESSARY DATA FOR DATABASE

php artisan db:seed
IF ERRORLEVEL 1 (
    ECHO Failed to seed database. Exiting...
    exit /b 1
)

ECHO SUCCESS! here is the credential for admin:
ECHO email : test@example.com
ECHO password : password123

ECHO here is for the dummy user account
ECHO email : userme@example.com
ECHO password : user123


ECHO STEP 5. RUNNING SERVER

php artisan serve
pause
