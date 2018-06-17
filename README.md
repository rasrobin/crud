# Small extendable CRUD coding framework
**Version 0.2**

The goal of this package is to provide a small extendable framework to create overview
and CRUD (Create, Read, Update, Delete) pages for your entities programmatically.
When familiar with it, you should be able to create a simple new entity with CRUD
functionality under the hour.

The html contains classes to make it instantly look okay with default Bootstrap.

###1 Dependencies
* Laravel 5.6.x
* Laravel Collective html 5.4
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

### Creating a new entity with CRUD.
* Create your migration file and create a table with it.
* Create a Model for your entity and have it implement ```HasCrud```.
* Create a controller and have it extend ```CrudController```.
* In the controller, set the ```public $model``` tot the Model you created.
```
/**
 * Class BlogController
 */
class BlogController extends CrudController
{
    /**
     * @var HasCrud $model
     */
    public $model = Blog::class;
}
```
* Create a view with the required form fields and have
```crudFormTemplate()``` in your Model return it's path/name.
```
/**
 * {@inheritdoc}
 */
public static function crudFormTemplate()
{
    return 'rasrobin\blog::blog_form';
}
```
* Create a route for your controller. An example:
```
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function(){
    Route::resource('blog', 'Rasrobin\Blog\Controllers\BlogController');
});
```

### Default columns.

### Adding columns.

### Adding special columns.

### One-to-many entity relationship.