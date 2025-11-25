<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadPhotoService
{
    private $fileRepository;
    private $slugger;

    public function __construct(SluggerInterface $slugger) {
        $this->slugger = $slugger;
    }

    public function setFileRepository(string $path): void {
        $this->fileRepository = $path;
    }

    public function upload(UploadedFile $file): string {
        dump($file->getPathname(), is_readable($file->getPathname()), $file->getError());
        $fileInitialName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileUpdatedName = $this->slugger->slug($fileInitialName);
        $fileFinalName = $fileUpdatedName.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->fileRepository, $fileFinalName);
        } catch (FileException $e) {
            throw new \Exception('Erreur lors du traitement de fichier ');
        }

        return $fileFinalName;
    }
}