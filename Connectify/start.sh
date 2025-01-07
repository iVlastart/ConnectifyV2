#cmd /k start.sh

echo "Starting PHP dev server"
php artisan serve &

echo "Starting NPM dev server"
npm run dev &

wait