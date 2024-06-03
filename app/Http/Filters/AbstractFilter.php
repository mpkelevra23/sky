<?php

namespace App\Http\Filters;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use RuntimeException;

/**
 * Абстрактный класс AbstractFilter содержит метод apply, который применяет фильтры к запросу.
 */
abstract class AbstractFilter
{
    // Массив ключей, по которым будет происходить фильтрация для каждого класса фильтра
    protected array $keys = [];

    /**
     * Применяет фильтры к запросу.
     *
     * @param Builder $builder
     * @param array $data
     * @return Builder
     * @throws RuntimeException Если метод фильтрации не найден или произошла другая ошибка
     */
    public function apply(Builder $builder, array $data): Builder
    {
        foreach ($this->keys as $key) {
            // Преобразуем ключ в camelCase для вызова метода фильтрации
            $method = Str::camel($key);

//            if (!method_exists($this, $method)) {
//                throw new RuntimeException("Method '{$method}' not found in class " . static::class);
//            }

            if (isset($data[$key])) {
                try {
                    // Вызываем метод фильтрации и передаем в него запрос и значение фильтра
                    $builder = $this->$method($builder, $data[$key]);
                } catch (RuntimeException $e) {
                    throw new RuntimeException("Error applying filter method '{$method}': " . $e->getMessage(), 0, $e);
                }
            }
        }

        // Возвращаем запрос с примененными фильтрами
        return $builder;
    }

    /**
     * Магический метод __call для вызова методов фильтрации.
     *
     * @param string $name
     * @param array $arguments
     * @throws RuntimeException
     */
    public function __call(string $name, array $arguments)
    {
        throw new RuntimeException("Call to undefined method " . static::class . "::{$name}()");
    }
}
