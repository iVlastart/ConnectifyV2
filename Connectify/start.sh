#cmd /k start.sh

echo "Starting PHP dev server"
php artisan serve &

echo "Starting NPM dev server"
npm run dev &

echo "Go to https://127.0.0.1:8000 to view the app"

wait