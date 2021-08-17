<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait ConvertsToSnakeCase
{
    public static function boot()
    {
        parent::boot();

        $changeToSnakeCase = function(Model $model) {
            foreach($model->getAttributes() as $key=>$value) {
                $snakeCase = Str::snake($key);
                unset($model->{$key});
                $model->{$snakeCase} = $value;
            }
        };

        static::creating($changeToSnakeCase);

        static::saving($changeToSnakeCase);

        static::updating($changeToSnakeCase);
    }

    public function __get($key)
    {
        $snakeCase = Str::snake($key);

        if (isset($this->getAttributes()[$snakeCase])) {
            return parent::__get($snakeCase);
        } else {
            return parent::__get($key);
        }
    }

    public function __set($key, $value)
    {
        $snakeCase = Str::snake($key);

        if (property_exists($this, $key)) {
            return parent::__set($key, $value);
        } else {
            return parent::__set($snakeCase, $value);
        }
    }
}
