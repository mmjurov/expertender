<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

/**
 * Class ListExportType
 * @package Zhmi\ExpertSender\Entity
 * @property string $type
 * @property integer $listId
 * @property string[] $fields
 * @property integer[] $properties
 */
class ListExportType extends BaseType
{
    protected $params = array(
        'type' => array(
            'type' => 'string',
            'xmlName' => 'Type',
        ),
        'listId' => array(
            'type' => 'integer',
            'xmlName' => 'ListId',
        ),
        'segmentId' => array(
            'type' => 'integer',
            'xmlName' => 'SegmentId',
        ),
        'fields' => array(
            'type' => 'string',
            'xmlName' => 'Field',
            'unbound' => true,
            'unboundTag' => 'Fields'
        ),
        'properties' => array(
            'type' => 'integer',
            'xmlName' => 'Property',
            'unbound' => true,
            'unboundTag' => 'Properties'
        ),
    );

    /**
     * @deprecated
     */
    public function __construct($type='', $listId=0, $segmentId=0, array $fields=[], array $properties=[])
    {
        $this->type = $type;
        $this->listId = $listId;
        $this->segmentId = $segmentId;
        $this->fields = $fields;
        if (count($properties) > 0) {
            $this->properties = $properties;
        }
    }
}