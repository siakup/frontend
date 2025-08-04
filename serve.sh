#!/bin/bash

# Load .env file
export $(grep -v '^#' .env | xargs)

echo "🚀 Starting Laravel server on http://127.0.0.1:$APP_PORT"
# Jalankan Laravel dengan APP_PORT dari .env atau fallback ke 8000
php artisan serve --port=${APP_PORT:-8000}
