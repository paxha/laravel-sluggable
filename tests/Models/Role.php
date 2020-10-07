<?php

namespace Sluggable\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sluggable\Traits\Sluggable;

class Role extends Model
{
    use Sluggable;
    use SoftDeletes;

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
