<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

/**
 * Class PropertyValueType
 * @package Zhmi\ExpertSender\Entity
 * @property mixed $value
 * @property string $type
 */
class PropertyValueType extends BaseType
{
    protected $params = array(
        'value' => array(
            'type' => 'mixed',
            'xmlName' => 'Value',
        ),
        'type' => array(
            'type' => 'string',
            'attribute' => true,
            'attributeName' => 'xsi:type',
        )
    );

    private $realValue;
    private $availableXsiMap = array(
        'string'    => 'string',
        'boolean'   => 'boolean',
        'integer'   => 'integer',
        'double'    => 'double',
        'DateTime'  => 'dateTime',
    );

    /**
     * @param mixed $value Значение свойства
     * @param null $type Тип свойства. При указании типа значение будет приведено к строке, поэтому при установке
     * собственного типа необходимо позаботиться заранее о приведении значения в нужный вид
     */
    public function __construct($value, $type = null)
    {
        if ($type === null)
        {
            $this->value = $value;
        }
        else
        {
            if (!$this->isAvailableXsi($type))
            {
                throw new \InvalidArgumentException("Unexpected type '{$type}' of PropertyValue");
            }
            $this->type = $type;
            parent::__set('value', (string)$value);
        }

    }

    /**
     * Собственный сеттер для класса. Необходим, чтобы задать произвольную логику установки значения свойства
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if ($name === 'value')
        {
            $this->setValue($value);
        }
        else
        {
            parent::__set($name, $value);
        }
    }

    /**
     * Приведение класса к строке приведет к тому, что объект будет содержать строковое значение свойства
     * @return mixed
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * Вспомогательная функция, которая по опредленной логике задает значение свойства и преобразует его в строку.
     * Также функция задает тип свойства в зависимости от типа значения
     * @param mixed $value
     */
    private function setValue($value)
    {
        $this->realValue = $value;

        $actualType = $this->getActualType($value);
        if (!$this->isAvailableType($actualType))
        {
            throw new \InvalidArgumentException("Unexpected type '{$actualType}' of the PropertyValue");
        }

        $xsi = $this->availableXsiMap[ $actualType ];

        switch ($actualType)
        {
            case 'DateTime':
                $value = $value->format('Y-m-d\TH:i:s');
                break;
            case 'integer':
            case 'double':
                $value = (string)$value;
                break;
            case 'boolean':
                $value = $value === true ? 'true' : 'false';
                break;
            case 'string':
            default:
                $xsi = 'string';
                $this->realValue = (string)$value;
                break;
        }

        if (preg_match('/^\d{4}-\d{2}-\d{2}&/', $value))
        {
            $xsi = 'date';
        }

        $this->type = 'xs:'.$xsi;
        parent::__set('value', $value);

    }

    /**
     * Получает реальное значение свойства
     * @return mixed
     */
    public function getRealValue()
    {
        return $this->realValue;
    }

    /**
     * Проверяет, доступен ли тип
     * @param string $actualType
     * @return bool
     */
    private function isAvailableType($actualType)
    {
        return isset($this->availableXsiMap[ $actualType ]);
    }

    /**
     * Проверяет, доступен ли тип xsi
     * @param string $xsi
     * @return bool
     */
    private function isAvailableXsi($xsi)
    {
        return in_array($xsi, $this->availableXsiMap);
    }
}