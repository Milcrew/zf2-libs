<?php
namespace Zf2Libs\Filter\File;

use Zend\Filter\AbstractFilter;

class ExtensionExtractor extends AbstractFilter
{
    /**
     * @var string
     */
    protected $extension = '';

    protected $mimeTypeToExtension = array('video/x-flv' =>  'flv',
                                           'video/mp4'   =>  'mp4',
                                           'audio/mpeg'  =>  'mp3',
                                           'audio/ogg'   =>  'ogg',
                                           'image/jpeg'  =>  'jpg',
                                           'image/jpg'   =>  'jpg',
                                           'image/gif'   =>  'gif',
                                           'image/png'   =>  'png',
                                           'application/pdf' => 'pdf');

    /**
     * @param mixed $value
     * @param null $files
     * @return mixed
     */
    public function filter($value, $files = null)
    {
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($value);

        if (!array_key_exists($mimeType, $this->mimeTypeToExtension)) {
            return $value;
        }

        return $this->mimeTypeToExtension[$mimeType];
    }
}
