<?php

namespace App\Extensions\ExpertSender\Entity;
use App\Extensions\ExpertSender\BaseType;

/**
 * Class ListExportType
 * @package App\Extensions\ExpertSender\Entity
 * @property string $Type
 * @property integer $ListId
 * @property FieldType[] $Fields
 */
class ListExportType extends BaseType
{
    protected $params = array(
        'Type' => array(
            'type' => 'string',
            'xmlName' => 'Type',
        ),
        'ListId' => array(
            'type' => 'integer',
            'xmlName' => 'ListId',
        ),
        'SegmentId' => array(
            'type' => 'integer',
            'xmlName' => 'SegmentId',
        ),
        'Fields' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\FieldType',
            'xmlName' => '',
            'unbound' => true,
            'unboundTag' => 'Fields'
        ),
        'Properties' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\SegmentPropertyType',
            'xmlName' => '',
            'unbound' => true,
            'unboundTag' => 'Properties'
        ),
    );

    /**
     * @deprecated
     */
    public function __construct($type='', $listId=0, $segmentId=0, array $fields=[], array $properties=[])
    {
        $this->Type = $type;
        $this->ListId = $listId;
        $this->SegmentId = $segmentId;
        $this->Fields = $fields;
        if (count($properties) > 0) {
            $this->Properties = $properties;
        }
    }
}