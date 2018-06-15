# CRUD coding framework by Rasrobin
**Version 0.2**

The goal of this package is to provide a small extendable framework to create overview
and CRUD (Create, Read, Update, Delete) pages for your entities programmatically.
When familiar with it, you should be able to create a simple new entity with CRUD
functionality under the hour.

The html contains classes to make it instantly look okay with default Bootstrap.

###1 Dependencies
* Laravel 5.6.x
* Laravel Collective html 5.4
* Nesbot Carbon
* jQuery 3.x

###2 Installation
Begin by installing this package through Composer. Edit your project's
```composer.json``` file to require ```rasrobin/crud```.

```
composer require "rasrobin/crud": "^0.2.0"
```

Run the following command to make the included javascript assets available.
```
php artisan vendor:publish --tag=public --force
```

### Default crud pages.

### Creating a new entity.

### Default columns.

### Adding columns.

### Adding special columns.

### One-to-many entity relationship.