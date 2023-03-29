@echo OFF
:: CD without any parameters displays the current working directory
CD

start "" "http://127.0.0.1:8000"
php artisan serve --host 0.0.0.0
pause