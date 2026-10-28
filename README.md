# Jamin - opdracht 2

Webapplicatie voor het magazijn van Jamin, gebouwd met Laravel (MVC), OOP, PDO en stored procedures.

## User stories

1. **Overzicht leveranciers** - overzicht van de leveranciers met het aantal verschillende producten en de door hen geleverde producten (wireframe-01, 02 en 03).
2. **Toevoegen producten** - een nieuwe zending van een product toevoegen aan het aantal in het magazijn (wireframe-02 en 04).

## Opbouw

| Laag | Bestanden |
| --- | --- |
| Model (PDO + stored procedures) | `app/Models/DatabaseModel.php`, `LeverancierModel.php`, `LeveringModel.php` |
| Controller | `app/Http/Controllers/LeverancierController.php`, `LeveringController.php` |
| View | `resources/views/leveranciers`, `resources/views/leveringen` |
| Create-script | `database/migrations/jamin-createscript-Zyon.sql` |
| Stored procedures | `database/migrations/2026_10_28_*` |

## Installeren

```
composer install
npm install && npm run build
cp .env.example .env     # zet DB_DATABASE op opdracht2-jamin
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Inloggen als magazijnmedewerker: `magazijn@test.com` / `password`.

## Tests

De tests gebruiken MySQL (database `opdracht2-jamin-test`) omdat de stored procedures niet in SQLite bestaan.

```
php artisan test
```
