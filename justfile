# justfile
set shell := ["bash", "-cu"]

# Setup project
setup:
    echo "Setting up the Felix"
    cp .env.example .env
    just install
    just keygen
    just migrate
    just seed
    just storage_link
    just start

# Install dependencies
install:
    echo "Installing PHP and Node.js dependencies"
    composer install
    npm install

# Generate application key
keygen:
    echo "Generating application key"
    php artisan key:generate

# Run migrations
migrate:
    echo "Running migrations"
    php artisan migrate --force

# Seed database
seed:
    echo "Seeding database"
    php artisan db:seed --force

# Create storage symlink
storage_link:
    echo "Creating storage symlink"
    php artisan storage:link

# Start Laravel server
start:
    echo "Starting Laravel development server"
    php artisan serve

# Start queue worker
queue:
    echo "Starting queue worker..."
    php artisan queue:work --tries=3

# Start scheduler
scheduler:
    echo "Starting scheduler..."
    php artisan schedule:work

# Stop services
stop:
    echo "Stopping services"
    pkill -f "artisan serve"

# Clear caches
clear:
    echo "Clearing caches"
    php artisan optimize:clear

# Run tests
test:
    echo "Running tests"
    php artisan test

# Nginx configuration
nginx_config:
    echo "Generating Nginx configuration"
    cp nginx/felix.conf /etc/nginx/sites-available/felix.conf
    ln -s /etc/nginx/sites-available/felix.conf /etc/nginx/sites-enabled/
