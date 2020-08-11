<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

class VideoFileDto
{
    /**
     * @Assert\File(
     *     maxSize = "60m",
     *     mimeTypes = {"video/mp4", "video/vnd.sealedmedia.softseal.mov"},
     *     mimeTypesMessage = "Please upload a valid video file (mp4, mov)"
     * )
     */
    private UploadedFile $uploadFile;

    /**
     * @return UploadedFile
     */
    public function getUploadFile(): UploadedFile
    {
        return $this->uploadFile;
    }

    /**
     * @param UploadedFile $uploadFile
     */
    public function setUploadFile(UploadedFile $uploadFile): void
    {
        $this->uploadFile = $uploadFile;
    }
}
