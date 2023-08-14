<?php

namespace App\Controller\Subtitle;

use App\Controller\BaseController;
use App\Service\Subtitle\VideoSubtitleService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/subtitle', name: 'subtitle_')]
class VideoSubtitleController extends BaseController
{
    public function __construct(
        private VideoSubtitleService $videoSubtitleService
    ) {
    }

    #[Route(path: '/upload-video', name: 'upload_raw_video', methods: 'POST')]
    public function uploadVideo(Request $request): JsonResponse
    {
        $video = $request->files->get('video');

        try {
            $video = $this->videoSubtitleService->uploadVideo();
            return $this->json([]);
        } catch (\Exception $exception) {
            return $this->jsonException($exception);
        }
    }

    #[Route(path: '/video/{videoId}/parts', name: 'video_parts_for_text_editing', methods: 'GET')]
    public function getRawVideoPartForTextEdit(int $videoId): JsonResponse
    {
        try {
            //TODO: will return response with videoParts and generating text for editing
            return $this->json([]);
        } catch (\Exception $exception) {
            return $this->jsonException($exception);
        }
    }

    #[Route(path: '/video/{videoId}/generatedText/{generatedTextId}', name: 'update_generated_text', methods: 'PUT')]
    public function updateGeneratedText(int $videoId, int $generatedTextId): JsonResponse
    {
        try {
            // TODO: will return updated video parts and related text, Before it will update text by user request data
            return $this->json([]);
        } catch (\Exception $exception) {
            return $this->jsonException($exception);
        }
    }
}
