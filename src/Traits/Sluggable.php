<?php

namespace Sluggable\Traits;

use Illuminate\Support\Str;

trait Sluggable
{
    public static function slugFrom(): array
    {
        return ['name'];
    }

    public static function slugSaveTo(): string
    {
        return 'slug';
    }

    public static function separator(): string
    {
        return '-';
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if (!count(self::slugFrom())) {
                return;
            }

            $str = null;
            foreach (self::slugFrom() as $item) {
                if ($str) {
                    $str .= ' ';
                }
                $str .= $model->{$item};
            }

            $slug = Str::slug($str, self::separator());

            $latestSlug = self::whereRaw(self::slugSaveTo()." = '$slug' or ".self::slugSaveTo()." LIKE '$slug%'")->latest('id')->value(self::slugSaveTo());
            if ($latestSlug) {
                $pieces = explode(self::separator(), $latestSlug);
                $number = intval(end($pieces));
                $slug .= self::separator().($number + 1);
            }

            $model->{self::slugSaveTo()} = $slug;
        });
    }
}
