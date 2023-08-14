<?php

namespace App\Service\Subtitle;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface VideoSubtitleService
{
    public function uploadVideo(UploadedFile $video): Video;
}