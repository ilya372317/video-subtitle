<?php

namespace App\Service\Subtitle;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class VideoSubtitleDefaultSevice implements VideoSubtitleService
{

    public function uploadVideo(UploadedFile $video): Video
    {
        return new Video();
    }
}