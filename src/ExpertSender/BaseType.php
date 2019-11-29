<?php

namespace Zhmi\ExpertSender;

/**
 * Базовый класс для всех сущностей XML
 * @package Zhmi\ExpertSender
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
    protected $values = array();

    /**
     * 在 xml 中的节点位置
     * auto 由属性定义自动关联
     * root 仅次于root
     *
     * @var string
     */
    protected $position = 'auto';

    /**
     * @var string|null Строковое имя типа сущности, используется не во всех сущностях
     */
    protected $xsiType = null;

    /**
     * 调用 toArray 方法时， 是否将接口的大陀封命名， 转换为下划线连接的全小写命名
     *
     * @var boolean
     */
    private $array_use_underline_field_name = false;


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
        if ($propInfo['unbound'] === false) {
            $this->values[ $name ] = $value;
        } elseif ($propInfo['unbound'] === true && !($value instanceof Unbound)) {
            $this->values[ $name ] = new Unbound($name, $propInfo[ 'type' ]);
            foreach ($value as $item) {
                $this->values[ $name ][ ] = $item;
            }
        } else {
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
        if ($propInfo[ 'unbound' ] === true && !array_key_exists($name, $this->values)) {
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
        if ($propInfo[ 'type' ] === 'mixed') {
            return false;
        }

        $actualType = $this->getActualType($value);

        $class = get_called_class();
        if (
            $propInfo[ 'unbound' ] === false
            && $actualType !== $propInfo[ 'type' ]
            && !is_a($value, $propInfo['type'])
        ) {
            throw new \InvalidArgumentException("Incorrect type '{$actualType}' for attribute '{$name}' in '{$class}'. '{$propInfo['type']}' expected");
        }
        elseif (
            $propInfo[ 'unbound' ] === true
            && ($actualType !== 'array' && !($value instanceof Unbound))
        ) {
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
        if (!$propInfo) {
            $class = get_called_class();
            throw new \InvalidArgumentException("Unexpected attribute '{$name}' in class {$class}. This attribute is not implemented, params:". json_encode($this->params));
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
        if (!isset( $propInfo[ 'unbound' ] ) || !is_bool($propInfo[ 'unbound' ])) {
            $propInfo[ 'unbound' ] = false;
            $propInfo[ 'unboundTag' ] = null;
        }

        if (!isset( $propInfo['cdata']) || !is_bool($propInfo['cdata'])) {
            $propInfo['cdata'] = false;
        } else {
            $propInfo['cdata'] = true;
        }

        if (!isset( $propInfo[ 'attribute' ] ) || !is_bool($propInfo[ 'attribute' ])) {
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
        if ($actualType == 'object') {
            $actualType = get_class($value);
        }

        return $actualType;
    }

    /**
     * 数据结构-节点位置
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Функция сериализации объекта в xml
     * @return string
     */
    public function toXml()
    {
        $xml = '';

        foreach (array_keys($this->params) as $name) {
            $propInfo = $this->getPropertyInfo($name);
            if (isset($this->{$name}) && $propInfo['attribute'] !== true) {
                $propertyValue = $this->{$name};
                if ($propInfo['unbound'] === true) {
                    $xml .= "<{$propInfo['unboundTag']}>";
                    foreach ($propertyValue as $value) {
                        if ($propInfo['xmlName']) {
                            $xml .= "<{$propInfo['xmlName']}{$this->attributesToXml()}>";
                            if (gettype($value) == 'object') {
                                $xml .= $value->toXml();
                            } else {
                                $xml .= $value;
                            }
                            $xml .= "</{$propInfo['xmlName']}>";
                        } else {
                            $xml .= $value->toXml();
                        }
                    }
                    $xml .= "</{$propInfo['unboundTag']}>";
                } elseif(!is_scalar($propertyValue)) {
                    if ($propInfo['xmlName']) {
                        $xml .= "<{$propInfo['xmlName']}{$this->attributesToXml()}>{$propertyValue->toXml()}</{$propInfo['xmlName']}>";
                    } else {
                        $xml .= $propertyValue->toXml();
                    }
                } else {
                    $cdata = isset($propInfo['cdata']) && $propInfo['cdata'] === true;
                    if ($propInfo['xmlName']) {
                        $tag = $propInfo['xmlName'];
                        $xml .= "<{$tag}{$this->attributesToXml()}>";
                        if ($cdata) $xml .= '<![CDATA[';
                        $xml .= "{$this->encodeXmlValue($propertyValue)}";
                        if ($cdata) $xml .= ']]>';
                        $xml .= "</{$tag}>";
                    } else {
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
     * 解析后的对象属性转为数组格式
     *
     * @return array
     */
    public function toArray($use_underline_field_name=false)
    {
        $arr = [];

        if($use_underline_field_name) {
            $this->array_use_underline_field_name = $use_underline_field_name;
        } else {
            $use_underline_field_name = $this->array_use_underline_field_name;
        }

        foreach (array_keys($this->params) as $name) {
            $value = array_get($this->values, $name, null);
            if (gettype($value) == 'object') {
                if (method_exists($value, 'toArray')) {
                    $value = $value->toArray();
                } else if (substr(get_class($value), -7) == 'Unbound') {
                    $subArr = [];
                    foreach ($value as $item) {
                        if (gettype($item) == 'object' && method_exists($item, 'toArray')) {
                            $subArr[] = $item->toArray($this->array_use_underline_field_name);
                        } else {
                            $subArr[] = $item;
                        }
                    }
                    $value = $subArr;
                }
            }

            $propInfo = $this->getPropertyInfo($name);
            if (isset($propInfo[ 'type' ])) {
                switch ($propInfo[ 'type' ]) {
                    case 'DateTime':
                        /** @var \DateTime $val */
                        $value = $value instanceof \DateTime ? $value->format('Y-m-d H:i:s') : string($value);
                        break;
                    case 'integer':
                        $value = intval($value);
                        break;
                    case 'boolean':
                        $value = boolval($value);
                        break;
                    case 'string':
                        $value = strval($value);
                        break;
                    default:
                        if (!$value && isset($propInfo[ 'unbound' ]) && $propInfo[ 'unbound' ] === true) {
                            $value = [];
                        }
                        break;
                }
            }

            if ($this->array_use_underline_field_name) {
                $name = preg_replace_callback('/[A-Z]+/', function ($val) { return '_' . strtolower($val[0]); }, $name);
                $name = preg_replace('/^_+/', '', strtolower($name));
            }

            $arr[$name] = $value;
        }

        return $arr;
    }

    /**
     * 转为下划线连接(大写字母转下划线和小写字母)命名
     *
     * @param  string $name
     * @return string
     */
    public function useUnderlineFieldName($use_underline_field_name=true)
    {
        $this->array_use_underline_field_name = $use_underline_field_name;

        return $this;
    }

    /**
     * Вспомогательная функция для преобразования атрибутов в xml
     * @return string
     */
    private function attributesToXml()
    {
        $arr = [];
        foreach (array_keys($this->params) as $name) {
            $propInfo = $this->getPropertyInfo($name);
            if ($propInfo['attribute'] !== true) {
                continue;
            }
            if (!isset($this->{$name})) {
                continue;
            }

            $arr[] = implode('', [$propInfo['attributeName'], '="', $this->{$name}, '"']);
        }
        return implode(' ', $arr);
    }

    /**
     * Вспомогательная функция, которая кодирует значение переменной в xml
     * @param $val
     * @return string
     */
    private function encodeXmlValue($val)
    {
        $type = $this->getActualType($val);
        switch ($type) {
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
        if (array_key_exists($elementName, $this->params)) {
            $info = $this->getPropertyInfo($elementName);
            $isAttribute = $info['attribute'] === true;

            $nameKey = $isAttribute ? 'attributeName' : 'xmlName';

            if (array_key_exists($nameKey, $info)) {
                if ($info[$nameKey] === $elementName) {
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