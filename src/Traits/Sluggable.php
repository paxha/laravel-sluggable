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

    public static function bootSluggable()
    {
        self::creating(function ($model) {
            $traits = class_uses(self::class);
            $usesSoftDelete = false;

            foreach ($traits as $trait) {
                if ($trait === 'Illuminate\Database\Eloquent\SoftDeletes') {
                    $usesSoftDelete = true;
                }
            }

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

            $query = self::where(self::slugSaveTo(), $slug);

            if ($usesSoftDelete) {
                $query->withTrashed();
            }

            $slugExists = $query->exists();

            $latestSlug = null;
            if ($slugExists) {
                $query = self::whereRaw(self::slugSaveTo()." LIKE '$slug%'");
                if ($usesSoftDelete) {
                    $query->withTrashed();
                }
                $latestSlug = $query->latest('id')->value(self::slugSaveTo());
            }

            if ($latestSlug) {
                $pieces = explode(self::separator(), $latestSlug);
                $number = intval(end($pieces));
                $slug .= self::separator().($number + 1);
            }

            $model->{self::slugSaveTo()} = $slug;
        });
    }
}
