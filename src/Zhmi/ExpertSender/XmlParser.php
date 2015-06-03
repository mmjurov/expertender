<?php

namespace Zhmi\ExpertSender;

/**
 * Класс, который помогает десериализовывать XML в объект
 * @package Zhme\ExpertSender
 */
class XmlParser
{
    private $rootObjectClass;
    private $rootObject;
    private $stack;

    public function __construct($rootObjectClass)
    {
        $this->rootObjectClass = $rootObjectClass;

        $this->stack = new \SplStack();
    }

    /**
     * Метод, который запускает механизм парсинга XML строки
     * @param string $xml
     * @return BaseType
     */
    public function parse($xml)
    {
        $parser = xml_parser_create('UTF-8');

        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_set_object($parser, $this);
        xml_set_element_handler($parser, 'startElementHandler', 'endElementHandler');
        xml_set_character_data_handler($parser, 'valueHandler');

        xml_parse($parser, $xml, true);

        xml_parser_free($parser);

        return $this->rootObject;
    }

    /**
     * Callback метод для обработки начального элемента XML
     * @param resource $parser
     * @param string $name
     * @param array $attributes
     * @return bool
     */
    private function startElementHandler($parser, $name, array $attributes)
    {
        if ($name == 'ApiResponse')
        {
            return false;
        }

        $this->stack->push($this->getPhpMeta($name, $attributes));
    }

    /**
     * Callback метод для обработки скалярного значения между тегами
     * @param resource $parser
     * @param string $value
     * @return bool
     */
    private function valueHandler($parser, $value)
    {
        $value = trim($value);
        if (strlen($value) === 0) return false;
        $this->stack->top()->strData .= $value;
    }

    /**
     * Callback метод для обработкик конечного элемента XML
     * @param resource $parser
     * @param string $name
     * @return bool
     */
    private function endElementHandler($parser, $name)
    {
        if ($name == 'ApiResponse')
        {
            return false;
        }

        $meta = $this->stack->pop();

        if (!$this->stack->isEmpty())
        {
            if ($meta->propertyName !== '')
            {
                $parentObject = $this->getParentObject();

                if ($parentObject)
                {
                    $parentObject->{$meta->propertyName} = $this->getValueToAssign($meta);
                }
            }
            else
            {
                $parentObject = $this->getParentObject($meta);
                if ($parentObject instanceof Unbound)
                {
                    $parentObject[] = $meta->phpObject;
                }
            }
        } else {
            $this->rootObject = $meta->phpObject;
        }
    }

    /**
     * Получает верхний элемент стека объектов
     * @return mixed
     */
    private function getParentObject()
    {
        return $this->stack->top()->phpObject;
    }

    /**
     * Формирует мета-объект, сущность XML документа
     * @param $elementName
     * @param $attributes
     * @return mixed|\StdClass
     */
    private function getPhpMeta($elementName, $attributes)
    {
        $meta = new \StdClass();
        $meta->propertyName = '';
        $meta->phpType = '';
        $meta->unbound = false;
        $meta->attribute = false;
        $meta->elementName = '';
        $meta->strData = '';
        $meta->unboundTag = '';

        if (!$this->stack->isEmpty())
        {
            $parentObject = $this->getParentObject();

            if ($parentObject instanceof Unbound)
            {
                $meta->phpType = $parentObject->getExpectedType();
            }
            elseif ($parentObject)
            {
                /** @var BaseType $parentObject */
                $elementMeta = $parentObject->elementMeta($elementName);
                if ($elementMeta)
                {
                    $meta = $elementMeta;
                }
            }
        }
        else
        {
            $meta->phpType = $this->rootObjectClass;
        }

        $meta->phpObject = $this->newPhpObject($meta);

        /*if ($meta->phpObject)
        {
            foreach ($attributes as $attribute => $value)
            {
                $attributeMeta = $meta->phpObject->elementMeta($attribute);
                if ($attributeMeta)
                {
                    $attributeMeta->strData = $value;
                    $meta->phpObject->{$attributeMeta->propertyName} = $this->getValueToAssignToProperty($attributeMeta);
                }
            }
        }*/

        return $meta;
    }

    /**
     * Создает новый экземпляр класса заданного типа
     * @param mixed $meta
     * @return null|Unbound
     */
    private function newPhpObject($meta)
    {
        $object = null;
        switch ($meta->phpType) {
            case 'integer':
            case 'string':
            case 'double':
            case 'boolean':
                break;
            default:
                $object = $meta->phpType !== '' ? new $meta->phpType() : null;
        }

        if ($meta->unbound)
        {
            $unbound = new Unbound($meta->elementName, $meta->phpType);
            return $unbound;
        }

        return $object;
    }

    /**
     * Возвращает реальное значение, которое нужно присвоить полю экземпляра класса
     * @param $meta
     * @return mixed
     */
    private function getValueToAssign($meta)
    {
        if ($this->isSimplePhpType($meta))
        {
            return $this->getValueToAssignToProperty($meta);
        }
        else
        {
            $meta->phpObject->value = $meta->strData;
            return $meta->phpObject;
        }
    }

    /**
     * Выполняет проверку на то, является ли объект в meta информации простым php типом или DateTime
     * @param $meta
     * @return bool
     */
    private function isSimplePhpType($meta)
    {
        switch ($meta->phpType)
        {
            case 'integer':
            case 'string':
            case 'double':
            case 'boolean':
            case 'DateTime':
                return true;
            default:
                return false;
        }
    }

    /**
     * Получает значение из мета-информации для простых php типов
     * @param $meta
     * @return mixed
     */
    private function getValueToAssignToProperty($meta)
    {
        switch ($meta->phpType)
        {
            case 'integer':
                return (integer)$meta->strData;
            case 'double':
                return (double)$meta->strData;
            case 'boolean':
                return strtolower($meta->strData) === 'true';
            case 'DateTime':
                return new \DateTime($meta->strData, new \DateTimeZone('UTC'));
            case 'string':
            default:
                return $meta->strData;
        }
    }
}
