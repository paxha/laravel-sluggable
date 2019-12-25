<p align="center">
<a href="https://travis-ci.org/paxha/laravel-slugable"><img src="https://img.shields.io/travis/paxha/laravel-slugable/master.svg?style=flat-square" alt="Build Status"></a>
<a href="https://github.styleci.io/repos/227086797"><img src="https://github.styleci.io/repos/227086797/shield?branch=master" alt="StyleCI"></a>
<a href="https://packagist.org/packages/paxha/laravel-slugable"><img src="https://poser.pugx.org/paxha/laravel-slugable/d/total.svg?format=flat-square" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/paxha/laravel-slugable"><img src="https://poser.pugx.org/paxha/laravel-slugable/v/stable.svg?format=flat-square" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/paxha/laravel-slugable"><img src="https://poser.pugx.org/paxha/laravel-slugable/license.svg?format=flat-square" alt="License"></a>
</p>

# Laravel Slug Generator

## Introduction

This package provides an event that will generate a unique slug when saving or creating any Eloquent model.

## Installation

    composer require paxha/laravel-slugable

## Usage

-   [Getting Started](#getting-started)
-   [Examples](#examples)

### Getting Started

Consider the following table schema for hierarchical data:

```php
Schema::create('users', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name');
    $table->string('slug')->unique();
});
```

Use the `Slugable` trait in your model to work with slug:

```php
class User extends Model
{
    use \Slugable\Traits\Slugable;
}
```

By default, the trait expects three things 

1.  slugFrom(): array (optional) if you using `name` column
2.  slugSaveTo(): string (optional) if you using `slug` column
3.  separator(): string (optional) default `-`

You can overriding it as well `slugFrom()`, `slugSaveTo()` and `separator()`:

```php
class User extends Model
{
    use \Slugable\Traits\Slugable;

    public static function slugFrom()
    {
        return ['name']; // or return ['first_name', 'last_name'];
    }
 
    public static function slugSaveTo()
    {
        return 'slug'; // or return ['user_slug'];
    }
 
    public static function separator()
    {
        return '-'; // or return '_';
    }
}
```

### Examples

#### Example A

##### Database

```php
Schema::create('users', function (Blueprint $table) {
    $table->increments('id');
    $table->string('first_name');
    $table->string('last_name');
    $table->string('slug')->unique();
});
```

##### Model

```php
class User extends Model
{
    use \Slugable\Traits\Slugable;

    protected $fillable = [
        'first_name', 'last_name',
    ];

    public static function slugFrom()
    {
        return ['first_name', 'last_name'];
    }
}
```

##### Create User

```php
User::create([
    'first_name' => 'John',
    'last_name' => 'Doe'
]);

// or

$user = new User();
$user->first_name = 'John';
$user->last_name = 'Doe';
$user->save();
```

##### Output

```json5
{
    'first_name': 'John',
    'last_name': 'Doe',
    'slug': 'john-doe',
}
```

#### Example B

##### Table

```php
Schema::create('users', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name');
    $table->string('user_slug')->unique();
});
```

##### Model

```php
class User extends Model
{
    use \Slugable\Traits\Slugable;
    
    protected $fillable = [
        'name',
    ];

    public static function slugSaveTo()
    {
        return ['user_slug'];
    }

    public static function separator()
    {
        return '_';
    }
}
```

##### Create User

```php
User::create([
    'name' => 'John Doe'
]);

// or

$user = new User();
$user->name = 'John Doe';
$user->save();
```

##### Output

```json5
{
    'name': 'John Doe',
    'user_slug': 'john_doe',
}
```

## License

This is open-sourced laravel library licensed under the [MIT license](https://opensource.org/licenses/MIT).
