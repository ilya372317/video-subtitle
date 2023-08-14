<?php

namespace App\Service\Converter;

class ConverterContext
{
    private Converter $converter;

    private function __construct(ConverterMode $mode)
    {
        $this->converter = match ($mode) {
            ConverterMode::MP4_TO_MP3 => new Mp4ToMp3Converter()
        };
    }

    public function convert(string $string, string $destPath): string
    {
        return $this->converter->convert($string, $destPath);
    }
}