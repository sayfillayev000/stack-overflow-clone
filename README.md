Bu project stackoverflow ga o'xshagan savol va javob oldadiga web dastur

repository ni clone qilib olish

```bash
   git clone https://github.com/sayfillayev000/stack-overflow-clone.git
   cd stack-overflow-clone
```

```bash
   composer install
   npm install
```

database papkasi ichida database.sqlite file yarating

```bash
php artisan migrate --seed
```

```bash
npm run build || npm run dev
```

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

```bash
php artisan serve
```

Admin
email => admin@example.com,
password =>password,

User
email => john@example.com,
password => password,
