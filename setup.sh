if [ -z $1 ]; then
	env=""
else
	env="--env=$1"
fi

echo "php artisan migrate:install $env"
echo "php artisan migrate $env"
echo "php artisan core::tagables:setup $env"
echo "php artisan admin::superadmin:setup $env"
echo "php artisan bundle:publish admin $env"

php artisan migrate:install $env
php artisan migrate $env
php artisan core::tagables:setup $env
php artisan admin::superadmin:setup $env
php artisan bundle:publish admin $env