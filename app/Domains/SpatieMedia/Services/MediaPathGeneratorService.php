<?php

namespace App\Domains\SpatieMedia\Services;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class MediaPathGeneratorService implements PathGenerator
{

    public function getPath(Media $media): string
    {
        return md5($media->id) . '/';
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media) . 'c/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . '/cri/';
    }
}
