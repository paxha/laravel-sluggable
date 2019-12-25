<?php

namespace Slugable\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Slugable\Traits\Slugable;

class User extends Model
{
    use Slugable;

    protected $fillable = [
        'first_name', 'last_name'
    ];

    public static function slugFrom()
    {
        return ['first_name', 'last_name'];
    }
}
