<?php

namespace Slugable\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Slugable\Slugable;

class Role extends Model
{
    use Slugable;

    protected $fillable = [
        'name'
    ];

    public static function slugFrom()
    {
        return ['name'];
    }

    public static function slugSaveTo()
    {
        return 'role_slug';
    }

    public static function separator()
    {
        return '_';
    }
}
