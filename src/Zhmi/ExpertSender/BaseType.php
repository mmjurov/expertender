<?php

namespace Zhmi\ExpertSender;

/**
 * Базовый класс для всех сущностей XML
 * @package Zhme\ExpertSender
 */
class BaseType
{
    /**
     * @var array Хеш таблица, где в качестве ключа используется имя свойства класса,
     * а каждый элемент может содержать хеш со следующими ключами:
     * <ul>
     * <li><b>(string) type</b> - тип значения свойства. Может содержать скалярные типы или имя класса<li>
     * <li><b>(string) xmlName</b> - имя тега, которое будет исопльзовано при сериализации объекта в xml<li>
     * <li><b>(boolean) attribute</b> - флаг, является ли данное свойство атрибутом для данной сущности<li>
     * <li><b>(string) attributeName</b> - имя атрибута, которое будет использовано при сериализации объекта в xml<li>
     * <li><b>(boolean) unbound</b> - этот флаг ставится для того свойства, которое должно быть множественным. В этом
     * случае создается экземпляр класса, который реализовывает итератор и доступ к массиву, а значение свойства задается
     * с помощью массива<li>
     * <li><b>(string) unboundTag</b> - название тега для множественных свойств класса<li>
     * </ul>
     */
    protected $params = array();

    /**
     * @var array Хранилище ключ => значение, в котором хранятся значения всех свойств класса
     */
    private   $values = array();

    /**
     * @var string|null Строковое имя типа сущности, используется не во всех сущностях
     */
    protected $xsiType = null;

    /**
     * Все свойства наследников определены в поле @params, а их значения в поле @values. Для доступа к свойствам используем
     * магическую функцию, чтобы динамически проверять значение, существование свойства, а также определять кастомную
     * логику для установки значения
     *
     * @param $name
     * @param $value
     */
    function __set($name, $value)
    {
        self::checkPropertyExists($name);
        self::checkPropertyType($name, $value);

        $propInfo = $this->getPropertyInfo($name);

        if ($propInfo['unbound'] === false)
        {
            $this->values[ $name ] = $value;
        }
        elseif ($propInfo['unbound'] === true && !($value instanceof Unbound))
        {
            $this->values[ $name ] = new Unbound($name, $propInfo[ 'type' ]);
            foreach ($value as $item)
            {
                $this->values[ $name ][ ] = $item;
            }
        }
        else
        {
            $this->values[ $name ] = $value;
        }

    }

    /**
     * Геттер, который получает значения свойства по их имени
     *
     * @param $name
     * @return null
     */
    function __get($name)
    {
        $propInfo = $this->getPropertyInfo($name);

        if ($propInfo[ 'unbound' ] === true && !array_key_exists($name, $this->values))
        {
            $this->values[ $name ] = new Unbound($name, $propInfo[ 'type' ]);
        }

        return array_key_exists($name, $this->values) ? $this->values[ $name ] : null;
    }

    /**
     * Проверка существования свойства
     * @param $name
     * @return bool
     */
    function __isset($name)
    {
        return array_key_exists($name, $this->values);
    }

    /**
     * Вспомогательная функция, которая проверяет тип свойства и в случае ошибки выбрасывает исключение
     * @param string $name Имя свойства
     * @param mixed $value Значение свойства
     * @throws \InvalidArgumentException
     */
    private function checkPropertyType($name, $value)
    {
        $propInfo = $this->getPropertyInfo($name);

        if ($propInfo[ 'type' ] === 'mixed')
            return;

        $actualType = $this->getActualType($value);

        $class = get_called_class();
        if (
            $propInfo[ 'unbound' ] === false
            && $actualType !== $propInfo[ 'type' ]
            && !is_a($value, $propInfo['type'])
        )
        {
            throw new \InvalidArgumentException("Incorrect type '{$actualType}' for attribute '{$name}' in '{$class}'. '{$propInfo['type']}' expected");
        }
        elseif
        (
            $propInfo[ 'unbound' ] === true
            && ($actualType !== 'array' && !($value instanceof Unbound))
        )
        {
            throw new \InvalidArgumentException("Incorrect type '{$actualType}' for attribute '{$name}' in '{$class}'. Array of '{$propInfo['type']}' expected");
        }
    }

    /**
     * Вспомогательная функция, которая проверяет наличие свойства в перечне допустимых, и в случае ошибки выбрасывает
     * исключение
     *
     * @param $name
     * @throws \InvalidArgumentException
     */
    private function checkPropertyExists($name)
    {
        $propInfo = $this->getPropertyInfo($name);
        if (!$propInfo)
        {
            $class = get_called_class();
            throw new \InvalidArgumentException("Unexpected attribute '{$name}' in class {$class}. This attribute is not implemented");
        }
    }

    /**
     * Вспомогательная функция, которая получает информацию о свойстве
     *
     * @param $name
     * @return mixed
     */
    private function getPropertyInfo($name)
    {
        $propInfo = $this->params[ $name ];
        if (!isset( $propInfo[ 'unbound' ] ) || !is_bool($propInfo[ 'unbound' ]))
        {
            $propInfo[ 'unbound' ] = false;
            $propInfo[ 'unboundTag' ] = null;
        }

        if (!isset( $propInfo['cdata']) || !is_bool($propInfo['cdata']))
        {
            $propInfo['cdata'] = false;
        }
        else
        {
            $propInfo['cdata'] = true;
        }

        if (!isset( $propInfo[ 'attribute' ] ) || !is_bool($propInfo[ 'attribute' ]))
        {
            $propInfo[ 'attribute' ] = false;
        }

        return $propInfo;
    }

    /**
     * Вспомогательная функция, которая получает реальный тип переменной. Если в качестве аргумента передан экземпляр
     * класса, то вернется имя класса
     * @param mixed $value
     * @return string
     */
    protected function getActualType($value)
    {
        $actualType = gettype($value);
        if ($actualType == 'object')
        {
            $actualType = get_class($value);
        }

        return $actualType;
    }

    /**
     * Функция сериализации объекта в xml
     * @return string
     */
    public function toXml()
    {
        $xml = '';

        foreach ($this->params as $name => $propInfo)
        {
            $propInfo = $this->getPropertyInfo($name);
            if (isset($this->{$name}) && $propInfo['attribute'] !== true)
            {
                $propertyValue = $this->{$name};
                if ($propInfo['unbound'] === true)
                {
                    $xml .= "<{$propInfo['unboundTag']}>";
                    foreach ($propertyValue as $value)
                    {
                        if ($propInfo['xmlName'])
                        {
                            $xml .= "<{$propInfo['xmlName']}{$this->attributesToXml()}>";
                            $xml .= $value->toXml();
                            $xml .= "</{$propInfo['xmlName']}>";
                        }
                        else
                        {
                            $xml .= $value->toXml();
                        }
                    }
                    $xml .= "</{$propInfo['unboundTag']}>";
                }
                elseif(!is_scalar($propertyValue))
                {
                    if ($propInfo['xmlName'])
                    {
                        $xml .= "<{$propInfo['xmlName']}{$this->attributesToXml()}>{$propertyValue->toXml()}</{$propInfo['xmlName']}>";
                    }
                    else
                    {
                        $xml .= $propertyValue->toXml();
                    }
                }
                else
                {
                    $cdata = isset($propInfo['cdata']) && $propInfo['cdata'] === true;
                    if ($propInfo['xmlName'])
                    {
                        $tag = $propInfo['xmlName'];
                        $xml .= "<{$tag}{$this->attributesToXml()}>";
                        if ($cdata) $xml .= '<![CDATA[';
                        $xml .= "{$this->encodeXmlValue($propertyValue)}";
                        if ($cdata) $xml .= ']]>';
                        $xml .= "</{$tag}>";
                    }
                    else
                    {
                        if ($cdata) $xml .= '<![CDATA[';
                        $xml .= $this->encodeXmlValue($propertyValue);
                        if ($cdata) $xml .= ']]>';
                    }

                }
            }
        }


        return $xml;
    }

    /**
     * Вспомогательная функция для преобразования атрибутов в xml
     * @return string
     */
    private function attributesToXml()
    {
        $xml = '';
        foreach ($this->params as $name => $propInfo)
        {
            $propInfo = $this->getPropertyInfo($name);
            if ($propInfo['attribute'] !== true)
            {
                continue;
            }
            if (!isset($this->{$name}))
            {
                continue;
            }

            $xml .= " {$propInfo['attributeName']}=\"{$this->{$name}}\"";
        }
        return $xml;
    }

    /**
     * Вспомогательная функция, которая кодирует значение переменной в xml
     * @param $val
     * @return string
     */
    private function encodeXmlValue($val)
    {
        $type = $this->getActualType($val);
        switch ($type)
        {
            case 'DateTime':
                /** @var \DateTime $val */
                $val = $val->format('Y-m-dTH:i:s');
                break;
            case 'integer':
            case 'double':
                $val = (string)$val;
                break;
            case 'boolean':
                $val = $val === true ? 'true' : 'false';
                break;
            case 'string':
            default:
                break;
        }

        return $val;
    }

    /**
     * Геттер для получения типа сущности
     * @return null|string
     */
    public function getXsiType()
    {
        return $this->xsiType;
    }

    /**
     * Получает мета-данные для элемента сущности
     *
     * Этот метод используется при десериализации XML в объект в тот момент, когда парсится имя свойства
     *
     * @param string $elementName Имя XML элемента, для которого нужно получить мета данные
     * @return mixed Мета-данные о свойтсве или null
     */
    public function elementMeta($elementName)
    {
        if (array_key_exists($elementName, $this->params))
        {
            $info = $this->getPropertyInfo($elementName);
            $isAttribute = $info['attribute'] === true;

            $nameKey = $isAttribute ? 'attributeName' : 'xmlName';

            if (array_key_exists($nameKey, $info))
            {
                if ($info[$nameKey] === $elementName)
                {
                    $meta = new \StdClass();
                    $meta->propertyName = $elementName;
                    $meta->phpType = $info['type'];
                    $meta->unbound = $info['unbound'];
                    $meta->unboundTag = $info['unboundTag'];
                    $meta->attribute = $info['attribute'];
                    $meta->elementName = $info[$nameKey];
                    $meta->strData = '';

                    return $meta;
                }
            }
        }

        return null;
    }
}