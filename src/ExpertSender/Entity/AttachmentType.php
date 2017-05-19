<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Class Attachment
 * @package Zhme\ExpertSender\Entity
 * @property string $filename
 * @property string $mimeType
 * @property string $content
 */
class AttachmentType extends BaseType
{
    protected $params = array(
        'filename' => array(
            'type' => 'string',
            'xmlName' => 'FileName'
        ),
        'mimeType' => array(
            'type' => 'string',
            'xmlName' => 'MimeType',
        ),
        'content' => array(
            'type' => 'string',
            'xmlName' => 'Content',
        ),
    );

    public function __construct($file)
    {
        $this->makeFromFile($file);
    }

    private function checkFileExists($file)
    {
        if (!file_exists($file))
        {
            throw new \InvalidArgumentException('Bad path to file');
        }
    }

    public function makeFromFile($file)
    {
        $this->checkFileExists($file);

        $this->filename = basename($file);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $this->mimeType = finfo_file($finfo, $this->filename);
        $this->content = base64_encode($file);
    }

}