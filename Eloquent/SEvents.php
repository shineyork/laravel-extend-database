<?php
namespace ShineYork\LaravelExtend\Database\Eloquent;

use ShineYork\LaravelExtend\Database\Eloquent\SBuilder;

trait SEvents
{
    public function fireModelEvent($event, $halt = true)
    {
        if (! isset(static::$dispatcher)) {
            return true;
        }

        $method = $halt ? 'until' : 'dispatch';

        $result = $this->filterModelEventResults(
            $this->fireCustomModelEvent($event, $method)
        );

        if ($result === false) {
            return false;
        }

        return ! empty($result) ? $result : static::$dispatcher->{$method}(
            "eloquent.{$event}: ".static::class, $this
        );
    }

    public static function observes($observes = null)
    {
        foreach ((empty($observes) ? config(config('extend.database.package-observer')) : $observes) as $model => $observe) {
            $model = (new static)->checkModel($model);
            $observe = (new static)->checkObserve($observe);
            $model::observe($observe);
        }
    }

    public function checkModel($model = null)
    {
        return (class_exists($model)) ? $model : 'ShineYork\LaravelShop\Data\Goods\Models\\'.$model;
    }

    public function checkObserve($observe = null)
    {
        return (class_exists($observe)) ? $observe : 'ShineYork\LaravelShop\Data\Goods\Observers\\'.$observe;
    }

    public function newEloquentBuilder($query)
    {
        return new SBuilder($query);
    }
}
