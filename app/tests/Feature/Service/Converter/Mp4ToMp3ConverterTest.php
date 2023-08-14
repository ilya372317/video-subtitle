<?php

namespace App\Tests\Feature\Service\Converter;

use App\Service\Converter\Mp4ToMp3Converter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Filesystem\Filesystem;

class Mp4ToMp3ConverterTest extends KernelTestCase
{
    private const PATH_TO_VIDEO = '/var/www/project/storage/test/sample.mp4';

    private const PATH_TO_MP3 = '/var/www/project/storage/test/sample.mp3';

    private const URL_WITH_VIDEO = 'https://jsoncompare.org/LearningContainer/SampleFiles/Video/MP4/sample-mp4-file.mp4';

    private const COMMAND_TO_DOWNLOAD_VIDEO = 'curl ' . self::URL_WITH_VIDEO . ' --output ' . self::PATH_TO_VIDEO . ' --silent';

    protected function setUp(): void
    {
        $fileSystem = new Filesystem();
        if (!$fileSystem->exists(self::PATH_TO_VIDEO)) {
            system(self::COMMAND_TO_DOWNLOAD_VIDEO);
        }
    }

    protected function tearDown(): void
    {
        $filesystem = new Filesystem();
        $filesystem->remove(self::PATH_TO_MP3);
    }

    /**
     * @return void
     */
    public function testConvertMp4ToMp3(): void
    {
        // prepare
        $sut = new Mp4ToMp3Converter();

        // act
        $resultPath = $sut->convert(self::PATH_TO_VIDEO, self::PATH_TO_MP3);

        // assert
        $this->assertFileExists(self::PATH_TO_MP3);
        $this->assertEquals(self::PATH_TO_MP3, $resultPath);
    }
}