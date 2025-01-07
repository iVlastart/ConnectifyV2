#cmd /k start.sh

echo "Starting PHP dev server"
php artisan serve &

echo "Starting NPM dev server"
npm run dev &

echo "THIS IS THE WEB APP LOCAL URL => http://127.0.0.1:8000"
echo "Any other links can be ignored"
echo "---------The server is running please keep open---------"

wait