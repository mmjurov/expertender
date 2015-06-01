<?php

namespace Zhmi\ExpertSender;

/**
 * Класс, реализующий необходимые интерфейсы для работы с ним как с массивом
 * @package Zhme\ExpertSender
 */
class Unbound implements \ArrayAccess, \Countable, \Iterator
{
    /**
     * @var array Массив с данными экземпляра класса
     */
    private $data = array();

    /**
     * @var integer Текущее положение указателя в массиве
     */
    private $position = 0;

    /**
     * @var string Имя свойства, которое будет работать как массив
     */
    private $property;

    /**
     * @var string Тип данных, который должен быть присвоен элементам массива
     */
    private $expectedType;

    /**
     * @param string $property Имя свойства, которое должно работать как массив
     * @param string $expectedType Тип данных, который должен быть присвоен элементам массива
     */
    public function __construct($property, $expectedType)
    {
        $this->property = $property;
        $this->expectedType = $expectedType;
    }

    public function getExpectedType()
    {
        return $this->expectedType;
    }

    /**
     * Реализация ArrayAccess
     * Определяет наличие элемента в массиве.
     *
     * @param integer $offset Индекс массива, который нужно проверить
     * @returns boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * Реализация ArrayAccess
     * Возвращает значение массива, хранящееся под заданным индексом
     *
     * @param integer $offset Индекс массива
     * @returns mixed Значение массива или null, если его нет
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->data[$offset] : null;
    }

    /**
     * Реализация ArrayAccess
     * Устанавливает значение массива
     *
     * @param mixed $offset Индекс массива или null, куда добавить значение массива
     * @throws \InvalidPropertyTypeException Если значение имеет неожидаемый тип, будет выброшено исключение
     */
    public function offsetSet($offset, $value)
    {
        self::ensurePropertyType($value);

        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * Реализация ArrayAccess
     * Удаляет значение под заданным индексом
     *
     * @param integer $offset Индекс массива
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * Реализация Countable
     * @returns integer Количество элементов массива
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * Реализация Iterator
     * @returns mixed Значение текущего элемента массива
     */
    public function current()
    {
        return $this->offsetGet($this->position);
    }

    /**
     * Реализация Iterator
     * @returns integer Позиция указателя массива
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Реализация Iterator
     * Перемещает указатель массива к следующему элементу массива
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * Реализация Iterator
     * Перемещает указатель массива в начало массива
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Реализация Iterator
     * @returns boolean Возвращает true, если текущий элемент массива с текущим индексом существует
     */
    public function valid()
    {
        return $this->offsetExists($this->position);
    }

    /**
     * Проверяет тип свойства для присваиваемого значения
     *
     * @param mixed $value Значение, которое устанавливается для элемента массива
     */
    private function ensurePropertyType($value)
    {
        $actualType = gettype($value);
        if ('object' === $actualType) {
            $actualType = get_class($value);
        }
        if ($this->expectedType !== $actualType) {
            throw new \InvalidArgumentException("Incorrect type");
        }
    }
}
