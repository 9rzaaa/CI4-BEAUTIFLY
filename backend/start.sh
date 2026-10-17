#!/usr/bin/env bash
set -e

cd /app

# Ensure writable directories and SQLite fallback DB exist with proper permissions
mkdir -p writable/cache writable/logs writable/session writable/uploads writable/debugbar
touch writable/easyco.db
chmod -R 777 writable

# Generate a starter .env if not present
if [ ! -f .env ] && [ -f env ]; then
    cp env .env
fi

# Run migrations and seed initial EASY&CO property, users, and sample bookings (idempotent)
php spark migrate --all || true
php spark db:seed DatabaseSeeder || true

# Bind to Railway's dynamic $PORT (or 8080 by default)
PORT="${PORT:-8080}"
echo "Starting EASY&CO Luxury Condo Booking Server on 0.0.0.0:${PORT}..."
exec php -S "0.0.0.0:${PORT}" -t public public/router.php
