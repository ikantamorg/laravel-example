# Facebook PHP SDK bundled up for laravel

It basically just uses Laravel Sessions to persist data(instead of php sessions), allows you to set your keys for different apps in a config, set an active app, and registers singleton generator for different sdk objects with IoC.

## Installation

### Artisan

    php artisan bundle:install fb

### Bundle registration 

In `application/bundles.php`:

    return array(
      'fb' => array('auto' => true)
    )

### Note

To use the Facebook PHP SDK you need to have the cURL extension enabled in PHP.

## Configuration

Edit `bundles/fb/config/active.php` and `bundles/fb/config/apps.php`.

## Usage

    $facebook = IoC::resolve('fb');
    $uid = $facebook->getUser();
