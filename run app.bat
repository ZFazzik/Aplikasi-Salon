@echo OFF
:: CD without any parameters displays the current working directory
:: jangan lupa hidupin php gd di php.ini
:: base = cd "C:\xampp"

if exist D:\Proj\xampp\xampp-control.exe (
    start D:\Proj\xampp\xampp-control.exe
) else (
    start C:\xampp\xampp-control.exe
)

start "" "http://127.0.0.1:8000"

CD

php artisan serve --host 0.0.0.0

pause