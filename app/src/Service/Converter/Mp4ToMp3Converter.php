<?php

namespace App\Service\Converter;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Audio\Mp3;

class Mp4ToMp3Converter implements Converter
{
    /**
     * @param string $destPath
     * @inheritDoc
     */
    public function convert(string $path, string $destPath): string
    {
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open($path);
        $audioFormat = new Mp3();
        $video->save($audioFormat, $destPath);
        $audio = $ffmpeg->open($destPath);

        return $audio->getPathfile();
    }
}
