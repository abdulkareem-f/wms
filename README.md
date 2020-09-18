# Warehouse Management System Developer Assessment


### Installation (first time)

1. Open in cmd or terminal app and navigate to project folder
2. Run following commands

```bash
composer install
cp .env.example .env
```

3. Set the database information in .env
   DB_DATABASE, DB_USERNAME, DB_PASSWORD

4. Run following commands

```bash
php artisan key:generate
php artisan passport:install
php artisan migrate --seed
```

### Auth

#### Admin
	- Email: `admin@admin.com`
	- Password: `admin_admin`

#### Warehouse Keeper User (Static one)
	- Email: `warehouse@keeper.com`
	- Password: `warehouse_keeper`


### For the APIs, you can import the file (`WMS.postman_collection.json`) to postman and test the APIs