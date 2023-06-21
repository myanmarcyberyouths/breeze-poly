<?php

namespace App\Services;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class MediaPathGenerator implements PathGenerator
{

    public function getPath(\Spatie\MediaLibrary\MediaCollections\Models\Media $media): string
    {
        return  md5($media->id) . '/';
    }

    public function getPathForConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media): string
    {
        return $this->getPath($media).'c/';
    }

    public function getPathForResponsiveImages(\Spatie\MediaLibrary\MediaCollections\Models\Media $media): string
    {
        return $this->getPath($media).'/cri/';
    }
}
