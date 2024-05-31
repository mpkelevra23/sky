<?php

namespace App\Traits;

use App\Events\LoggingEnded;
use App\Events\LoggingStarted;
use App\Models\Log;
use Illuminate\Support\Facades\Event;

trait Loggable
{

    /**
     * Метод bootLoggable регистрирует обработчики событий создания, обновления, удаления и получения для любой модели, использующей данный трейт.
     * В laravel метод, который начинается с boot + имя трейта, будет вызван автоматически при загрузке трейта.
     *
     * @return void
     */
    public static function bootLoggable(): void
    {
        static::created(static function ($model) {
            $model->logChange('created');
        });

//        static::retrieved(static function ($model) {
//            $model->logChange('retrieved');
//        });

        static::updated(static function ($model) {
            $model->logChange('updated');
        });

        static::deleted(static function ($model) {
            $model->logChange('deleted');
        });
    }

    public function logChange(string $event): void
    {
        // Запуск события LoggingStarted
        Event::dispatch(new LoggingStarted($this, $event));

        $oldValues = $this->getOriginal();
        $newValues = $this->getDirty();

        // Создаем запись в таблице логов
        Log::create([
            'loggable_id' => $this->id,
            'loggable_type' => get_class($this),
            'event' => $event,
            'old_values' => $oldValues,
            'new_values' => $newValues,
        ]);

        // Запуск события LoggingEnded
        Event::dispatch(new LoggingEnded($this, $event));
    }
}
