<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use JsonException;

class Log extends Model
{
    use HasFactory;

    /**
     * Метод loggable() создает полиморфную связь один ко многим между моделью Log и любой другой моделью приложения.
     *
     * @return MorphTo
     */
    public function loggable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Set the "old_values" attribute.
     * Этот метод является мутатором для столбца old_values таблицы logs. Он принимает массив старых значений и преобразует его в JSON-строку, которая затем сохраняется в столбце old_values таблицы logs.
     * Мутаторы используются для автоматического преобразования значений атрибутов при их установке и сохранении в базе данных.
     * Мутаторы определяются в модели с использованием методов set{AttributeName}Attribute, где {AttributeName} - это имя атрибута, для которого определяется мутатор.
     * Если имя атрибута состоит из нескольких слов, они должны быть записаны в нижнем регистре и разделены символом подчеркивания, а имя метода должно быть записано в верблюжьем регистре.
     *
     * @param array $value
     * @return void
     * @throws JsonException
     */
    public function setOldValuesAttribute(array $value): void
    {
        $this->attributes['old_values'] = json_encode($value, JSON_THROW_ON_ERROR);
    }

    /**
     * Get the "old_values" attribute.
     * Этот метод является аксессором для столбца old_values таблицы logs. Он принимает JSON-строку из столбца old_values таблицы logs и преобразует ее в массив старых значений.
     * Аксессоры используются для автоматического преобразования значений атрибутов при их извлечении из базы данных.
     * Аксессоры определяются в модели с использованием методов get{AttributeName}Attribute, где {AttributeName} - это имя атрибута, для которого определяется аксессор.
     * Если имя атрибута состоит из нескольких слов, они должны быть записаны в нижнем регистре и разделены символом подчеркивания, а имя метода должно быть записано в верблюжьем регистре.
     *
     * @param $value
     * @return array
     * @throws JsonException
     */
    public function getOldValuesAttribute($value): array
    {
        return json_decode($value, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Set the "new_values" attribute.
     *
     * @param array $value
     * @return void
     * @throws JsonException
     */
    public function setNewValuesAttribute(array $value): void
    {
        $this->attributes['new_values'] = json_encode($value, JSON_THROW_ON_ERROR);
    }

    /**
     * Get the "new_values" attribute.
     *
     * @param $value
     * @return array
     * @throws JsonException
     */
    public function getNewValuesAttribute($value): array
    {
        return json_decode($value, true, 512, JSON_THROW_ON_ERROR);
    }
}
