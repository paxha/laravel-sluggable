<?php

namespace Sluggable\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Sluggable\Traits\Sluggable;

class Role extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
    ];

    public static function slugSaveTo()
    {
        return 'role_slug';
    }

    public static function separator()
    {
        return '_';
    }
}
