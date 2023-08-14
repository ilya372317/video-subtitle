<?php

namespace App\Service\Converter;

interface Converter
{
    /**
     * @param string $path input path
     * @param string $destPath
     * @return string output path
     */
    public function convert(string $path, string $destPath): string;
}