<?php

namespace Sluggable\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Sluggable\Traits\Sluggable;

class User extends Model
{
    use Sluggable;

    protected $fillable = [
        'first_name', 'last_name',
    ];

    public static function slugFrom()
    {
        return ['first_name', 'last_name'];
    }
}
