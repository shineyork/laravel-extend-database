<h1 align="center"> laravel-extend-database </h1>

<p align="center"> .</p>


## Installing

```shell
$ composer require shineyork/laravel-extend-database
```

## 描述

这是针对于laravel的观察者模型在进行完善的扩展

```php
Model::where('id', '1')->update([
  'name' => 'laravel'
]);
```

如上的方式修改或者删除而观察者事件失效进一步扩展该功能，使用的方式只需要在模型中引用`ShineYork\LaravelExtend\Database\Eloquent\SEvents`即可

```php
use Illuminate\Database\Eloquent\Model;
use ShineYork\LaravelExtend\Database\Eloquent\SEvents;

class Category extends Model
{
    use SEvents;
}
```
