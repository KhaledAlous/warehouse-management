<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Sluggable
{
    protected static function bootSluggable()
    {
        static::creating(function ($model) {
            $model->generateSlug();
        });

        static::updating(function ($model) {
            if ($model->isDirty($model->getSlugFrom())) {
                $model->generateSlug();
            }
        });
    }

    protected function generateSlug()
    {
        $baseSlug = Str::slug($this->{$this->getSlugFrom()}); 
        $slug = $baseSlug;
        $counter = 1;
        while (static::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $this->attributes['slug'] = $slug;
    }

    abstract protected function getSlugFrom(): string;
}